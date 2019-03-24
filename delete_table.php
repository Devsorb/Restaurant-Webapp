<?php

	include 'auth/database.php';
	
	if(isset($_GET['id']))
	{
		$table_id = $_GET['id'];
		$query = "DELETE FROM book_table WHERE id = '" . $table_id . "'";
		mysqli_query($connect, $query);
		header('Location: table.php');		
	}	
?>