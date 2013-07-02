<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hop On Buy</title>
<link rel="stylesheet" type="text/css" href="include/css/styles.css" media="screen" />
<script src="include/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		$("#login_form").submit(function() {
			var unameval = $("#username").val();
			var pwordval = $("#password").val();
			$.post("login_check.php", { username: unameval, password: pwordval }, function(data) {
				$("#status p").html(data);
			});
			return false;
		});

		$(".fade").fadeTo("fast", 0.7);
		$(".fade").hover(function(){
				$(this).fadeTo("slow", 1.0);
			},
			function(){
				$(this).fadeTo("slow", 0.7);
			});
	});
</script>
</head>

<body>
<?php if (isset($_GET['reg'])) include ("register_form.php"); ?>
<div id="main_container">
	<div id="header">
    	<h1><a href="index.php" title="HopOnBuy: Get empowered."><img border=0 src="images/hoponbuy_logo.png" /></a></h1>
		
			<div id="login">
				<form id="login_form" method="post">
					<fieldset id="fieldset">
						<label for="status"></label><span id="status"><p>&nbsp;</p></span>
						<label for="username">Username</label>&nbsp;<input type="text" size=8 id="username" name="username"/>&nbsp;&nbsp;
						<label for="password">Password</label>&nbsp;<input type="password" size=8 id="password" name="password"/>&nbsp;&nbsp;<input type="submit" id="button" value="Log in">
						<div>
							<a href="forgot_pass.php?forgot_pass=1">Forgot password</a>&nbsp;&nbsp;&nbsp;
							<a href="index.php?reg=1">Create account?</a>
						</div>
					</fieldset>
				</form>
			</div><!--end of login-->
    	
    </div><!--end of header-->
 
	<div id="deal_tables">
		<table class=deal_table_hod width=300 cellpading=0 cellspacing=0 border=0>
		<tr><th colspan=3><b>Hot Open Deals</b></th></tr>
		<tr><td class=th2l width=195><b>Deal</b></td><td class=th2l width=65><b>Ends</b></td><td class=th2r width=40><font color=#55ee33><b>Save</b></td></tr>
		<tr><td>Toyota Camry SFO<td>04/10/2011</td><td class=right><b><font color=#55ee33>34 %</font></b></td></tr>
		<tr><td>BMW Dublin<td>04/10/2011</td><td class=right><b><font color=#55ee33>32.5 %</font></b></td></tr>
		<tr><td>Sony HD TV Sears<td>04/10/2011</td><td class=right><b><font color=#55ee33>25 %</font></b></td></tr>
		<tr><td>Toyota Camry SFO<td>04/10/2011</td><td class=right><b><font color=#55ee33>19 %</font></b></td></tr>
		<tr><td>BMW Dublin<td>04/10/2011</td><td class=right><b><font color=#55ee33>16.5 %</font></b></td></tr>
		<tr><td colspan=3 class=bottom_space></td></tr>
		</table>
		
		<table class=deal_table_lcd width=300 cellpading=0 cellspacing=0 border=0>
		<tr><th colspan=3><b>Last Closed Deals</b></th></tr>
		<tr><td class=th2l width=195><b>Deal</b></td><td class=th2l width=65><b>Closed</b></td><td class=th2r width=40><b>Saved</b></td></tr>
		<tr><td>Toyota Camry SFO<td>03/10/2011</td><td class=right><b><font color=#ffcc55>13 %</font></b></td></tr>
		<tr><td>BMW Dublin<td>03/09/2011</td><td class=right><b><font color=#ffcc55>9.5 %</font></b></td></tr>
		<tr><td>Sony HD TV Sears<td>03/08/2011</td><td class=right><b><font color=#ffcc55>25 %</font></b></td></tr>
		<tr><td>Toyota Camry SFO<td>03/05/2011</td><td class=right><b><font color=#ffcc55>13 %</font></b></td></tr>
		<tr><td>BMW Dublin<td>03/02/2011</td><td class=right><b><font color=#ffcc55>9.5 %</font></b></td></tr>
		<tr><td colspan=3 class=bottom_space></td></tr>
		</table>
		
		<table class=deal_table_bs width=300 cellpading=0 cellspacing=0 border=0>
		<tr><th colspan=3><b>Best Deals so far</b></th></tr>
		<tr><td class=th2l width=195><b>Deal</b></td><td class=th2l width=65><b>Closed</b></td><td class=th2r width=40><b>Saved</b></td></tr>
		<tr><td>Toyota Camry SFO<td>03/10/2011</td><td class=right><b><font color=#ffcc55>$ 2,500</font></b></td></tr>
		<tr><td>BMW Dublin<td>04/10/2011</td><td class=right><b><font color=#ffcc55>$ 2,130</font></b></td></tr>
		<tr><td>Sony HD TV Sears<td>11/10/2011</td><td class=right><b><font color=#ffcc55>$ 2,000</font></b></td></tr>
		<tr><td>Toyota Camry SFO<td>03/10/2011</td><td class=right><b><font color=#ffcc55>$ 1,500</font></b></td></tr>
		<tr><td>BMW Dublin<td>04/10/2011</td><td class=right><b><font color=#ffcc55>$ 1,230</font></b></td></tr>
		<tr><td colspan=3 class=bottom_space></td></tr>
		</table>
    </div><!--end of tables-->
    <div style=" clear:both;"></div>
    
	<div id="infograph">
		<!--<img border=0 src='images/hoponbuy.png'>-->   
		<img class="fade" align=left width=318 height=336 border=1 src='images/hoponbuy01.png'> 
		<img class="fade" align=left width=318 height=336 border=1 src='images/hoponbuy02.png'> 
		<img class="fade" align=left width=318 height=336 border=1 src='images/hoponbuy03.png'>   
	</div><!--end of infograph-->
    
	<div id="footer"><?php include ("footer.html") ?></div>
</div> <!--end of main_container-->

</body>
</html>

