<?
require_once "_util.inc.php";

auth();

$campaigns = array();
$ids = GetCampaigns();

foreach ($ids as $id) {
  $n = GetUrlCount($id);
  for ($i=1;$i<=$n;$i++) {
    $url = GetUrlStat($id,$i);
    $visitors += $url[0];
	$result   += $url[1]+$url[2]+$url[3]+$url[4]+$url[5]+
	             $url[6]+$url[7]+$url[8]+$url[9]+$url[10];
  }
  $campaign    = array_values(GetCampaign($id));
  $campaign[] = $n;
  list($visitors,$result,$percent) = GetGlobalStat($id);
  $campaign[] = $visitors;
  $campaign[] = $result;
  $campaign[] = $percent;
  $campaigns[] = $campaign;


}

### Smarty Output ########################
$smarty->assign('campaigns', $campaigns);
$smarty->display('campaign-management.tpl');
?>