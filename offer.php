<?php
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE offer SET offertype='$_POST[offertype]',offertitle='$_POST[offertitle]',offercode='$_POST[offercode]',startdate='$_POST[startdate]',enddate='$_POST[enddate]',status='$_POST[status]' WHERE offerid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('offer Record updated successfully..');</script>";
			echo "<script>window.location='viewoffer.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
			$sql="INSERT INTO offer(offertype,offertitle,offercode,startdate,enddate,status)VALUES('$_POST[offertype]','$_POST[offertitle]','$_POST[offercode]','$_POST[startdate]','$_POST[enddate]','$_POST[status]')";
			$qsql = mysqli_query($con,$sql);
			if(mysqli_affected_rows($con) == 1)
			{
			echo "<script>alert('offer record inserted successfully..');</script>";	
				echo "<script>window.location='offer.php';</script>";
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
	$sqledit = "select * from offer WHERE offerid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Offer</h3>
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
Offer Types: <label class="errmsg" id="idoffertype"></label><input type="text" name="offertype" value="<?php echo $rsedit[offertype]; ?>" class="form-control">
<br>
Offer Title: <label class="errmsg" id="idoffertitle"></label><input type="text" name="offertitle" value="<?php echo $rsedit[offertitle]; ?>" class="form-control">
<br>
Offer Code:<label class="errmsg" id="idoffercode"></label><input type="text" name="offercode"value="<?php echo $rsedit[offercode]; ?>" class="form-control">
<br>
Start Date: <input type="date" name="startdate"value="<?php echo $rsedit[startdate]; ?>" class="form-control">
<br>
End Date: <input type="date" name="enddate" value="<?php echo $rsedit[enddate]; ?>" class="form-control">
<br>
Status:<label class="errmsg" id="idstatus"></label>
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
	$('.errmsg').html('');
	var errcondition = "true";
	if(document.frmform.offertype.value == "")
	{
		document.getElementById("idoffertype").innerHTML = "offer type should not be empty..";
		errcondition = "false";
		}
	if(document.frmform.offertitle.value == "")
	{
		document.getElementById("idoffertitle").innerHTML = "offer title should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.offercode.value == "")
	{
		document.getElementById("idoffercode").innerHTML = "offer code should not be empty..";
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