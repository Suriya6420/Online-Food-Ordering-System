<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM restaurant WHERE restaurantid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('restaurant record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewrestaurant.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View restaurant</h3>
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
			<div class="col-md-8">
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr style="background-color:#a9428057;">
			<th>Image</th>
			<th>Restaurant Name</th>
			<th>login Id</th>
			<th> Location</th>
			<th>Restaurant Type</th>
			<th>Restaurant Status</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
	<?php
		$sql= "SELECT restaurant.*,location.locationname FROM restaurant LEFT JOIN location ON restaurant.locationid=location.locationid";
    $qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs["restaurantimage"] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("imgrestaurant/".$rs[restaurantimage]))
		{
			$imgname= "imgrestaurant/".$rs[restaurantimage];
		}
		else
		{
			$imgname = "images/noimage.png";
		}
		echo "<tr>
			<td><img src='$imgname' style='width:100px;height:50px;'></td>
			<td>$rs[restaurantname]</td>
			<td>$rs[loginid]</td>
			<td>$rs[locationname]</td>
			<td>$rs[restauranttype]</td>
            <td>$rs[status]</td>
			<td><a href='restaurant.php?editid=$rs[0]' class='btn btn-info' style='width:70px;'>Edit</a><br><a href='viewrestaurant.php?delid=$rs[0]' class='btn btn-danger' onclick='return confdel()' style='width:70px;'>Delete</a></td>

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