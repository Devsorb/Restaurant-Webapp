<?php

	include 'auth/database.php';

	if(isset($_POST['product_id']))
	{
		$product_id = $_POST['product_id'];

		$query = "SELECT * FROM add_product WHERE id = '$product_id'";
		$result = mysqli_query($connect, $query);
		$data = mysqli_fetch_assoc($result);
		echo json_encode($data);
	}

?>