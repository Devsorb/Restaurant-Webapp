<?php

	include 'auth/database.php';
	
	if(isset($_GET['id']))
	{
		$category_id = $_GET['id'];
		$query = "DELETE FROM category WHERE id = '" . $category_id . "'";
		mysqli_query($connect, $query);
		header('Location: category.php');		
	}	
?>