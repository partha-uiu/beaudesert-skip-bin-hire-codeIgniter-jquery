<?
require_once "_util.inc.php";

$campaign = $_REQUEST['id'];
$str = $HTTP_COOKIE_VARS['campaign_'.$campaign];
if ($str <> 'finished') {
  list($cookie_url,$visit_number) = split("#",$str);
  if ($cookie_url) {
    AddThanks($campaign, $cookie_url, $visit_number);
    setcookie('campaign_'.$campaign,'finished',time()+365*24*60*60);
  }
}
exit;
?>
