<?php
include("header.php");
?>
<!--content-->
<div class="kic-top ">
	<div class="container ">
	<div class="kic ">
			<h3><b><u><?php 
			if($_GET['restauranttype'] == "Both")
			{
				echo "Veg & Non-Veg ";
			}
			else
			{
			echo $_GET['restauranttype']; 
			}
			?> Restaurant</u></b></h3>
	</div>
	<?php
	$sql= "SELECT restaurant.*,location.locationname FROM restaurant LEFT JOIN location on   location.locationid=restaurant.locationid WHERE restaurant.status='Active' AND restaurant.locationid='$_SESSION[locationid]' ";
	if($_GET['restauranttype'] != "")
	{
	$sql = $sql . " AND restaurant.restauranttype='$_GET[restauranttype]'";
	}
	if($_GET['search'] != "")
	{
		$sql = $sql . " AND restaurant.restaurantname LIKE '%$_GET[search]%'";
	}
	$sql = $sql . " order by rand() limit 0,8 ";
    $qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{		
		if($rs["restaurantimage"] == "")
		{
			$imgname = "images/no-logo.png";
		}
		else if(file_exists("imgrestaurant/".$rs[restaurantimage]))
		{
			$imgname= "imgrestaurant/".$rs[restaurantimage];
		}
		else
		{
			$imgname = "images/no-logo.png";
		}
	?>
		<div class="col-md-4 kic-top1" onclick="window.location='restaurantdetail.php?restaurantid=<?php echo $rs[0]; ?>'" >
			<div style="border: 1px solid grey;border-radius: 5px;cursor:pointer;padding:10px;" >
			
			<a href="#">
				<?php echo"<img src='$imgname' style='width:100%;height:250px;' >";  ?>
			</a>
			<b><?php echo $rs['restaurantname']; ?></b>
			<p><?php echo $rs['restauranttype']; ?></p>
			</div>
		<hr>		
		</div>
	<?php
	}
	?>		
	</div>
</div>

<hr>
<?php
include("footer.php");
?>