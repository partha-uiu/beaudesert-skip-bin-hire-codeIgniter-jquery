<?
require_once "_util.inc.php";

auth();

if ($_REQUEST['do_it']) {
  if ($_REQUEST['redirect'] == 'highest') { $manual_url = ''; } else { $manual_url = $_REQUEST['manual_url'];}
  $description = preg_replace("/[\r\n]+/","<br>",$_REQUEST['description']);
  $id = AddCampaign($_REQUEST['title'],$description,$_REQUEST['campaign_type'],$manual_url,$_REQUEST['visitors_count']);
  $urls = array();
  foreach ($_REQUEST as $key => $url) if (preg_match("/url\d+/",$key)) { if ($url) {$urls[] = $url;}}
  AddUrls($id,$urls);
  header("Location: campaign-created.php?id=$id");
}


### Smarty Output ########################
$smarty->display('campaign.tpl');
?>