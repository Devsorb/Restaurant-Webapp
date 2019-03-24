<?php

	include 'auth/database.php';
	
	if(isset($_GET['id']))
	{
		$product_id = $_GET['id'];
		$query = "DELETE FROM add_product WHERE id = '" . $product_id . "'";
		mysqli_query($connect, $query);
		header('Location: manage_product.php');		
	}	
?>