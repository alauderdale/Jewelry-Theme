<?php

// CREATE TABLES

$wordpressapi_db_version = "1.0";
 
global $wpdb;
global $wordpressapi_db_version;

$stats_table = $wpdb->prefix . "launcheffect";

if($wpdb->get_var("show tables like '$stats_table'") != $stats_table) {

	$sql = "CREATE TABLE " . $stats_table . " (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time VARCHAR(19) DEFAULT '0' NOT NULL,
		email VARCHAR(55),
		code VARCHAR(6),
		referred_by VARCHAR(6),
		visits int(10),
		conversions int(10),
		ip VARCHAR(20),
		UNIQUE KEY id (id)
	);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
	
	$test_email = "Email OK";
	$test_code = "OK";
	$test_referred_by = "OK";
	$test_visits = 0;
	$test_conversions = 0;
	
	// INSERT TEST VALUES
	$insert = "INSERT INTO " . $stats_table .
	" (time, email, code, referred_by, visits, conversions, ip) " .
	"VALUES ('" . date('Y-m-d H:i:s') . "','" . $wpdb->escape($test_email) . "','" . $wpdb->escape($test_code) . "','" . $wpdb->escape($test_referred_by) . "','" . $wpdb->escape($test_visits) . "','" . $wpdb->escape($test_conversions) . "','" . $_SERVER['REMOTE_ADDR'] . "')";

	$results = $wpdb->query( $insert );
 
}

add_option("wordpressapi_db_version", $wordpressapi_db_version);

?>