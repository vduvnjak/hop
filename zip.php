<?php
require "include/connect_db.php";
$zip=substr ($_REQUEST['czip'],0,5);
$data = array("zip_data");
	$d_query = db_query ("SELECT city,state FROM zip_city WHERE zip=$zip");
	$city = $data['zip_data']['city'] = db_result($d_query,0,0);
	$zstate = $data['zip_data']['zstate'] = db_result($d_query,0,1);
	db_free_result($d_query);
	
	// now we have state abbr., we need state id as well	
	$s_query = db_query ("SELECT state_id, state FROM state WHERE state_abbr='$zstate'");
	$state_id = $data['zip_data']['state_id'] = db_result($s_query,0,0);
	$state = $data['zip_data']['state'] = db_result($s_query,0,1);

	echo json_encode($data); 
?>