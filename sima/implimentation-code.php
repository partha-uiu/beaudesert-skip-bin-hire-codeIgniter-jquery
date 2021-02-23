<?
require_once "_util.inc.php";

auth();

### Smarty Output ########################
$link = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/click.php?id='.$_REQUEST['id'];
$thanks = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/stat.php?id='.$_REQUEST['id'];
$smarty->assign('link',$link);
$smarty->assign('thanks',$thanks);
$smarty->display('implimentation-code.tpl');
?>