<?php
	$count = 0;
	$venueName ="";
	$venueID =1;

	if(isset($_GET['venueID']))
	{ 
		$venueID = $_GET['venueID'];
	}
	
	//$connection = mysqli_connect("localhost","root","");
	//mysqli_select_db($connection,"headcount");
	$connection = mysqli_connect("mysql3791int.cp.blacknight.com","u1259749_kinnego","LetUsIn123");
	mysqli_select_db($connection,"db1259749_headcount");

	$query = "SELECT * FROM footfall WHERE $venueID = footfallVenueID AND DATE(footfallDate) = CURDATE()";
	$result = mysqli_query($connection, $query);

	while($r=mysqli_fetch_assoc($result))
	{
		$count += $r["footfallInward"];
		$count -= $r["footfallOutward"];
	}

	$query1 = "SELECT * FROM venues WHERE $venueID = venueID";
	$result = mysqli_query($connection, $query1);
	
	while($r=mysqli_fetch_assoc($result))
	{
		$venueName = $r["venueName"];
	}

	//so a minus count is never shown. 		//count minus no. of employees as they may be counted also.
	if($count < 0)
		$count = 0;

	$data = '{"count":"'.$count.'", "venueName": "'.$venueName.'"}';

	json_encode($data);
	echo($data);
	mysqli_close($connection);
?>

