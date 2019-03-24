<?php

	include 'auth/database.php';

	if(isset($_POST['user_id']))
	{
		$query = "SELECT * FROM add_user WHERE id = '" . $_POST['user_id'] . "'";
		$result = mysqli_query($connect, $query);
		$data = mysqli_fetch_array($result);
		echo json_encode($data);
	}
?>