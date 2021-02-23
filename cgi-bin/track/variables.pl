#!/usr/bin/perl

##################################################
##    variables.pl (C)1999-00 Wes Blaylock      ##
##################################################
##    Wes Blaylock (http://www.cgitoolbox.com)  ##
##                                              ##
##    		Ultimate Ad Tracker             ##
##                                              ##
## COPYRIGHT NOTICE:				##
##						##
## Copyright 1999-00 Wes Blaylock.      	##
## All Rights Reserved.				##
##						##
## All file associated with the Ultimate Ad	##
## Tracker fall under this copyright notice.	##
##						##
## This program is not being distributed as	##
## freeware or shareware. Selling the code 	##
## (in whole or in part) for this program 	##
## without prior written consent is expressly 	##
## forbidden.  Obtain permission before 	##
## redistributing this program over the		##
## Internet or in any other medium.		##
##						##
## Modification to the code are permitted	##
## so long as the modified code is not sold	##
## or redistributed without prior written 	##
## consent. In all cases copyright and header	##
## must remain intact.				##
##						##
## All violaters will be prosecuted.		##
##						##
## This program is distributed "as is" and 	##
## without warranty of any kind, either express	##
## or implied.  (Some states do not allow the	##
## limitation or exclusion of liability for 	##
## incidental or consequential damages, so this	##
## notice may not apply to you.)  In no event 	##
## shall the liability of Wes Blaylock for any 	##
## damages, losses and/or causes of action 	##
## exceed the total amount paid by the user for	##
## this software.				##
##						##
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

use CGI::Carp qw(carpout);

use constant TOP => '/home/beaudes1/public_html/cgi-bin/track';

use constant HOME => 'http://www.beaudesertareaskipbinhire.com/cgi-bin/track';

$TOP = TOP;
$HOME = HOME;

BEGIN {
  open (STDERR, '>' . TOP . '/error.log');
  carpout(*STDERR);
  carp "Started\n";
}

use lib TOP;

$accts = TOP . '/accts.dat';
$datapath = TOP . '/data';
$pass_file = $datapath . "/adps.txt";


1;
