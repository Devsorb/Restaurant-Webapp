<?php

	include 'auth/database.php';

	session_start();

    $email = $_SESSION['email'];

    if(!isset($email))
    {
    	header('Location: login.php');
    }

    //$query = "SELECT * FROM book_table ORDER BY id DESC";
    //$result = mysqli_query($connect, $query);
    //$count = mysqli_num_rows($result);

    $results_per_page = 5;

    $result1 = mysqli_query($connect, "SELECT * FROM book_table");
    $number_of_results = mysqli_num_rows($result1);

    $number_of_pages = ceil($number_of_results/$results_per_page);

    if(!isset($_GET['page']))
  	 $page = 1;
    else
  	 $page = $_GET['page'];


    $page_next = $page + 1;
    $page_previous = $page - 1;

    //determine sql starting limit number for results on displaying page.

    $this_page_first_result = ($page > 1) ? ($page-1)*$results_per_page : 0;

    $result = mysqli_query($connect, "SELECT * FROM book_table ORDER BY id DESC LIMIT $this_page_first_result, $results_per_page");
    $count = mysqli_num_rows($result);

    if($page > $number_of_pages)
    {
        header('Location: table.php?page=' . $number_of_pages);
    } 

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Restaurant - table</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/table.css">
</head>
<body>
	<div class="wrapper">

		<!-- Sidebar -->

		<div class="nav-side-menu">
			<div class="brand">Admin</div>
			<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
			<div class="menu-list">
				<ul id="menu-content" class="menu-content collapse out">
					<li>
						<a href="dashboard.php">
	                  		<i class="fas fa-tachometer-alt"></i> Dashboard
	                  	</a>
					</li>
					
					<li  data-toggle="collapse" data-target="#users" class="collapsed">
	                	<a href="#"><i class="fa fa-user fa-lg"></i> Users <i class="fas fa-caret-down"></i></a>
	                </li>
	                <ul class="sub-menu collapse" id="users">
	                    <li><a href="add_user.php">Add Users</a></li>
	                    <li><a href="manage_user.php">Manage Users</a></li>
	                </ul>

	                <li data-toggle="collapse" data-target="#groups" class="collapsed">
	                	<a href="#"><i class="fa fa-users fa-lg"></i> Groups <i class="fas fa-caret-down"></i></a>
	                </li>  
	                <ul class="sub-menu collapse" id="groups">
	                	<li><a href="group.php">Manage Groups</a></li>
	                </ul>

	                <li>
	                  	<a href="store.php">
	                  		<i class="fa fa-store fa-lg"></i> Stores
	               		</a>
	                </li>

	                <li class="active">
	                  	<a href="table.php">
	                  		<i class="fa fa-table fa-lg"></i> Table
	               		</a>
	                </li>

	                <li>
	                  	<a href="category.php">
	                  		<i class="fas fa-cash-register"></i> Category
	               		</a>
	                </li>

	                <li data-toggle="collapse" data-target="#products" class="collapsed">
	                	<a href="#"><i class="fas fa-cookie"></i> Products <i class="fas fa-caret-down"></i></a>
	                </li>
	                <ul class="sub-menu collapse" id="products">
	                  <li><a href="add_product.php">Add Products</a></li>
	                  <li><a href="manage_product.php">Manage Products</a></li>
	                </ul>

	                <li data-toggle="collapse" data-target="#order" class="collapsed">
	                	<a href="#"><i class="fas fa-book-open"></i> Orders <i class="fas fa-caret-down"></i></a>
	                </li>
	                <ul class="sub-menu collapse" id="order">
	                  <li><a href="order.php">Manage Orders</a></li>
	                </ul>

	                <li>
	                  	<a href="info.php">
	                  		<i class="fa fa-info fa-lg"></i> Company Info
	               		</a>
	                </li>

	                <li>
	                  	<a href="profile.php">
	                  		<i class="fa fa-users fa-lg"></i> Profile
	               		</a>
	                </li>

	                <li>
	                	<a href="settings.php">
	                		<i class="fa fa-sun fa-lg"></i> Settings
	                  	</a>
	                </li>

	                <li>
	                  	<a href="logout.php">
	                  		<i class="fa fa-user-times fa-lg"></i> Logout
	               		</a>
	                </li>

				</ul>	
			</div>
		</div>

		<!-- Content -->

		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<nav class="bar">
							<a href="#" id="toggle"><i class="fas fa-bars ml-3"></i></a>
						</nav>
						<div class="below-toggle-content">
							<div class="col-md-12">
								<div class="top-part mb-3">
									<h2 class="d-inline">Manage</h2>
									<p class="d-inline ml-2">Tables</p>
									<a href="dashboard.php" class="d-inline text-dark mt-2" style="text-decoration: none; float: right; font-weight: 500;"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
								</div>
								<div class="row">

									<!-- Add Group Button -->

									<div class="col-md-4">
										<button class="btn btn-primary add-group shadow-none add_data" data-toggle="modal" data-target="#AddModal">Add Table</button>
									</div>	

									<!-- Search Bar -->

									<div class="col-md-4 mt-2 mb-4 ml-auto">
										<div class="input-group">
						                	<input type="text" name="search" id="search" onkeyup="SearchField();" class="form-control shadow-none" placeholder="Search Table">
						                	<span class="input-group-btn">
						                		<button class="btn btn-primary shadow-none" id="search-button">Search</button>
						                 	</span>
						               	</div>
									</div>

								</div>

								<div class="row pl-3 pr-3">	

									<!-- Table -->

									<table class="table table-hover w-100" id="table">
										<thead class="thead-dark">
									    	<tr>
									      		<th scope="col">Id</th>
									      		<th scope="col">Table Name</th>
									      		<th scope="col">Capacity</th>
									      		<th scope="col">Available</th>
									      		<th scope="col">Status</th>
									      		<th scope="col">Action</th>
									    	</tr>
									  	</thead>
									  	<tbody id="display">
									  		<?php
										  		if($count > 0)
										  		{
										  			while($data = mysqli_fetch_array($result))
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
																			<a href="delete_table.php?id=<?php echo $data['id']; ?>" name="cancel" class="btn btn-sm btn-danger delete_data">Delete</a>														      			</div>
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
														      				<a href="delete_table.php?id=<?php echo $data['id']; ?>" name="cancel" class="btn btn-sm btn-danger delete_data">Delete</a>
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
									    			echo "<h5 class='text-danger mb-3'>No data to display.<h5>";
									    		}	
											?>    	
									  	</tbody>
									</table>

								</div>

								<div class="row">	

									<!-- Pagination -->

									<nav aria-label="Page navigation example" style="background-color: transparent;">
		                              <ul class="pagination justify-content-end">

		                                <?php if($page > 1) { ?>  
		                                     
		                                  <li class="page-item"><a href="<?php  echo 'table.php?page=' . $page_previous ?>" class="page-link">Previous</a></li>               
		                                  
		                                <?php } ?>   

		                                  <?php
		                                    for ($page = 1; $page <= $number_of_pages ; $page++) 
		                                { 
		                                  echo '<li class="page-item"><a href="table.php?page=' . $page . '" class="page-link">' . $page . ' ' . '</a></li>';
		                                }
		                                  ?>

		                                <?php if($page >= 1) { ?>  
		                                      
		                                  <li class="page-item "><a href="<?php  echo 'table.php?page=' . $page_next ?>" class="page-link">Next</a></li>

		                                <?php } ?>    
		                                      
		                              </ul>
		                          	</nav>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Add Group Modal -->

	<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="AddModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	    		<div class="modal-header">
	        		<h4 class="modal-title text-center text-info" id="exampleModalCenterTitle">Add Table</h4>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		<div class="modal-body">
	      			<form method="POST" action="" id="add_form">
						<div class="form-group">
					    	<label for="tableName">Table Name</label>
					    	<input type="text" name="tableName" class="form-control shadow-none" id="tableName" aria-describedby="emailHelp" placeholder="Enter Table Name">
					  	</div>
					  	<div class="form-group">
					    	<label for="capacity">Capacity</label>
					    	<input type="text" name="capacity" class="form-control shadow-none" id="capacity" aria-describedby="emailHelp" placeholder="Enter Capacity">
					  	</div>
					  	<div class="form-group">
					    	<label for="Available">Select Availability</label>
					    	<select name="availability" class="form-control shadow-none" id="Available">
					      		<option value="available">Available</option>
					      		<option value="unavailable">Unavailable</option>
					    	</select>
					  	</div>
					  	<div class="form-group">
					    	<label for="status">Select Status</label>
					    	<select name="status" class="form-control shadow-none" id="status">
					      		<option value="active">Active</option>
					      		<option value="inactive">Inactive</option>
					    	</select>
					  	</div>
					  <button type="submit" name="add_table" id="add_table" class="btn btn-primary shadow-none">Add Table</button>
					  <button type="button" class="btn btn-danger shadow-none" data-dismiss="modal" aria-label="Close">Cancel</button>
					</form>
	      		</div>
	    	</div>
	  	</div>
	</div>	

	<!-- Update Group Modal -->

	<div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="UpdateModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	    		<div class="modal-header">
	        		<h4 class="modal-title text-center text-info" id="exampleModalCenterTitle">Update Table</h4>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		<div class="modal-body">
	      			<form method="POST" action="" id="update_form">
						<div class="form-group">
					    	<label for="tableNameUpdate">Table Name</label>
					    	<input type="text" name="tableNameUpdate" class="form-control shadow-none" id="tableNameUpdate" aria-describedby="emailHelp" placeholder="Enter Table Name">
					  	</div>
					  	<div class="form-group">
					    	<label for="capacityUpdate">Capacity</label>
					    	<input type="text" name="capacityUpdate" class="form-control shadow-none" id="capacityUpdate" aria-describedby="emailHelp" placeholder="Enter Capacity">
					  	</div>
					  	<div class="form-group">
					    	<label for="AvailableUpdate">Select Availability</label>
					    	<select name="availabilityUpdate" class="form-control shadow-none" id="AvailableUpdate">
					      		<option value="available">Available</option>
					      		<option value="unavailable">Unavailable</option>
					    	</select>
					  	</div>
					  	<div class="form-group">
					    	<label for="statusUpdate">Select Status</label>
					    	<select name="statusUpdate" class="form-control shadow-none" id="statusUpdate">
					      		<option value="active">Active</option>
					      		<option value="inactive">Inactive</option>
					    	</select>
					  	</div>
					  	<button type="hidden" id="table_id" class="d-none"></button>
					  <button type="submit" name="update_table" id="update_table" class="btn btn-primary shadow-none">Update Table</button>
					  <button type="button" class="btn btn-danger shadow-none" data-dismiss="modal" aria-label="Close">Cancel</button>
					</form>
	      		</div>
	    	</div>
	  	</div>
	</div>

	<script type="text/javascript">
		$('#toggle').click(function(e){
			e.preventDefault();
			$('.wrapper').toggleClass('menuDisplayed');
		});
	</script>

	<script type="text/javascript">
		/* Insert Data */

		$(document).ready(function(){
			$('#add_form').on('submit', function(e){
				e.preventDefault();
				if($('#tableName').val() == "" || $('#capacity').val() == "")
				{
					alert('Name or capacity is empty.');
				}
				else
				{
					$.ajax({
						url:"add_store_data.php",
						method:"POST",
						data:$('#add_form').serialize(),
						success:function(data)
						{
							$('#add_form')[0].reset();
							$('#AddModal').modal('hide');
							$('#table').html(data);
							//location.href = "store.php";
							//setTimeout(function(){// wait for 5 secs
						          // location.reload(); // then reload the page.
						    //  }, 5000);
						}
					});
				}
			});
		});

		/* Getting Data as json */

		$(document).on('click','.edit_data',function(){
			var table_id = $(this).attr('id');
			$.ajax({
				url:"get_table_data.php",
				method:"POST",
				data:{table_id:table_id},
				dataType:"json",
				success:function(data){
					//console.log(data);
					$('#tableNameUpdate').val(data.table_name);
					$('#capacityUpdate').val(data.capacity);
					$('#availabilityUpdate').val(data.availability);
					$('#statusUpdate').val(data.status);
					$('#table_id').val(table_id);
					$('#UpdateModal').modal('show');
				}
			});
		});

		/* Updating Data at backend */

		$('#update_form').on('submit', function(e){
			var table_id = $('#table_id').val();
			var tableNameUpdate = $('#tableNameUpdate').val();
			var capacityUpdate = $('#capacityUpdate').val();
			var availabilityUpdate = $('#AvailableUpdate').val();
			var statusUpdate = $('#statusUpdate').val();
			e.preventDefault();
			if($('#tableNameUpdate').val() == "" || $('#capacityUpdate').val() == "")
			{
				alert('Table Name or capacity is empty.');
			}
			else
			{
				$.ajax({
					url:"update_table_database.php",
					method:"POST",
					data: {
						tableNameUpdate: tableNameUpdate,
						capacityUpdate: capacityUpdate,
						availabilityUpdate: availabilityUpdate,
						statusUpdate: statusUpdate,
						table_id: table_id
					},
					success:function(data)
					{
						$('#UpdateModal').modal('hide');
						$('#table').html(data);
					}
				});
			}
		});
	</script>

	<script type="text/javascript">
		function SearchField() {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "table_search.php?search="+document.getElementById('search').value, false);
			xmlhttp.send(null);

			document.getElementById('display').innerHTML=xmlhttp.responseText;
      	}
	</script>

</body>
</html>