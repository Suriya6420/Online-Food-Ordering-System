<?php
include("header.php");
if(isset($_POST[submit]))
{
	
		$sql ="UPDATE employee SET employeename='$_POST[employeename]',locationid='$_POST[locationid]',loginid='$_POST[loginid]',employeetype='$_POST[employeetype]' WHERE employeeid='$_SESSION[employeeid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('employee Record updated successfully..');</script>";
			echo "<script>window.location='employeeprofile.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	
//2. Select query starts

//2. Select query ends
?>
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Employee</h3>
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
Employee Name:<input type="text" name="employeename" value="<?php echo $rsedit[employeename]; ?>" class="form-control">
<br>
Location: <select name="locationid" class="form-control">
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
Login:<input type="text" name="loginid" value="<?php echo $rsedit[loginid]; ?>"class="form-control">
<br>

Employee Type: <select name="employeetype" class="form-control">
	<option value="">Select</option>
	<?php
	$arr = array("Admin","Employee");
	foreach($arr as $val)
	{
	if($val == $rsedit[status])
		{
		echo "<option value='$val'selected>$val</option>";
		}
			else
			{
		echo "<option value='$val'>$val</option>";
			}	
	}
	?>
</select>
<br>

	<input type="submit" name="submit" value="Submit" class="form-control" >
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
