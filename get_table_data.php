<?php
	
	include 'auth/database.php';

	if(isset($_POST['table_id']))
	{
		$query = "SELECT * FROM book_table WHERE id = '" . $_POST['table_id'] . "'";
		$result = mysqli_query($connect, $query);
		$data = mysqli_fetch_array($result);
		echo json_encode($data);
	}

?>