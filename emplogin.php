<?php
include("header.php");
if(isset($_SESSION["employeeid"]))
{
	echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_POST[submit]))
{
	$sql= "SELECT * FROM employee WHERE loginid='$_POST[loginid]' AND password='$_POST[Password]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION["employeeid"] = $rs["employeeid"];
		$_SESSION["employeetype"] = $rs["employeetype"];
		echo "<script>alert('Logged in successfully...')</script>";
		echo "<script>window.location='dashboard.php';</script>";
	}
	else
	{
		echo "<script>alert('Failed to login.');</script>";
	}
}
?>
  <!---->
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Login</h3>
		<h4><a href="index.html">Home</a><label>/</label>Login</h4>
		<div class="clearfix"> </div>
	</div>
</div>
<!--login-->

	<div class="login">
	
		<div class="main-agileits">
				<div class="form-w3agile">
					<h3>Employee Login Panel</h3>
					<form action="" method="post" name="frmform" onsubmit="return validateform()" >
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<label class="errmsg" id="idloginid"></label><input  type="text" name="loginid" placeholder="Enter Login ID" placeholder="Enter Login ID">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<label class="errmsg" id="idpassword"></label><input  type="password" name="Password" placeholder="Enter Password">
							<div class="clearfix"></div> 
						</div>
						<input type="submit" name="submit" value="Login">
					</form>
				</div>
			</div>
		</div>
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
if(document.frmform.loginid.value == "")
	{
		document.getElementById("idloginid").innerHTML = "Please enter the loginid..";
		errcondition = "false";
		}
	if(document.frmform.loginid.value == "")
	{
		document.getElementById("idpassword").innerHTML = "Please enter the password..";
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