<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Form</title>
<?php 
require "include/connect_db.php";
require_once 'include/access.class.php';
$user = new flexibleAccess();
?>
<script src="include/js/jquery.tools.min.js"></script>
<script src="include/js/jquery.validate.js" type="text/javascript"></script>
<script src="include/js/jquery.defaultvalue.js" type="text/javascript"></script>
<script src="include/js/jquery.inputmask.js" type="text/javascript"></script>
<script src="include/js/jquery.password_strength.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="include/css/styles.css" media="screen" />
<link rel="stylesheet" type="text/css" href="include/css/form_style.css" media="screen" />
<script type="text/javascript">

(function($){ // no-conflict wrapper
  $(document).ready(function(){

	  $('form').attr('autocomplete', 'off');
	  $('#cpassword').password_strength();


	  $.validator.addMethod("CheckLength", function(value, element) {
			if (value.length >=6) 
			{
				$("#cpassword").removeClass('redbackground');
				$("#cpassword2").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#cpassword").addClass('redbackground');
				$("#cpassword2").addClass('redbackground');
				return false;
			}

	    }, "Enter at least 6 characters.");

	  
	  $.validator.addMethod("CheckPass", function(value, element) {
		    var sec_pass = value;
		    var first_pass = $("#cpassword").val();
			if (sec_pass==first_pass)
			{
				$("#cpassword").removeClass('redbackground');
				$("#cpassword2").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#cpassword").addClass('redbackground');
				$("#cpassword2").addClass('redbackground');
				return false;
			}
	
	    }, "Passwords do not match.");

	  function checkInputVal()
		{
			if ( ($("#cpassword").valid()) && ($("#cpassword2").valid()) ) return true;
			else return false;
		};

		$("#upgForm").submit(function() {
		(checkInputVal()); 

		});
		
		
		 $("#upgForm").validate({
		
			errorPlacement: function(error, element) {
			 error.insertAfter(element);
	         error.appendTo( element.parent("p").next("p") );
	        }
			   		
		
		});		
		
		$("#upgForm").bind("keypress", function(e) {
		    var c = e.which ? e.which : e.keyCode;
		    if (c == 13) 
			{
		        return false;
		    }
		});

		
		
 	
  }); 

  

  function tooltipcall(selector)
  {
	  $(selector).tooltip({

			// place tooltip on the right edge
			position: "center right",

			// a little tweaking of the position
			offset: [-2, 10],

			// use the built-in fadeIn/fadeOut effect
			effect: "fade",

			// custom opacity setting
			opacity: 0.7

		}); 

  }


  

  
})(jQuery);    // end of no-conflict wrapper




</script>
</head>
<body>
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

		$userId = $_SESSION[userSessionValue];
		
		$user_data_query = db_query (" SELECT * FROM users WHERE UserID = $userId");
		$email = db_result ($user_data_query,0,'email');
		$firstname = db_result ($user_data_query,0,'fname');
		
		
			echo"
			<div id='update_infobox'>
			<form id='upgForm' method='post' action='update_pass_complete.php'>
				<fieldset id='update_fieldset'>
	
					<ul>
					    <li><strong>Update Your Information</strong></li>
					</ul><br><br>
						
					<p>
						<label for='cpassword'>New Password</label><em>*</em>
						<input id='cpassword' type='password'  name='password' size='20'  class='required CheckPass CheckLength'  />&nbsp;&nbsp;
					</p>
					<p class=error>&nbsp;</p>
					
					<p>
						<label for='cpassword2'>Re-type Password</label><em>*</em>
						<input id='cpassword2' type='password'  name='password2' size='20'  class='required CheckPass'  />
					</p>
					<p class=error>&nbsp;</p>
		
							
					<div id='dsubmit'>
					<p>
						<label for='dsubmit'>&nbsp;&nbsp;</label><em>&nbsp;</em>
						<input type='submit' value='Update' alt='Update'>
					</p>
					</div>
				
				</fieldset>
			</form>	
			</div>
			";
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
