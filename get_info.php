<?php
	
	include 'auth/database.php';

	$query = "SELECT * FROM info";
	$result = mysqli_query($connect, $query);
	$data = mysqli_fetch_array($result);
	echo json_encode($data);

?>