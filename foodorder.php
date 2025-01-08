<?php
include("header.php");
if(isset($_POST[submit]))
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
$sql="INSERT INTO foodorder(customerid,paymentid,restaurantid,itemid,qty,cost,description,status)VALUES('$_POST[customerid]','$_POST[paymentid]','$_POST[restaurantid]','$_POST[itemid]','$_POST[qty]','$_POST[cost]','$_POST[description]','$_POST[status]')";
$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
	echo "<script>alert('order record inserted successfully..');</script>";	
		echo "<script>window.location='payment.php';</script>";
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
	$sqledit = "select * from foodorder WHERE orderid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
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
				<p style="color:blue;" ><b> Kindly enter following details</b></p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>
<form action="" method="post" name="frmform" onsubmit="return validateform()">
Customer:<label class="errmsg" id="idcustomerid"></label><select name="customerid" class="form-control">
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
Payment:<label class="errmsg" id="idpaymentid"></label><select name="paymentid" class="form-control">
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
Restaurant:<label class="errmsg" id="idrestaurantid"></label><select name="restaurantid" class="form-control">
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
Item:<label class="errmsg" id="iditemid"></label><select name="itemid" class="form-control">
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
Quantity:<label class="errmsg" id="idqty"></label><input type="text" name="qty" value="<?php echo $rsedit[qty]; ?>"class="form-control">
<br>
Cost:<label class="errmsg" id="idcost"></label> <input type="text" name="cost"value="<?php echo $rsedit[cost]; ?>" class="form-control">
<br>
Description: 
<textarea name="description" class="form-control"><?php echo $rsedit[description]; ?></textarea>
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
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,6}$/;
	$('.errmsg').html('');
	var errcondition = "true";
	if(document.frmform.customerid.value == "")
	{
		document.getElementById("idcustomerid").innerHTML = "customer name should not be empty..";
		errcondition = "false";
		}
	if(document.frmform.paymentid.value == "")
	{
		document.getElementById("idpaymentid").innerHTML = "payment name should not be empty..";
		errcondition = "false";
		}
	if(document.frmform.restaurantid.value == "")
	{
		document.getElementById("idrestaurantid").innerHTML = "restaurant  should not be empty..";
		errcondition = "false";
	}
	if(document.frmform.itemid.value == "")
	{
		document.getElementById("iditemid").innerHTML = "item name should not be empty..";
		errcondition = "false";
		}
		if(!document.frmform.qty.value.match(numericExpression))
	{
		document.getElementById("idqty").innerHTML = "Entered Quantity should contain digits...";
		errcondition = "false";
	}
		if(document.frmform.qty.value == "")
	{
		document.getElementById("idqty").innerHTML = "quantity name should not be empty..";
		errcondition = "false";
		}
		if(!document.frmform.cost.value.match(numericExpression))
	{
		document.getElementById("idcost").innerHTML = "Entered Cost should contain digits...";
		errcondition = "false";
	}
		if(document.frmform.cost.value == "")
	{
		document.getElementById("idcost").innerHTML = "cost name should not be empty..";
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
