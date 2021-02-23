{include file="_header.tpl"}
                              </td>
                              <td width="12" valign="top"></td>
                              <td width="1" bgcolor="#000000" valign="top"><img border="0" src="invisible.gif" width="1" height="1"></td>
                              <td width="28" valign="top"></td>
                            <td width="429" valign="top">
                              <p align="left"><u><font face="Trebuchet MS" size="3"><b>Campaign
                              Statistics...</b></font></u></p>
                              <p align="left"><font face="Trebuchet MS" size="2">Listed
                              below are the test results / campaign statistics
                              for the following campaign...</font></p>
                              <blockquote>
                              <p align="left"><font face="Trebuchet MS" size="2"><u>{$title}</u></font></p>
                              <p align="left"><font face="Trebuchet MS" size="2">{$description}</font></p>
                              </blockquote>
                              <p align="left"><font face="Trebuchet MS" size="2">You
                              will find an explanation of these statistics
                              listed towards the bottom of the page. You can
                              also reset your statistics back to zero if you've
                              been testing your campaign or would simply like to
                              start it over by clicking the &quot;Reset Your Statistics&quot;
                              button beneath the charts below.</font></p>
                              </center></center>
                            <div align="center">
                              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                  <td width="881" align="center" colspan="7">
                                    <p align="left"><font face="Trebuchet MS" size="2" color="#000080"><u>Campaign</u></font><font color="#000080"><font face="Trebuchet MS" size="2"><u>
                              Statistics:</u></font></font></td>
                                </tr>
                            <center><center>
                                <tr>
                                  <td width="881" align="center" colspan="7" height="30"></td>
                                </tr>
                                <tr>
                                  <td width="288" align="center"></td>
                                  <td width="17" align="center"></td>
                                  <td width="139" align="center"><u><font size="2" face="Trebuchet MS"><b>Unique
                                    Visitors</b></font></u></td>
                                  <td width="12" align="center"></td>
                                  <td width="254" align="center"><font face="Trebuchet MS" size="2"><b><u>Actual
                                    Results Acquired
                                    </u></b></font></td>
                                  <td width="17" align="center"></td>
                                  <td width="154" align="center"><u><font size="2" face="Trebuchet MS"><b>Conversion
                                    Ratio</b></font></u></td>
                                </tr>
                                <tr>
                                  <td width="881" colspan="7" height="20"></td>
                                </tr>
                              <tr>
                                <td width="881" colspan="7" height="20">
                                  <hr size="1" color="#000080">
                                </td>
                              </tr>
 {assign var="num" value=1}
 {foreach name=count item=stat from=$campaign}  
							  <tr>
                                  <td width="881" align="center" colspan="7">
  <table border="0" cellpadding="0" cellspacing="0" width="429">
    <tr>
      <td width="117"><font size="2" face="Trebuchet MS"><u><a href="{$stat[23]}" target="_blank">Test
        Subject {$num}{assign var="num" value=$num+1}</a></u></font></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 1</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[1]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center"><font face="Trebuchet MS" size="2">{$stat[11]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 2</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[2]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center"><font face="Trebuchet MS" size="2">{$stat[12]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 3</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[3]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2">{$stat[13]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 4</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[4]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2">{$stat[14]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 5</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[5]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2">{$stat[15]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 6</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[6]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2">{$stat[16]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 7</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[7]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2">{$stat[17]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 8</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[8]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2">{$stat[18]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 9</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[9]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2">{$stat[19]}%</font></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 10</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2">{$stat[10]}</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2">{$stat[20]}%</font></td>
    </tr>
    <tr>
      <td width="427" colspan="7"></td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="301" align="center" colspan="5">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="117"></td>
      <td width="5"></td>
      <td width="76" align="center" bgcolor="#EFEFEF"><font face="Trebuchet MS" size="2" {if ($best == $num)}color="#FF0000"{else}color="black"{/if}><u><b>{$stat[0]}</b></u></font></td>
      <td width="4" align="center" bgcolor="#EFEFEF">&nbsp;</td>
      <td width="115" align="center" bgcolor="#EFEFEF"><font face="Trebuchet MS" size="2" {if ($best == $num)}color="#FF0000"{else}color="black"{/if}><u><b>{$stat[21]}</b></u></font></td>
      <td width="5" align="center" bgcolor="#EFEFEF">&nbsp;</td>
      <td width="93" align="center" bgcolor="#EFEFEF"><u><b><font face="Trebuchet MS" size="2" {if ($best == $num)}color="#FF0000"{else}color="black"{/if}><u><b>{$stat[22]}%</font></b></u></td>
    </tr>
    <tr>
      <td width="427" colspan="7">
        <hr size="1" color="#000080">
      </td>
    </tr>
    <tr>
      <td width="427" colspan="7" height="20"></td>
    </tr>
  </table>
    </td></tr>
  {/foreach}
    <tr>
	  <form>
      <td width="427" colspan="7" height="20">
                              <p align="center">
							    <input type="hidden" name="id" value="{$id}">
							    <input type="hidden" name="reset" value="1">
                                <input type="submit" value="Reset Your Statistics" name="B1" style="font-family: Verdana; font-size: 8pt; border: 1 solid #000000"></p>
                              <p align="center"><font face="Trebuchet MS" size="2">Warning:
                              The above action cannot be undone.</font></p>
                              <p align="left"><font face="Trebuchet MS" size="2" color="#000080"><u>Notes
                              About These Statistics:</u></font></p>
                              <ul>
                                <li>
                                  <p align="left"><font face="Trebuchet MS" size="2">The
                                  &quot;Unique Visitors&quot; column shows the
                                  total number of unique visitors sent to the
                                  respective test subject to date. If you have
                                  set a test limitation these will be identical
                                  for each subject upon the conclusion of this
                                  campaign.</font></li>
                                <li>
                                  <p align="left"><font face="Trebuchet MS" size="2">The
                                  &quot;Visit X&quot; records show you on which
                                  visit your desired result occurred. That is,
                                  if a visitor returned 3 times before they
                                  performed the desired action, their result is recorded
                                  in the &quot;Visit 3&quot; column.</font></li>
                                <li>
                                  <p align="left"><font face="Trebuchet MS" size="2">The
                                  &quot;Actual Results Acquired&quot; column
                                  shows you the number of actual results acquired
                                  as a result of this test, both per visit (see
                                  above) and as a total at the bottom.</font></li>
                                <li>
                                  <p align="left"><font face="Trebuchet MS" size="2">The
                                  conversion ratio shows you the conversion
                                  ratio of unique visitors exposed to this test
                                  to actual results acquired as a percentage to
                                  3 decimal places. This is also shown per visit
                                  and as a total at the bottom.</font></li>
                                <li>
                                  <p align="left"><font face="Trebuchet MS" size="2">The
                                  highest performing test subject (the one with
                                  the greatest conversion ratio) has their total
                                  figures highlighted in red.</font></li>
                                <li>
                                  <p align="left"><font face="Trebuchet MS" size="2">You
                                  can click on the &quot;Test Subject X&quot;
                                  hyperlinks to be taken to the respective page
                                  you've been testing in a new window for ease
                                  of reference.</font></li>
                              </ul>
      </td>
	  </form>
    </tr>
  </table>
</div>
                              </center></center>
                              <p align="right"><font face="Trebuchet MS" size="2"><a href="campaign-management.php">Campaign
                              Management Area</a></font></p>
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" colspan="5" height="40">
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" colspan="5">
{include file="_footer.tpl"}