<?php

// GET RANDOM 

function randomString() {
    $length = 5;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz';
    $string = '';    
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}


// GET REFERRED_BY CODE

$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$parseurl = parse_url($url, PHP_URL_PATH);
$parseurlstr = substr($parseurl, -5, 5);

if (strstr($parseurlstr, '/') OR $parseurlstr == '') {
	$referredindex = 'direct';
} else {
	$referredindex = $parseurlstr;
}


// QUERY IT

function wpdbQuery($query, $type) {

	global $wpdb;
	$result = $wpdb->$type( $query );
	return $result;

}


// LOG VISITS VIA REFERRAL LINK  

function logVisits($table, $referral) {
	
	$update = wpdbQuery("UPDATE $table SET visits = visits+1 WHERE code = '$referral'", 'query');
	
}


// POST DATA

function postData($table, $referral) {

	$result = wpdbQuery("INSERT INTO $table (time, email, code, referred_by, visits, conversions, ip) VALUES('" . date('Y-m-d H:i:s') . "','$_POST[email]', '$_POST[code]','$referral',0,0,'" . $_SERVER['REMOTE_ADDR'] . "')", 'query');
	
	$update2 = wpdbQuery("UPDATE $table SET conversions = conversions+1 WHERE code = '$referral'", 'query');
	
}


// COUNT CHECK (RETURN COUNT OF INSTANCES WHERE X = Y)

function countCheck($table, $entry, $value) {
	$query = wpdbQuery(wpdbQuery("SELECT COUNT(*) FROM $table WHERE $entry = '$value'", 'prepare'), 'get_var');
	return $query;
}


// REPEAT CODE CHECK

function codeCheck() {
	global $wpdb;
	$code = randomString(); 
	$count = countCheck($wpdb->prefix . 'launcheffect', 'code', $code);
	if($count > 0) { echo randomString(); } else { echo $code; }	
}


// GET DATA

function getData($table) {

	$result = wpdbQuery("SELECT * FROM $table ORDER BY time DESC", 'get_results');
	return $result;
	
}


// GET DATA BY VALUE (RETURN X WHERE Y = Z)

function getDetail($table, $entry, $value) {

	$result = wpdbQuery("SELECT * FROM $table WHERE $entry = '$value' ORDER BY time DESC", 'get_results');
	return $result;
	
}

?>