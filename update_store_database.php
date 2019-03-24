<?php

	include 'auth/database.php';

	$message = "";

	if(isset($_POST['storeName']) && isset($_POST['status']) && isset($_POST['store_id']))
	{
		$output = "";
		$storeName = mysqli_real_escape_string($connect, $_POST['storeName']);
		$status = $_POST['status'];
		$store_id = $_POST['store_id'];

		$query = "UPDATE store SET store_name = '$storeName', status = '$status' WHERE id = '" . $store_id . "'";
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
			$select_query = "SELECT * FROM store ORDER BY id DESC";
			$result = mysqli_query($connect, $select_query);
			$output .= "
				<table class='table table-striped'>
					<thead class='thead-dark'>
				    	<tr>
				      		<th scope='col'>Id</th>
				      		<th scope='col'>Store Name</th>
				      		<th scope='col'>Status</th>
				      		<th scope='col'>Action</th>
				    	</tr>
				  	</thead>
			";


			while($data = mysqli_fetch_array($result))
			{	
				if($data['status'] == 'active')
				{
		    		$output .= "
				    	<tbody
					    	<tr>
					      		<td> " . $data['id'] . "</td>
					      		<td> " . $data['store_name'] . "</td>
					      		<td><span class='active-status'>" . $data['status'] . "</span></td>
					      		<td>
					      			<div class='row'>
					      				<button type='submit' name='edit' id='" . $data['id'] . "' class='btn btn-sm btn-primary mr-2 edit_data'>Edit</button>
					      				<a href='delete_store.php?id=" . $data['id'] . "' name='cancel' class='btn btn-sm btn-danger delete_data'>Delete</a>
					      			</div>
					      		</td>
					    	</tr>
					    </tbody>
	    			";
	    		}
	    		else
	    		{
	    			$output .= "
				    	<tbody
					    	<tr>
					      		<td> " . $data['id'] . "</td>
					      		<td> " . $data['store_name'] . "</td>
					      		<td><span class='inactive-status'>" . $data['status'] . "</span></td>
					      		<td>
					      			<div class='row'>
					      				<button type='submit' name='edit' id='" . $data['id'] . "' class='btn btn-sm btn-primary mr-2 edit_data'>Edit</button>
					      				<a href='delete_store.php?id=" . $data['id'] . "' name='cancel' class='btn btn-sm btn-danger delete_data'>Delete</a>
					      			</div>
					      		</td>
					    	</tr>
					    </tbody>
	    			";
	    		}	
		    }

		    $output .= "</table>";
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