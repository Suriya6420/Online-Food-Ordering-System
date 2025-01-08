<?php
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		 $sql ="UPDATE city SET locationid='$_POST[locationid]',city='$_POST[city]',description='$_POST[description]',status='$_POST[status]' WHERE cityid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('city Record updated successfully..');</script>";
			echo "<script>window.location='viewcity.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		$sql="INSERT INTO city(locationid,city,description,status)VALUES('$_POST[locationid]','$_POST[city]','$_POST[description]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1)
			{
			echo "<script>alert('city record inserted successfully..');</script>";	
				echo "<script>window.location='city.php';</script>";
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
	$sqledit = "select * from city WHERE cityid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >City</h3>
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
City:<label class="errmsg" id="idcity"></label> 
<input type="text" name="city" value="<?php echo $rsedit[city]; ?>" class="form-control">
<br>
description: 
<textarea name="description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
<br>
City Status: <label class="errmsg" id="idstatus"></label>
<select name="status" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Active","Inactive");
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
	$('.errmsg').html('');
	var errcondition = "true";
	if(document.frmform.locationid.value == "")
	{
		document.getElementById("idlocationid").innerHTML = "Kindly select location";
		errcondition = "false";
		}
	if(document.frmform.city.value == "")
	{
		document.getElementById("idcity").innerHTML = "City name should not be empty..";
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
