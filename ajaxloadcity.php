<?php
session_start();
error_reporting(0);
include("connection.php");
?>
City: <select name="cityid" class="form-control">
	<option value="">Select</option>
	<?php
	$sqlcity="select * from city WHERE status='Active' ";
	if(isset($_GET[editid]))
	{
		$sqlcity = $sqlcity . " AND locationid='$rsedit[locationid]'";
	}
	else
	{
		$sqlcity = $sqlcity . " AND locationid='$_GET[locationid]'";
	}
	$qsqlcity =mysqli_query($con,$sqlcity);
	while($rscity =mysqli_fetch_array($qsqlcity))
	{
		if($rscity['locationid'] == $rsedit['locationid'])
		{
		echo "<option selected value='$rscity[cityid]'>$rscity[city]</option>";
		}
		else
		{
		echo "<option value='$rscity[cityid]'>$rscity[city]</option>";
		}
	}
	?>
</select>