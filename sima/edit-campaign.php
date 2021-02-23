<?
require_once "_util.inc.php";

auth();

$campaign = $_REQUEST['id'];

$info = GetCampaign($campaign);

$urls = array();

$n = GetUrlCount($campaign);
for($i=1;$i<=$n;$i++) {
  $urls[] = GetUrl($campaign,$i);
}

if ($_REQUEST['do_it']) {
  if ($_REQUEST['redirect'] == 'highest') { $manual_url = ''; } else { $manual_url = $_REQUEST['manual_url'];}
  $id = AddCampaign($_REQUEST['title'],$_REQUEST['description'],$_REQUEST['campaign_type'],$manual_url,$_REQUEST['visitors_count']);
  $urls = array();
  foreach ($_REQUEST as $key => $url) if (preg_match("/url\d+/",$key)) { if ($url) {$urls[] = $url;}}
  AddUrls($id,$urls);
  header("Location: campaign-created.php?id=$id");
}


### Smarty Output ########################
$smarty->assign("urls",$urls);
$smarty->assign("id", $campaign);
$smarty->assign("title",$info['title']);
$smarty->assign("description", $info['description']);
$smarty->assign("type", $info['type']);
$smarty->assign("visitors", $info['visitors']);
$smarty->assign("manual_url", $info['manual_url']);
$smarty->display('edit-campaign.tpl');
?>