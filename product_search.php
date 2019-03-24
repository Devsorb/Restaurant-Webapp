<?php

	include 'auth/database.php';

	$search = $_GET['search'];

	$result = mysqli_query($connect, "SELECT * FROM add_product WHERE name like ('%$search%') OR price like ('%$search%') OR category like ('%$search%') OR status like ('%$search%') ORDER BY id DESC ");
  	$query_results = mysqli_num_rows($result);

?>

<!DOCTYPE html>
  	<html>
  	<head>
  		<title>
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
  		</title>
  	</head>
  	<body> 	

	  	<table class='table table-hover' id="product">
	    <tbody id="display">
	    	<?php
		  		if($query_results > 0)
		  		{
		  			while($data = mysqli_fetch_array($result))
		  			{	
	  		?>
				    	<tr>
				      		<td>
				      			<img src="file/<?php echo $data['image']; ?>" width="70px" height="70px" alt="img" class="img-fluid" style="border-radius: 50%;">
				      		</td>
				      		<td><?php echo $data['name']; ?></td>
				      		<td><?php echo $data['price']; ?></td>
				      		<td><?php echo $data['category']; ?></td>
				      		<?php
				      			if($data['status'] == 'yes')
				      			{
				      		?>
						      		<td><span class="active-status bg-success"><?php echo $data['status']; ?></span></td>
						      		<td>
						      			<div class="row">
						      				<button type="submit" name="edit" id="<?php echo $data['id']; ?>" class="btn btn-sm btn-primary mr-2 edit_data">Edit</button>
						      				<a href="delete_product.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
						      			</div>
						      		</td>
						    <?php
						    	}
						    	else
						    	{	
						    ?>  
						    		<td><span class="inactive-status bg-danger"><?php echo $data['status']; ?></span></td>
						      		<td>
						      			<div class="row">
						      				<button type="submit" name="edit" id="<?php echo $data['id']; ?>" class="btn btn-sm btn-primary mr-2 edit_data">Edit</button>
						      				<a href="delete_product.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
						      			</div>
						      		</td>
						    <?php
						    	}
					}
				}
				else
				{		    	
						    ?>  

						    <style> thead{ border: none; display: none; } </style>
					        <div class='alert alert-danger fade show w-100' role='alert'>
								<strong>No Matching Records!!</strong>
							</div>
				<?php
				}	
				?>				
				    	</tr>
	    	
			

		</tbody>
		</table>
	</body>
</html>   		
