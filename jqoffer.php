<?php
session_start();
include("connection.php");
$dt = date("Y-m-d");
$sql ="SELECT * FROM offer WHERE offercode='$_REQUEST[offercode]' AND ('$dt' BETWEEN startdate AND enddate)";
$qsql = mysqli_query($con,$sql);
if(mysqli_num_rows($qsql) == 0)
{
	echo 0;
}
if(mysqli_num_rows($qsql) >= 1)
{
	$rs = mysqli_fetch_array($qsql);
	echo json_encode(array("offerid" => $rs[offerid], "offertype" => $rs[offertype], "offertitle" => $rs[offertitle], "offercode" => $rs[offercode], "offeramt" => $rs[offeramt]));
}
?>