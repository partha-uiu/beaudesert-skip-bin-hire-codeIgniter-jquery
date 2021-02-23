#!/usr/bin/perl  

##################################################
##    admin.cgi (C)1999-00 Wes Blaylock         ##
##################################################
##    Wes Blaylock (http://www.cgitoolbox.com)  ##
##                                              ##
##    		Ultimate Ad Tracker             ##
##                                              ##
## COPYRIGHT NOTICE:				##
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
				# Paths defined for external files
require 'variables.pl';

require 'io.pl';		# Contains routines for 'reading and writing'
				# the CGI connection.
use constant DEBUGGING => 0;	# Enable debug output

use CGI::Carp qw(carpout);
carpout(*STDERR)
  if DEBUGGING;

$cgiurl = 'admin.cgi';
&postparse;			# Parse the input parameters

$action = $FORM{'action'};

				# If there's no password file, display the
				# initial admin form and exit.
if(!-e "$pass_file" && !$action && !$FORM{'pass'}){ &setup; exit; }

				# If the script was invoked from the initial
				# admin form, save the admin password and exit.
 if($action eq "setpass"){ &setpass; exit;}

				# Handle the various kinds of forms.
if($action eq "addfrm") { &addfrm('add'); }
elsif($action eq "add") { &add; }
elsif($action eq "editfrm") { &addfrm('edit', $FORM{name}); }
elsif($action eq "edit") { &edit; }
elsif($action eq "rm") { &rm; }
elsif($action eq "rset") { &rset; }
elsif($action eq "stats") { require 'stats.pl'; &stats; }
#else { &main; }
elsif($action eq "checkpass") { &checkpass; }
else { &login; }

#-*-End of main script -#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub login {
&Header("Tracking System","Tracking System","Login Area");	
print qq|Welcome to the tracking system login. Please enter your password below:<p>
<form action="$cgiurl" method="POST"><center><table borders="0" width="80%" align="center">
<tr><td align="right"><font face="Arial">Password: </font></td>
<td><input type="password" name="pass">
<input type="submit" name="submit" value="Login">
<input type="hidden" name="action" value="checkpass"></td></tr></table></center></form>|;
&Footer;	
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub checkpass {

$pass = $FORM{'pass'};
&error('No Password Was Provided') unless $pass;
	
open(PASS,"$pass_file") || &error("Can't open $pass_file ($!)!");
$admin_pass = <PASS>;
close(PASS);
	
$entered_pass = crypt($pass,"aa");
	
unless($entered_pass eq "$admin_pass") {
	&error('The Password Entered Was Incorrect');
}
	
&main;	
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub main {
&LoadAccts;
&Header("Tracking System","Tracking System","Admin Area");
print qq|Welcome to the tracking system admin area. Please select from below:<p>
<center><table borders="0" width="80%" align="center">
<tr><td colspan=5 valign=bottom><hr noshade color=#800000></td></tr>|;
foreach $line (sort @accts) {
	chop($line);
	($name,$notes,$url) = split(/\|/,$line);
	print qq|<tr valign=top><td><font face="Arial" color=#800000><u><a href="tracker.cgi?$name">$name</a></u></font>
<p>
</td>
<td align=center valign=middle>
<form action="$cgiurl" method="POST">

<input type="hidden" name="name" value="$name">
<input type="hidden" name="action" value="stats">
<input type="submit" value="View Stats">

</form>
</td>

<td align=center valign=middle>
<form action="$cgiurl" method="POST">

<input type="hidden" name="name" value="$name">
<input type="hidden" name="action" value="rset">
<input type="submit" value="Reset Stats"
>
</form>
</td>

<td align=center valign=middle>
<form action="$cgiurl" method="POST">

<input type="hidden" name="name" value="$name">
<input type="hidden" name="action" value="editfrm">
<input type="submit" value="Edit Account">

</form>
</td>

<td align=center valign=middle>
<form action="$cgiurl" method="POST">

<input type="hidden" name="name" value="$name">
<input type="hidden" name="action" value="rm">
<input type="submit" value="Remove Account">

</form>
</td>

</tr>
<tr><td colspan=5 valign=bottom>
<small><font face="Arial">$notes<br></font></small>
<small><font face="Arial">$HOME/tracker.cgi?$name<br></font></small></td></tr>
<tr><td colspan=5 valign=bottom><hr noshade color=#800000></td></tr>|;
}
print qq|</table></center>
<center>
<form action="$cgiurl" method="POST">
<input type="hidden" name="action" value="addfrm">
<input type="submit" value="Make a New Link Tracker">
</form></center>|;
&Footer;
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub addfrm {
($action, $account) = @_;

carp '$action = ' . $action
  if DEBUGGING;
carp '$account = ' . $account
  if DEBUGGING;
if ($action eq 'add') {
  $note = '';
  $ur = 'http://';
}
else {
  &LoadAccts;
  ($name, $note, $ur) = split(/\|/, (grep(/^$account/, @accts))[0]);
  carp '$name = ' . $name
    if DEBUGGING;
  carp '$note = ' . $note
    if DEBUGGING;
  carp '$ur = ' . $ur
    if DEBUGGING;

  unless ($name eq $account)
  {
    &error("CANNOT EDIT $account");
  }
}

&Header("Tracking System","Tracking System",
	$action eq 'add' ? "Add an Account" : 'Edit an Account');
print qq|
Please fill out the form below:<p>
<center>
<form method="POST" action="$cgiurl">
<table borders="0" width=50%">
<tr><td>Link_Tracker_Name:</td><td>|;

print $action eq 'add' ?
  q|<input type="text" name="handle" size="20">| :
  qq|<input type="hidden" name="handle" value="$account"> $account|;

print qq|</td></tr>
<tr><td>What's it for?:</td><td><input type="text" name="notes" size="20" value="$note">
</td></tr>
<tr><td>Target URL:</td><td><input type="text" name="url" size="20" value="$ur">
</td></tr>
<tr><td colspan="2"><input type="submit" value="Save this Account"></td></tr>
<input type="hidden" name="action" value="$action">
</table></form></center>
|;
&Footer;
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub add {
$handle = $FORM{'handle'};
$notes = $FORM{'notes'};
$url = $FORM{'url'};
&LoadAccts;
foreach $line (@accts) {
	chop($line);
	($name,$note,$ur) = split(/\|/,$line);
	if($name eq $handle) { &error("Account $handle already exists!"); }
}
open(ACCTS, ">>$accts") || &error("Could not open $accts ($!)!");
flock (ACCTS, 2) || &error("Could not lock $accts ($!)!");
print ACCTS "$handle|$notes|$url\n";
close(ACCTS);
$tmp = `touch $datapath/$handle.dat`;
&Header("Tracking System","Tracking System","Account Added");
$button="<a href=\"admin.cgi\">Return to Tracking System Admin Area</a>";
print qq|The requested account has been added to the system.<br>$button |;
&Footer;
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub rm {
$handle = $FORM{'name'};
&LoadAccts;
open(ACCTS, ">$accts") || &error("Could not open $accts($!)!");
flock (ACCTS, 2) || &error ("Coult not lock $accts ($!)!");
foreach $line (@accts) {
	chop($line);
	($name,$notes,$url) = split(/\|/,$line);
	unless($name eq $handle) {
		print ACCTS "$line\n";
	}
}
$tmp = `/bin/rm $datapath/$handle.dat`;
&Header("Tracking System","Tracking System","Account Removed");
print qq|The requested account has been removed from the system.<br><a href=\"admin.cgi\">Return to Tracking System Admin Area</a>|;
&Footer;
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub edit {
$handle = $FORM{'handle'};
carp '$handle = ' . $handle
  if DEBUGGING;
&LoadAccts;
open(ACCTS, ">$accts") || &error("Could not open $accts($!)!");
flock (ACCTS, 2) || &error("Could not lock $accts ($!)!");
foreach $line (@accts) {
  ($name,$notes,$url) = split(/\|/,$line);
  if ($name eq $handle) {
    print ACCTS join('|', $handle, $FORM{notes}, $FORM{url}), "\n";
  }
  else {
    print ACCTS "$line";
  }
}
&Header("Tracking System","Tracking System","Account Updated");
print qq|The requested account has been updated.<br><a href=\"admin.cgi\">Return to Tracking System Admin Area</a>|;
&Footer;
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub rset {
$handle = $FORM{'name'};
open(DATA, ">$datapath/$handle.dat") || &error("Could not open $datapath/$handle.dat ($!)!");
flock (DATA, 2) || &error("Could not lock $datapath/$handle.dat ($!)!");
print DATA "";
close(DATA);

open(DATA, ">$datapath/$handle.hit") || &error("Could not open $datapath/$handle.hit ($!)!");
flock (DATA, 2) || &error("Could not lock $datapath/$handle.hit ($!)!");
print DATA "";
close(DATA);
&Header("Tracking System","Tracking System","Account Reset");
print qq|The requested account has been Reset.<br><a href=\"admin.cgi\">Return to Tracking System Admin Area</a>|;
&Footer;
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub setup {
&Header("Tracking System","Tracking System","Login Area");	
print qq|Welcome to the tracking system. Please set your admin password below:<p>
<form action="$cgiurl" method="POST"><center><table borders="0" width="80%" align="center">
<tr><td align="right"><font face="Arial">Password: </font></td>
<td><input type="password" name="new_pass"></td></tr>
<tr><td align="right"><font face="Arial">Confirm: </font></td>
<td><input type="password" name="confirm"></td></tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Set Password">
<input type="hidden" name="action" value="setpass"></td></tr></table></center></form>|;
&Footer;

}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub setpass {
$pass = $FORM{'new_pass'};
$confirm_pass = $FORM{'confirm'};
	
&error('It Appears You Have Forgotten To Fill In One Of The Fields.') if(!$pass || !$confirm_pass);
	
if($pass eq "$confirm_pass"){
		
	$admin_pass = crypt($pass,"aa");

	open(PASS,">$pass_file") || &error("Cant open $pass_file($!)!");
	print PASS "$admin_pass";
	close(PASS);	
	
	&main;
}
else {
	&error('Passwords did not match');
}	

}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub LoadAccts
{
  open(ACCTS, "$accts") || &error("Could not open $accts($!)!");
  flock (ACCTS, 1) || &error("Could not lock $accts ($!)!");
  @accts = <ACCTS>;
  close(ACCTS);
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-

sub FmtDate
{
  my $date = shift;
  my $fmtDate = ('Jan','Feb','Mar','Apr','May','Jun',
		 'Jul','Aug','Sep','Oct','Nov','Dec')[substr($date,4,2)]
		. ' ' . substr($date,0,4);
  if (length($date) > 6)
  {
    $fmtDate = substr($date,6,2) . ' ' . $fmtDate;
  }
  return $fmtDate;
}
#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-
