<?php

	include 'auth/database.php';

	$search = $_GET['search'];

	$result = mysqli_query($connect, "SELECT * FROM book_table WHERE table_name like ('%$search%') OR capacity like ('%$search%') OR availability like ('%$search%') OR status like ('%$search%') OR id like ('%$search%') ORDER BY id DESC ");
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

	  	<table class='table table-striped'>
	    <tbody>
	    <?php 
	    	if($query_results > 0)
	    	{  
	        	while ($data = mysqli_fetch_assoc($result)) 
	        	{
	        	?>
	        		
	        		<tr>
			      		<td><?php echo $data['id']; ?></td>
			      		<td><?php echo $data['table_name']; ?></td>
			      		<td><?php echo $data['capacity']; ?></td>
			      		<?php
			      			if($data['availability'] == 'available')
	      					{
			      		?>
			      				<td><span class="available bg-success"><?php echo $data['availability']; ?></span></td>
			      		<?php
			      			}
			      			else
			      			{	
			      		?>	
			      				<td><span class="unavailable bg-warning"><?php echo $data['availability']; ?></span></td>
			      		<?php
			      			}
			      		?>
			      		<?php
			      			if($data['status'] == 'active')
	      					{
			      		?>		
				      			<td><span class="active-status bg-success"><?php echo $data['status']; ?></span></td>
					      		<td>
					      			<div class="row">
					      				<button type="submit" name="edit" id="<?php echo $data['id']; ?>" class="btn btn-sm btn-primary mr-2 edit_data">Edit</button>
					      				<button type="submit" name="cancel" class="btn btn-sm btn-danger">Delete</button>
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
					      				<button type="submit" name="cancel" class="btn btn-sm btn-danger">Delete</button>
					      			</div>
					      		</td>	
					    <?php
					    	}
					    ?>  			
			    	</tr>

				<?php
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

			</tbody>
		</table>
	</body>
</html>   		
