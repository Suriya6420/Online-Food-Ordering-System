<?php
include("header.php");
if(isset($_POST[submit]))
{
	$filename = rand(). $_FILES["restaurantimage"]["name"];
	move_uploaded_file($_FILES["restaurantimage"]["tmp_name"],"imgrestaurant/".$filename);

		$sql ="UPDATE restaurant SET restaurantname='$_POST[restaurantname]',loginid='$_POST[loginid]',locationid='$_POST[locationid]',restauranttype='$_POST[restauranttype]',restaurantimage='$filename',restaurantdiscription='$_POST[restaurantdiscription]' WHERE restaurantid='$_SESSION[restaurantid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Restaurant profile updated successfully..');</script>";
			echo "<script>window.location='restaurantprofile.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}

}
//2. Select query starts
if(isset($_SESSION[restaurantid]))
{
	$sqledit = "select * from restaurant WHERE restaurantid='$_SESSION[restaurantid]'";
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
				<p> Kindly enter following details</p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>
<form action="" method="post" enctype="multipart/form-data">
Restaurant Name: <input type="text" name="restaurantname" value="<?php echo $rsedit[restaurantname]; ?>"class="form-control">
<br>
login Id: <input type="text" name="loginid" value="<?php echo $rsedit[loginid]; ?>"class="form-control">

<br>
Location: <select name="locationid" class="form-control">
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
Restaurant Type:
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
<br>
Restaurant Description: 
<textarea name="restaurantdiscription" class="form-control"><?php echo $rsedit[restaurantdiscription]; ?></textarea>
<br>

	<input type="submit" value="submit" name="submit" class="form-control" >
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
