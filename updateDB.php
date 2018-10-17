<?php
	
	$correct = False;
	$arrayOfVenueIDs = array();

	//$connection = mysqli_connect("localhost","root","");
	//mysqli_select_db($connection,"headcount");
	$connection = mysqli_connect("mysql3791int.cp.blacknight.com","u1259749_kinnego","LetUsIn123");
	mysqli_select_db($connection,"db1259749_headcount");

	$query = "SELECT venueID FROM venues";
	$result = mysqli_query($connection, $query);

	while($row = mysqli_fetch_array($result))
		$arrayOfVenueIDs[] = $row["venueID"];

	if(isset($_GET['venueID']) && isset($_GET['in']) && isset($_GET['out']))
	{
		$venueID = $_GET['venueID'];
		$inward = $_GET['in'];
		$outward = $_GET['out'];

		if(in_array($venueID, $arrayOfVenueIDs))
		{
			if(($inward == 0 || $inward== 1) && ($outward == 0 || $outward == 1))
			{
				if($inward == 0 && $outward == 1)
					$correct = True;

				else if($inward == 1 && $outward == 0)
					$correct = True;

				else
					$correct = False;
			}
		}
	}

	if($correct)
	{
		$connection = mysqli_connect("mysql3791int.cp.blacknight.com","u1259749_kinnego","LetUsIn123");
		mysqli_select_db($connection,"db1259749_headcount");

		$query = "INSERT INTO footfall(footfallVenueID, footfallInward, footfallOutward) VALUES($venueID, $inward, $outward)";
		$result = mysqli_query($connection, $query);

		mysqli_close($connection);
		echo "success";
	}

	else
	{
		echo "Wrong parameters";
		mysqli_close($connection);
	}
?>