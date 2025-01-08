<?php
include("header.php");
if(isset($_POST[submit]))
{
	$sql="INSERT INTO customer(customername,companyname,emailid,password,contactno,address,status)values('$_POST[customername]','$_POST[companyname]','$_POST[emailid]','$_POST[password]','$_POST[contactno]','$_POST[address]','Active')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer Registration done successfully..');</script>";	
		echo "<script>window.location='custlogin.php';</script>";
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
		<center><h3 >Customer Registration Panel</h3></center>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact">
	<div class="container">
		<div class=" contact-w3">	

			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				<p style="color:blue;" ><b> Kindly enter following details</b></p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>
<form action="" method="post" name="frmform" onsubmit="return validateform()">
Customer Name: <label class="errmsg" id="idcustomername"></label> <input type="text" name="customername" class="form-control">
<br>
Email ID: <label class="errmsg" id="idemailid"></label><input type="text" name="emailid" class="form-control">
<br>
Password: <label class="errmsg" id="idpassword"></label> <input type="password" name="password" class="form-control">
<br>
Confirm Password: <label class="errmsg" id="idcpassword"></label> <input type="password" name="cpassword" class="form-control">
<br>
Contact No: <label class="errmsg" id="idcontactno"></label><input type="text" name="contactno" class="form-control">
<br>
<br>
	<center>
	<?php
	/*
	<input type="reset"  class="btn btn-info" style="width:200px;">
	*/
	?>
	<input type="submit" name="submit" value="Click here to Register" class="btn btn-info" style="width:200px;"></center>
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
	
	if(!document.frmform.customername.value.match(alphaSpaceExp))
	{
		document.getElementById("idcustomername").innerHTML = "Entered customer name is not valid...";
		errcondition = "false";
	}
	if(document.frmform.customername.value == "")
	{
		document.getElementById("idcustomername").innerHTML = "Customer name should not be empty..";
		errcondition = "false";
	}
	if(!document.frmform.emailid.value.match(emailExp))
	{
		document.getElementById("idemailid").innerHTML = "Entered Email ID is not valid...";
		errcondition = "false";
	}
	if(document.frmform.emailid.value == "")
	{
		document.getElementById("idemailid").innerHTML = "Email ID should not be empty..";
		errcondition = "false";
	}
	if(document.frmform.password.value.length < 6)
	{
		document.getElementById("idpassword").innerHTML = "Password should contain more than 6 characters..";
		errcondition = "false";
	}
	if(document.frmform.password.value == "")
	{
		document.getElementById("idpassword").innerHTML = "Password should not be empty..";
		errcondition = "false";
	}
	if(document.frmform.password.value != document.frmform.cpassword.value)
	{
		document.getElementById("idcpassword").innerHTML = "Password and Confirm Password not matching...";
		errcondition = "false";
	}
	if(document.frmform.cpassword.value == "")
	{
		document.getElementById("idcpassword").innerHTML = "Confirm password should not be empty..";
		errcondition = "false";
	}
	if(document.frmform.contactno.value.length != 10)
	{
		document.getElementById("idcontactno").innerHTML = "Contact number should contain 10 digits..";
		errcondition = "false";
	}
	if(!document.frmform.contactno.value.match(numericExpression))
	{
		document.getElementById("idcontactno").innerHTML = "Entered Contact number should contain digits...";
		errcondition = "false";
	}
		if(document.frmform.contactno.value == "")
	{
		document.getElementById("idcontactno").innerHTML = "Contact no should not be empty..";
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