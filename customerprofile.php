<?php
include("header.php");
if(isset($_POST[submit]))
{
	$sql ="UPDATE customer SET customername='$_POST[customername]',companyname='$_POST[companyname]',emailid='$_POST[emailid]',contactno='$_POST[contactno]',address='$_POST[address]',locationid='$_POST[locationid]',cityid='$_POST[cityid]' WHERE customerid='$_SESSION[customerid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
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
		<h3 >Customer Profile</h3>
		<div class="clearfix"> </div>
	</div>
</div>

<!-- contact -->
<div class="contact">
	<div class="container">
		<div class=" contact-w3">	
<?php
include("sidebar.php");
?>
			<div class="col-md-9 ">
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
Email ID:<input type="text" name="emailid"value="<?php echo $rsedit[emailid]; ?>" class="form-control">
<br>
Contact No: <input type="text" name="contactno" value="<?php echo $rsedit[contactno]; ?>" class="form-control">
<br>
Address: 
<textarea name="address" class="form-control"><?php echo $rsedit[address]; ?></textarea>
<br>
Location: <select name="locationid" id="locationid" class="form-control" onchange="loadcity(this.value)">
	<option value="">Select</option>
	<?php
	$sqllocation="select * from location WHERE status='Active'";
	$qsqllocation =mysqli_query($con,$sqllocation);
	while($rslocation =mysqli_fetch_array($qsqllocation))
	{
		if($rslocation[locationid] == $rsedit[locationid])
		{
		echo "<option value='$rslocation[locationid]' selected>$rslocation[locationname]</option>";
		}
		else
		{
		echo "<option value='$rslocation[locationid]'>$rslocation[locationname]</option>";
		}
	}
	?>
</select>
<br>
<div id="divcity">City: <select name="cityid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqlcity="select * from city WHERE status='Active' AND cityid='$rsedit[cityid]'";
	$qsqlcity =mysqli_query($con,$sqlcity);
	while($rscity =mysqli_fetch_array($qsqlcity))
	{
		if($rscity['locationid'] == $rsedit['locationid'])
		{
		echo "<option selected value='$rscity[cityid]'>$rscity[city]</option>";
		}
	}
	?>
</select></div>
<br>

	<center><input type="submit" name="submit" value="Submit" class="btn btn-info" style="width:200px;"></center>
</form>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
		<div class="clearfix"></div>
	</div>
	</div>
</div>
<!-- //contact -->
<?php
include("footer.php");
?>
<script>
function loadcity(locationid)
{
	if (window.XMLHttpRequest) 
	{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divcity").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajaxloadcity.php?locationid="+locationid,true);
        xmlhttp.send();
}
</script>