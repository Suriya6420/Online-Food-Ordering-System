<?php
include("header.php");
if(isset($_POST[submit]))
{
	$sql ="UPDATE restaurant SET password='$_POST[password]' WHERE password='$_POST[oldpassword]' AND restaurantid='$_SESSION[restaurantid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Restaurant Password updated successfully..');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Restaurant Change Password</h3>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact">
	<div class="container">
		<div class=" contact-w3">	
			<div class="col-md-2">
			</div>
			<div class="col-md-8 ">
				<b> Kindly enter following details</b>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>
<form action="" method="post" name="frmform" onsubmit="return validateform()">
Old Password:<label class="errmsg" id="idoldpassword"></label><input type="password" name="oldpassword" class="form-control">
<br>
New Password:<label class="errmsg" id="idpassword"></label><input type="password" name="password" class="form-control">
<br>
Confirm Password:<label class="errmsg" id="idcpassword"></label><input type="password" name="cpassword" class="form-control">
<br>
<br>
	<center><input type="submit" name="submit" value="Click here to Update Password"  class='btn btn-info' style="width:300px;"></center>	
</form>

							</div>
						</div>
					</div>
				</div>
			
				
			</div>
				
			<div class="col-md-2">
			</div>
		<div class="clearfix"></div>
	</div>
	</div>
</div>
<!-- //contact -->
<?php
include("footer.php");
?>
<script>
function validateform()
{
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,6}$/;
	$('.errmsg').html('');
	var errcondition = "true";
		
	if(document.frmform.password.value.length < 6)
	{
		document.getElementById("idpassword").innerHTML = "Password should contain more than 6 characters..";
		errcondition = "false";
	}
		if(document.frmform.password.value == "")
	{
		document.getElementById("idpassword").innerHTML = "password should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.password.value != document.frmform.cpassword.value)
	{
		document.getElementById("idcpassword").innerHTML = "Password and Confirm Password not matching...";
		errcondition = "false";
	}
		if(document.frmform.cpassword.value == "")
	{
		document.getElementById("idcpassword").innerHTML = "confirm password id should not be empty..";
		errcondition = "false";
		}
		if(errcondition == "true")
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
