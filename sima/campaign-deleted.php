<?
require_once "_util.inc.php";

auth();

DeleteCampaign($_REQUEST['id']);

### Smarty Output ########################
$smarty->display('campaign-deleted.tpl');
?>
