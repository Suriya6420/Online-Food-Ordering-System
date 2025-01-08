<?php
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE employee SET employeename='$_POST[employeename]',locationid='$_POST[locationid]',loginid='$_POST[loginid]',password='$_POST[password]',employeetype='$_POST[employeetype]',status='$_POST[status]' WHERE employeeid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('employee Record updated successfully..');</script>";
			echo "<script>window.location='viewemployee.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		$sql = "INSERT INTO employee(employeename,locationid,loginid,password,employeetype,status) VALUES('$_POST[employeename]','$_POST[locationid]','$_POST[loginid]','$_POST[password]','$_POST[employeetype]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
		echo "<script>alert('Employee Record inserted successfully..');</script>";
		echo "<script>window.location='employee.php';</script>";
		}
		else
		{
		echo mysqli_error($con);
		}
    }
}
//2. Select query starts
if(isset($_GET[editid]))
{
	$sqledit = "select * from employee WHERE employeeid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Employee</h3>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact">
	<div class="container">
		<div class=" contact-w3">	
<?php
include("sidebar.php");
?>
			<div class="col-md-9 ">
				<p style="color:blue;" ><b> Kindly enter following details</b></p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>
<form action="" method="post" name="frmform" onsubmit="return validateform()">
Employee Name:<label class="errmsg" id="idemployeename"></label><input type="text" name="employeename" value="<?php echo $rsedit[employeename]; ?>" class="form-control">
<br>
Location: <label class="errmsg" id="idlocationid"></label><select name="locationid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqllocation="select * from location WHERE status='Active'";
	$qsqllocation =mysqli_query($con,$sqllocation);
	while($rslocation =mysqli_fetch_array($qsqllocation))
	{
		if($rslocation[locationid] == $rsedit[locationid])
		{
		echo "<option value='$rslocation[locationid]' selected>$rslocation[locationname]</option>";
		}
		else
	{
		echo "<option value='$rslocation[locationid]'>$rslocation[locationname]</option>";
	}
	}
	?>
	</select>
	<br>
Login:<label class="errmsg" id="idloginid"></label><input type="text" name="loginid" value="<?php echo $rsedit[loginid]; ?>"class="form-control">
<br>
Password:<label class="errmsg" id="idpassword"></label><input type="password" name="password" value="<?php echo $rsedit[password]; ?>" class="form-control">
<br>
Confirm Password:<label class="errmsg" id="idcpassword"></label><input type="password" name="cpassword" value="<?php echo $rsedit[cpassword]; ?>" class="form-control">
<br>
Employee Type:<label class="errmsg" id="idemployeetype"></label> <select name="employeetype" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Admin","Employee");
	foreach($arr as $val)
	{
	if($val == $rsedit[status])
		{
		echo "<option value='$val'selected>$val</option>";
		}
			else
			{
		echo "<option value='$val'>$val</option>";
			}	
	}
	?>
</select>
<br>
Status: <label class="errmsg" id="idstatus"></label>
<select name="status" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Active","Inactive");
	foreach($arr as $val)
	{
		if($val == $rsedit[status])
		{
		echo "<option value='$val'selected>$val</option>";
		}
			else
			{
		echo "<option value='$val'>$val</option>";
			}
	}
	?>
</select>
<br>
	<center><input type="submit" name="submit" value="Submit" class="btn btn-info" style="width:200px;"></center>
</form>
							</div>
						</div>
					</div>
				</div>
				
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
	if(!document.frmform.employeename.value.match(alphaSpaceExp))
	{
		document.getElementById("idemployeename").innerHTML = "Entered employee name is not valid...";
		errcondition = "false";
	}
	if(document.frmform.employeename.value == "")
	{
		document.getElementById("idemployeename").innerHTML = "employeename name should not be empty..";
		errcondition = "false";
		}
	if(document.frmform.locationid.value == "")
	{
		document.getElementById("idlocationid").innerHTML = "locationid name should not be empty..";
		errcondition = "false";
		}
		if(!document.frmform.loginid.value.match(alphaNumericExp))
	{
		document.getElementById("idloginid").innerHTML = "Entered loginid is not valid...";
		errcondition = "false";
	}
	if(document.frmform.loginid.value == "")
	{
		document.getElementById("idloginid").innerHTML = "loginid  should not be empty..";
		errcondition = "false";
	}
	if(document.frmform.password.value.length < 6)
	{
		document.getElementById("idpassword").innerHTML = "Password should contain more than 6 characters..";
		errcondition = "false";
	}
	if(document.frmform.password.value == "")
	{
		document.getElementById("idpassword").innerHTML = "password name should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.password.value != document.frmform.cpassword.value)
	{
		document.getElementById("idcpassword").innerHTML = "Password and Confirm Password not matching...";
		errcondition = "false";
	}
		if(document.frmform.cpassword.value == "")
	{
		document.getElementById("idcpassword").innerHTML = "cpassword name should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.employeetype.value == "")
	{
		document.getElementById("idemployeetype").innerHTML = "employeetype should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.status.value == "")
	{
		document.getElementById("idstatus").innerHTML = "status name should not be empty..";
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
