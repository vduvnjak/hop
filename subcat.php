<?php
require "include/connect_db.php";
$category=$_REQUEST['category'];
$data = array("subcat_data");
	$d_query = db_query ("SELECT code, name FROM subcategories WHERE categoryCode='$category'");
	$nr_results = db_numrows($d_query);
	for ($i=0; $i<$nr_results; $i++)
	{
		$data['subcat_data']['code'][$i] = db_result($d_query,$i,0);
		$data['subcat_data']['name'][$i] = db_result($d_query,$i,1);
	}
	db_free_result($d_query);

	echo json_encode($data); 
?>