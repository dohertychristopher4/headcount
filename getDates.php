<!-- GET DAYS -->

<select id="slctDay">

<?php

	$arrayOfVenueIDs = array(); 

	//$connection = mysqli_connect("localhost","root","");
	//mysqli_select_db($connection,"headcount");
	$connection = mysqli_connect("mysql3791int.cp.blacknight.com","u1259749_kinnego","LetUsIn123");
	mysqli_select_db($connection,"db1259749_headcount");

	$query = "SELECT DISTINCT date(footfallDate) FROM footfall ORDER BY date(footfallDate) DESC";// WHERE footfallVenueID = ";
	$result = mysqli_query($connection, $query);

	while($row = mysqli_fetch_array($result))
		$arrayOfDays[] = $row["date(footfallDate)"];

	foreach($arrayOfDays as $day)
	{
		$strDay = date('j F Y', strtotime($day));
		$dd = date('j', strtotime($day));
		$correctOrdinal = "";
		$ordinals = ["st", "nd", "rd", "th"];

		switch ($dd)
		{
						case 1: case 21: case 31:
					        $correctOrdinal = $ordinals[0];
					        break;
					    case 2: case 22:
					        $correctOrdinal = $ordinals[1];

					        break;
					    case 3: case 23:
					        $correctOrdinal = $ordinals[2];
					        break;

					    case 4: case 5: case 6: case 7: case 8: case 9: case 10: case 11: case 12: case 13: case 14:
					    case 15: case 16: case 17: case 18: case 19: case 20: case 24: case 25: case 26: case 27: 
					    case 28: case 29: case 30:
					        $correctOrdinal = $ordinals[3];
					        break;
		}

		if($dd < 10)
			$strDay = substr_replace($strDay, $correctOrdinal, 1, 0);
		else
			$strDay = substr_replace($strDay, $correctOrdinal, 2, 0);

		echo("<option value=".$day.">".$strDay."</option>");
	}

	$rs = array();
	while($rs[] = mysqli_fetch_assoc($result)) 
	{
		//do nothing
	}

	unset($rs[count($rs)-1]);  //removes a null value
	//print("{ \"results\":" . json_encode($rs) . "}");
	print json_encode($rs);
	mysqli_close($connection);
?>
</select>



