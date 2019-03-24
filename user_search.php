<?php

	include 'auth/database.php';

	$search = $_GET['search'];

	$result = mysqli_query($connect, "SELECT * FROM add_user WHERE firstName like ('%$search%') OR username like ('%$search%') OR id like ('%$search%') OR email like ('%$search%') OR gender like ('%$search%') OR groups like ('%$search%') OR store like ('%$search%') ORDER BY id DESC ");
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
		    
		    <tr>
	  			<?php 
		  			if($query_results > 0)
		  			{
		  				while($data = mysqli_fetch_assoc($result))
		  				{	
	  			?>			
				      		<td><?php echo $data['id'] ?></td>	
				      		<td><?php echo $data['firstName'] ?></td>	
				      		<td><?php echo $data['username'] ?></td>
				      		<td><?php echo $data['email'] ?></td>
				      		<td><?php echo $data['gender'] ?></td>
				      		<td><?php echo $data['groups'] ?></td>
				      		<td><?php echo $data['store'] ?></td>
				      		<td>
				      			<div class="row">
				      				<button type="submit" name="edit" id="<?php echo $data['id']; ?>" class="btn btn-sm btn-primary mr-2 edit_data">Edit</button>
				      				<a href="delete_user.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
				      			</div>
				      		</td>
	    	</tr>      		
				<?php
						}
					}
					else
					{
						echo "<h5 class='text-danger mt-3 mb-3'>No data to display.<h5>";
					}	
				?>       		
	    	    	
		</tbody>
		</table>
	</body>
</html>   		
