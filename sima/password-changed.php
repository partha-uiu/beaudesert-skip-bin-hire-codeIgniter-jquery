<?
require_once "_util.inc.php";

auth();

if (ChangePassword($_REQUEST['old_psw'],$_REQUEST['new_psw_1'],$_REQUEST['new_psw_2'])) {
  $SESSION['auth'] = 'NO';
  $smarty->assign('err','Your administrative login password has now been
                         updated. You will need to login using your new
                         password on future visits so be sure to write it
                         down and keep it in a safe place.');
} else {
  $smarty->assign('err','<font color="red">Make shure, that you type correct password</font>');
}

### Smarty Output ########################
$smarty->display('password-changed.tpl');
?>