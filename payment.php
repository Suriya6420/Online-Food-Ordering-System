<?php
include("header.php");
if(isset($_POST[submit]))
{
	$dttim = date("Y-m-d H:i:s");
	$delliverydttime = $_POST[deliverydate] . " " . $_POST[deliverytime];
	if(isset($_GET[editid]))
	{
		$sql ="UPDATE payment SET customerid='$_POST[customerid]',paidamount='$_POST[paidamount]',offerid='$_POST[offerid]',paymenttype='$_POST[paymenttype]',paymentdetail='$_POST[paymentdetail]',orderdatetime='$dttim',deliverydatetime='$delliverydttime',employeeid='$_POST[employeeid]',address='<b>$_POST[name]</b><br>$_POST[address]',locationid='$_POST[locationid]',cityid='$_POST[cityid]',contactno='$_POST[contactno]',status='Active' WHERE paymentid='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Payment done successfully..');</script>";
			echo "<script>window.location='viewpayment.php';</script>";
		} 
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		$sqlcity ="select * from city where cityid='$_POST[cityid]'";
		$qsqlcity = mysqli_query($con,$sqlcity);
		$rscity= mysqli_fetch_array($qsqlcity);
		$paymentdetail= "Card Holder : $_POST[cardholder] | Card Number:  $_POST[cardno] | CVV No. $_POST[cvrno] | Expiry date: $_POST[expirydate]";
		$sql="INSERT INTO payment(customerid,paidamount,offerid,paymenttype,paymentdetail,orderdatetime,deliverydatetime,employeeid,address,locationid,cityid,contactno,status)VALUES('$_POST[customerid]','$_POST[paidamount]','$_POST[offerid]','$_POST[paymenttype]','$paymentdetail','$dttim','$delliverydttime','$_POST[employeeid]','$_POST[address]','$rscity[locationid]','$rscity[cityid]','$_POST[contactno]','Active')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		$insid= mysqli_insert_id($con);
		$sql="UPDATE foodorder SET status='Active',paymentid='$insid' WHERE customerid='$_POST[customerid]' AND status='Pending'";
		$qsql = mysqli_query($con,$sql);
		echo "<script>alert('payment record inserted successfully..');</script>";	
		echo "<script>window.location='paymentreceipt.php?paymentid=$insid';</script>";
	}
}
//2. Select query starts
if(isset($_GET[editid]))
{
	$sqledit = "select * from payment WHERE paymentid='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends

$sqlcustomer= "SELECT customer.*,location.locationname,city.city FROM customer LEFT JOIN location ON customer.locationid=location.locationid LEFT JOIN city on city.cityid=customer.cityid WHERE customer.customerid='$_SESSION[customerid]'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
$rscustomer = mysqli_fetch_array($qsqlcustomer);
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Payment Panel</h3>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact" style="padding: 0em 0;">
	<div class="container">
		<div class=" contact-w3">	
		
<h2 style="color:red;">Order Details</h2>

<form action="" method="post" name="frmform" onsubmit="return validateform()">
<table id="myTable" class="table" style="width:100%">
	<thead>
		<tr>
			<th class="t-head head-it">Item</th>
			<th class="t-head head-it">Note</th>
			<th class="t-head head-it">Cost</th>			
			<th class="t-head head-it">Quantity</th>
			<th class="t-head head-it">Total </th>
			</tr>
	</thead>
			
	<tbody>
		<?php
	$sql= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.status='Pending' AND foodorder.customerid='$_SESSION[customerid]'";
	$qsql = mysqli_query($con,$sql);
	$totamt = 0;
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr  class='cross'>
				<td class='ring-in t-data'><img src='itemimage/$rs[itemimage]' class='img-responsive' align='left' style='width: 150px; padding-right: 15px;' ><b>$rs[itemname]</b><br>$rs[restaurantname]</td>
				<td class='ring-in t-data'>"; 
				if($rs['description'] != "")
				{
					echo $rs['description'];
				}
				else
				{
					echo "NIL";
				}
				echo "</td>
				<td class='ring-in t-data'>₹$rs[cost]</td>
				<td class='ring-in t-data'>$rs[qty]</td>
				<td class='ring-in t-data'>₹" . $rs[qty] * $rs[cost] . "</td>
				</tr>";
		$totamt = $totamt + ($rs['qty'] * $rs['cost']);
	}
	?>
	</tbody>
		<tr>
			<th class="t-head head-it ">Offer code<br><input type="hidden" name="totamt" id="totamt" value="<?php echo $totamt; ?>" >
			<input type="text" class="form-control" name="offercode" id="offercode" onkeyup="funcheckoffercode()" onchange="funcheckoffercode()"></th> 
			<th class="t-head head-it "><span id="idoffer"></span></th>
			<th class="t-head head-it " colspan='2'><span id="iddiscount"></span></th>	
			<th class="t-head head-it " id="iddiscountamt">₹0<input type="hidden" name="discamt" id="discamt" value="0"></th>
		</tr>
		<tr>
			<th class="t-head head-it"></th>
			<th class="t-head head-it"></th>
			<th class="t-head head-it" colspan='2'>Total Amount</th>			
			<th class="t-head head-it" id="totpayableamt">₹<?php echo $totamt; ?><input type="hidden" name="paidamount" value="<?php echo $totamt; ?>"></th>
		</tr>
		<tr>
		<td  class='ring-in t-data' colspan='6'>
		
				<input type="hidden" name="customerid" value="<?php echo $_SESSION[customerid]; ?>">
				<div class="row"><div class="col-md-12"><h3>Payment Detail</h3></div></div>
	<div class="row">
		<div class="col-md-6" >
			Payment Type:<label class="errmsg" id="idpaymenttype"></label><select name="paymenttype" class="form-control">
				<option value="">Select</option>
	<?php
	$arr = array("Visa","Master card","Rupay","Cash on Delivery");
	foreach($arr as $val)
	{
		echo "<option value='$val'>$val</option>";
	}
	?>
			</select>
		</div>
		<div class="col-md-6">
			Card holder:<label class="errmsg" id="idcardholder"></label><input type="text" name="cardholder" value="<?php echo $rsedit[cardholder]; ?>"class="form-control">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			Card No:<label class="errmsg" id="idcardno"></label><input type="text" name="cardno" value="<?php echo $rsedit[cardno]; ?>"class="form-control">
		</div>
		<div class="col-md-6">
			CVV No:<label class="errmsg" id="idcvrno"></label><input type="text" name="cvrno" value="<?php echo $rsedit[cvrno]; ?>"class="form-control">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6">
			Expiry date:<input type="month" min="<?php echo date("Y-m"); ?>" name="expirydate" value="<?php echo $rsedit[expirydate]; ?>"class="form-control">
		</div>
	</diV>
	
	</td>
		</tr>
		<tr>
		<td  class='ring-in t-data' colspan='6'>
	<div class="row"><div class="col-md-12"><h3>Delivery Address</h3></div></div>
	
		<div class="row">
		<div class="col-md-6">
			Name: <input type="text" name="name" value="<?php echo $rscustomer['customername']; ?>"class="form-control">
		</div>
		<div class="col-md-6">
			Contact No.: <input type="text" name="contactno" value="<?php echo $rscustomer['contactno']; ?>"class="form-control">			
		</div>
	</diV>
	 
	<div class="row">
		<div class="col-md-6">
			Address: <label class="errmsg" id="idaddress"></label><textarea name="address" class="form-control"><?php echo $rscustomer[address]; ?></textarea>
		</div>
		<div class="col-md-6">
			City: <label class="errmsg" id="idcityid"></label>
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
		</div>
	</diV>
	
	<div class="row">
		<div class="col-md-6">
			Delivery Date:<input type="date" name="deliverydate" min="<?php echo date("Y-m-d"); ?>" class="form-control" value="<?php echo date("Y-m-d"); ?>" >
		</div>
		<div class="col-md-6">			
			Delivery Time:<input type="time" name="deliverytime" class="form-control" >
		</div>
	</div>	
	
		<div class="row">
		<div class="col-md-12"><hr>
			<center><input type="submit" name="submit" value="Make Payment" class="btn btn-info" style="width:200px;"></center>
		</div>
	</div>
		</td>
		</tr>
</table>
</form>

			
		<div class="clearfix"></div>
	</div>
	</div>
</div>
<!-- //contact -->
<?php
include("footer.php");
?>
<script>
function validateform()
{
    var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,6}$/;
	$('.errmsg').html('');
	var errcondition = "true";
	if(document.frmform.paymenttype.value == "")
	{
		document.getElementById("idpaymenttype").innerHTML = "Kindly select payment type";
		errcondition = "false";
		}
		if(!document.frmform.cardholder.value.match(alphaSpaceExp))
	{
		document.getElementById("idcardholder").innerHTML = "Entered Card Holder is not valid...";
		errcondition = "false";
	}
	if(document.frmform.cardholder.value == "")
	{
		document.getElementById("idcardholder").innerHTML = "card holder should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.cardno.value == "")
	{
		document.getElementById("idcardno").innerHTML = "card no should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.cvrno.value == "")
	{
		document.getElementById("idcvrno").innerHTML = "cvv no should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.address.value == "")
	{
		document.getElementById("idaddress").innerHTML = "address should not be empty..";
		errcondition = "false";
		}
		if(document.frmform.cityid.value == "")
	{
		document.getElementById("idcityid").innerHTML = "cityid should not be empty..";
		errcondition = "false";
		}
		if(errcondition == "true")
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script>
function funcheckoffercode()
{
	var offercode = document.getElementById("offercode").value;
	var totamt = document.getElementById("totamt").value;
	$.post("jqoffer.php", {offercode: offercode,totamt: totamt}, function(result)
	{
		
		var jsondata = JSON.parse(result);
		var offerdetail = "";
		var discamtstring = "";
		var paidamt="";
		var offeramt=0;
		var payableamt=0;
		if(result ==0)
		{
			discamtstring = "₹0<input type='hidden' name='discamt' id='discamt' value='0'>";
			offerdetail = "Offer code not available";	
			paidamt="₹" + totamt + "<input type='hidden' name='paidamount' value='<?php echo $totamt; ?>'>";
			$("#idoffer").html(offerdetail);
			$("#iddiscount").html("");
			$("#iddiscountamt").html(discamtstring);
			$("#totpayableamt").html(paidamt);
		}
		else
		{
			if(jsondata.offertype == "Percentage")
			{
				offeramt = (totamt * jsondata.offeramt) / 100;
				discamtstring = "₹" + offeramt + "<input type='hidden' name='offerid' id='offerid' value='" + jsondata.offerid + "'><input type='hidden' name='discamt' id='discamt' value='" + offeramt + "'>";
				offerdetail = "Offer detail:<br>" + jsondata.offertitle + " (" +jsondata.offeramt + "% Discount)";	
				payableamt = totamt - offeramt;
				paidamt="₹" + payableamt + "<input type='hidden' name='paidamount' value='" + payableamt + "'>";
				$("#idoffer").html(offerdetail);
				$("#iddiscount").html("Discount<br>" +jsondata.offeramt + "% Discount");
				$("#iddiscountamt").html(discamtstring);
				$("#totpayableamt").html(paidamt);
			}
			if(jsondata.offertype == "Flat")
			{
				offeramt=  jsondata.offeramt;
				discamtstring = "₹" + offeramt + "<input type='hidden' name='offerid' id='offerid' value='" + jsondata.offerid + "'><input type='hidden' name='discamt' id='discamt' value='" + offeramt + "'>";
				offerdetail = "Offer detail:<br>" + jsondata.offertitle + " (₹" +jsondata.offeramt + " Discount)";
				payableamt = totamt - offeramt;
				paidamt="₹" + payableamt + "<input type='hidden' name='paidamount' value='" + payableamt + "'>";
				$("#idoffer").html(offerdetail);
				$("#iddiscount").html("Discount<br>₹" +jsondata.offeramt + " Flat Discount");
				$("#iddiscountamt").html(discamtstring);
				$("#totpayableamt").html(paidamt);
			}
		}
	});
}
</script>