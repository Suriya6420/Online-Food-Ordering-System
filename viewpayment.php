<?php
include("header.php");
if(isset($_GET['editid']))
{
	//Processing Packed  
	 $sql = "UPDATE foodorder set status='$_GET[st]' WHERE paymentid='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) >=1)
	{
		if($_GET['st'] == 'Delivered')
		{
			echo "<SCRIPT>alert('Item Delivered successfully...');</SCRIPT>";
		}
		else
		{
			echo "<SCRIPT>alert('Delivery process Started...');</SCRIPT>";
		}
	//	echo "<script>window.location='viewdelivertedpayment.php';</script>";
	}
}
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
		<h3>View Payment</h3>
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
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>Bill No.</th>
			<th>Customer</th>
			<th>Payment Detail</th>
			<th>Order Date Time</th>
			<th>Delivery Date Time</th>
			<th>Order Tracking</th>
			<th>Address</th>
			<th>Paid Amount</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT payment.*,location.locationname,customer.customername,employee.employeename , employee.loginid FROM payment LEFT JOIN location ON payment.locationid=location.locationid LEFT JOIN customer on customer.customerid=payment.customerid LEFT JOIN employee on employee.employeeid=payment.employeeid";

	$sql = $sql . "	ORDER BY payment.paymentid DESC";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		$foodorderqty =0;
		$orderstatus="";
		$sqlfoodorder= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]' AND foodorder.status='Active'";
		$qsqlfoodorder = mysqli_query($con,$sqlfoodorder);
		$foodordertotitemqty = mysqli_num_rows($qsqlfoodorder);
										
		$sqlpending= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]' AND foodorder.status='Packed' ";
		$qsqlpending = mysqli_query($con,$sqlpending);
		$noitemqty = mysqli_num_rows($qsqlpending);
		if($noitemqty >=1)
		{
			$orderstatus="<b>Packed</b>";
		}	
		
		$sqlpending= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]' AND foodorder.status='Delivery Process' ";
		$qsqlpending = mysqli_query($con,$sqlpending);
		$noitemqty = mysqli_num_rows($qsqlpending);
		if($noitemqty >=1)
		{
			$orderstatus="<b>Delivery Process</b>";
		}	
		
		$sqlpending= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]'  AND foodorder.status='Processing'";
		$qsqlpending = mysqli_query($con,$sqlpending);
		if(mysqli_num_rows($qsqlpending) >=1)
		{
			$orderstatus="<b>Processing</b>";
		}
			
		$sqlDelivered= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$rs[0]' AND foodorder.status='Delivered' ";
		$qsqlDelivered= mysqli_query($con,$sqlDelivered);
		$noitemqty = mysqli_num_rows($qsqlDelivered);
		if($noitemqty >=1)
		{
			$orderstatus="<b>Delivered</b>";
		}
		if($orderstatus != "<b>Delivered</b>")
		{
		echo "<tr>
			<td>$rs[paymentid]</td>
			<td>$rs[customername]</td>
			<td><b>Payment type - $rs[paymenttype]</b><br>$rs[paymentdetail]</td>
			<td>$rs[orderdatetime]</td>
			<td>$rs[deliverydatetime]</td>
			<td>";
			echo "<b>Order status:</b>" . $orderstatus ;
			if($rs['employeename'] != "")
			{
				$deliveryboy=$rs['employeename'];
				echo "<hr><b>Delivery Boy :</b> "  . $rs['employeename'] . " ($rs[loginid])";
			}
			echo "</td>
			<td>$rs[address]<br>$rs[locationname]<br>$rs[cityid]<br>Phone No.$rs[contactno]</td>
			<td>₹$rs[paidamount]</td>
			<td><a href='paymentreceipt.php?paymentid=$rs[0]' class='btn btn-info' style='width:70px;'>View</a>";
			if($orderstatus=="<b>Delivered</b>")
			{
			}
			else
			{
				if($rs['employeename'] == "")
				{
					if(trim($orderstatus)=="<b>Packed</b>")
					{
						echo "<a href='delivery.php?editid=$rs[0]' class='btn btn-success' >Assign Delivery Boy</a>";
					}
				}			
				if($rs['employeename'] != "")
				{
					if($orderstatus="<b>Delivery Process</b>")
					{
		echo "<br><img src='images/delivery-boy.gif' style='width:150px;height:105px;cursor: pointer;'>";
		echo "<button type='button' class='btn btn-success' onclick='to_open(`$rs[employeename]`)'>Track</button> | <a href='viewpayment.php?editid=$rs[0]&st=Delivered' class='btn btn-success'>Delivered</a>";
					}
					else
					{
						echo "<a href='viewpayment.php?editid=$rs[0]&st=Delivery Process' class='btn btn-success'>Delivery Process</a>";
					}
				}
			}
		echo "</td></tr>";
		}
	}
	?>
	<tbody>
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
<script>
function to_open(empname)
{
tm=window.open("currentlocation.php?empname="+empname,"Ratting","width=550,height=170,0,top=260,status=0");
}
</script>