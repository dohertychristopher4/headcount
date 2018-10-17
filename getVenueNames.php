<!-- GET VENUES -->
<select name="slctVenue" id="slctVenue">
<?php	
	$arrayOfVenueIDs = array(); 
	
	//$connection = mysqli_connect("localhost","root","");
	//mysqli_select_db($connection,"headcount");
	$connection = mysqli_connect("mysql3791int.cp.blacknight.com","u1259749_kinnego","LetUsIn123");
	mysqli_select_db($connection,"db1259749_headcount");

	$query = "SELECT * FROM venues";
	$result = mysqli_query($connection, $query);

	while($row = mysqli_fetch_array($result))
		$arrayOfVenueIDs[] = $row["venueName"];

	$i = 1;
	foreach($arrayOfVenueIDs as $name)
	{
		echo("<option value=".$i.">".$name."</option>");
		$i++;
	}

	mysqli_close($connection);
?>
</select>