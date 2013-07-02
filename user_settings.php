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
<link rel="stylesheet" type="text/css" href="include/css/styles.css" media="screen" />
<script src="include/js/jquery-1.4.4.min.js" type="text/javascript"></script>
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
			echo "<center><br><br><br><br><br><br> <h1><b>You either disabled cookies, or you are not registered user.</b></h1><br><br><br></center>";
		}
		
		else
		{
			$userId = $_SESSION[userSessionValue] ;

			$user_data_query = db_query (" SELECT * FROM users WHERE UserID = $userId");
			$username = db_result ($user_data_query,0,"username");
			$email = db_result ($user_data_query,0,"email");
			$firstname = db_result ($user_data_query,0,"fname");
			$lastname = db_result ($user_data_query,0,"lname");
			$street = db_result ($user_data_query,0,"street");
			$city = db_result ($user_data_query,0,"city");
			$state = db_result ($user_data_query,0,"state");
			$zip = db_result ($user_data_query,0,"zip");
			$active = db_result ($user_data_query,0,"active");
			
			if ($active==1)
			{
				$signupDate = db_result ($user_data_query,0,"signupDate");
				$signupDate_f=date("M d Y",strtotime ($signupDate));
				$memb_sentence ="Member since $signupDate_f";
			}
			else 
			{
				$memb_sentence ="Membership not active";
			}
			
			
			echo"
			<span id='user_settings_infobox'>
			    <span class='account_info'>
			    ACCOUNT INFORMATION
			    	<span class='membersince'>$memb_sentence</span>
			    </span>
			         
				<span class='personal_data_info'>
				    <ul>
				    <li><strong>$firstname $lastname</strong></li>
				    <li>$street</li>
					<li>$city, $state $zip</li><br>
					<li><a href='update_address.php'>Update</a></li>
				     </ul>
				</span>
				<span class='pass_info'>
					<ul>
						<li><strong>$email</strong></li>
			
						<li>Password: ******</li><br>
						<li><a href='update_pass.php'>Update</a></li>
					</ul>
				</span>";
			
			echo "</span><div style='clear:both;'></div>";

			
		}
	
	?>	   
   
    </div><!--end of user_content-->

    <div style="clear:both;"></div>
    
	<div id="footer">
 	<?php include ("footer.html") ?>
 	</div>

</div> <!--end of main_container-->

</body>
</html>
