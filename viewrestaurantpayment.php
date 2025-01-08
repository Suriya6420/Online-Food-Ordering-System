<?php
include("header.php");
if(isset($_GET['orderid']))
{
	//Processing Packed  
	$sql = "UPDATE foodorder set status='$_GET[status]' WHERE orderid='$_GET[orderid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('Food order status updated successfully...');</SCRIPT>";
		echo "<script>window.location='viewfoodorders.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View Food Order</h3>
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
	<h2>Earnings Report</h2>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>Bill No.</th>
			<th>Date</th>
			<th>Customer</th>
			<th>Item</th>
			<th>Cost</th>
			<th>Quantity</th>
			<th>Total Cost</th>
			<th>Foodbite Commission (₹25+5%)</th>
			<th>Total Earned</th>
		</tr>
	</thead>
	<tbody>
		<?php
	 $sql= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,customer.contactno,item.itemimage FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE (foodorder.status='Active' OR foodorder.status='Paid')   ";
	 
	 if(isset($_SESSION['restaurantid']))
	 {
		 $sql = $sql . " AND foodorder.restaurantid='$_SESSION[restaurantid]'";
	 }
$sql = $sql . " ORDER BY orderid DESC";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$sqlbilldetail = "SELECT * FROM payment WHERE paymentid='$rs[paymentid]'";
		$qsqlbilldetail = mysqli_query($con,$sqlbilldetail);
		$rsbilldetail = mysqli_fetch_array($qsqlbilldetail);
		echo "<tr>
			<td>$rs[paymentid]</td>
			<td>" . date("d-M-Y <br> h:i A",strtotime($rsbilldetail['deliverydatetime'])) . "</td>
			<td>$rs[customername]<br>Ph. No. $rs[contactno]</td>
			<td>" . ucfirst($rs['itemname']) . "</td>
			<td>₹$rs[cost]</td>
			<td>$rs[qty]</td>
			<td>₹" . $totamt = ($rs['cost'] * $rs['qty']) . " </td>
			<td>₹";
			echo $commamt = 25+($totamt*5)/100;
			echo "</td>
			<td>₹" . $earned = $totamt - $commamt . "</td></tr>";
			$totalearned = $totalearned + $earned;
	}
	?>
	</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>Total Earnings</th>
			<th>₹<?php echo $totalearned; ?></th>
		</tr>
	</tfoot>
</table>
							</div>
						</div>
					</div>
				</div>
				
				<!--Plug-in Initialisation-->
				
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
	if(confirm("Are you sure?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>