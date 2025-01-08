<?php
include("header.php");
if(isset($_POST[submit]))
{
	$filename = rand(). $_FILES["restaurantimage"]["name"];
	move_uploaded_file($_FILES["restaurantimage"]["tmp_name"],"imgrestaurant/".$filename);
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE restaurant SET restaurantname='$_POST[restaurantname]',loginid='$_POST[loginid]',password='$_POST[password]',locationid='$_POST[locationid]',restauranttype='$_POST[restauranttype]',";
		if($_FILES["restaurantimage"]["name"] != "")
		{
		$sql = $sql . "restaurantimage='$filename',";
		}
		$sql = $sql . "restaurantdiscription='$_POST[restaurantdiscription]',status='$_POST[status]' WHERE restaurantid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Restaurant profile updated successfully..');</script>";
			echo "<script>window.location='viewrestaurant.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
$sql="INSERT INTO restaurant(restaurantname,loginid,password,locationid,restauranttype,restaurantimage,restaurantdiscription,status)VALUES('$_POST[restaurantname]','$_POST[loginid]', '$_POST[password]','$_POST[locationid]','$_POST[restauranttype]','$filename','$_POST[restaurantdiscription]','$_POST[status]')";
$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Restaurant Record inserted successfully..');</script>";
		echo "<script>window.location='restaurant.php';</script>";
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
	$sqledit = "select * from restaurant WHERE restaurantid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Restaurant</h3>
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
<form action="" method="post" enctype="multipart/form-data" name="frmform" onsubmit="return validateform()">
Restaurant Name: <label class="errmsg" id="idrestaurantname"></label><input type="text" name="restaurantname" value="<?php echo $rsedit[restaurantname]; ?>"class="form-control">
<br>
login Id: <label class="errmsg" id="idloginid"></label><input type="text" name="loginid" value="<?php echo $rsedit[loginid]; ?>"class="form-control">
<br>
Password:<label class="errmsg" id="idpassword"></label><input type="password" name="password"value="<?php echo $rsedit[password]; ?>" class="form-control">
<br>
Confirm Password:<label class="errmsg" id="idcpassword"></label><input type="password" name="cpassword" value="<?php echo $rsedit[password]; ?>" class="form-control">
<br>
Location:<label class="errmsg" id="idlocationid"></label> <select name="locationid" class="form-control">
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
Restaurant Type:<label class="errmsg" id="idrestauranttype"></label>
<select name="restauranttype" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Vegetarian","Non-vegetarian","Both");
	foreach($arr as $val)
	{
		if($val == $rsedit[restauranttype])
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
Restaurant Image: <input type="file" name="restaurantimage"  class="form-control">
<?php
		if($rsedit["imgrestaurant"] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("restaurantimage/".$rsedit[imgrestaurant]))
		{
			$imgname= "restaurantimage/".$rsedit[itemimage];
		}
		else
		{
			$imgname = "images/noimage.png";
		}
?>
<img src="<?php echo $imgname; ?>" style="width:300px;height:250px;" >
<br>
Restaurant Description: 
<textarea name="restaurantdiscription" class="form-control"><?php echo $rsedit[restaurantdiscription]; ?></textarea>
<br>
Restaurant Status:<label class="errmsg" id="idstatus"></label> 
<select name="status" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Active","Inactive","Pending");
	foreach($arr as $val)
	{
		if($val == $rsedit[status])
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
	<center><input type="submit" value="submit" name="submit" class="btn btn-info" style="width:200px;"></center> 
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
	if(!document.frmform.restaurantname.value.match(alphaSpaceExp))
	{
		document.getElementById("idrestaurantname").innerHTML = "Entered Restaurant name is not valid...";
		errcondition = "false";
	}
	if(document.frmform.restaurantname.value == "")
	{
		document.getElementById("idrestaurantname").innerHTML = "restaurantname should not be empty..";
		errcondition = "false";
		}
		if(!document.frmform.loginid.value.match(alphaNumericExp))
	{
		document.getElementById("idloginid").innerHTML = "Entered loginid is not valid...";
		errcondition = "false";
	}
	if(document.frmform.loginid.value == "")
	{
		document.getElementById("idloginid").innerHTML = "loginid should not be empty..";
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
		document.getElementById("idcpassword").innerHTML = "confirm password should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.locationid.value == "")
	{
		document.getElementById("idlocationid").innerHTML = "location id should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.restauranttype.value == "")
	{
		document.getElementById("idrestauranttype").innerHTML = "restaurant type should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.status.value == "")
	{
		document.getElementById("idstatus").innerHTML = "status should not be empty..";
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
