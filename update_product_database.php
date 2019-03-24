<?php

	include 'auth/database.php';

	$message = "";

	if(isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['status']) && isset($_POST['product_id']))
	{
		$output = "";
		$product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
		$price = mysqli_real_escape_string($connect, $_POST['price']);
		$status = $_POST['status'];
		$product_id = $_POST['product_id'];

		$query = "UPDATE add_product SET name = '$product_name', price = '$price', status = '$status' WHERE id = '" . $product_id . "'";
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
			$select_query = "SELECT * FROM add_product ORDER BY id DESC";
			$result = mysqli_query($connect, $select_query);
			$output .= '
				<table class="table table-hover" id="product">
					<thead class="thead-dark">
				    	<tr>
				      		<th scope="col">Image</th>
				      		<th scope="col">Product Name</th>
				      		<th scope="col">Price</th>
				      		<th scope="col">Category</th>
				      		<th scope="col">Active</th>
				      		<th scope="col">Action</th>
				    	</tr>
				  	</thead>
			';


			while($data = mysqli_fetch_array($result))
			{	
				if($data['status'] == 'yes')
				{
		    		$output .= "
				    	<tbody
					    	<tr>
					      		<td>
					      			<img src='file/" . $data['image'] . "' width='70px' height='70px' alt='img' class='img-fluid' style='border-radius: 50%;'>
					      		</td>
					      		<td>" . $data['name'] . "</td>
					      		<td>" . $data['price'] . "</td>
					      		<td>" . $data['category'] . "</td>
					      		<td><span class='active-status bg-success'>" . $data['status'] . "</span></td>
					      		<td>
					      			<div class='row'>
					      				<button type='submit' id='" . $data['id'] . "' name='edit' class='btn btn-sm btn-primary mr-2 edit_data'>Edit</button>
					      				<a href='delete_product.php?id=" . $data['id'] . "' class='btn btn-sm btn-danger'>Delete</a>
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
					      		<td>
					      			<img src='file/" . $data['image'] . "' width='70px' height='70px' alt='img' class='img-fluid' style='border-radius: 50%;'>
					      		</td>
					      		<td>" . $data['name'] . "</td>
					      		<td>" . $data['price'] . "</td>
					      		<td>" . $data['category'] . "</td>
					      		<td><span class='inactive-status bg-danger'>" . $data['status'] . "</span></td>
					      		<td>
					      			<div class='row'>
					      				<button type='submit' id='" . $data['id'] . "' name='edit' class='btn btn-sm btn-primary mr-2 edit_data'>Edit</button>
					      				<a href='delete_product.php?id=" . $data['id'] . "' class='btn btn-sm btn-danger'>Delete</a>
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