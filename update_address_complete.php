<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Form</title>
<?php 
require "include/connect_db.php";
require_once 'include/class_mail_send.php'; 
require_once 'include/access.class.php';
$user = new flexibleAccess();
?>
<link rel="stylesheet" type="text/css" href="include/css/styles.css" media="screen" />
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
	    	
			$fname = $_POST['name'];
			$lname = $_POST['lastname'];
			$street = $_POST['street'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			
			$userId = $_SESSION[userSessionValue];
			
			$user_data_query = db_query (" SELECT * FROM users WHERE UserID = $userId");
			$email = db_result ($user_data_query,0,'email');
			$firstname = db_result ($user_data_query,0,'fname');		
			
			echo "
			<b>Info updated</b><br>
			<hr><br>
			<p>Dear $fname, <br> Your info is updated. <br><br></p><br>
			<i> Your <font color=#ffcc55> HopOnBuy</font> Team</i>";
		
			$html = true; 
			$mail = new mail_send(); 
			
			$mail->setSenderData("HopOnBuy Team","mailer@hoponbuy.com"); 
			$mail->subject("Your info is updated"); 
			$mail->to($email);  
			
			if(true==$html) 
			{ 
			    $mail->html("<font face='Tahoma' size=2 color='#555599'>Dear $firstname,<br>Your info is updated.</font><br><br><font face='Tahoma' size=1 color='#111111'><i>Your HopOnBuy Team<i/></font>"); 
			} 
			else 
			{ 
			    $mail->text("Dear $firstname,<br>Your info is updated.<br><br><i>Your HopOnBuy Team<i/>"); 
			} 
			 
			$mail->send(); 
			
						
			$update_query = db_query (" UPDATE users SET
			fname='$fname', lname='$lname', street='$street', city='$city', state='$state', zip='$zip'
			WHERE UserID = $userId
			");
			
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
