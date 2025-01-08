<?php
include("header.php");
if(isset($_POST[submit]))
{
	$filename= rand(). $_FILES["categoryimage"]["name"];
	move_uploaded_file($_FILES["categoryimage"]["tmp_name"],"imgcategory/".$filename);
	
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE category SET categoryname='$_POST[categoryname]',categorydiscription='$_POST[categorydiscription]',";
		if($_FILES["categoryimage"]["name"] != "")
		{
		$sql = $sql . "categoryimage='$filename',";
		}
		$sql = $sql . "categorystatus='$_POST[categorystatus]' WHERE categoryid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('category Record updated successfully..');</script>";
			echo "<script>window.location='viewcategory.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
    {
		$sql="INSERT INTO category(categoryname,categorydiscription,categoryimage,categorystatus)VALUES('$_POST[categoryname]','$_POST[categorydiscription]','$filename','$_POST[categorystatus]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
		echo "<script>alert('category record inserted successfully..');</script>";	
			echo "<script>window.location='category.php';</script>";
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
	$sqledit = "select * from category WHERE categoryid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Category</h3>
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
Category Name:<label class="errmsg" id="idcategoryname"></label> <input type="text" name="categoryname" value="<?php echo $rsedit[categoryname]; ?>" class="form-control">
<br>
Category Description: 
<textarea name="categorydiscription" class="form-control"><?php echo $rsedit[categorydiscription]; ?></textarea>
<br>
Category Image: <input type="file" name="categoryimage" class="form-control">
<?php
		if($rsedit["categoryimage"] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("categoryimage/".$rsedit[categoryimage]))
		{
			$imgname= "categoryimage/".$rsedit[categoryimage];
		}
		else
		{
			$imgname = "images/noimage.png";
		}
?>
<img src="<?php echo $imgname; ?>" >
<br>
Category Status:<label class="errmsg" id="idcategorystatus"></label> 
<select name="categorystatus" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Active","Inactive","Pending");
	foreach($arr as $val)
	{
		if($val == $rsedit[categorystatus])
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
	if(document.frmform.categoryname.value == "")
	{
		document.getElementById("idcategoryname").innerHTML = "category name should not be empty..";
		errcondition = "false";
		}
	if(document.frmform.categorystatus.value == "")
	{
		document.getElementById("idcategorystatus").innerHTML = "Kindly select status..";
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