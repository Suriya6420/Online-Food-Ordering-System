<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM location WHERE locationid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('location record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewlocation.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View Location</h3>
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
				<p> location details</p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Status</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT * FROM location";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[locationname]</td>
			<td>$rs[description]</td>
			<td>$rs[status]</td>
			<td><a href='location.php?editid=$rs[0]' class='btn btn-info' style='width:70px;'>Edit</a><br><a href='viewlocation.php?delid=$rs[0]' class='btn btn-danger' onclick='return confdel()' style='width:70px;'>Delete</a></td>
		</tr>";
	}
	?>
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