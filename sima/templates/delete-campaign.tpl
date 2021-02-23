          {include file="_header.tpl"}
		                      </td>
                              <td width="12" valign="top"></td>
                              <td width="1" bgcolor="#000000" valign="top"><img border="0" src="invisible.gif" width="1" height="1"></td>
                              <td width="28" valign="top"></td>
                            <td width="429" valign="top">
                              <p align="left"><u><font face="Trebuchet MS" size="3"><b>Delete
                              Campaign...</b></font></u></p>
                              <p align="left"><font face="Trebuchet MS" size="2">You
                              are about to delete the following campaign.</font></p>
                              <p align="left"><font face="Trebuchet MS" size="2"><u>{$title}</font></p>
                              <p align="left"><font face="Trebuchet MS" size="2">{$description}</font></p>
                              <p align="left"><font face="Trebuchet MS" size="2">Please
                              be aware that this action is irreversible and you
                              will lose all information about this campaign
                              including your test results. If you would like to
                              delete the campaign simply click the button below.</font></p>
                              <p align="center">
							  <form name=del action="campaign-deleted.php" method="post">
							    <input type="hidden" name="id" value="{$id}">
                                <input type="submit" value="Yes... Delete This Campaign" name="B1" style="font-family: Verdana; font-size: 8pt; border: 1 solid #000000"><br>
                              </p>
                              </center></center>
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" colspan="5" height="40">
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" colspan="5">
{include file="_footer.tpl"}
