<?php
	
	//$connection = mysqli_connect("localhost","root","");
	//mysqli_select_db($connection,"headcount");
	$connection = mysqli_connect("mysql3791int.cp.blacknight.com","u1259749_kinnego","LetUsIn123");
	mysqli_select_db($connection,"db1259749_headcount");

	$query = "SELECT * FROM webviews";
	mysqli_query($connection, "UPDATE webviews SET totalcount = totalcount+1");
	$result = mysqli_query($connection, $query);

	while($r=mysqli_fetch_assoc($result))
	{
		$totalcount = $r["totalcount"];
	}

	$data = '{"totalViews":"'.$totalcount.'"}';

	json_encode($data);
	echo($data);
	mysqli_close($connection);
?>

