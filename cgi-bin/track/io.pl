#!/usr/bin/perl

##################################################
##    io.msm (C)1999-00 Wes Blaylock            ##
##################################################
##    Wes Blaylock (http://www.cgitoolbox.com)  ##
##                                              ##
##    		Ultimate Ad Tracker             ##
##                                              ##
## COPYRIGH NOTICE:				##
##						##
## Copyright 1999-00 Wes Blaylock.		##
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

sub Header {
	($page,$title,$header) = @_;
	print "Content-type: text/html\n\n";
	print "<html><head><title>$page</title></head>\n";
	print "<body link=\"#800000\" vlink=\"#FF0000\">\n";
	print "<table border=\"0\" width=\"100%\" cellpadding=\"3\"><tr>\n";
	print "<td width=\"100%\" bgcolor=\"#800000\" height=\"25\" valign=\"middle\">\n";
	print "<font face=\"Arial\" color=\"#FFFFFF\">$title - $header</font>\n";
	print "</td></tr><tr><td width=\"100%\"><p><br><small><font face=\"Arial\">\n";
}

sub Footer {
	print "</font></small>\n";
	print "</td></tr><tr align=\"center\">\n";
	print "<td width=\"100%\" bgcolor=\"#800000\" height=\"25\" valign=\"middle\" align=\"right\">\n";
	print "<small><font face=\"Arial\" color=\"#FFFFFF\">© Net Wealth Group</font></small>\n";
	print "</td></tr></table><center>Link tracking program<BR>maintained with<BR><a href=\"http://www.netwealthgroup.com\">Net Wealth Group</a></center></body></html>\n";
	exit;
}

sub error
{
print "Content-type: text/html\n\n";
print "<html><head><title>Program Error</title></head>\n";
print "<body link=\"#800000\" vlink=\"#FF0000\">\n";
print "<table border=\"0\" width=\"100%\" cellpadding=\"3\"><tr>\n";
print "<td width=\"100%\" bgcolor=\"#800000\" height=\"25\" valign=\"middle\">\n";
print "<font face=\"Arial\" color=\"#FFFFFF\">Program Error</font>\n";
print "</td></tr><tr><td width=\"100%\"><blockquote><p><br><small><font face=\"Arial\">\n";
print "Your request could not be processed. This was because:\n";
print "<br><br><b> $_[0]</b></font></small></p>\n";
print "<a href=\"admin.cgi\">Return to Tracking System Admin Area</a>\n";
print "</td></tr><tr align=\"center\">\n";
print "<td width=\"100%\" bgcolor=\"#800000\" height=\"25\" valign=\"middle\" align=\"right\">\n";
print "<small><font face=\"Arial\" color=\"#FFFFFF\">© Net Wealth Group</font></small>\n";
print "</td></tr></table><center>Link tracking program<BR>maintained with<BR><a href=\"http://www.netwealthgroup.com\">Net Wealth Group</a></center></body></html>\n";
exit(1);
}

sub postparse
{
read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
@sets = split(/&/, $buffer);
foreach $set (@sets)
{
($name, $value) = split(/=/, $set);
$value =~ tr/+/ /;
$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
$value =~ s/^( +)//;
$value =~ s/( +)$//;
$value =~ s/(\t|\r|\n)//g;
$FORM{$name} = $value;
}
}

sub getparse
{
$FORM = $ENV{'QUERY_STRING'};
@FORM = split(/&/,$FORM);
foreach $i (0 .. $#FORM) {
	$FORM[$i] =~ s/\+/ /g;
	$FORM =~ s/%(..)/pack("c",hex($1))/ge;
	($name, $value) = split(/=/,$FORM[$i],2);
	$FORM{$name} = $value;
}
}
1;
