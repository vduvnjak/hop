<?php
require_once 'include/connect_db.php';
require_once 'include/class_mail_send.php'; 
require_once 'include/small_functions.php';
require_once 'include/access.class.php';
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
    	<h1><a href="index.php" title="HopOnBuy: Get empowered."><img border=0 src="images/background-ballpark-logo.png" /></a></h1>	
    </div><!--end of header-->
    
	<div id="user_content">
	<?php 

	if ( (isset($_POST['newpass'])) && (isset($_POST['email'])) )
	{
		
		$email = $_POST['email'];
		// we will get user data from email
		
		
		if (isValidEmail($email))
		{
		
			$user_data_query = db_query (" SELECT * FROM users WHERE email = '$email'");
			$userId = db_result ($user_data_query,0,'userID');
			$firstname = db_result ($user_data_query,0,'fname');
			$username = db_result ($user_data_query,0,'username');
			
			
			//record_activity($userId,"request_new_pass");
			$password = randomPass(10, '1234567890qwertyuiopasdfghjklzxcvbnm');
			$sha1password = sha1($password);
			
			$update_pass_query = db_query (" UPDATE users SET password='$sha1password' WHERE UserID = $userId ");
				
			$html = true; 
			$mail = new mail_send(); 
			
			$mail->setSenderData("HopOnBuy Team","mailer@hoponbuy.com"); 
			$mail->subject("Your new password"); 
			$mail->to($email);   
			
			if(true==$html) 
			{ 
			    $mail->html("<font face='Tahoma' size=2 color='#555599'>Dear $firstname,<br>Your credentials are updated.</font><br><br>
			    Your username is : $username<br>
			    Your new pass is : $password<br><br>
			    <font face='Tahoma' size=1 color='#111111'><i>Your HopOnBuy Team<i/></font>"); 
			} 
			else 
			{ 
			    $mail->text("Dear $firstname,<br>Your credentials are updated.<br><br>
			    Your username is : $username<br>
			    Your new pass is : $password<br><br>
			    <i>Your IWC Team<i/>"); 
			} 
			
			//$mail->attachment("text.zip"); 
			$mail->send(); 
			
			
			echo "
			<b>Forgot password</b><br>
			<hr><br>
			<p>Dear $firstname, <br> Your username and a new password have been be emailed to you. <br><br></p><br>
			<i> Your <font color=#ffcc55> HopOnBuy</font> Team</i>";
		}
		else 
		{
			echo "
			<b>Forgot password</b><br>
			<hr><br>
			<p>Please enter a valid email address.</p><br>
			<p> <a href='forgot_pass.php?forgot_pass=1'><font color=#ffcc55>Go Back</font></a><br></p><br>";
		}
	
	}
	
	
	else if (isset($_GET['forgot_pass']))
	{
		
	echo "
		<b>Forgot password</b><br>
		<hr><br>
		<p>Please enter your email address to receive your account credentials. <br>
		Your username and a new password will be emailed to you. <br><br>
		Please change your password upon logging by going to  settings -> Password update.<br>
		Please note that if you did not supply a valid email upon registration,
		 you will not receive your new password.</p><br>
		<p><form method='post' action='forgot_pass.php' /> 
		 Your email address: <input type='text' name='email' />&nbsp;&nbsp;
		 <input type='submit' value='Request New Password' />
		 <input type='hidden' name=newpass value='1' />
		</form>
		</p>
	";
	}
	
	?>
	
   </div><!--end of tables-->

    <div style=" clear:both;"></div>
    
	<div id="footer">
 	<?php include ("footer.html") ?>
 	</div>

</div> <!--end of main_container-->

</body>
</html>

	