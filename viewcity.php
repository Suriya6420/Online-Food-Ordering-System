<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM city WHERE cityid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('city record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewcity.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View City</h3>
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
			<th>Location</th>
			<th>City</th>
			<th>Description</th>
			<th>Status</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT city.*,location.locationname FROM city LEFT JOIN location ON city.locationid=location.locationid";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[locationname]</td>
			<td>$rs[city]</td>
			<td>$rs[description]</td>
			<td>$rs[status]</td>
			<td><a href='city.php?editid=$rs[0]' class='btn btn-info' style='width:70px;'>Edit</a><br><a href='viewcity.php?delid=$rs[0]' class='btn btn-danger' onclick='return confdel()' style='width:70px;'>Delete</a></td>
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