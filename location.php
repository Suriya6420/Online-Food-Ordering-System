<?php
include("header.php");
if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE location SET locationname='$_POST[locationname]',description='$_POST[description]',status='$_POST[status]' WHERE locationid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{			
			echo "<script>alert('location Record updated successfully..');</script>";
			echo "<script>window.location='viewlocation.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		$sql="INSERT INTO location(locationname,description ,status)VALUES('$_POST[locationname]','$_POST[description]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Employee Record inserted successfully..');</script>";
			echo "<script>window.location='location.php';</script>";
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
	$sqledit = "select * from location WHERE locationid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Location</h3>
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
Location Name: <label class="errmsg" id="idlocationname"></label><input type="text" name="locationname" value="<?php echo $rsedit[locationname]; ?>" class="form-control">
<br>
description: 
<textarea name="description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
<br>
City Status:<label class="errmsg" id="idstatus"></label> 
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
				
				<!--Plug-in Initialisation-->
				<script type="text/javascript">
				$(document).ready(function() {
					//Horizontal Tab
					$('#parentHorizontalTab').easyResponsiveTabs({
						type: 'default', //Types: default, vertical, accordion
						width: 'auto', //auto or any width like 600px
						fit: true, // 100% fit in a container
						tabidentify: 'hor_1', // The tab groups identifier
						activate: function(event) { // Callback function if tab is switched
							var $tab = $(this);
							var $info = $('#nested-tabInfo');
							var $name = $('span', $info);
							$name.text($tab.text());
							$info.show();
						}
					});

					// Child Tab
					$('#ChildVerticalTab_1').easyResponsiveTabs({
						type: 'vertical',
						width: 'auto',
						fit: true,
						tabidentify: 'ver_1', // The tab groups identifier
						activetab_bg: '#fff', // background color for active tabs in this group
						inactive_bg: '#F5F5F5', // background color for inactive tabs in this group
						active_border_color: '#c1c1c1', // border color for active tabs heads in this group
						active_content_border_color: '#5AB1D0' // border color for active tabs contect in this group so that it matches the tab head border
					});

					//Vertical Tab
					$('#parentVerticalTab').easyResponsiveTabs({
						type: 'vertical', //Types: default, vertical, accordion
						width: 'auto', //auto or any width like 600px
						fit: true, // 100% fit in a container
						closed: 'accordion', // Start closed if in accordion view
						tabidentify: 'hor_1', // The tab groups identifier
						activate: function(event) { // Callback function if tab is switched
							var $tab = $(this);
							var $info = $('#nested-tabInfo2');
							var $name = $('span', $info);
							$name.text($tab.text());
							$info.show();
						}
					});
				});
			</script>
				
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
	if(document.frmform.locationname.value == "")
	{
		document.getElementById("idlocationname").innerHTML = "Kindly select location";
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