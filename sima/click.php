<?
require_once "_util.inc.php";

$campaign = $_REQUEST['id'];

$info = array_values(GetCampaign($campaign));
$n = GetUrlCount($campaign);
$i = 0; $rating = 0;

if (!preg_match("/continuously/",$info[3])) {
  do {
    list($url_number,$url_name) = GetNextUrl($campaign);
    $stat = GetUrlStat($campaign,$url_number);
    $new_rating = $stat[1]+$stat[2]+$stat[3]+$stat[4]+$stat[5]+
                  $stat[6]+$stat[7]+$stat[8]+$stat[9]+$stat[10];
    if ($rating < $new_rating) { $rating = $new_rating; $rating_url = $url_name;}
    $count = $stat[0];
	$i++;
	//print $info[5]." $i  ".$count."<br>";
  } while (intval($count)>=intval($info[5]) && $i<=$n);
  if ($i>$n) { 
    if ($info[4] <> '') { header("Location: ".$info[4]); }
	else { header("Location: ".$rating_url); }
	exit;
  }
} else { list($url_number,$url_name) = GetNextUrl($campaign); } 


$str = $HTTP_COOKIE_VARS['campaign_'.$campaign];

list($cookie_url,$visit_number) = split("#",$str);
if ($cookie_url) {
  $url = GetUrl($campaign,$cookie_url);
  if ($url == '') { AddClick($campaign,$url_number);
     setcookie('campaign_'.$campaign,$url_number.'#1',time()+365*24*60*60);
     header("Location: ".$url_name);
     exit;
  }
  $visit_number++;
  setcookie('campaign_'.$campaign,$cookie_url.'#'.$visit_number,time()+365*24*60*60);
  header("Location: $url");
  exit;
} else {
  AddClick($campaign,$url_number);
  setcookie('campaign_'.$campaign,$url_number.'#1',time()+365*24*60*60);
  header("Location: ".$url_name);
  exit;
}
?>