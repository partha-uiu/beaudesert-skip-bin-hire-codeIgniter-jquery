<?
require_once "_util.inc.php";

auth();

if ($_REQUEST['reset'] == "1") {
  $n = GetUrlCount($_REQUEST['id']);
  $ff = fopen('do_not_edit/'.$_REQUEST['id'].'.stt','w');
  for($i = 1;$i<=$n;$i++) {
	fwrite($ff,'['.$i."]\n");
	for ($j=0;$j<11;$j++) fwrite($ff,"0\n");
  }
  fclose($ff);
}

$id = $_REQUEST['id'];
$n = GetUrlCount($id);
$campaign = array();
for ($i=1;$i<=$n;$i++) $campaign[] = GetUrlStat($id,$i);
$info = array_values(GetCampaign($id));
$temp = 0; $best = 0;
for($i=0;$i<count($campaign);$i++) 
  if ($campaign[$i][22] > $temp) { $temp = $campaign[$i][22]; $best = $i;}


### Smarty Output ########################
$smarty->assign('id',$_REQUEST['id']);
$smarty->assign('best',$best+2);
$smarty->assign('title',$info[1]);
$smarty->assign('description',$info[2]);
$smarty->assign('campaign', $campaign);
$smarty->display('stats.tpl');
?>