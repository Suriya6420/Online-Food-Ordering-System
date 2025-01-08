<?php
session_start();
include("connection.php");
if(isset($_GET['paydt']) && $_GET['chk'] == "True")
{
	$delliverydttime = $_GET['paydt'];
	$sql="INSERT INTO payment(customerid,paidamount,offerid,paymenttype,paymentdetail,deliverydatetime,employeeid,address,locationid,cityid,contactno,status)VALUES('$_SESSION[customerid]','$_GET[grandtotal]','0','','','$delliverydttime','0','0','','','','Inactive')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	$insid=mysqli_insert_id($con);
	$sql="INSERT INTO foodorder(customerid,paymentid,restaurantid,itemid,qty,cost,description,status ) SELECT customerid,'$insid',restaurantid,itemid,qty,cost,description,status FROM foodorder WHERE customerid='$_SESSION[customerid]' AND description='Daily Order' AND status='Inactive' AND paymentid='0'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
}
if(isset($_GET['paydt']) && $_GET['chk'] == "False")
{
	$delliverydttimest = $_GET['paydt'] . " 00:00:00";
	$delliverydttimeend = $_GET['paydt'] . " 23:59:59";
	
	$sqlpayment ="SELECT * FROM payment WHERE  customerid='$_SESSION[customerid]' AND status='Inactive' AND (deliverydatetime BETWEEN '$delliverydttimest' and '$delliverydttimeend')";
	$qsqlpayment = mysqli_query($con,$sqlpayment);
	$rspayment = mysqli_fetch_array($qsqlpayment);
	$sql="DELETE FROM payment WHERE customerid='$_SESSION[customerid]' AND status='Inactive' AND (deliverydatetime BETWEEN '$delliverydttimest' and '$delliverydttimeend')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	$sql ="DELETE FROM foodorder WHERE paymentid='$rspayment[0]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
}
if(isset($_GET['paydt']) && $_GET['chk'] == "Time")
{
	$delliverydttimest = $_GET['paydt'] . " 00:00:00";
	$delliverydttimeend = $_GET['paydt'] . " 23:59:59";
	$delliverydttim = $_GET['paydt'] . ' ' . $_GET['tim'];
	$sqlpayment ="SELECT * FROM payment WHERE  customerid='$_SESSION[customerid]' AND status='Inactive' AND (deliverydatetime BETWEEN '$delliverydttimest' and '$delliverydttimeend')";
	$qsqlpayment = mysqli_query($con,$sqlpayment);
	$rspayment = mysqli_fetch_array($qsqlpayment);
//	echo $rspayment[0];
	echo $sql="UPDATE payment SET deliverydatetime='$delliverydttim' WHERE  paymentid='$rspayment[0]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
}
?>