<?php
//echo"<pre>";print_r($_REQUEST);	echo"<pre>";
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//exit;

require_once "include/connect_db.php";
require_once "include/small_functions.php";
require_once "include/access.class.php";
$user = new flexibleAccess();

	$username = 		($_REQUEST['username']);
	$password = 		($_REQUEST['password']);	
	$email = 			clean_colons(mysql_real_escape_string($_REQUEST['email']));	
	$fname = 			clean_colons(mysql_real_escape_string($_REQUEST['name']));
	$lname = 			clean_colons(mysql_real_escape_string($_REQUEST['lastname']));
	$street = 			clean_colons(mysql_real_escape_string($_REQUEST['street']));
	$city = 			clean_colons(mysql_real_escape_string($_REQUEST['city']));
	$state = 			$_REQUEST['state'];
	$zip= 				clean_colons(mysql_real_escape_string($_REQUEST['zip']));
	$phone = 			clean_colons(mysql_real_escape_string($_REQUEST['phone']));
	$phoneext = 		clean_colons(mysql_real_escape_string($_REQUEST['wphoneext']));
	
	
	// if working phone extension exist, we glue it to the phone
	if ($phoneext != "")
	{
		$phone = $phone." ext: ".$phoneext;
	}
	
	$signupDate = get_date_today();
	
	// do the insert
	
	$data = array(
	
  	'username' => $username,
  	'password' => $password,
	'email' => $email,
  	'active' => 1,
	'fname' => $fname,
  	'lname' => $lname,
	'street' => $street,
  	'city' => $city,
	'state' => $state,
  	'zip' => $zip,
	'phone' => $phone,
	'signupDate'=> $signupDate
	
  );
  $userID = $user->insertUser($data); //The method returns the userID of the new user or 0 if the user is not added
  if ($userID==0) echo "User not registered"; 
  else echo 'User registered with user id '.$userID;
  
	$user->login($username,$password,0);  
	?><script>window.top.location.href = "user_area.php";</script><?php

?>
