<?
require_once "_util.inc.php";

auth();
  if ($_REQUEST['redirect'] == 'highest') { $manual_url = ''; } else { $manual_url = $_REQUEST['manual_url'];}
  $description = preg_replace("/[\n\r]+/","<br>",$_REQUEST['description']);
  if(!EditCampaign($_REQUEST['id'],$_REQUEST['title'],$description,$_REQUEST['campaign_type'],$manual_url,$_REQUEST['visitors_count'])) $err = "<font color=red>Campaign is not updated.</font>";
  $urls = array();
  foreach ($_REQUEST as $key => $url) if (preg_match("/url\d+/",$key)) { if ($url) {$urls[] = $url;}}
  AddUrls($_REQUEST['id'],$urls);



### Smarty Output ########################
$smarty->display('campaign-updated.tpl');
?>