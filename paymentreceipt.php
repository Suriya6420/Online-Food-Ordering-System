<?php
include("header.php");

$sqlpayment = "select payment.*,city.city,location.locationname from payment left JOIN city on city.cityid=payment.cityid left join location ON location.locationid=city.locationid  WHERE payment.paymentid='$_GET[paymentid]'";
$qsqlpayment = mysqli_query($con,$sqlpayment);
$rspayment = mysqli_fetch_array($qsqlpayment);

$sqlcustomer= "SELECT customer.*,location.locationname,city.city FROM customer LEFT JOIN location ON customer.locationid=location.locationid LEFT JOIN city on city.cityid=customer.cityid WHERE customer.customerid='$_SESSION[customerid]'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
$rscustomer = mysqli_fetch_array($qsqlcustomer);

$sqloffer ="SELECT * FROM offer WHERE offerid='$rspayment[offerid]'";
$qsqloffer = mysqli_query($con,$sqloffer);
$rsoffer = mysqli_fetch_array($qsqloffer);
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Payment Receipt</h3>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact" style="padding: 0em 0;">
	<div class="container">
		<div class=" contact-w3">	
		
<center><h2 style="color:red;">Payment Receipt</h2></center>

<form action="" method="post">
<table id="myTable" class="table" style="width:100%">
		
	<tr  class='cross'>
			<td class='ring-in t-data' colspan="1"><b>Delivery Address:</b><br><?php echo $rscustomer[address]; ?><BR>Area: <?php echo $rspayment[locationname]; ?><BR>City: <?php echo $rspayment[city]; ?></td>
			<td class='ring-in t-data' colspan="2"><b>Delivery Date / Time:</b><br><?php echo date("d-M-Y h:i A",strtotime($rspayment[deliverydatetime])); ?></td>
			<td class='ring-in t-data' colspan="2"><b>Bill No.:</b><br><?php echo $rspayment[paymentid]; ?></td>
	</tr>
		<tr>
			<th class="t-head head-it">Item</th>
			<th class="t-head head-it">Note</th>
			<th class="t-head head-it">Cost</th>			
			<th class="t-head head-it">Quantity</th>
			<th class="t-head head-it">Total </th>
		</tr>
	<tbody>
		<?php
	$sql= "SELECT foodorder.*,customer.customername,payment.paymenttype,restaurant.restaurantname,item.itemname,item.itemimage  FROM foodorder LEFT JOIN customer ON foodorder.customerid=customer.customerid LEFT JOIN payment on payment.paymentid=foodorder.paymentid LEFT JOIN restaurant on restaurant.restaurantid=foodorder.restaurantid LEFT JOIN item on item.itemid=foodorder.itemid WHERE foodorder.paymentid='$_GET[paymentid]'";
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
				echo "<hr><b>Order Status:</b>";

		if($rs[status] == "Active")
		{
			echo "<b>Ordered</b><br>";
			echo "<img src='images/paid.png' style='width: 75px; height: 75px;' >";
		}
		else if($rs[status] == "Processing")
		{
			echo "<b>Processing</b><br>";
			echo "<img src='images/procesing.gif' style='width: 75px; height: 75px;' >";
		}
		else if($rs[status] == "Packed")
		{
			echo "<b>Packed</b><br>";
			echo "<img src='images/packed.png' style='width: 75px; height: 75px;' >";
		}
		else
		{
			echo $rs[status];
		}
				echo "</td>
				<td class='ring-in t-data'>₹$rs[cost]</td>
				<td class='ring-in t-data'>$rs[qty]</td>
				<td class='ring-in t-data'>₹" . $rs['qty'] * $rs['cost'] . "</td>
				</tr>";
		$totamt = $totamt + ($rs['qty'] * $rs['cost']);
	}
	?>
	</tbody>
	<tbody>
	<?php
	if($rspayment[offerid] != 0)
	{
	?>
		<tr>
			<th class="t-head head-it"></th>
			<th class="t-head head-it"></th>
			<th class="t-head head-it" colspan='2'>Total Amount</th>			
			<th class="t-head head-it" id="totpayableamt">₹<?php echo $totamt; ?><input type="hidden" name="paidamount" value="<?php echo $totamt; ?>"></th>
		</tr>
		<tr>
			<th class="t-head head-it ">Offer code<br><?php echo $rsoffer[offercode]; ?></th> 
			<th class="t-head head-it ">Offer detail<br><?php 
			if($rsoffer[offertype] == "Flat")
			{
			echo "₹".$rsoffer[offeramt]." discount"; 
			$offeramt = $rsoffer[offeramt];
			}
			if($rsoffer[offertype] == "Percentage")
			{
			echo $rsoffer[offeramt] . "% discount"; 
			$offeramt = ($rsoffer[offeramt] * $totamt) /100;
			}
			?></th>
			<th class="t-head head-it " colspan='2'>Discount Amount</th>	
			<th class="t-head head-it " >₹<?php  echo $offeramt; ?></th>
		</tr>
		<tr>
			<th class="t-head head-it"></th>
			<th class="t-head head-it"></th>
			<th class="t-head head-it" colspan='2'>Total Amount</th>			
			<th class="t-head head-it" id="totpayableamt">₹<?php echo $toamt = $totamt-$offeramt; ?></th>
		</tr>
	<?php
	}
	else
	{
	?>
		<tr>
			<th class="t-head head-it"></th>
			<th class="t-head head-it"></th>
			<th class="t-head head-it" colspan='2'>Total Amount</th>			
			<th class="t-head head-it" id="totpayableamt">₹<?php echo $totamt; ?><input type="hidden" name="paidamount" value="<?php echo $totamt; ?>"></th>
		</tr>	
	<?php
	}
	?>
	</tbody>
	
		
	<tr  class='cross'>
		<th   colspan='5' class="t-head head-it" ><b>Payment detail:</th>		
	</tr>

	<tr  class='cross'>
		<td  class='ring-in t-data'><b>Payment Type:</b> <?php echo $rspayment[paymenttype]; ?></td>
		<td   colspan='4'  class='ring-in t-data'><b>Payment date:</b> <?php echo date("d-M-Y",strtotime($rspayment[orderdatetime])); ?></td>		
	</tr>
	
	

</table>	

	<table  class="table">
		<tr  class='cross'>
			<td   colspan='5'  class='ring-in t-data'><center><input type="button" name="print" value="Print"class="form-control" style="width: 250px;" onclick="printDiv('myTable')">
</center></td>		
		</tr>
	</table>
			
		<div class="clearfix"></div>
	</div>
	</div>
</div>
<!-- //contact -->
<?php
include("footer.php");
?>
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
function printDiv(divName)
{
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>