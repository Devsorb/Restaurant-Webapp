<?php

	include 'auth/database.php';

	if(isset($_POST['store_id']))
	{
		$query = "SELECT * FROM store WHERE id = '" . $_POST['store_id'] . "'";
		$result = mysqli_query($connect, $query);
		$data = mysqli_fetch_array($result);
		echo json_encode($data);
	}
?>