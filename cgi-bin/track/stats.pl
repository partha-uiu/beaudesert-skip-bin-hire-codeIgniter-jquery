##################################################
##    stats.pl (C)1999-00 Wes Blaylock          ##
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


sub stats {
  use constant DEBUGGING => 0;	# Enables debugging output
  use constant DAY_TABLE_LIMIT => 90; # Nbr days per table
  use constant DAY_PLOT_LIMIT => 30; # Nbr days per plot
  use constant LIMIT =>		# Max limits
    DAY_TABLE_LIMIT > DAY_PLOT_LIMIT ?
      DAY_TABLE_LIMIT : DAY_PLOT_LIMIT;
  use constant ONE_DAY => 60 * 60 * 24; # Nbr seconds in a day
  use constant UNIQ_HITS_GIF => '/cgi-bin/track/uniq.gif'; # Gif to use for unique hits
  use constant TOTAL_HITS_GIF => '/cgi-bin/track/all.gif'; # Gif to use for total hits
  use constant RATIO_FMT => '%3.1f%%'; # Format to use when displaying hit ratio
  
  $ac = $FORM{'name'};
  open(IDF, "$datapath/$ac.dat") || 
    &error("Could not open $datapath/$ac.dat($!)!");
  flock (IDF, 1) || &error("Could not lock $datapath/$ac.dat ($!)!") ;
  @data = <IDF>;
  close(IDF);
  &Header("Tracking System","Tracking System","Stats For $ac");
  print qq|Below are the stats for $ac:<p>
<center><table borders="0" width="80%">
<tr><td><b>Referring URLs</b></td><td><b>Total Visits</b></td></tr>|;
  foreach $ref (@data) {
    chop($ref);
    ($url,$hits) = split(/\|/,$ref);
    if ($url) {
      print qq|<tr><td><a href="$url">$url</a></td>|;
    } else {
      print q|<tr><td>--unknown--</td>|;
    }
    print qq|<td>$hits</td></tr>
|;
  }
  print qq|</table></center>|;
  
  # Retrieve the hit statistics for this account.
  open (HITS, "$datapath/$ac.hit") || 
    &error("Could not open $datapath/$ac.hit ($!)!");
  flock (HITS, 1) ||
    &error("Coult not lock $datapath/$ac.hit ($!)!");
  my @today = localtime;
  my $now = time;
  carp $now
    if DEBUGGING;
  my @hourLabels = map(sprintf('%02d:00-%02d:59', $_, $_), 0..23);
  while (<HITS>) {
    chomp;
    ($time, $url, $unique) = split /\|/;
    carp qq!\$time = '$time'!
      if DEBUGGING;
    $url = '--unknown--' unless $url;
    carp qq!\$url = '$url'!
      if DEBUGGING;
    carp qq!\$unique = '$unique'!
      if DEBUGGING;
    $unique = '0' unless $unique;
    ($hour, $mday, $mon, $year, $yday) = (localtime($time))[2..5, 7];
    $theMonth = sprintf('%4d%02d', $year+1900, $mon);
    unless (defined($hitURL{$url})) {
      carp $url
	if DEBUGGING;
    }
    
    # Count the current hit in each of the buckets:
    #	%hitURL: hits by URL
    #	%hitUnique: unique hits by URL
    #	%hitURLMo: hits by URL and month (hash of hashes)
    #	%hitMonth: hits by month
    #     %hitMonthUniq: unique hits by month
    #     %hitDay: hits by day, limited to LIMIT
    #     %hitDayUniq: unique hits by day, limited to LIMIT
    #	%hitHour: hits by hour of the day, limited to LIMIT
    $hitURL{$url}++;
    $hitUnique{$url}++ if $unique == 1;
    unless (defined($hitURLMo{$url})) {
      $hitURLMo{$url} = {};
    }
    $hitURLMo{$url}->{$theMonth}++;
    $hitMonth{$theMonth}++;
    $hitMonthUniq{$theMonth}++ if $unique == 1;
    
    if (			# Determine if day within LIMIT days
	($year == $today[5] &&
	 $today[7] - $yday <= LIMIT) ||
	($year + 1 == $today[5] && 
	 $yday - 365 - $today[7] <= LIMIT)
       ) {
      $hitDay{ sprintf('%4d%02d%02d', $year+1900, $mon, $mday) }++;
      $hitDayUniq{ sprintf('%4d%02d%02d', $year+1900, $mon, $mday) }++
	if $unique == 1;
      $hitHour{ $hourLabels[$hour] }++;
      $hitHourUniq{ $hourLabels[$hour] }++
	if $unique == 1;
    }
    if ($time > $now - ONE_DAY) {
      $hit24{ $hourLabels[$hour] }++;
      $hit24Uniq{ $hourLabels[$hour] }++
	if $unique == 1;
    }
  }				# while <HITS>
  close HITS;
  
  ####################
  # Format the hit statistics.
  
  # Fill in missing counters.
  map {$hit24{$_} = 0 unless defined $hit24{$_};
       $hit24Uniq{$_} = 0 unless defined $hit24Uniq{$_};}
    @hourLabels;
  
  # Last 24 hours graph is always produced.
  
  print q|<p><hr><table border=2 borderColor=#800000 cellspacing=1>
<caption> Last 24 hours</caption>
<tr valign='bottom'>
 <th>Time</th>
 <th>Total<br>Visits</th>
 <th>Unique<br>Visitors</th>
 <th>% Unique</th>
</tr>
|;
  @hourGraphLabels = $today[2] ?
    @hourLabels[($today[2]+1 % 24)..23, 0..$today[2]] :
    @hourLabels;

  # Find max for graph scaling.
  my $max = 0;
  foreach (keys %hit24) {
    $max = $hit24{$_}
      if $hit24{$_} > $max;
  }
  
  foreach (@hourGraphLabels) {
    my $ratio = sprintf(RATIO_FMT, 
			$hit24{$_} ?
			100 * $hit24Uniq{$_} / $hit24{$_}
			: 0);
    my $hitWidth = $max ? sprintf('<img src="all.gif" height=10 width=%d>',
				  int(400*($hit24{$_}-$hit24Uniq{$_})/$max))
      : '';
    my $uniqWidth = $max ? sprintf('<img src="uniq.gif" height=10 width=%d>',
				   int(400*$hit24Uniq{$_}/$max))
      : '';
    print qq!
<tr>
 <td>$_</td>
 <td align='right'>$hit24{$_}</td>
 <td align='right'>$hit24Uniq{$_}</td>
 <td align='right'>$ratio</td>
 <td>${uniqWidth}${hitWidth}</td>
</tr>
!;
  }
  print q!</table>
!;
  
  if (%hitURL) {
    print q|<p><hr><center>
<table border=2 borderColor=#800000 cellSpacing=1>
<tr valign='bottom'>
 <th>Referring URLs</th>
 <th>Total<br>Visits</th>
 <th>Unique<br>Visitors</th>
 <th>% Unique</th>
 <th colspan=2>Month</th>
</tr>
|;
    foreach $url (sort keys %hitURL) {
      my $ratio = sprintf(RATIO_FMT, 
			  $hitURL{$url} ?
			  100 * $hitUnique{$url} / $hitURL{$url}
			  : 0);
      print q!<tr>!,
	qq!<td valign='top'>$url</td>\n!, # URL
	q!<td valign='top' align='right'>!, # Total
	$hitURL{$url} || '0',
	qq!</td>\n!,
	qq!<td valign='top' align='right'>!, # Total Unique
	$hitUnique{$url} || '0',
	qq!</td>\n!,
	qq!<td valign='top' align='right'>$ratio</td>\n!,	# Ratio
	qq!<td valign='top'>\n!, # Month
	join('<br>',
	   map(&FmtDate($_), sort keys %{$hitURLMo{$url}})),
	qq!</td>\n!,
	q!<td valign='top' align='right'>!, # Subtotal
	join('<br>',
	     map($hitURLMo{$url}->{$_} || '0', 
		 sort keys %{$hitURLMo{$url}})),
	qq!</td></tr>\n!;
    }
    print q!</table>!;
  }
  
  if (%hitMonth) {
    # Determine max hit count for graph scaling.
    $max = 0;
    foreach ((reverse sort keys %hitMonth)[0..3]) {
      last unless defined($hitMonth{$_});
      $max = $hitMonth{$_}
	if $hitMonth{$_} > $max;
    }
    
    print q|<p><hr>
<table border=2 borderColor=#800000 cellSpacing=1>
<tr>
 <th>Month</th>
 <th>Total<br>Visits</th>
 <th>Unique<br>Visitors</th>
 <th>% Unique</th>
</tr>
|;
    foreach (reverse sort keys %hitMonth) {
      carp $_
	if DEBUGGING;
      my $fmtDate = &FmtDate($_);
      my $nbr = $hitMonth{$_} || '0';
      my $nbrUniq = $hitMonthUniq{$_} || '0';
      my $ratio = sprintf(RATIO_FMT, 
			  $nbr ?
			  100 * $nbrUniq / $nbr
			  : 0);
      # Graph the data.
      my $hitWidth = $max ? 
	sprintf('<img src="all.gif" height=10 width=%d>',
		int(400*($hitMonth{$_}-$hitMonthUniq{$_})/$max))
	  : '';
      my $uniqWidth = $max ? 
	sprintf('<img src="uniq.gif" height=10 width=%d>',
		int(400*$hitMonthUniq{$_}/$max))
	  : '';

      print qq!
<tr>
 <td align='left'> $fmtDate</td>
 <td align='right'> $nbr</td>
 <td align='right'> $nbrUniq</td>
 <td align='right'>$ratio</td>
 <td>${uniqWidth}${hitWidth}</td>
</tr>
!;
    }
    print q!
</table><p>
!;
  }
  
  if (%hitDay) {

    # Determine max for graph scaling.
    $max = 0;
    foreach ((reverse sort keys %hitDay)[0..LIMIT-1]) {
      last unless defined($hitDay{$_});
      $max = $hitDay{$_}
	if $hitDay{$_} > $max;
    }
    
    print qq|<p><hr>
<table border=2 borderColor=#800000 cellSpacing=1>
<caption>Limited to last @{[DAY_TABLE_LIMIT]} days</caption>
<tr>
 <th>Day</th>
 <th>Total<br>Visits</th>
 <th>Unique<br>Visitors</th>
 <th>% Unique</th>
</tr>
|;
    foreach ((reverse sort keys %hitDay)[0..DAY_TABLE_LIMIT-1]) {
      carp $_
	if DEBUGGING;
      last unless defined($hitDay{$_});
      my $fmtDate = &FmtDate($_);
      my $ratio = sprintf(RATIO_FMT, 
			  $hitDay{$_} ?
			  100 * $hitDayUniq{$_} / $hitDay{$_}
			  : 0);
      # Graph the data.
      my $hitWidth = $max ? 
	sprintf('<img src="all.gif" height=10 width=%d>',
		int(400*($hitDay{$_}-$hitDayUniq{$_})/$max))
	  : '';
      my $uniqWidth = $max ? 
	sprintf('<img src="uniq.gif" height=10 width=%d>',
		int(400*$hitDayUniq{$_}/$max))
	  : '';

      print qq!
<tr valign='bottom'>
 <td align='left'> $fmtDate</td>
 <td align='right'>$hitDay{$_}</td>
 <td align='right'>$hitDayUniq{$_}</td>
 <td align='right'>$ratio</td>
 <td>${uniqWidth}${hitWidth}</td>
</tr>
!;
    }
    print q!</table><p>
!;
  }
  
if (%hitHour) {

    # Find max for graph scaling.
    $max = 0;
    foreach (sort keys %hitHour) {
      $max = $hitHour{$_}
	if $hitHour{$_} > $max;
    }
    
    print qq!<p><hr>
<table border=2 borderColor=#800000 cellSpacing=1>
<caption>Limited to last @{[DAY_TABLE_LIMIT]} days</caption>
<tr>
 <th>Hour</th>
 <th>Total<br>Visits</th>
 <th>Unique<br>Visitors</th>
 <th>% Unique</th>
</tr>
!;

    foreach (sort keys %hitHour) {

      my $ratio = sprintf(RATIO_FMT, 
			  $hitHour{$_} ?
			  100 * $hitHourUniq{$_} / $hitHour{$_}
			  : 0);
      # Graph the data.
      my $hitWidth = $max ? 
	sprintf('<img src="all.gif" height=10 width=%d>',
		int(400*($hitHour{$_}-$hitHourUniq{$_})/$max))
	  : '';
      my $uniqWidth = $max ? 
	sprintf('<img src="uniq.gif" height=10 width=%d>',
		int(400*$hitHourUniq{$_}/$max))
	  : '';

      print qq!
<tr>
 <td>$_</td>
 <td>$hitHour{$_}</td>
 <td>$hitHourUniq{$_}</td>
 <td>$ratio</td>
 <td>${uniqWidth}${hitWidth}</td>
</tr>
!;
    }
    print q!
</table><p>
!;
  }

  &Footer;
}

#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-#-*-
  
1;
