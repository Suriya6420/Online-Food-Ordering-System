<?php
session_start();
include("connection.php");
if(isset($_GET['qty']))
{
	$sqlUPDATE = "UPDATE foodorder set qty='$_GET[qty]' WHERE orderid='$_GET[id]'";
	mysqli_query($con,$sqlUPDATE);
}
$sqldailyorder = "SELECT * FROM `foodorder` LEFT JOIN item ON foodorder.itemid=item.itemid WHERE foodorder.customerid='$_SESSION[customerid]' AND foodorder.status='Inactive' ";
$qsqldailyorder = mysqli_query($con,$sqldailyorder);
echo "<h4>Order details</h4>";
echo "<table  class='table table-striped table-bordered' style='width:100%'>";
echo "<thead><tr>
		<th>Item</th>
		<th>Cost</th>
		<th>Quantity</th>
		<th>Total Cost</th>
</tr></thead><tbody>";
$grandtotal = 0;
while($rs = mysqli_fetch_array($qsqldailyorder))
{
		echo "<tr>
			<td>" . ucfirst($rs['itemname']) . "<br>
			<img src='itemimage/$rs[itemimage]' style='width:100px;height:100px;'>
			</td>
			<td>₹$rs[cost]</td>
			<td>";
?>
		<input class="form-control" type="number" name="qty" id="qty" value="<?php echo $rs[qty]; ?>" onchange="updatecart('<?php echo $rs[0]; ?>',this.value)"  onkeyup="updatecart('<?php echo $rs[0]; ?>',this.value)" style="width: 150px;">
<?php
		echo "</td>
			<td>₹" . $rs['cost'] * $rs['qty'] . " </td></tr>";
			$grandtotal = $grandtotal + ($rs['cost'] * $rs['qty']);
}
echo "</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th></th>
			<th>Grand Total</th>
			<th>₹$grandtotal</th>
		</tr>
	</tfoot>
</table>";
?>
<input type="hidden" name="grandtotal" id="grandtotal" value="<?php echo $grandtotal; ?>" >