<?php
$con=mysqli_connect("localhost","root","","foodbite");
if(mysqli_connect_errno($con))
{
	echo "failed to connect to MySQL:" . mysqli_connect_error();
}
?>
	