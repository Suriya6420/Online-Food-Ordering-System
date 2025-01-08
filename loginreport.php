<?php
include("header.php");
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<center><h3>View Login Report</h3></center>
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
			<th>Customer Name</th>
			<th>Company Name</th>
			<th>Email ID</th>
			<th>Contact No</th>
			<th>Last Login Date and Time</th>		
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT customer.*,location.locationname,city.city FROM customer LEFT JOIN location ON customer.locationid=location.locationid LEFT JOIN city on city.cityid=customer.cityid ORDER BY customer.lastlogin DESC";
    $qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[customername]</td>
			<td>$rs[companyname]</td>
			<td>$rs[emailid]</td>
			<td>$rs[contactno]</td>
			<td>" . date("d-M-Y h:i A",strtotime($rs[lastlogin])) . " </td>
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