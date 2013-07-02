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
<link rel="stylesheet" type="text/css" href="include/css/styles.css" media="screen" />
<link rel="stylesheet" type="text/css" href="include/css/form_style.css" media="screen" />
<script type="text/javascript">

(function($){ // no-conflict wrapper
  $(document).ready(function(){
	  
		$("#cname, #clastname, #cstreet").defaultvalue("First Name", "Last Name", "123 Main Street");
		
		

		$.validator.addMethod("FirstNameReq", function(value, element) {
			if ((value.length >=2) && (value !="First Name"))
			{

				$("#cname").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#cname").addClass('redbackground');
				return false;
			}

	    }, "Please enter first name.<br>");
	    
	    $.validator.addMethod("LastNameReq", function(value, element) {
	    	if ((value.length >=2) && (value !="Last Name"))
			{
				$("#clastname").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#clastname").addClass('redbackground');
				return false;
			}

	    }, "Please enter last name.<br>");
	    
	    $.validator.addMethod("StreetReq", function(value, element) {
	    	if ((value.length >=3) && (value !="123 Main Street"))
			{

				$("#cstreet").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#cstreet").addClass('redbackground');
				return false;
			}

	    }, "Please enter street address.");
	    
	    $.validator.addMethod("CityReq", function(value, element) {
			if (value.length >=2) 
			{
				$("#city").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#city").addClass('redbackground');
				return false;
			}

	    }, "Please enter city name.");
	    
	    $.validator.addMethod("StateReq", function(value, element) {
			if (value !="")
			{
				$("#cstate").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#cstate").addClass('redbackground');
				return false;
			}

	    }, "Please select the state.");
	    
	     $.validator.addMethod("ZipReq", function(value, element) {
			if (value.length >=5) 
			{
				$("#czip").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#czip").addClass('redbackground');
				return false;
			}

	    }, "Please enter zip code.");
	    
		    
	  	
	  	$.validator.addMethod("MustSelectOpt", function(value, element) {
			if (value != "") return true;
			else return false;
	    }, "Please select an option.");

		
		 
		function checkInputVal()
		{
			if ( ($("#cname").valid()) && ($("#clastname").valid()) && ($("#cstreet").valid()) && ($("#czip").valid()) && ($("#city").valid()) && ($("#cstate").valid()) ) return true;
			else return false;
		};


		// setting up state and city based on zip

		$("#czip").keyup(function() {
			var input_zip = $('#czip').val();
			var textlength = input_zip.length;
			if(textlength > 4)
			{
					$.getJSON('zip.php',{czip:$(this).val()},function(json){
					if (json.zip_data.city == false) $("#city").val("");
					else $("#city").val(json.zip_data.city);
					if (json.zip_data.zstate == false) (json.zip_data.state_id=0);
					$("#cstate").find("option[value=" + json.zip_data.zstate + "]").attr("selected","selected");
					//checkInputVal();
					});
					
			}
		});

		

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


function win_terms() {
    window.open("termsandconditions.html","Window","menubar=no,width=460,height=360,toolbar=no");
}

</script>
</head>
<?php

// here we write universal query for all drop downs
function dropquery ($field1,$field2,$table,$orderby)
{
		echo "<option value=''>Please Select</option>";
		$d_query = db_query ("SELECT $field1,$field2 FROM $table ORDER BY $orderby ASC");
		$rows = db_numrows ($d_query);
		for ($x=0; $x<$rows; $x++)
		{
			$tmp_value = db_result($d_query,$x,$field1);
			$tmp_text = db_result($d_query,$x,$field2); 
			echo "<option value=$tmp_value>$tmp_text</option>";
		}
		db_free_result($d_query);
}
 
?>
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
			<form id='upgForm' method='post' action='update_address_complete.php'>
				<fieldset id='update_fieldset'>
	
				<ul>
				    <li><strong>Update Your Information</strong></li>
				</ul><br><br>
				
						
						<p>
							<label for='cname'>Name</label><em>*</em>
							<input type='text' id='cname'  name='name' size='12' value='' class='FirstNameReq' />
							<input type='text' id='clastname'  name='lastname' size='12' value=''  class='LastNameReq'  />
						</p>
						<p class=error>&nbsp;</p>
						
						<p>
							<label for='cstreet'>Street</label><em>*</em>
							<input id='cstreet' title='' name='street' size='25'  class='StreetReq'  />
						</p>
						<p class=error>&nbsp;</p>
						
						<p>
							<label for='city'>City</label><em>*</em>
							<input id='city' name='city' title='' size='25'  class='CityReq' />
						</p>
						<p class=error>&nbsp;</p>
						
						<p>
							<label for='state'>State and Zip</label><em>*</em>
							<select id='cstate' name='state'  class='StateReq' >";
							dropquery ('state_abbr','state','state','state');
							echo "</select>
							<input id='czip'  name='zip' class='ZipReq'  size='5' />
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