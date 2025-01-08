<?php
session_start();
include("connection.php");
$sqlcustomer= "SELECT customer.*,location.locationname,city.city FROM customer LEFT JOIN location ON customer.locationid=location.locationid LEFT JOIN city on city.cityid=customer.cityid WHERE customer.customerid='$_SESSION[customerid]'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
$rscustomer = mysqli_fetch_array($qsqlcustomer);
?>
<form action="" method="post" name="frmform" onsubmit="return validateform()">
	<input type="hidden" name="customerid" value="<?php echo $_SESSION[customerid]; ?>">
	<table id="myTable" class="table" style="width:100%">
	<?php
		$sql= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.status='Inactive' AND foodorder.customerid='$_SESSION[customerid]'";
		$qsql = mysqli_query($con,$sql);
		$totamt = 0;
		while($rs = mysqli_fetch_array($qsql))
		{
			$totamt = $totamt + ($rs['qty'] * $rs['cost']);
		}
	?>
	<tr>
		<th class="t-head head-it" colspan='4'>Total Amount</th>			
		<th class="t-head head-it" id="totpayableamt">₹<?php echo $totamt; ?><input type="hidden" name="paidamount" value="<?php echo $totamt; ?>"></th>
	</tr>
	</table>
	
	<hr>
	<b>Delivery Address</b>
	<table class="table"  style="width:100%">			
		<tbody>
			<tr>
				
				<th>
				Name: 	
				</th>
				<td>
					<input type="text" name="name" value="<?php echo $rscustomer['customername']; ?>"class="form-control">
				</td>
				<th>
				Contact No.: 			
				</th>
				<td><input type="text" name="contactno" value="<?php echo $rscustomer['contactno']; ?>"class="form-control">
				</td>
			</tr>
			<tr>
				<th>
					Address: 
				</th>
				<td><label class="errmsg" id="idaddress"></label><textarea name="address" class="form-control"><?php echo $rscustomer[address]; ?></textarea>
				</td>
				<th>
					City: 
				</th>
				<td>
				<label class="errmsg" id="idcityid"></label>
				<select name="cityid" class="form-control">
					<option value="">Select</option>
					<?php
					$sqlcity="select * from city WHERE status='Active'";
					$qsqlcity =mysqli_query($con,$sqlcity);
					while($rscity =mysqli_fetch_array($qsqlcity))
					{
						
						echo "<option value='$rscity[cityid]'>$rscity[city]</option>";
					}
					?>
				</select>				
				</td>
			</tr>
	</tbody>
	</table>
	<hr><b>Payment Detail</b>
	<table class="table"  style="width:100%">			
		<tbody>
			<tr>
				<th>
					Payment Type:<label class="errmsg" id="idpaymenttype"></label>
				</th>
				<td>
					<select name="paymenttype" class="form-control">
						<option value="">Select</option>
						<?php
						$arr = array("Visa","Master card","Rupay");
						foreach($arr as $val)
						{
							echo "<option value='$val'>$val</option>";
						}
						?>
					</select>
				</td>
				<th>
				Card holder:
				</th>
				<td><label class="errmsg" id="idcardholder"></label><input type="text" name="cardholder" class="form-control">
				</td>
			</tr>
			<tr>
				<th>
					Card No:
				</th>
				<td><label class="errmsg" id="idcardno"></label><input type="text" name="cardno" value="<?php echo $rsedit[cardno]; ?>" class="form-control">
					</select>
				</td>
				<th>
					CVV No:
				</th>
				<td><label class="errmsg" id="idcvrno"></label><input type="text" name="cvrno" value="<?php echo $rsedit[cvrno]; ?>" class="form-control">
				</td>
			</tr>
			<tr>
				<th>
					Expiry date:
				</th>
				<td><input type="month" min="<?php echo date("Y-m"); ?>" name="expirydate" value="<?php echo $rsedit[expirydate]; ?>" class="form-control">
				</td>
				<th>
					
				</th>
				<td>
				</td>
			</tr>
			<tr>
				<th></th>
				<td></td>
				<th></th>
				<td>
				<input type="submit" name="submit" value="Make Payment" class="btn btn-info" style="width:200px;">
				</td>
			</tr>
		</tbody>
	</table>
</form>