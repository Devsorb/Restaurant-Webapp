<?php

	include 'auth/database.php';
	
	if(isset($_GET['id']))
	{
		$group_id = $_GET['id'];
		$query = "DELETE FROM make_group WHERE id = '" . $group_id . "'";
		mysqli_query($connect, $query);
		header('Location: group.php');		
	}	
?>