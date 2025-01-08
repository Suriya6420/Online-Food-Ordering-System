<?php
include("header.php");
//if(isset($_POST[submit]))
{
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE foodorder SET customerid='$_POST[customerid]',paymentid='$_POST[paymentid]',restaurantid='$_POST[restaurantid]',itemid='$_POST[itemid]',qty='$_POST[qty]',cost='$_POST[cost]',description='$_POST[description]',status='$_POST[status]' WHERE orderid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('order Record updated successfully..');</script>";
			echo "<script>window.location='vieworder.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		$sql = "DELETE FROM foodorder WHERE customerid='$_SESSION[customerid]' AND status='Pending'";
		$qsql = mysqli_query($con,$sql);
		
		$itemid = $_POST[id];
		$quantity = $_POST[quantity];
		$price = $_POST[price];
		$description = $_POST[description];
		for($i=0; $i < count($itemid);$i++)
		{
			$sqlrestaurant="SELECT * FROM item WHERE itemid='$itemid[$i]'";
			$qsqlrestaurant=mysqli_query($con,$sqlrestaurant);
			$rsrestaurant = mysqli_fetch_array($qsqlrestaurant);
			$sql="INSERT INTO foodorder(customerid,paymentid,restaurantid,itemid,qty,cost,description,status)VALUES('$_SESSION[customerid]','0','$rsrestaurant[restaurantid]','$itemid[$i]','$quantity[$i]','$price[$i]','$description[$i]','Pending')";
			$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
			echo "<script>window.location='payment.php';</script>";
		}
    }
}
/*
//2. Select query starts
if(isset($_GET[editid]))
{
	$sqledit = "select * from foodorder WHERE orderid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
*/
?>
<?php
/*
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Item Order</h3>
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
<form action="" method="post">
Customer:<select name="customerid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqlcustomer="select * from customer WHERE status='Active'";
	$qsqlcustomer =mysqli_query($con,$sqlcustomer);
	while($rscustomer =mysqli_fetch_array($qsqlcustomer))
	{
		echo "<option value='$rscustomer[customerid]'>$rscustomer[customername]</option>";
	}
	?>
</select>
<br>
Payment:<select name="paymentid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqlpayment="select * from payment WHERE status='Active'";
	$qsqlpayment =mysqli_query($con,$sqlpayment);
	while($rspayment =mysqli_fetch_array($qsqlpayment))
	{
		echo "<option value='$rspayment[paymentid]'>$rspayment[paymenttype]</option>";
	}
	?>
</select>
<br>
Restaurant:<select name="restaurantid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqlrestaurant="select * from restaurant WHERE status='Active'";
	$qsqlrestaurant =mysqli_query($con,$sqlrestaurant);
	while($rsrestaurant =mysqli_fetch_array($qsqlrestaurant))
	{
		echo "<option value='$rsrestaurant[restaurantid]'>$rsrestaurant[restaurantname]</option>";
	}
	?>
</select>
<br>
Item:<select name="itemid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqlitem="select * from item WHERE status='Active'";
	$qsqlitem =mysqli_query($con,$sqlitem);
	while($rsitem =mysqli_fetch_array($qsqlitem))
	{
		echo "<option value='$rsitem[itemid]'>$rsitem[itemname]</option>";
	}
	?>
</select>
<br>
Quantity:<input type="text" name="qty" value="<?php echo $rsedit[qty]; ?>"class="form-control">
<br>
Cost: <input type="text" name="cost"value="<?php echo $rsedit[cost]; ?>" class="form-control">
<br>
Description: 
<textarea name="description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
<br>
Status: 
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
*/
?>