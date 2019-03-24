<?php 

	include 'auth/database.php';

	$output = "";
	$message = "";

	if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['userid']))
	{
		$first_name = mysqli_real_escape_string($connect, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($connect, $_POST['last_name']);
		$email = mysqli_real_escape_string($connect, $_POST['email']);
		$userid = $_POST['userid'];

		$query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = $userid ";
		$message = "Profile Updated";

		if(mysqli_query($connect, $query))
		{
			$output .= "
				<div class='alert alert-success alert-dismissible fade show w-100 mx-3' role='alert'>
					<strong>" . $message . "</strong>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				    	<span aria-hidden='true'>&times;</span>
				  	</button>
				</div>
			";

			$select = "SELECT * FROM users WHERE id = $userid";
			$result = mysqli_query($connect, $select);

			while($data = mysqli_fetch_assoc($result))
			{
				$output .= '
					<form method="POST" action="" class="w-100 p-3" id="update_form">
						<div class="form-group">
					    	<label for="userid" style="font-weight: 600;">Id</label>
					    	<input type="text" name="userid" class="form-control shadow-none" id="userid"  value="' . $data["id"] . '" disabled="true">
					  	</div>
					  	<div class="form-group">
					    	<label for="first_name" style="font-weight: 600;">First Name</label>
					    	<input type="text" name="first_name" class="form-control shadow-none" id="first_name" placeholder="Enter First Name" value="' . $data["first_name"] .'">
					  	</div>
					  	<div class="form-group">
					    	<label for="last_name" style="font-weight: 600;">Last Name</label>
					    	<input type="text" name="last_name" class="form-control shadow-none" id="last_name" placeholder="Enter Last Name" value="' . $data["last_name"] .'">
					  	</div>
					  	<div class="form-group">
					    	<label for="email" style="font-weight: 600;">Email</label>
					    	<input type="email" name="email" class="form-control shadow-none" id="email" placeholder="Enter Email" value="' . $data["email"] .'">
					  	</div>
						<button type="submit" name="update" class="btn btn-primary" id="update">Update Details</button>
					</form>
				';
			}
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