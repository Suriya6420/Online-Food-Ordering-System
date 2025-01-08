<?php
include("header.php");
if(isset($_POST[submit]))
{
$sql="INSERT INTO restaurant(restauranttype,restaurantname,loginid,password,locationid,address,contactno,status)VALUES('$_POST[restauranttype]','$_POST[restaurantname]','$_POST[loginid]','$_POST[password]','$_POST[locationid]','$_POST[address]','$_POST[contactno]','Pending')";
$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Restaurant Registration done successfully.. Admin will verify your account in 24 hours...');</script>";
		echo "<script>window.location='index.php';</script>";
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
		<h3 >Restaurant Registration Panel</h3>
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
Restaurant type:<label class="errmsg" id="idrestauranttype"></label>
<select name="restauranttype" class="form-control">
	<option value=''>Select</option>
		<?php
		$arr = array("Vegetarian","Non-vegetarian","Both");
		foreach($arr as $val)
		{
			echo "<option value='$val'>$val</option>";
		}
		?>
</select>
<br>
Restaurant Name: <label class="errmsg" id="idrestaurantname"></label><input type="text" name="restaurantname" class="form-control">
<br>
login Id:<label class="errmsg" id="idloginid"></label> <input type="text" name="loginid" class="form-control">
<br>
Password:<label class="errmsg" id="idpassword"></label><input type="password" name="password" class="form-control">
<br>
Confirm Password:<label class="errmsg" id="idcpassword"></label><input type="password" name="cpassword" class="form-control">
<br>
Location: <label class="errmsg" id="idlocationid"></label><select name="locationid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqllocation="select * from location WHERE status='Active'";
	$qsqllocation =mysqli_query($con,$sqllocation);
	while($rslocation =mysqli_fetch_array($qsqllocation))
	{
		echo "<option value='$rslocation[locationid]'>$rslocation[locationname]</option>";
	}
	?>
</select>
<br>
Address:<label class="errmsg" id="idaddress"></label> 
<textarea name="address" class="form-control"><?php echo $rsedit[address]; ?></textarea>
<br>
contact No: <label class="errmsg" id="idcontactno"></label><input type="text" name="contactno" class="form-control">
<br>
<br>
	<center><input type="submit" name="submit" value="Click here to Register"  class='btn btn-info' style="width:300px;"></center>	
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
	
	if(document.frmform.restauranttype.value == "")
	{
		document.getElementById("idrestauranttype").innerHTML = "restaurant type should not be empty..";
		errcondition = "false";
		}
		if(!document.frmform.restaurantname.value.match(alphaSpaceExp))
	{
		document.getElementById("idrestaurantname").innerHTML = "Entered restaurant name is not valid...";
		errcondition = "false";
	}
	if(document.frmform.restaurantname.value == "")
	{
		document.getElementById("idrestaurantname").innerHTML = "restaurant name should not be empty..";
		errcondition = "false";
		}
		if(!document.frmform.loginid.value.match(alphaNumericExp))
	{
		document.getElementById("idloginid").innerHTML = "Entered loginid is not valid...";
		errcondition = "false";
	}
		if(document.frmform.loginid.value == "")
	{
		document.getElementById("idloginid").innerHTML = "login id should not be empty..";
		errcondition = "false";
		}
		
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
		if(document.frmform.locationid.value == "")
	{
		document.getElementById("idlocationid").innerHTML = "location id type should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.address.value == "")
	{
		document.getElementById("idaddress").innerHTML = "address should not be empty..";
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
		document.getElementById("idcontactno").innerHTML = "contact no should not be empty..";
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
