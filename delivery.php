<?php
include("header.php");
if(isset($_POST['btnAssignDelivery']))
{
	if(isset($_GET['editid']))
	{
		 $sql ="UPDATE payment SET employeeid='$_POST[employeename]' WHERE paymentid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Delivery boy assigned successfully..');</script>";
			echo "<script>window.location='viewpayment.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
?>
  <!---->
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Assign Delivery Boy</h3>
		<div class="clearfix"> </div>
	</div>
</div>
<!--login-->

	<div class="login">
	
		<div class="main-agileits">
				<div class="form-w3agile">
					<h3>Assign Delivery Boy</h3>
<form action="" method="post" name="frmform" onsubmit="return validateform()">
Employee name: <label class="errmsg" id="idemployeename"></label>
<select name="employeename" class="form-control">
	<option value="">Select</option>
	<?php
	$sqlemployee="select * from employee WHERE status='Active'";
	$qsqlemployee =mysqli_query($con,$sqlemployee);
	while($rsemployee =mysqli_fetch_array($qsqlemployee))
	{
		if($rsemployee['employeeid'] == $rsedit['employeeid'])
		{
		echo "<option value='$rsemployee[employeeid]' selected>$rsemployee[employeename]</option>";
		}
		else
		{
		echo "<option value='$rsemployee[employeeid]'>$rsemployee[employeename]</option>";
		}
	}
	?>
	</select>
	<br>
	<center><input type="submit" name="btnAssignDelivery" value="Assign Delivery Boy" class="btn btn-info" style="width:200px;"></center>
</form>
</div>
		</div>
		</div>
<?php
include("footer.php");
?>