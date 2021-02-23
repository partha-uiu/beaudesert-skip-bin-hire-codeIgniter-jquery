<?php /* Smarty version 2.3.0, created on 2004-02-23 13:23:33
         compiled from campaign.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include("_header.tpl", array());
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                              </td>
                              <td width="12" valign="top"></td>
                              <td width="1" bgcolor="#000000" valign="top"><img border="0" src="invisible.gif" width="1" height="1"></td>
                              <td width="28" valign="top"></td>
                            <td width="429" valign="top">
                              <p align="left"><u><font face="Trebuchet MS" size="3"><b>Create
                              A New Campaign...</b></font></u></p>
                              <p align="left"><font face="Trebuchet MS" size="2">To
                              create a new campaign please fill out the form
                              fields listed below. If you need help creating
                              your new campaign, please refer to the user manual
                              for more detailed information.</font></p>
                              <div align="left">
                                <script>
 function Add_more() {
    n = document.forms.new_campaign.add_more.value;
	str="<table border=0>";
    for(i=1;i<=n;i++) {
	   str = str + "<tr><td align=left><font face='Trebuchet MS' size=2>URL"+
                   (5+i)+": </font><input type=text name=url" + (5+i) + " size=50 style='font-family: Verdana; font-size: 8pt'></td></tr>";
	}
	document.all.add1.innerHTML = str+"</table>";
 }
 
 function Enable() {
    if (document.forms.new_campaign.campaign_type[1].checked) {
	   document.forms.new_campaign.visitors_count.disabled = false;
	   document.forms.new_campaign.redirect[0].disabled = false;
	   document.forms.new_campaign.redirect[1].disabled = false;
	   document.forms.new_campaign.manual_url.disabled = false;
	} else {
	   document.forms.new_campaign.visitors_count.disabled = true;
	   document.forms.new_campaign.redirect[0].disabled = true;
	   document.forms.new_campaign.redirect[1].disabled = true;
	   document.forms.new_campaign.manual_url.disabled = true;
	}
 }
</script>               
					         <form name="new_campaign" action="campaign.php" method="post">
							 <input type=hidden name="do_it" value="1">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                  <tr>
                                    <td><font face="Trebuchet MS" size="2" color="#000080"><u>Campaign
                                      Title:</u></font></td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td><input type="text" name="title" size="50" style="font-family: Verdana; font-size: 8pt"></td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td><font face="Trebuchet MS" size="2" color="#000080"><u>Campaign
                                      Description:</u></font></td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td><textarea rows="8" name="description" cols="50" style="font-family: Verdana; font-size: 8pt"></textarea></td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td><font face="Trebuchet MS" size="2" color="#000080"><u>Test
                                      Subjects:</u></font></td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"><font face="Trebuchet MS" size="2">URL
                                      1: </font><input type="text" name="url1" size="50" style="font-family: Verdana; font-size: 8pt"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"><font face="Trebuchet MS" size="2">URL
                                      2: </font><input type="text" name="url2" size="50" style="font-family: Verdana; font-size: 8pt"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"><font face="Trebuchet MS" size="2">URL
                                      3: </font><input type="text" name="url3" size="50" style="font-family: Verdana; font-size: 8pt"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"><font face="Trebuchet MS" size="2">URL
                                      4: </font><input type="text" name="url4" size="50" style="font-family: Verdana; font-size: 8pt"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"></td>
                                  </tr>
                                  <tr>
                                    <td align="left"><font face="Trebuchet MS" size="2">URL
                                      5: </font><input type="text" name="url5" size="50" style="font-family: Verdana; font-size: 8pt"></td>
                                  </tr>
								  <tr><td><p id="add1"></p></td></tr>
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <p align="center"><font face="Trebuchet MS" size="2">Add
                                      </font><select size="1" name="add_more" onchange="Add_more()" style="font-family: Verdana; font-size: 8pt">
                                        <option value=1>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        <option value=5>5</option>
                                        <option value=6>6</option>
                                        <option value=7>7</option>
                                        <option value=8>8</option>
                                        <option value=9>9</option>
                                        <option value=10>10</option>
                                        <option value=11>11</option>
                                        <option value=12>12</option>
                                        <option value=13>13</option>
                                        <option value=14>14</option>
                                        <option value=15>15</option>
                                        <option value=16>16</option>
                                        <option value=17>17</option>
                                        <option value=18>18</option>
                                        <option value=19>19</option>
                                        <option value=20>20</option>
                                      </select> <font size="2" face="Trebuchet MS">New
                                      Test Subject Fields </font>
								  </td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td><font face="Trebuchet MS" size="2" color="#000080"><u>Set
                                      Test Limitations:</u></font></td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td><font face="Trebuchet MS" size="2">Setting
                                      test limitations allows you to define
                                      specific criteria as to when this campaign
                                      should conclude. For example you can allow
                                      you campaign to run continuously or
                                      specify that each test subject should be
                                      shown X number of times before the test is
                                      completed.</font></td>
                                  </tr>
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div align="left">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                            <td width="8%" valign="top"><input type="radio" name="campaign_type" value="continuously" onclick="Enable()" style="font-family: Verdana; font-size: 8pt" checked></td>
                                            <td width="3%" valign="top"></td>
                                            <td width="89%" valign="top"><font face="Trebuchet MS" size="2">Run
                                              This Campaign Continuously&nbsp;</font></td>
                                          </tr>
                                        </table>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div align="left">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                            <td width="8%" valign="top"></td>
                                            <td width="3%" valign="top"></td>
                                            <td width="89%" valign="top"><font face="Trebuchet MS" size="2"><b>OR...</b>&nbsp;</font></td>
                                          </tr>
                                        </table>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div align="left">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                            <td width="8%" valign="top"><input type="radio" name="campaign_type" value="visitors limit" onclick="Enable()" style="font-family: Verdana; font-size: 8pt"></td>
                                            <td width="3%" valign="top"></td>
                                            <td width="89%" colspan=3 valign="top"><font face="Trebuchet MS" size="2">Conclude
                                              this campaign after the specified
                                              number of</font> <font face="Trebuchet MS" size="2">unique
                                              visitors have been sent to each
                                              test subject.</font></td>
                                          </tr>
                                          <tr>
                                            <td width="100%" valign="top" colspan="6" height="10"></td>
                                          </tr>
                                          <tr>
                                            <td width="8%" valign="top"></td>
                                            <td width="3%" valign="top"></td>
                                            <td width="89%" colspan=3 valign="top"><font face="Trebuchet MS" size="2">#
                                              </font><font face="Trebuchet MS" size="2">Visitors:</font>
                                              <input type="text" name="visitors_count" size="10" disabled style="font-family: Verdana; font-size: 8pt"></td>
                                          </tr>
                                        </table>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div align="left">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                            <td width="8%" valign="top"></td>
                                            <td width="3%" valign="top"></td>
                                            <td width="89%" valign="top"  colspan=6><font face="Trebuchet MS" size="2">And
                                              upon the conclusion of this
                                              campaign either...</font></td>
                                          </tr>
                                        </table>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div align="left">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                            <td width="8%" valign="top"></td>
                                            <td width="3%" valign="top"></td>
											<td width="8%" valign="top"><input type="radio" checked disabled name="redirect" value="highest" style="font-family: Verdana; font-size: 8pt"></td>
											<td width="3%" valign="top"></td>
                                            <td width="78%" valign="top"><font face="Trebuchet MS" size="2">a)
                                              Redirect all subsequent visitors
                                              to the test subject producing the
                                              highest conversion ratio as proven
                                              by this test.</font></td>
                                          </tr>
                                        </table>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td height="10"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div align="left">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                          <tr>
                                            <td width="8%" valign="top"></td>
                                            <td width="3%" valign="top"></td>
											<td width="8%" valign="top"><input type="radio" disabled name="redirect" value="manual" style="font-family: Verdana; font-size: 8pt"></td>
											<td width="3%" valign="top"></td>
                                            <td width="78%" valign="top"><font face="Trebuchet MS" size="2">b)
                                              Or redirect all visitors to the
                                              following URL only....&nbsp;</font></td>
                                          </tr>
                                          <tr>
                                            <td width="100%" valign="top" colspan="6" height="10"></td>
                                          </tr>
                                          <tr>
                                            <td width="8%" valign="top"></td>
                                            <td width="3%" valign="top"></td>
                                            <td width="89%" valign="top"  colspan=3>&nbsp;&nbsp;<input type="text" disabled name="manual_url" size="50" style="font-family: Verdana; font-size: 8pt"></td>
                                          </tr>
                                        </table>
                                      </div>
                              </center></center>
                            <center><center>
                            </td>
                                  </tr>
                                  <tr>
                                    <td height="20"></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <p align="center"><input type="submit" value="Create Campaign" name="B1" style="font-family: Verdana; font-size: 8pt; border: 1 solid #000000"><br>
                                    </td>
                                  </tr>
                                </table>
                              </div>
                            <p align="center"><font face="Trebuchet MS" size="2">Click
                            the &quot;Create Campaign&quot; button now to create
                            this campaign and generate your marketing test implementation
                            codes.</font>
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