<?
//Require classes and libraries

//FIX implemented by Sonny Mataka http://www.sonnysales.com 8/07/03

/* 
   SIMA Code fix to work with php when safe_mode = on  

   This Fix was designed so you do not have to make any changes to the 
   code or document structure. 
   
   Note:     The default name of the directory folder is "sima" 
   		 if you do want to change the name of the default sima folder 
		 you must make these changes:
   
   -----------------------------
   
   		define('SMARTY_DIR',"$server_root/name_change/");
		require(SMARTY_DIR.'Smarty.class.php');
		$smarty->template_dir = "$server_root/name_change/templates/";
		$smarty->compile_dir = "$server_root/name_change/templates_c/ ";
		$smarty->config_dir = "$server_root/name_change/configs/";
		$smarty->cache_dir = "$server_root/name_change/cache/ ";
		
		
	----------------------------	
   
   ** where /name_change/ is the only thing you modify . **
   
 */


// default folder is sima   ----- this is where you would have to make the /name_change/ if desired.
//FIX Start -------------------------------------------------->


$server_root = $_SERVER["SCRIPT_FILENAME"] ;
$server_root = preg_replace("/\/[^\/]+?$/","/",$server_root);
define('SMARTY_DIR',"$server_root"); 
require_once(SMARTY_DIR.'Smarty.class.php');


nocache();
session_start();
$smarty = new Smarty;

//FIX END -------------------------------------------------->


/////////////////
function auth() {
  if ($_SESSION["auth"] <> 'YES') {
    header("Location: admin.php");
  exit;
 }
}

function CheckPassword($a) {
  if (!file_exists('do_not_edit/t1.php')) { 
    $f = fopen('do_not_edit/t1.php','w');
	fwrite($f,"<?php\ndie('access denied')\n?>\n");
    fwrite($f,'x412x40dx400x408x41d');
    fclose($f);
  }
  $psw = file('do_not_edit/t1.php');
  if (edecode($psw[3],'simasimpleproject') != $a) { return false;
  } else {
    return true;
  }
}

//////////// File work //////////////////////
function DeleteCampaign($id) {
  if (!file_exists('do_not_edit/sima.glb')) { return false; exit;}
  if (file_exists('do_not_edit/'.$id.'.url'))  { unlink('do_not_edit/'.$id.'.url');}
  if (file_exists('do_not_edit/'.$id.'.stt'))  { unlink('do_not_edit/'.$id.'.stt');}
  $sima = file('do_not_edit/sima.glb');
  for ($i=0;$i<count($sima);$i++)
    if (preg_match("/id=(\d+)/",$sima[$i],$matches) && ($matches[1] == $id)) {
	  array_splice($sima,$i-1,7);
	  break;
	}
  $f = fopen('do_not_edit/sima.glb','w');
  foreach ($sima as $str) fwrite($f,$str);
  fclose($f);
}

function EditCampaign($id,$title,$description,$type,$manual_url,$visitors) {
  if (!file_exists('do_not_edit/sima.glb')) { return false; exit;}
  $info = file('do_not_edit/sima.glb');
  for ($i=0;$i<count($info);$i++) {
    if ($info[$i] == '['.$id."]\n") {
	  $info[$i+1] = 'id='.$id."\n";
	  $info[$i+2] = 'title='.$title."\n";
	  $info[$i+3] = 'description='.$description."\n";
	  $info[$i+4] = 'type='.$type."\n";
	  $info[$i+5] = 'manual_url='.$manual_url."\n";
	  $info[$i+6] = 'visitors='.$visitors."\n";
	  break;
	}
  }
  $f = fopen('do_not_edit/sima.glb','w');
  foreach ($info as $str) fwrite($f,$str);
  fclose($f);
  return true;
}


function AddCampaign($title,$description,$type,$manual_url,$visitors) {
  if (!file_exists('do_not_edit/sima.glb')) { $f = fopen('do_not_edit/sima.glb','w'); fclose($f); }
  $sima = file('do_not_edit/sima.glb');
  if (!is_array($sima)) $sima = array();
  foreach($sima as $str) if (preg_match("/id=(\d+)/",$str,$matches) && $matches[1]>$id)  $id = $matches[1];
  array_push($sima,
             '['.++$id."]\n",
	  	     'id='.$id."\n",
		     'title='.$title."\n",
		     'description='.$description."\n",
             'type='.$type."\n",
		     'manual_url='.$manual_url."\n",
		     'visitors='.$visitors."\n"
		    );
  $f = fopen('do_not_edit/sima.glb','w+');
  foreach ($sima as $str) fwrite($f,$str);
  fclose($f);
  return $id;
}

function GetCampaign($id) {
  if (!file_exists('do_not_edit/sima.glb')) { return array(); exit;}
  $return = array();
  $sima = fopen('do_not_edit/sima.glb','r');
  while (!feof($sima)) {
    $str = fgets($sima, 4024);
	if (preg_match("/id=(\d+)/",$str,$matches) && ($matches[1] == $id)) {
	  $return['id'] = $id;
	  for ($i=0;$i<5;$i++) {
	    $str = fgets($sima, 4024);
	    preg_match("/(\w*)=(.*)/",$str,$matches);
	    $return[$matches[1]] = $matches[2];
	  } //for
	  break;
	} //if
  } //while
  fclose($sima);
  return $return;
} //function

function GetCampaigns() {
  if (!file_exists('do_not_edit/sima.glb')) { return array(); exit;}
  $sima = file('do_not_edit/sima.glb');
  if (!is_array($sima)) $sima = array();
  $return = array();
  foreach($sima as $str) if (preg_match("/id=(\d+)/",$str,$matches)) $return[] = $matches[1];
  return $return;
}

function AddUrls($id,$urls) {

  $f = fopen('do_not_edit/'.$id.'.url','w');
  fwrite($f,"[1]\n");
  $i = 1;
  $ff = fopen('do_not_edit/'.$id.'.stt','w');
  flock($ff, LOCK_EX);
  foreach ($urls as $str) {
    fwrite($f,"$str\n");
	fwrite($ff,'['.$i++."]\n");
	for ($j=0;$j<11;$j++)fwrite($ff,"0\n");
  }
  fclose($ff);
  fclose($f);
}

function GetNextUrl($id) {
  if (!file_exists('do_not_edit/'.$id.'.url')) { return false; exit;}
  $sima = file('do_not_edit/'.$id.'.url');
  $url = substr($sima[0],1,strlen($sima[0])-3);
  $return = array($url,$sima[$url]);
  $count = count($sima)-1;
  if ($url >= $count) { $sima[0] = "[1]\n"; }
  else { $sima[0] = '['.++$url."]\n"; }
  $f = fopen('do_not_edit/'.$id.'.url','w');
  foreach ($sima as $str) fwrite($f,"$str");
  fclose($f);
  return $return;
}

function GetUrl($id,$url_id) {
  if (!file_exists('do_not_edit/'.$id.'.url')) { return false; exit;}
  $sima = file('do_not_edit/'.$id.'.url');
  return $sima[$url_id];
}

function AddClick($id, $url_id) {
  if (!file_exists('do_not_edit/'.$id.'.stt')) { return false; exit;}
  $stat = file('do_not_edit/'.$id.'.stt');
  for ($i=0;$i<count($stat);$i++) {
    if ($stat[$i] == '['.$url_id."]\n") {
	  $stat[$i+1] = intval($stat[$i+1])+1;
	  $stat[$i+1] = $stat[$i+1]."\n";
	  break;
	}
  }
  $f = false;
  $f = fopen('do_not_edit/'.$id.'.stt','w+');
  flock($f, LOCK_EX); 
  foreach ($stat as $str) fwrite($f,"$str");
  fclose($f);
  
} //function

function AddThanks($id, $url_id, $position) {
  if (!file_exists('do_not_edit/'.$id.'.stt')) { return false; exit;}
  $stat = file('do_not_edit/'.$id.'.stt');
  for ($i=0;$i<count($stat);$i++) {
    if ($stat[$i] == '['.$url_id."]\n") {
	  $next = intval($stat[$i+$position+1])+1;
	  $stat[$i+$position+1] = $next."\n";
	  break;
	}
  }
  $f = fopen('do_not_edit/'.$id.'.stt','w+'); 
  flock($f, LOCK_EX);
  foreach ($stat as $str) fwrite($f,"$str");
  fclose($f);
} //function

function GetUrlCount($id) {
  if (!file_exists('do_not_edit/'.$id.'.url')) { return false; exit;}
  $stat = file('do_not_edit/'.$id.'.url');
  return count($stat)-1;
}

function GetUrlStat($id,$url_id) {
  if (!file_exists('do_not_edit/'.$id.'.stt')) { return false; exit;}
  $stat = file('do_not_edit/'.$id.'.stt');
  for ($i=0;$i<count($stat);$i++) {
    if ($stat[$i] == '['.$url_id."]\n") {
	  $url_stat = array_slice($stat,$i+1,11);
	  $actions = 0; $percent = 0;
	  for ($j=1;$j<11;$j++) {
	    if ($url_stat[0] <> 0) {$url_stat[] = sprintf("%0.2f",$url_stat[$j]*100/$url_stat[0]);} else {$url_stat[] = 0;}
		$actions   += $url_stat[$j];
		if ($url_stat[0] <> 0) $percent += sprintf("%0.2f",$url_stat[$j]*100/$url_stat[0]);
	  }
	  $url_stat[] = sprintf("%0.2f",$actions);
	  $url_stat[] = sprintf("%0.2f",$percent);
	  $url_stat[] = GetUrl($id,$url_id);
	  break;
	}
  }
  return $url_stat;
}

function ChangePassword($a,$b,$c) {
   if (!file_exists('do_not_edit/t1.php')) { return false; exit;}
   $psw = file('do_not_edit/t1.php');
   if (edecode($psw[3],'simasimpleproject') != $a) { return false; exit; }
   if ($b != $c) { return false; exit; }
   $f = fopen('do_not_edit/t1.php','w');
   fwrite($f,"<?php\ndie('access denied')\n?>\n");
   fwrite($f,eencode($b,'simasimpleproject'));
   fclose($f);
   return true;
}

function eencode($data, $passw) {
   $lpass = strlen($passw);
   $res = "";
   for ($i = 0, $j = 0; $i < strlen($data); $i++, $j++) {
       if ($j >= $lpass) $j = 0;
       $m = 1024 + ord($data[$i]) ^ ord($passw[$j]);
       $res .= "x" . dechex($m);
   }
   return $res;
}

function edecode($data, $passw) {
    $lpass = strlen($passw);
    preg_match_all("/x([0-9ABCDEF][0-9ABCDEF][0-9ABCDEF])/i", $data, $arr);
    $res = "";
    for ($i = 0, $j = 0; $i < count($arr[1]); $i++, $j++) {
        if ($j >= $lpass) $j = 0;
        $m = (hexdec($arr[1][$i]) - 1024) ^ ord($passw[$j]);
        $res .= chr($m);
    }
    return $res;
}

function GetGlobalStat($id) {
  $visitors = 0;
  $result = 0;
  $percent = 0;
  $n = GetUrlCount($id);
  for ($i=1;$i<=$n;$i++) {
    $url = GetUrlStat($id,$i);
    $visitors += $url[0];
	$result   += $url[1]+$url[2]+$url[3]+$url[4]+$url[5]+
	             $url[6]+$url[7]+$url[8]+$url[9]+$url[10];
  }
  if ($visitors <> 0) {$percent = sprintf("%.2f",$result*100/$visitors);} else {$percent = 0;}
  return array($visitors,$result,$percent);
}

function nocache() {
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}


?>
