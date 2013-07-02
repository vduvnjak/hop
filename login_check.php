<?php
require_once 'include/access.class.php';
$user = new flexibleAccess();

	if (isset($_POST['username']) && isset($_POST['password']))
	{
		  if ( !$user->login($_POST['username'],$_POST['password'],$_POST['remember'] ))
		  {
			  	//we don't have to use addslashes as the class do the job
			  	if (!isset($_SESSION[userSessionValue])) 
			  	{
			  		$userId=0;
			  	}
			  	else $userId = $_SESSION[userSessionValue];
			    echo 'Login failed';
			    
		  }
		  else
		  {
		  		?><script>
				window.location = "user_area.php";
				</script><?php 
		  }
	}
	else 
	{
		 echo 'Missing user or pass';
	}
	
	
?>
