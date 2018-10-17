<?php

	if(isset($_GET['venueID'])) {
		$venueID = $_GET['venueID'];
	}

	else
	{
		$venueID = 1;
	}

	if(isset($_GET['selectedDate'])) 
	{
		$selectedDate = $_GET['selectedDate'];
	}
	
	else
	{
		$selectedDate = '2018-04-05';
	}
	
	//$connection = mysqli_connect("localhost","root","");
	//mysqli_select_db($connection,"headcount");
	$connection = mysqli_connect("mysql3791int.cp.blacknight.com","u1259749_kinnego","LetUsIn123");
	mysqli_select_db($connection,"db1259749_headcount");

	//$query = 	"set session sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'; 

    $query = "SELECT date(footfallDate) AS specificDay, hour(footfallDate) AS specificHour, sum(footfallInward) AS myIns, sum(footfallOutward) AS myOuts 
				FROM footfall 
				WHERE footfallVenueID = '$venueID' AND date(footfallDate) = '$selectedDate'
				GROUP BY date(footfallDate), hour(footfallDate)
				ORDER BY date(footfallDate), hour(footfallDate)";
    /*"SELECT date(footfallDate) AS specificDay, hour(footfallDate) AS specificHour, sum(footfallInward) AS myIns, sum(footfallOutward) AS myOuts 
				FROM footfall 
				WHERE footfallVenueID = '$venueID' AND date(footfallDate) = '$selectedDate'
				GROUP BY day(footfallDate), hour(footfallDate)
				ORDER BY date(footfallDate), hour(footfallDate)";*/
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