<?php 

// INCLUDE WORDPRESS STUFF
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');

session_start();

$referredpost = $_SESSION['referredBy'];

// POST FORM WITH AJAX
$email_check = ''; // (true or false) if email is valid
$reuser = ''; // (true or false) if visitor is a returning visitor
$clicks = ''; // if returning visitor, number of visits via his link
$conversions = ''; // if returning visitor, number of people that signed up via his link
$return_arr = array(); // this array will store our form data and the above additional information.  we'll use it later on down the page.

if(isset($_POST['email'])){ 

	if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	
		$email_check = 'valid';
	
		$count = countCheck($stats_table, 'email', $_POST['email']);
	
		if ($count > 0) {
			
			$reuser = 'true';
			
			$stats = getDetail($stats_table, 'email', $_POST['email']);
			
			foreach ($stats as $stat) {
				$clicks = $stat->visits;
				$conversions = $stat->conversions;
				$returncode = $stat->code;
			}
			
		} else {
		
			$reuser = 'false';
			postData($stats_table, $referredpost);
			
		}
			
	} else {
	
	    $email_check = 'invalid';
	
	}

	$return_arr["email_check"] = $email_check;
	$return_arr["reuser"] = $reuser;
	$return_arr["clicks"] = $clicks;
	$return_arr["conversions"] = $conversions;
	$return_arr["returncode"] = $returncode;
	$return_arr["email"] = $_POST['email'];
	$return_arr["code"] = $_POST['code'];

} else if(!isset($_POST)){ 

	echo "hmmm..."; 

}  

echo json_encode($return_arr);

?>