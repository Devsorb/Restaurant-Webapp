<?php

	include 'auth/database.php';

	if(isset($_POST['category_id']))
	{
		$category_id = $_POST['category_id'];
		$query = "SELECT * FROM category WHERE id='$category_id'";
		$result = mysqli_query($connect, $query);
		$data = mysqli_fetch_assoc($result);
		echo json_encode($data);
	}

?>