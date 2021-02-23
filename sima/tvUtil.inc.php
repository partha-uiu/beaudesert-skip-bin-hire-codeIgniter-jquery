<?php
/**
 * Get parameter of HTTP query
 * @param string $param The param name
 */
function param($param) {
    $res = null;
    if (array_key_exists($param,  $_REQUEST)) $res = $_REQUEST[$param];
    if (!$res && isset($_SESSION) && array_key_exists($param,  $_SESSION))
        $res = $_SESSION[$param];
    return $res;
}

/**
 * Delete HTTP caching
 */
function nocache() {
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}

/**
 * Check E-mail address
 * @param string $email The email adress for checking
 * @return boolean false Is $email is not E-Mail address
 */
function isemail($email) {
    $email_regexp = "^([-!#\$%&'*+./0-9=?A-Z^_`a-z{|}~])+@([-!#\$%&'*+/0-9=?A-Z^_`a-z{|}~]+\\.)+[a-zA-Z]{2,4}\$";
    return eregi($email_regexp, $email);
}

/**
 * Quoted array (apply htmlentities to all elements)
 */
function arrayquote($array) {
    $i = array();
    if ($array) foreach($array as $x) array_push($i, htmlentities($x));
    return $i;
}

/**
 * Quoted array (apply htmlentities to all elements)
 */
function multiarrayquote($array) {
    $i = array();
    if ($array) foreach($array as $xs) array_push($i, arrayquote($xs));
    return $i;
}

/**
 * Simple encode data
 */
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

/**
 * Simple decode data
 */
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
?>
