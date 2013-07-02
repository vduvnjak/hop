<?php
require "include/connect_db.php";
$username=$_REQUEST['username'];

$data = array("username_data");
	$d_query = db_query ("SELECT userID FROM users WHERE username='$username'");
	$user_found = $data['username_data']['username'] = db_result($d_query,0,0);
	db_free_result($d_query);

	echo json_encode($data); 
?>