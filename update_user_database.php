<?php

	include 'auth/database.php';

	$message = "";

	if(isset($_POST['firstNameUpdate']) && isset($_POST['usernameUpdate']) && isset($_POST['emailUpdate']) && isset($_POST['genderUpdate']) && isset($_POST['user_id']))
	{
		$output = "";
		$firstNameUpdate = mysqli_real_escape_string($connect, $_POST['firstNameUpdate']);
		$usernameUpdate = mysqli_real_escape_string($connect, $_POST['usernameUpdate']);
		$emailUpdate = mysqli_real_escape_string($connect, $_POST['emailUpdate']);
		$genderUpdate = $_POST['genderUpdate'];
		$user_id = $_POST['user_id'];

		$query = "UPDATE add_user SET firstName = '$firstNameUpdate', username = '$usernameUpdate', email = '$emailUpdate', gender = '$genderUpdate' WHERE id = '" . $user_id . "'";
		$message = "Data Updated Successfully!!!";

		if(mysqli_query($connect, $query))
		{
			//$output .= "<p class='bg-success text-white w-100 pt-2 pb-2 pl-3 pr-3 mb-3' style='border-radius: 5px;'>Store Added Successfully...</p>";
			$output .= "
				<div class='alert alert-success alert-dismissible fade show w-100' role='alert'>
					<strong>" . $message . "</strong>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				    	<span aria-hidden='true'>&times;</span>
				  	</button>
				</div>
			";
			$select_query = "SELECT * FROM add_user ORDER BY id DESC";
			$result = mysqli_query($connect, $select_query);
			$output .= '
				<table class="table table-hover mx-3" id="user_table">
					<thead class="thead-dark">
				    	<tr>
				      		<th scope="col">Id</th>
				      		<th scope="col">Name</th>
				      		<th scope="col">Username</th>
				      		<th scope="col">Email</th>
				      		<th scope="col">Gender</th>
				      		<th scope="col">Group</th>
				      		<th scope="col">Store</th>
				      		<th scope="col">Action</th>
				    	</tr>
				  	</thead>
			';


			while($data = mysqli_fetch_array($result))
			{	
				$output .= "
				    	<tbody>
					    	<tr>
					      		<td> " . $data['id'] . "</td>
					      		<td> " . $data['firstName'] . "</td>
					      		<td> " . $data['username'] . "</td>
					      		<td>" . $data['email'] . "</td>
					      		<td>" . $data['gender'] . "</td>
					      		<td>" . $data['groups'] . "</td>
					      		<td>" . $data['store'] . "</td>
					      		<td>
					      			<div class='row'>
					      				<button type='submit' name='edit' id=" . $data['id'] . " class='btn btn-sm btn-primary mr-2 edit_data'>Edit</button>
					      				<a href='delete_user.php?id=" . $data['id'] . "' class='btn btn-sm btn-danger'>Delete</a>
					      			</div>
					      		</td>
					    	</tr>
					    </tbody>
	    			";
		    }

		    $output .= "</table>";
		}
		else
		{
			$msg = "Error in Query";
			$output .= "
				<div class='alert alert-success alert-dismissible fade show w-100' role='alert'>
					<strong>" . $msg . "</strong>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				    	<span aria-hidden='true'>&times;</span>
				  	</button>
				</div>
			";
		}
		echo $output;

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.active-status{
		  background-color: #28a745 !important;
		  font-size: 14px;
		  color: white;
		  padding: 1.5px 5px;
		  border-radius: 2px;
		}

		.inactive-status{
		  background-color: #dc3545 !important;
		  font-size: 14px;
		  color: white;
		  padding: 1.5px 5px;
		  border-radius: 2px;
		}
	</style>
</head>
<body>

</body>
</html>