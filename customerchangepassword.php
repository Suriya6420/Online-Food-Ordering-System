<?php
include("header.php");
if(isset($_POST[submit]))
{
		$sql ="UPDATE customer SET customername='$_POST[customername]',companyname='$_POST[companyname]',emailid='$_POST[emailid]',contactno='$_POST[contactno]',address='$_POST[address]',locationid='$_POST[locationid]',cityid='$_POST[cityid]' WHERE customerid='$_SESSION[customerid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('customer Record updated successfully..');</script>";
			echo "<script>window.location='customerprofile.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	
//2. Select query starts
if(isset($_SESSION[customerid]))
{
	$sqledit = "select * from customer WHERE customerid='$_SESSION[customerid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Customer</h3>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact">
	<div class="container">
		<div class=" contact-w3">	
			
			<div class="col-md-2">
			</div>
			<div class="col-md-8">
				<p> Kindly enter following details</p>
				<div id="container">
					<!--Horizontal Tab-->
					<div id="parentHorizontalTab">
						<div class="resp-tabs-container hor_1">
							<div>
<form action="" method="post" enctype="multipart/form-data">
Customer Name: <input type="text" name="customername" value="<?php echo $rsedit[customername]; ?>"class="form-control">
<br>
Company Name: <input type="text" name="companyname"value="<?php echo $rsedit[companyname]; ?>" class="form-control">
<br>
Email Id:<input type="text" name="emailid"value="<?php echo $rsedit[emailid]; ?>" class="form-control">
<br>
	<center><input type="submit" name="submit" value="Submit" class="btn btn-info" style="width:200px;"></center>
</form>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
			<div class="col-md-2">
			</div>
		<div class="clearfix"></div>
	</div>
	</div>
</div>
<!-- //contact -->
<?php
include("footer.php");
?>
