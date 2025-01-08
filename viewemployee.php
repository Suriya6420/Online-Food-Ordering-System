<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM employee WHERE employeeid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('employee record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewemployee.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View Employee</h3>
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
				<p> Employee details</p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr>
			<th>Employee Name</th>
			<th> Location</th>
			<th>Login Id</th>
			<th>Password</th>
			<th>Employee Type</th>
			<th>Status</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
	<?php
		$sql= "SELECT employee.*,location.locationname FROM employee LEFT JOIN location ON employee.locationid=location.locationid";
        $qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[employeename]</td>
			<td>$rs[locationname]</td>
			<td>$rs[loginid]</td>
			<td>$rs[password]</td>
			<td>$rs[employeetype]</td>
			<td>$rs[status]</td>
			<td><a href='employee.php?editid=$rs[0]' class='btn btn-info' style='width:70px;'>Edit</a><br><a href='viewemployee.php?delid=$rs[0]' class='btn btn-danger' onclick='return confdel()' style='width:70px;'>Delete</a></td>
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