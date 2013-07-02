<?php
require_once "include/connect_db.php";
require_once "include/small_functions.php";
require_once "include/access.class.php";
$user = new flexibleAccess();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hop On Buy</title>
<script src="include/js/jquery.tools.min.js" type="text/javascript"></script>
<script src="include/js/jquery.validate.js" type="text/javascript"></script>
<script src="include/js/newhop.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="include/css/styles.css" media="screen" />
<link rel="stylesheet" type="text/css" href="include/css/form_style.css" media="screen" />
</head>

<body >

<div id="main_container">
	<div id="header">
    <?php include ("ua_header.html") ?>
    </div><!--end of header-->
    
	<div id="user_content">
	<?php   
	     
		if (!$user->is_loaded())
		{ 
			echo "<center><br><br><br><br><br><br> <h1><b>You either disabled cookies, or you are not registered user.</b></h1><br><br><br><br><br></center>";
		}
		
		else
		{
			
			$userId = $_SESSION[userSessionValue];
			$user_active = check_active($userId);
			$user_data_query = db_query (" SELECT username, fname, lname FROM users WHERE UserID = $userId");
			$username = db_result ($user_data_query,0,"username");
			
			$content = $_REQUEST[content];
			
			echo"
			<div id='tabsH'>
			  <ul>
			    <li><a href='user_area.php?content=active' title='Your active Hops'><span>Your active Hops</span></a></li>
			    <li><a href='user_area.php?content=new' title='Create new Hop'><span>Create new Hop</span></a></li>
			    <li><a href='user_area.php?content=search' title='Search Hops'><span>Search Hops</span></a></li>
			  </ul>
			</div> <div style=' clear:both;'></div>";
			
			if ($content == 'new') include ('new_hop.php');
			else if ($content == 'search') include ('search_hops.php');
			else include ('active_hops.php');
			
		}
	
	?>	   
   
    </div><!--end of user_content-->

    <div style=" clear:both;"></div>
    
	<div id="footer">
 	<?php include ("footer.html") ?>
 	</div>

</div> <!--end of main_container-->

</body>
</html>

