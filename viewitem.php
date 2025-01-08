<?php
include("header.php");
if(isset($_GET[delid]))
{
	$sql = "DELETE FROM item WHERE itemid='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) ==1)
	{
		echo "<SCRIPT>alert('item record deleted successfully...');</SCRIPT>";
		echo "<script>window.location='viewitem.php';</script>";
	}
}
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3>View Item</h3>
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
	<tr style="background-color:#a9428057;">		
			<th>Image</th>
			<?php
			if(!isset($_SESSION["restaurantid"]))
			{
			?>
			<th>Restaurant</th>
			<?php
			}
			?>
			<th>Category</th>
			<th>Food Type</th>
			<th>Item Name</th>
			<th>Item Cost</th>
			<th>Item Type</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$sql= "SELECT item.*,restaurant.restaurantname,category.categoryname FROM item LEFT JOIN restaurant ON item.restaurantid=restaurant.restaurantid  LEFT JOIN category ON item.categoryid=category.categoryid WHERE item.status<>'Deleted' ";
		if(isset($_SESSION["restaurantid"]))
		{
			$sql = $sql . " AND item.restaurantid='$_SESSION[restaurantid]'";
		}
         $qsql = mysqli_query($con,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			if($rs["itemimage"] == "")
			{
				$imgname = "images/noimage.png.png";
			}
			else if(file_exists("itemimage/".$rs[itemimage]))
			{
				$imgname= "itemimage/".$rs[itemimage];
			}
			else
			{
				$imgname = "images/noimage.png";
			}
			$foodtype = unserialize($rs[foodtype]);
			$ftype="";
			foreach($foodtype as $val)
			{
				$ftype = $ftype . " " . $val;
			}
			echo "<tr>
				<td><img src='$imgname' width='75' height='75'></td>";
			if(!isset($_SESSION["restaurantid"]))
			{
				echo "<td>$rs[restaurantname]</td>";
			}
			
				echo "<td>$rs[categoryname]</td>
				<td>$ftype</td>
				<td>$rs[itemname]</td>
				<td>₹$rs[itemcost]</td>
				<td>$rs[itemtype]</td>
				<td>$rs[status]</td>
				<td><a href='item.php?editid=$rs[0]' class='btn btn-info' style='width:70px;'>Edit</a><br><a href='viewitem.php?delid=$rs[0]' class='btn btn-danger' onclick='return confdel()' style='width:70px;'>Delete</a></td>

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