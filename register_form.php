<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Form</title>
<?php require "include/connect_db.php";?>
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
		$("#cphone").inputmask("mask", {"mask": "(999) 999-9999"}); 

		tooltipcall("#cemail");  

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
	    
	     $.validator.addMethod("PhoneReq", function(value, element) {
		    var find_underscore = value.indexOf("_");
			if (find_underscore==-1)
			{
				$("#cphone").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#cphone").addClass('redbackground');
				return false;
			}

	    }, "Please enter a phone number.");


	     $.validator.addMethod("CheckUsername", function(value, element) {

			$.getJSON('username.php',{username:value},function(json){
				if (json.username_data.username == false) 
				{
					finduser=0;
				}
				else 
				{
					finduser=1;
				}
			});
				
			if (finduser==0)
			{
				$("#cusername").removeClass('redbackground');
				return true;
			}
			else 
			{
				$("#cusername").addClass('redbackground');
				return false;
			}

	    }, "Username is already taken.");

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
		    
	  	
	  	$.validator.addMethod("MustSelectOpt", function(value, element) {
			if (value != "") return true;
			else return false;
	    }, "Please select an option.");

		
		 
		function checkInputVal()
		{
			if ( ($("#cname").valid()) && ($("#clastname").valid()) && ($("#cstreet").valid()) && ($("#czip").valid()) && ($("#city").valid()) && ($("#cstate").valid()) && ($("#cphone").valid()) && ($("#cemail").valid()) && ($("#cusername").valid()) && ($("#cpassword2").valid()) ) return true;
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

		

		$("#iwcForm").submit(function() {
		(checkInputVal()); 

		});
		
		
		 $("#iwcForm").validate({
		
		errorPlacement: function(error, element) {
			 error.insertAfter(element);
	         error.appendTo( element.parent("p").next("p") );
	        }
			   		
		
		});		
		
		$("#iwcForm").bind("keypress", function(e) {
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

function light()
{
	document.getElementById('light').style.display='block';
	document.getElementById('fade').style.display='block';	
}
function dark()
{
	document.getElementById('light').style.display='none';
	document.getElementById('fade').style.display='none';	
}

</script>
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


	</head>
	<body onload = "light();">
	
		<div id="light" class="white_content">
		<!--<table border=0 width=100%>
		  <tr><td align=right><a href = "javascript:void(0)" onclick = "dark();"><img border=0 src='./images/close.png'></a></td></tr>
		<tr><td align=right><a href = "javascript:void(0)" onclick = "window.location='index.php'"><img border=0 src='./images/close.png'></a></td></tr>
		</table>-->
		<table border=0 width=100%>
		<tr><td width=100% align=center>
		<form class="iwcForm" id="iwcForm" method="post" action="form_submit.php">
			<fieldset id="form_fieldset">
				
				<p class=close_button><a href = "javascript:void(0)" onclick = "window.location='index.php'"><img border=0 src='./images/close.png'></a></p>
				<p>
					<label for="form_header"></label><em></em>
					<span class=form_header>Create an account</span>
				</p>
				<p>
					<label for="cname">Name</label><em>*</em>
					<input type="text" id="cname"  name="name" size="12" value="" class="FirstNameReq" />
					<input type="text" id="clastname"  name="lastname" size="12" value=""  class="LastNameReq"  />
				</p>
				<p class=error>&nbsp;</p>
				
				<p>
					<label for="cstreet">Street</label><em>*</em>
					<input id="cstreet" title="" name="street" size="25"  class="StreetReq"  />
				</p>
				<p class=error>&nbsp;</p>
				
				<p>
					<label for="city">City</label><em>*</em>
					<input id="city" name="city" title="" size="25"  class="CityReq" />
				</p>
				<p class=error>&nbsp;</p>
				
				<p>
					<label for="state">State and Zip</label><em>*</em>
					<select id="cstate" name="state"  class="StateReq" >
					<?php dropquery ("state_abbr","state","state","state"); ?>
					</select>
					<input id="czip"  name="zip" class="ZipReq"  size="5" />
				</p>
				<p class=error>&nbsp;</p>
				
				<p>
					<label for="cphone">Phone</label><em>*</em>
					<input id="cphone" title="" name="phone" size="14" class="PhoneReq" />&nbsp;ext.&nbsp;
					<input id="cphoneext" title="Optional" name="phoneext" size="2" />
				</p>
				<p class=error>&nbsp;</p>
				
				<p>
				<label for="cemail">E-Mail Address</label><em>*</em>
				<input id="cemail" title="Don't worry we hate spam ourselves!" name="email" size="25"  class="required email" />
				</p>
				<p class=error>&nbsp;</p>
				
				<p>
					<label for="form_header"></label><em></em>
					<span class=form_header>Select an ID and password</span>
				</p>
				
				<p>
					<label for="cusername">Desired Username</label><em>*</em>
					<input id="cusername" title="" name="username" size="25"  class="required CheckUsername"  />
				</p>
				<p class=error>&nbsp;</p>
				
				<p>
					<label for="cpassword">Desired Password</label><em>*</em>
					<input id="cpassword" type="password" title="" name="password" size="25"  class="required"  />
				</p>
				<p class=error>&nbsp;</p>
				
				<p>
					<label for="cpassword2">Re-type Password</label><em>*</em>
					<input id="cpassword2" type="password" title="" name="password2" size="25"  class="required CheckPass"  />
				</p>
				<p class=error>&nbsp;</p>
				
				<div id="dsubmit">
				<p>
					<label for="dsubmit">&nbsp;&nbsp;</label><em>&nbsp;</em>
					<input type="image" class=img_sub src="images/submit_button.png" value="Submit" alt="Submit">
				</p>
				</div>
		
			</fieldset>
		</form>		
		

		
		</td></tr>
		</table>
		</div>
		<div id="fade" class="black_overlay"></div>
		
	</body>
</html>