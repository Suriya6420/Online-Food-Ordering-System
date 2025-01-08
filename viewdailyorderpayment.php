<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM payment WHERE paymentid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('Payment record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewpayment.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View Food Orders</h3>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact">
	<div class="container">
		<div class=" contact-w3">	
			<div class="col-md-12 ">
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>Bill No.</th>
			<th>Address</th>
			<th>Order Date Time</th>
			<th>Delivery Date Time</th>
			<th>Order Tracking</th>
			<th>Payment detail</th>
			<th>Action</th>
				
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT payment.*,location.locationname,customer.customername,employee.employeename, city.city FROM payment LEFT JOIN location ON payment.locationid=location.locationid LEFT JOIN customer on customer.customerid=payment.customerid LEFT JOIN employee on employee.employeeid=payment.employeeid LEFT JOIN city ON city.cityid=payment.cityid WHERE payment.status='Paid' ";
	if(isset($_SESSION['customerid']))
	{
	$sql = $sql . " AND  payment.customerid='$_SESSION[customerid]' ";
	}
	$sql= $sql . " ORDER BY payment.paymentid DESC";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$foodorderqty =0;
		$orderstatus="";
		$sqlfoodorder= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]' AND foodorder.status='Paid'";
		$qsqlfoodorder = mysqli_query($con,$sqlfoodorder);
		$foodordertotitemqty = mysqli_num_rows($qsqlfoodorder);
		
								
		$sqlpending= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]' AND foodorder.status='Packed' ";
		$qsqlpending = mysqli_query($con,$sqlpending);
		$noitemqty = mysqli_num_rows($qsqlpending);
		if($noitemqty >=1)
		{
			$orderstatus="<b>Packed</b>";
		}	
				
		$sqlpending= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]'  AND foodorder.status='Processing'";
		$qsqlpending = mysqli_query($con,$sqlpending);
		if(mysqli_num_rows($qsqlpending) >=1)
		{
			$orderstatus="<b>Processing</b>";
		}
		
		$sqlpending= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]' AND foodorder.status='Paid'";
		$qsqlpending = mysqli_query($con,$sqlpending);
		if(mysqli_num_rows($qsqlpending) != 0)
		{
			$orderstatus="<b>Pending</b>";
		}

		
	$sqlfoodorder= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[paymentid]'";
	$qsqlfoodorder= mysqli_query($con,$sqlfoodorder);
	$totamt = 0;
	while($rsfoodorder = mysqli_fetch_array($qsqlfoodorder))
	{
		$totamt = $totamt + ($rsfoodorder['qty'] * $rsfoodorder['cost']);
	}
		
		echo "<tr>
				<td><b style='font-size: 20px;'>$rs[paymentid]</b></td>
				<td><b>". ucfirst($rs['customername']) . "</b><br>$rs[address]<br>$rs[locationname]<br>$rs[city]<br>Phone No.$rs[contactno]</td>
				<td>" . date("d-M-Y h:i A",strtotime($rs['orderdatetime'])) ."</td>
				<td>" . date("d-M-Y h:i A",strtotime($rs['deliverydatetime'])) ."</td>
				<td>";
			echo "Order status: ".$orderstatus . "<br>";
			if($rs['employeename'] != "")
			{
				echo $rs['employeename'];
			}
		echo "</td>
				<td><b>Payment type -</b> $rs[paymenttype]<br>
				<b>Total Cost -</b> ₹$totamt</td>
				<td><a href='paymentreceipt.php?paymentid=$rs[0]' class='btn btn-info' style='width:70px;'>View</a></td>
			</tr>";
		}
	?>
	</tbody>
</table>
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
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
function confdel()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>