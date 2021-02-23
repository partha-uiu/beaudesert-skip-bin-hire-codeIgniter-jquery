<?php /* Smarty version 2.3.0, created on 2004-02-23 13:45:50
         compiled from stats.tpl */ ?>
<?php $this->_load_plugins(array(
array('function', 'assign', 'stats.tpl', 56, false),)); ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include("_header.tpl", array());
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
                              <p align="left"><font face="Trebuchet MS" size="2"><u><?php echo $this->_tpl_vars['title']; ?>
</u></font></p>
                              <p align="left"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['description']; ?>
</font></p>
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
 <?php $this->_plugins['function']['assign'][0](array('var' => "num",'value' => "1"), $this); if($this->_extract) { extract($this->_tpl_vars); $this->_extract=false; } ?>
 <?php if (isset($this->_foreach["count"])) unset($this->_foreach["count"]);
$this->_foreach["count"]['name'] = "count";
$this->_foreach["count"]['total'] = count((array)$this->_tpl_vars['campaign']);
$this->_foreach["count"]['show'] = $this->_foreach["count"]['total'] > 0;
if ($this->_foreach["count"]['show']):
$this->_foreach["count"]['iteration'] = 0;
    foreach ((array)$this->_tpl_vars['campaign'] as $this->_tpl_vars['stat']):
        $this->_foreach["count"]['iteration']++;
        $this->_foreach["count"]['first'] = ($this->_foreach["count"]['iteration'] == 1);
        $this->_foreach["count"]['last']  = ($this->_foreach["count"]['iteration'] == $this->_foreach["count"]['total']);
?>  
							  <tr>
                                  <td width="881" align="center" colspan="7">
  <table border="0" cellpadding="0" cellspacing="0" width="429">
    <tr>
      <td width="117"><font size="2" face="Trebuchet MS"><u><a href="<?php echo $this->_tpl_vars['stat'][23]; ?>
" target="_blank">Test
        Subject <?php echo $this->_tpl_vars['num']; ?>
<?php $this->_plugins['function']['assign'][0](array('var' => "num",'value' => $num+1), $this); if($this->_extract) { extract($this->_tpl_vars); $this->_extract=false; } ?></a></u></font></td>
      <td width="5"></td>
      <td width="76" align="center"><font face="Trebuchet MS" size="2">Visit 1</font></td>
      <td width="4" align="center"></td>
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][1]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][11]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][2]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][12]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][3]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][13]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][4]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][14]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][5]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][15]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][6]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][16]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][7]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][17]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][8]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][18]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][9]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][19]; ?>
%</font></td>
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
      <td width="115" align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][10]; ?>
</font></td>
      <td width="5" align="center"></td>
      <td width="93" align="center">
        <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['stat'][20]; ?>
%</font></td>
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
      <td width="76" align="center" bgcolor="#EFEFEF"><font face="Trebuchet MS" size="2" <?php if (( $this->_tpl_vars['best'] == $this->_tpl_vars['num'] )): ?>color="#FF0000"<?php else: ?>color="black"<?php endif; ?>><u><b><?php echo $this->_tpl_vars['stat'][0]; ?>
</b></u></font></td>
      <td width="4" align="center" bgcolor="#EFEFEF">&nbsp;</td>
      <td width="115" align="center" bgcolor="#EFEFEF"><font face="Trebuchet MS" size="2" <?php if (( $this->_tpl_vars['best'] == $this->_tpl_vars['num'] )): ?>color="#FF0000"<?php else: ?>color="black"<?php endif; ?>><u><b><?php echo $this->_tpl_vars['stat'][21]; ?>
</b></u></font></td>
      <td width="5" align="center" bgcolor="#EFEFEF">&nbsp;</td>
      <td width="93" align="center" bgcolor="#EFEFEF"><u><b><font face="Trebuchet MS" size="2" <?php if (( $this->_tpl_vars['best'] == $this->_tpl_vars['num'] )): ?>color="#FF0000"<?php else: ?>color="black"<?php endif; ?>><u><b><?php echo $this->_tpl_vars['stat'][22]; ?>
%</font></b></u></td>
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
  <?php endforeach; endif; ?>
    <tr>
	  <form>
      <td width="427" colspan="7" height="20">
                              <p align="center">
							    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
">
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include("_footer.tpl", array());
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>