<?
 require_once("_util.inc.php");
 
 if ($_REQUEST['password']) {
   if (CheckPassword($_REQUEST['password'])) {
     header("Location: index.php");
     $_SESSION['auth'] = 'YES';
     exit;
   } else { $err = "<font color=red>Incorect password</font>";}
 }
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<title></title>
</head>

<body link="#0000FF" vlink="#0000FF" alink="#0000FF" background="images/bgfinegrey.gif">
<div align="center">
  <table border="1" cellpadding="0" cellspacing="0" width="650" bordercolor="#000000" bgcolor="#FFFFFF">
    <tr>
      <td>
        <div align="center">
                          <table border="0" cellpadding="0" cellspacing="0" width="610">
                            <tr>
                              <td width="598" valign="top" height="10">
                                <font face="Trebuchet MS" size="2"><a name="Top"></a></font>
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" height="20">
                                <p align="right"><font face="Trebuchet MS" size="2">Version
                                1.32</font>
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top">
                                <p align="center"><a href="/sima/" target="_blank"><img border="0" src="images/sima.gif" width="600" height="80"></a>
                              </td>
                            </tr>
                            
                            <tr>
                              <td width="598" valign="top" height="30">
                              <hr size="1" color="#000080">
                              </td>
                            </tr>
                            <tr>
                              <td width="592" valign="top">
                                
                <p align="center"><u><font face="Trebuchet MS" size="3"><b>Administration 
                  Login...</b></font></u></p>
      <font face="Trebuchet MS" size="2">
                            <blockquote>
                              <blockquote>
                            <p align="center"><? if ($err) { echo $err.'<br>';}?>To login to your administration
                            area please enter your password in the field below
                            and click the &quot;Login Now&quot; button.</p>
							<form action=admin.php method="post">
                            <p align="center"><input type="password" name="password" size="20" style="font-family: Verdana; font-size: 8pt; border: 1 solid #000000"></p>
                              </blockquote>
                            </blockquote>
                            <p align="center"><input  type="submit" value="Login Now" style="font-family: Trebuchet MS; font-size: 10pt; border: 1 solid #000000"><br>
      </p>
                </font> </form> <font face="Trebuchet MS" size="2"> 
                <hr size="1" color="#000080">
      </font>
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" height="40">
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top">
                              
                <p align="center"><font face="Trebuchet MS" size="2">Copyright 
                  2009<br>
                              All Rights Reserved<br>
                              <a href="http://www.netwealthgroup.com" target="_blank">Net Wealth Group</a></font>
                              </td>
                            </tr>
                            <tr>
                              <td width="598" valign="top" height="20">
                              </td>
                            </tr>
                          </table>
          </div>
        </td>
      </tr>
    </table>
</div>
</body>

</html>
