<?
require_once "_util.inc.php";

auth();

$id = $_REQUEST['id'];

$info = array_values(GetCampaign($id));

### Smarty Output ########################
$smarty->assign('title',$info[1]);
$smarty->assign('description',$info[2]);
$smarty->assign('id', $id);
$smarty->display('delete-campaign.tpl');
?>