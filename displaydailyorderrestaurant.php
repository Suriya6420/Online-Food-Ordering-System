<?php
session_start();
include("connection.php");
?>

<!--content-->
<center><h5>Select Restaurant</h5></center>
<?php
$sql= "SELECT restaurant.*,location.locationname FROM restaurant LEFT JOIN location on   location.locationid=restaurant.locationid WHERE restaurant.status='Active' AND restaurant.locationid='$_SESSION[locationid]' AND restaurant.restauranttype='$_GET[restauranttype]' order by rand() limit 0,8 ";
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
	<div class="col-md-4" onclick="displayrestaurantdetail('dailyorderrestaurantdetail.php?restaurantid=<?php echo $rs[0]; ?>')" >
		<div style="border: 1px solid grey;border-radius: 5px;cursor:pointer;padding:10px;" >
		<a href="" onclick="return false;">
			<?php echo"<img src='$imgname' style='width:100%;height:250px;' >";  ?>
		</a>
		<b><?php echo $rs[restaurantname]; ?></b>
		<p><?php echo $rs[restauranttype]; ?></p>
		</div>
	<hr>		
	</div>
<?php
}
?>		
