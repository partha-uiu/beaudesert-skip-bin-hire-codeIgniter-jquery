#!/usr/bin/perl

##################################################
##    io.msm (C)1999 Wes Blaylock               ##
##################################################
##    Wes Blaylock (http://www.muchsuccess.com) ##
##                                              ##
##              Ultimate Ad Tracker             ##
##                                              ##
## COPYRIGHT NOTICE:                            ##
##                                              ##
## Copyright 1999 Wes Blaylock.                 ##
## All Rights Reserved.                         ##
##                                              ##
## All file associated with the Ultimate Ad     ##
## Tracker fall under this copyright notice.    ##
##                                              ##
## This program is not being distributed as     ##
## freeware or shareware. Selling the code      ##
## (in whole or in part) for this program       ##
## without prior written consent is expressly   ##
## forbidden.  Obtain permission before         ##
## redistributing this program over the         ##
## Internet or in any other medium.             ##
##                                              ##
## Modification to the code are permitted       ##
## so long as the modified code is not sold     ##
## or redistributed without prior written       ##
## consent. In all cases copyright and header   ##
## must remain intact.                          ##
##                                              ##
## All violaters will be prosecuted.            ##
##                                              ##
## This program is distributed "as is" and      ##
## without warranty of any kind, either express ##
## or implied.  (Some states do not allow the   ##
## limitation or exclusion of liability for     ##
## incidental or consequential damages, so this ##
## notice may not apply to you.)  In no event   ##
## shall the liability of Wes Blaylock for any  ##
## damages, losses and/or causes of action      ##
## exceed the total amount paid by the user for ##
## this software.                               ##
##                                              ##
##                                              ##
## Usage:                                       ##
##                                              ##
##  require "io.msm";                           ##
##  &error("Error Message Here");               ##
##  &Header("Title","Page Title","Sub-Title");  ##
##  &Footer;                                    ##
##  &postparse;                                 ##
##  &getparse;                                  ##
##                                              ##
##################################################

require 'variables.pl'; 

require 'io.pl';                # Contains routines for 'reading and writing'
                                # the CGI connection.
#require 'cookie-lib.pl';       # Routines for manipulating browser 'cookies'

use constant DEBUGGING => 0;    # non-zero enables debugging code

use CGI;

open(ACT, "$accts") || &error("Could not open $accts($!)!");
@act = <ACT>;
close(ACT);
$ac = $ENV{'QUERY_STRING'};
unless ($ac) {
  &error('MISSING ACCOUNT');
}
  
  # Determine if the user's browser holds our cookie.

$q = new CGI;
my $Cookie = $q->cookie(-name=>"$ac"); 

if ( defined($Cookie) )
{
    $unique = 0;
}
else
{
    $unique = 1;
}

$referer = $ENV{'HTTP_REFERER'};
$forward = "";
foreach $line (@act) {
  chop($line);
  ($name,$notes,$url) = split(/\|/, $line);
  if ($name eq $ac) {
    $forward = $url;            
    last;
  }
}
  
open(DATA, "$datapath/$ac.dat") || 
  &error("Could not open $datapath/$ac.dat ($!)!");
@data = <DATA>;
close(DATA);
$found = 0;
foreach $line (@data) {
  chop($line);
  ($host,$num) = split(/\|/,$line);
  if ($host eq $referer) {
    $found = 1;
    last;
  }
}
open(DATA, ">$datapath/$ac.dat") || 
  &error("Could not open $datapath/$ac.dat ($!)!");
flock (DATA, 2) || &error("Could not lock $datapath/$ac.dat ($!)!");
if ($found eq "1") {
  foreach $line (@data) {
    chomp $line;
    ($host,$num) = split(/\|/,$line);
    if ($host eq $referer) {
      $num++;   
      print DATA "$host|$num\n";
    } else {
      print DATA "$line\n";
    }
  }
} else {
  foreach $line (@data) {
    print DATA "$line\n";
  }
  print DATA "$referer|1\n";
}
  close(DATA);

open (HITS, ">>$datapath/$ac.hit") ||
  &error("CANNOT OPEN $datapath/$ac.hit ($!)!");
flock (HITS, 2) || &error("Could not lock $datapath/$ac.hit ($!)!");
print HITS join('|', time, $referer, $unique), "\n";
close HITS;

if ($forward eq "") {
  &error("INVALID TRACKING URL");
} else {
  # Set the cookie.

    $c = $q->cookie(-name=>$ac,
                    -path=>'/', 
                    -expires=>'+1y', 
                    -value=>"1"
                    ); 
    print $q->header(-cookie=>$c, -Location=>"$forward");
    $q->end_html;                  
}
