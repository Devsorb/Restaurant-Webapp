<?php

	include 'auth/database.php';
	
	if(isset($_GET['id']))
	{
		$user_id = $_GET['id'];
		$query = "DELETE FROM add_user WHERE id = '" . $user_id . "'";
		mysqli_query($connect, $query);
		header('Location: manage_user.php');		
	}	
?>