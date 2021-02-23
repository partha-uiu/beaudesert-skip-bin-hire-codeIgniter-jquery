{include file="_header.tpl"}
                              </td>
                              <td width="12" valign="top"></td>
                              <td width="1" bgcolor="#000000" valign="top"><img border="0" src="invisible.gif" width="1" height="1"></td>
                              <td width="28" valign="top"></td>
                            <td width="429" valign="top">
                              <p align="left"><u><font face="Trebuchet MS" size="3"><b>Campaign
                              Management...</b></font></u></p>
                              <p align="left"><font face="Trebuchet MS" size="2">This
                              is your main campaign management area. Here you
                              can manage all aspects of your existing campaigns
                              and create additional campaigns to scientifically
                              test other aspects of your online marketing.</font></p>
                              </center></center>
                              <p align="right"><font face="Trebuchet MS" size="2"><a href="campaign.php">Create
                              A New Campaign</a></font></p>
                            <center>
                            <p align="left"><font face="Trebuchet MS" size="2" color="#000080"><u>Existing
                            Campaigns</u></font></p>
                            <p align="left"><font face="Trebuchet MS" size="2">Your
                            existing campaigns (if any) are shown below. Use the
                            respective links to manage the different aspects of
                            these campaigns.</font></p>
                            <div align="left">
{foreach name=count item=campaign from=$campaigns} 
                              <table border="1" cellpadding="0" cellspacing="0" width="420" bordercolor="#000000" bgcolor="#EFEFEF">
                                <tr>
                                  <td>
                                    <div align="center">
                                      <table border="0" cellpadding="0" cellspacing="0" width="380">
                                        <tr>
                                          <td height="20"></td>
                                        </tr>
                                        <tr>
                                          <td>
                                            <p align="center"><u><font face="Trebuchet MS" size="3"><b>{$campaign[1]}</b></font></u></td>
                                        </tr>
                                        <tr>
                                          <td height="10"></td>
                                        </tr>
                              </center>
                                    <tr>
                                      <td>
                                        <p align="left"><font face="Trebuchet MS" size="2">{$campaign[2]}</font></td>
                                    </tr>
                                      <center>
                            <tr>
                              <td height="20"></td>
                            </tr>
                              </center>
                                    <tr>
                                      <td height="20">
                                        <div align="center">
                                          <center>
                                          <table border="0" cellpadding="0" cellspacing="0" width="270">
                                            <tr>
                                              <td width="138"><u><font size="2" face="Trebuchet MS">Campaign
                                                Status:</font></u></td>
                                              <td width="11"></td>
                                              <td width="115"><font size="2" face="Trebuchet MS">Active</font></td>
                                            </tr>
                                            <tr>
                                              <td width="138"></td>
                                              <td width="11"></td>
                                              <td width="115"></td>
                                            </tr>
                                            <tr>
                                              <td width="138"><u><font size="2" face="Trebuchet MS">Campaign
                                                Type:</font></u></td>
                                              <td width="11"></td>
                                              <td width="115"><font size="2" face="Trebuchet MS">{$campaign[3]}</font></td>
                                            </tr>
                                            <tr>
                                              <td width="138"></td>
                                              <td width="11"></td>
                                              <td width="115"></td>
                                            </tr>
                                            <tr>
                                              <td width="138"><u><font size="2" face="Trebuchet MS">#
                                                Test Subjects:</font></u></td>
                                              <td width="11"></td>
                                              <td width="115"><font size="2" face="Trebuchet MS">{$campaign[6]}</font></td>
                                            </tr>
                                            <tr>
                                              <td width="264" colspan="3" height="10"></td>
                                            </tr>
                                            <tr>
                                              <td width="138"><u><font size="2" face="Trebuchet MS">Overall
                                                Impressions:</font></u></td>
                                              <td width="11"></td>
                                              <td width="115"><font face="Trebuchet MS" size="2">{$campaign[7]}</font></td>
                                            </tr>
                                            <tr>
                                              <td width="138"></td>
                                              <td width="11"></td>
                                              <td width="115"></td>
                                            </tr>
                                            <tr>
                                              <td width="138"><u><font size="2" face="Trebuchet MS">Overall
                                                Results:</font></u></td>
                                              <td width="11"></td>
                                              <td width="115"><font size="2" face="Trebuchet MS">{$campaign[8]}</font></td>
                                            </tr>
                                            <tr>
                                              <td width="138"></td>
                                              <td width="11"></td>
                                              <td width="115"></td>
                                            </tr>
                                            <tr>
                                              <td width="138"><u><font size="2" face="Trebuchet MS">Overall
                                                CR:</font></u></td>
                                              <td width="11"></td>
                                              <td width="115"><font size="2" face="Trebuchet MS">{$campaign[9]}%</font></td>
                                            </tr>
                                          </table>
                                          </center>
                                        </div>
                                      </td>
                                    </tr>
                                      <center>
                            <tr>
                              <td height="20"></td>
                            </tr>
                            <tr>
                              <td>
                                <p align="center">
								 <input type="button" value="Edit" name="B1" onclick="self.location.href='edit-campaign.php?id={$campaign[0]}'" style="font-family: Verdana; font-size: 8pt; border: 1 solid #000000">&nbsp;
                                 <input type="button" value="Stats/Results" name="B1" onclick="self.location.href='stats.php?id={$campaign[0]}'" style="font-family: Verdana; font-size: 8pt; border: 1 solid #000000">&nbsp;
                                 <input type="button" value="Get Code" name="B1" onclick="self.location.href='implimentation-code.php?id={$campaign[0]}'"  style="font-family: Verdana; font-size: 8pt; border: 1 solid #000000">&nbsp;
                                 <input type="button" value="Delete" name="B1" onclick="self.location.href='delete-campaign.php?id={$campaign[0]}'" style="font-family: Verdana; font-size: 8pt; border: 1 solid #000000"><br>
                                </p>
                              </td>
                            </tr>
                            <tr>
                              <td></td>
                            </tr>
                            <tr>
                              <td height="20"></td>
                            </tr>
                            </table>
                                    </div>
                                  </center>
                                  </td>
                                </tr>
                              </table>
				             <br>
{/foreach}						
                            </div>
                            <p align="right"><font face="Trebuchet MS" size="2"><a href="campaign.php">Create
                              A New Campaign</a></font></p>
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" colspan="5" height="40">
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" colspan="5">
{include file="_footer.tpl"}
