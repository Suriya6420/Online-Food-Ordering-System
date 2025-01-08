<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM offer WHERE offerid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('offer record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewoffer.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View Offer</h3>
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
				<p> Offer details</p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>Offer Type</th>
			<th>Offer Title</th>
			<th>Offer Code</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Status</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT * FROM offer";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
		    <td>$rs[offertype]</td>
			<td>$rs[offertitle]</td>
			<td>$rs[offercode]</td>
			<td>$rs[startdate]</td>
			<td>$rs[enddate]</td>
			<td>$rs[status]</td>
			<td><a href='offer.php?editid=$rs[0]' class='btn btn-info' style='width:70px;'>Edit</a><br><a href='viewoffer.php?delid=$rs[0]' class='btn btn-danger' onclick='return confdel()' style='width:70px;'>Delete</a></td>

		</tr>";
	}
	?>
	</tbody>
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