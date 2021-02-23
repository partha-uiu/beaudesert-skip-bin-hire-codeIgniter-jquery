<?php /* Smarty version 2.3.0, created on 2004-02-23 13:26:57
         compiled from campaign-created.tpl */ ?>
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
                              <p align="left"><u><font face="Trebuchet MS" size="3"><b>Campaign
                              Created...</b></font></u></p>
                              <p align="left"><font face="Trebuchet MS" size="2">Congratulations.
                              Your new campaign has been created and is now
                              accessible via the main campaign management area.
                              Here are your campaign implementation URL's.</font></p>
                              </center></center>
                            <p align="left"><font face="Trebuchet MS" size="2" color="#000080"><u>Scientific
                            Implementation URL:</u></font></p>
                            <p align="left"><font face="Trebuchet MS" size="2">This
                            is the URL you need to implement the redirecting of
                            visitors to your test subjects. All visitors sent to
                            the following URL will be consecutively rotated
                            between the various URL's you are using as test
                            subjects until the campaign has concluded.</font></p>
                            <p align="center"><font face="Trebuchet MS" size="2"><?php echo $this->_tpl_vars['link']; ?>
</p>
                            <p align="left"><font face="Trebuchet MS" size="2" color="#000080"><u>Scientific
                            Result Tracking:</u></font></p>
                            <p align="left"><font face="Trebuchet MS" size="2">This
                            is the code that you need to implement on the page
                            on your site which will record that an actual event
                            / result has occurred. For example if you are
                            tracking actual orders place the code on your
                            &quot;thank you for ordering page&quot;. If you are
                            tracking visitors to ezine subscribers place the
                            code on your &quot;thank you for subscribing
                            page&quot;.</font></p>
                            <p align="center"><font face="Trebuchet MS" size="2">&lt;img
                            border=&quot;0&quot;
                            src=&quot;<?php echo $this->_tpl_vars['thanks']; ?>
&quot;
                            width=&quot;1&quot;
                            height=&quot;1&quot;&gt;</font></p>
                            <p align="left"><font face="Trebuchet MS" size="2">Failure
                            to use the above code in this test will result in
                            the absence of any actual conversion ratio data
                            making your test redundant.</font></p>
                            <p align="right"><a href="campaign-management.php"><font face="Trebuchet MS" size="2">Campaign
                            Management Area</font></a>
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