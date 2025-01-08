<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM category WHERE categoryid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('category record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewcategory.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View Category</h3>
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
				<p> Category details</p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>

<table id="myTable" class="table table-striped table-bordered" style="width:100%">
	<thead>
		<tr style="background-color:red;">
		<th>Category Image</th>
			<th>Category Name</th>
			<th>Discription</th>
			<th>Status</th>
			<th>Action</th>
			
		</tr>
	</thead>
	<tbody>
	<?php
	$sql= "SELECT * FROM category";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs["categoryimage"] == "")
		{
			$imgname = "images/noimage.png";
		}
		else if(file_exists("imgcategory/".$rs[categoryimage]))
		{
			$imgname= "imgcategory/".$rs[categoryimage];
		}
		else
		{
			$imgname = "images/noimage.png";
		}
		echo "<tr>
		<td><img src='$imgname' style='width:100px;height:50px;'></td>
			<td>$rs[categoryname]</td>
			<td>$rs[categorydiscription]</td>
			<td>$rs[categorystatus]</td>
			<td><a href='category.php?editid=$rs[0]' class='btn btn-info' style='width:70px;'>Edit</a><br><a href='viewcategory.php?delid=$rs[0]' class='btn btn-danger' onclick='return confdel()' style='width:70px;'>Delete</a></td>
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