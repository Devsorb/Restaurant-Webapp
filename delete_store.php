<?php

	include 'auth/database.php';
	
	if(isset($_GET['id']))
	{
		$store_id = $_GET['id'];
		$query = "DELETE FROM store WHERE id = '" . $store_id . "'";
		mysqli_query($connect, $query);
		header('Location: store.php');		
	}	
?>