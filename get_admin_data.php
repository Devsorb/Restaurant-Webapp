<?php

	include 'auth/database.php';

	$query = "SELECT * FROM users";
	$result = mysqli_query($connect, $query);
	$data = mysqli_fetch_assoc($result);
	echo json_encode($data);

?>