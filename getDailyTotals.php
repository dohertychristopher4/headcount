<?php
	if(isset($_GET['venueID'])) {
		$venueID = $_GET['venueID'];
	}
	
	else
	{
		$venueID = 1;
	}
	
	//$connection = mysqli_connect("localhost","root","");
	//mysqli_select_db($connection,"headcount");
	$connection = mysqli_connect("mysql3791int.cp.blacknight.com","u1259749_kinnego","LetUsIn123");
	mysqli_select_db($connection,"db1259749_headcount");

	$query = 	"SELECT date(footfallDate) AS specificDay, sum(footfallInward) AS myIns, sum(footfallOutward) AS myOuts 
				FROM footfall 
				WHERE footfallVenueID = '$venueID'
				GROUP BY date(footfallDate)
				ORDER BY date(footfallDate)";
	//WHERE footfallVenueID = " . $venueID . " AND date(footfallDate) = ".date($selectedDate)."
	$result = mysqli_query($connection, $query) or die("Error: ".mysqli_error($connection));;

	$rs = array();
	while($rs[] = mysqli_fetch_assoc($result)) 
	{
		//do nothing
	}

	unset($rs[count($rs)-1]);  //removes a null value
	//print("{ \"results\":" . json_encode($rs) . "}");
	print json_encode($rs);
	//echo CURDATE();
	mysqli_close($connection);
?>