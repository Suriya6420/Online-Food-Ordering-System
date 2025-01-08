<?php
include("header.php");
if(isset($_POST[submit]))
{
	$filename= rand(). $_FILES["itemimage"]["name"];
	move_uploaded_file($_FILES["itemimage"]["tmp_name"],"itemimage/".$filename);
	
	$foodtype = serialize($_POST[foodtype]);
	//echo print_r($foodtype);
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE item SET restaurantid='$_POST[restaurantid]',categoryid='$_POST[categoryid]',foodtype='$foodtype',itemname='$_POST[itemname]',itemcost='$_POST[itemcost]',";
		if($_FILES["itemimage"]["name"] != "")
		{
		$sql = $sql . "itemimage='$filename',";
		}
		$sql = $sql ."itemdescription='$_POST[itemdescription]',itemtype='$_POST[itemtype]',status='$_POST[status]' WHERE itemid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('item Record updated successfully..');</script>";
			echo "<script>window.location='viewitem.php';</script>";
		}
	}
	else
	{
		$sql="INSERT INTO item(restaurantid,categoryid,foodtype,itemname,itemcost,itemimage,itemdescription,itemtype,status)VALUES('$_POST[restaurantid]','$_POST[categoryid]','$foodtype','$_POST[itemname]','$_POST[itemcost]','$filename','$_POST[itemdescription]','$_POST[itemtype]','$_POST[status]')";
		$qsql= mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Item record inserted successfully..');</script>";	
			echo "<script>window.location='item.php';</script>";
		}
	}
}
//2. Select query starts
if(isset($_GET[editid]))
{
	$sqledit = "select * from item WHERE itemid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
	$foodtype = unserialize($rsedit[foodtype]);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Item</h3>
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

<?php
if(isset($_SESSION[restaurantid]))
{
	echo "<input type='hidden' name='restaurantid' value='$_SESSION[restaurantid]'>";
}
else
{
?>
Restaurant:<label class="errmsg" id="idrestaurantid"></label><select name="restaurantid" class="form-control" >
	<option value="">Select</option>
	<?php
	$sqlrestaurant="select * from restaurant WHERE status='Active'";
	$qsqlrestaurant =mysqli_query($con,$sqlrestaurant);
	while($rsrestaurant =mysqli_fetch_array($qsqlrestaurant))
	{
		if($rsrestaurant[restaurantid]== $rsedit[restaurantid])
		{
		echo "<option value='$rsrestaurant[restaurantid]' selected>$rsrestaurant[restaurantname]</option>";
		}
		else
		{
		echo "<option value='$rsrestaurant[restaurantid]'>$rsrestaurant[restaurantname]</option>";
		}
	}
	?>
</select>
<?php
}
?>

<br>
Category:<label class="errmsg" id="idcategoryid"></label> 
<?php

	$sqlcategory="select * from category WHERE categorystatus='Active'";
	$qsqlcategory =mysqli_query($con,$sqlcategory);
	echo mysqli_error($con);
	?>
<select name="categoryid" class="form-control">
	<option value="">Select</option>
	<?php
	while($rscategory =mysqli_fetch_array($qsqlcategory))
	{
		if($rscategory[categoryid] == $rsedit[categoryid])
		{
		echo "<option value='$rscategory[categoryid]' selected>$rscategory[categoryname]</option>";
		}
		else
		{
		echo "<option value='$rscategory[categoryid]'>$rscategory[categoryname]</option>";
		}
	}
	?>
</select>
<br>
Food Type: <label class="errmsg" id="idfoodtype"></label>
<style>
.multiselect {
  width: 100%;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>
<script>
var expanded = false;

function showCheckboxes() 
{
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
<div class="multiselect">
	<div class="selectBox" onclick="showCheckboxes()">
	  <select class="form-control">
		<option>Select an option</option>
	  </select>
	  <div class="overSelect"></div>
	</div>
	<div id="checkboxes" >
		<?php
		$i=0;
		$arr = array("General","Breakfast","Lunch","Dinner");
		foreach($arr as $val)
		{
			if(in_array($val, $foodtype))
			{
		?>
			<label for="one">
			<input type="checkbox" id="val<?php echo $i; ?>" name="foodtype[]" value="<?php echo $val; ?>" checked ><?php echo $val; ?></label>
		<?php
			}
			else
			{
		?>
			<label for="one">
			<input type="checkbox" id="val<?php echo $i; ?>" name="foodtype[]" value="<?php echo $val; ?>" ><?php echo $val; ?></label>
		<?php
			}
			$i = $i+1;
		}
		?>
	</div>
</div>
<?php
/*
<select name="foodtype[]" class="form-control" multiple>
	<?php
	$arr = array("General","Breakfast","Lunch","Dinner");
	foreach($arr as $val)
	{
		if(in_array($val, $foodtype))
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
*/
?>
<br>
Item Name:<label class="errmsg" id="iditemname"></label><input type="text" name="itemname" value="<?php echo $rsedit[itemname]; ?>" class="form-control" >
<br>
Item Cost:<label class="errmsg" id="iditemcost"></label> <input type="text" name="itemcost"value="<?php echo $rsedit[itemcost]; ?>" class="form-control">
<br>
Item Image: <input type="file" name="itemimage" class="form-control"  accept="image/x-png,image/gif,image/jpeg" >
<?php
		if($rsedit["itemimage"] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("itemimage/".$rsedit[itemimage]))
		{
			$imgname= "itemimage/".$rsedit[itemimage];
		}
		else
		{
			$imgname = "images/noimage.png";
		}
?>
<img src="<?php echo $imgname; ?>" style="width:300px;height:250px;" >
<br>
Item Description: 
<textarea name="itemdescription" class="form-control"><?php echo $rsedit[itemdescription]; ?></textarea>
<br>
Item Type:<label class="errmsg" id="iditemtype"></label>
<select name="itemtype" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Vegetarian","Non-vegetarian","Both");
	foreach($arr as $val)
	{
		if($val == $rsedit[itemtype])
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
	var errcondition = "true";uuu01181 
	if(document.frmform.restaurantid.value == "")
	{
		document.getElementById("idrestaurantid").innerHTML = "customer name should not be empty..";
		errcondition = "false";
		}
	if(document.frmform.categoryid.value == "")
	{
		document.getElementById("idcategoryid").innerHTML = "payment name should not be empty..";
		errcondition = "false";
		}
	if(document.frmform.foodtype.value == "")
	{
		document.getElementById("idfoodtype").innerHTML = "restaurant  should not be empty..";
		errcondition = "false";
	}
	if(document.frmform.itemname.value == "")
	{
		document.getElementById("iditemname").innerHTML = "item name should not be empty..";
		errcondition = "false";
		}
		if(!document.frmform.itemcost.value.match(numericExpression))
	{
		document.getElementById("iditemcost").innerHTML = "Entered Item cost  should contain digits...";
		errcondition = "false";
	}
		if(document.frmform.itemcost.value == "")
	{
		document.getElementById("iditemcost").innerHTML = "item cost should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.itemtype.value == "")
	{
		document.getElementById("iditemtype").innerHTML = "cost should not be empty..";
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