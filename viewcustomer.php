<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM customer WHERE customerid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('customer record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewcustomer.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View Customer</h3>
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
			<th>Customer Name</th>
			<th>Company Name</th>
			<th>Email ID</th>
			<th>Contact No</th>
			<th>Address</th>
			<th>Location</th>
			<th>City</th>
			<th>Status</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT customer.*,location.locationname,city.city FROM customer LEFT JOIN location ON customer.locationid=location.locationid LEFT JOIN city on city.cityid=customer.cityid";
    $qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[customername]</td>
			<td>$rs[companyname]</td>
			<td>$rs[emailid]</td>
			<td>$rs[contactno]</td>
			<td>$rs[address]</td>
			<td>$rs[locationname]</td>
			<td>$rs[city]</td>
			<td>$rs[status]</td>
			<td><a href='customer.php?editid=$rs[0]' class='btn btn-info' style='width:70px;'>Edit</a><br><a href='viewcustomer.php?delid=$rs[0]' class='btn btn-danger' onclick='return confdel()' style='width:70px;'>Delete</a></td>
		</tr>";
	}
	?>
	</tbody>
</table>
<br>
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