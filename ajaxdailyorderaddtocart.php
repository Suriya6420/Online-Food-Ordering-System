<?php
session_start();
include("connection.php");
$sqlitem= "SELECT item.*,restaurant.restaurantname,category.categoryname FROM item LEFT JOIN restaurant ON item.restaurantid=restaurant.restaurantid  LEFT JOIN category ON item.categoryid=category.categoryid WHERE item.itemid='$_GET[itemid]'";
$qsqlitem = mysqli_query($con,$sqlitem);
$rsitem = mysqli_fetch_array($qsqlitem);
$sqlinsert= "INSERT INTO foodorder( customerid, paymentid, restaurantid, itemid, qty, cost, description, status) VALUES ('$_SESSION[customerid]','0','$rsitem[restaurantid]','$_GET[itemid]','1','$rsitem[itemcost]','Daily Order','Inactive')";
mysqli_query($con,$sqlinsert);
?>
<div class="add" id="divitemid<?php echo $rs[0]; ?>">					
	<button type="button" style="background-color: green;color: white;" class="form-control" onclick="addtodailycart('<?php echo $rs[0]; ?>')"  ><i class="fa fa-thumbs-up" aria-hidden="true"></i> Added to Daily order Cart</button>
</div>