<?php
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE customer SET customername='$_POST[customername]',companyname='$_POST[companyname]',emailid='$_POST[emailid]',password='$_POST[password]',contactno='$_POST[contactno]',address='$_POST[address]',locationid='$_POST[locationid]',cityid='$_POST[cityid]',status='$_POST[status]' WHERE customerid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('customer Record updated successfully..');</script>";
			echo "<script>window.location='viewcustomer.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
    {
		$sql="INSERT INTO customer(customername,companyname,emailid,password,contactno,address,locationid,cityid ,status)values('$_POST[customername]','$_POST[companyname]','$_POST[emailid]','$_POST[password]','$_POST[contactno]','$_POST[address]','$_POST[locationid]','$_POST[cityid]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
		echo "<script>alert('customer record inserted successfully..');</script>";	
			echo "<script>window.location='customer.php';</script>";
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
	$sqledit = "select * from customer WHERE customerid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Customer</h3>
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
Customer Name: <label class="errmsg" id="idcustomername"></label> <input type="text" name="customername" value="<?php echo $rsedit[customername]; ?>" class="form-control">
<br>
Company Name:  <label class="errmsg" id="idcompanyname"></label> <input type="text" name="companyname" value="<?php echo $rsedit[companyname]; ?>" class="form-control">
<br>
Email Id:  <label class="errmsg" id="idemailid"></label> <input type="text" name="emailid" value="<?php echo $rsedit[emailid]; ?>" class="form-control">
<br>
Password:  <label class="errmsg" id="idpassword"></label>  <input type="password" name="password" value="<?php echo $rsedit[password]; ?>" class="form-control">
<br>
Confirm Password:  <label class="errmsg" id="idcpassword"></label>  <input type="password" name="cpassword" value="<?php echo $rsedit[password]; ?>" class="form-control">
<br>
Contact No:   <label class="errmsg" id="idcontactno"></label> <input type="text" name="contactno" value="<?php echo $rsedit[contactno]; ?>" class="form-control">
<br>
Address:   <label class="errmsg" id="idaddress"></label> 
<textarea name="address" class="form-control"><?php echo $rsedit[address]; ?></textarea>
<br>
Location:   <label class="errmsg" id="idlocationid"></label> <select name="locationid" class="form-control">
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
City:   <label class="errmsg" id="idcityid"></label> <select name="cityid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqlcity="select * from city WHERE status='Active'";
	$qsqlcity =mysqli_query($con,$sqlcity);
	while($rscity =mysqli_fetch_array($qsqlcity))
	{
		
		echo "<option value='$rscity[cityid]'>$rscity[city]</option>";
	}
	?>
</select>
<br>
Status:   <label class="errmsg" id="idstatus"></label> 
<select name="status" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Active","Inactive");
	foreach($arr as $val)
	{
		if($val == $rsedit['status'])
		{
		echo "<option value='$val' selected>$val</option>";
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
		document.getElementById("idcontactno").innerHTML = "Contact number should not be empty..";
		errcondition = "false";
	}
	if(document.frmform.address.value == "")
	{
		document.getElementById("idaddress").innerHTML = "Address should not be empty..";
		errcondition = "false";
	}
	if(document.frmform.locationid.value == "")
	{
		document.getElementById("idlocationid").innerHTML = "Kindly select location..";
		errcondition = "false";
	}
	if(document.frmform.cityid.value == "")
	{
		document.getElementById("idcityid").innerHTML = "Kindly select city..";
		errcondition = "false";
	}
	if(document.frmform.status.value == "")
	{
		document.getElementById("idstatus").innerHTML = "Kindly select status..";
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