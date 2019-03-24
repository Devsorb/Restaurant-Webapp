<?php

	include 'auth/database.php';

	session_start();

    $email = $_SESSION['email'];

    if(!isset($email))
    {
    	header('Location: login.php');
    }

    $results_per_page = 5;

    $result1 = mysqli_query($connect, "SELECT * FROM add_user");
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

    $result = mysqli_query($connect, "SELECT * FROM add_user ORDER BY id DESC LIMIT $this_page_first_result, $results_per_page");
    $count = mysqli_num_rows($result);

    if($page > $number_of_pages)
    {
        header('Location: manage_user.php?page=' . $number_of_pages);
    }  

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Restaurant - manage-user</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/manage_user.css">
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
					
					<li  data-toggle="collapse" data-target="#users" class="collapsed active">
	                	<a href="#"><i class="fa fa-user fa-lg"></i> Users <i class="fas fa-caret-down"></i></a>
	                </li>
	                <ul class="sub-menu collapse" id="users">
	                    <li><a href="add_user.php">Add Users</a></li>
	                    <li class="active"><a href="manage_user.php">Manage Users</a></li>
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

	                <li>
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
									<p class="d-inline ml-2">Users</p>
									<a href="dashboard.php" class="d-inline text-dark mt-2" style="text-decoration: none; float: right; font-weight: 500;"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
								</div>
								<div class="row">

									<!-- Add User Button -->

									<div class="col-md-4">
										<a href="add_user.php" class="btn btn-primary ml-1">Add User</a>
									</div>

									<!-- Search Bar -->

									<div class="col-md-4 mt-2 mb-4 ml-auto">
										<div class="input-group">
						                	<input type="text" name="search" id="search" onkeyup="SearchField();" class="form-control shadow-none" placeholder="Search Users">
						                	<span class="input-group-btn">
						                		<button class="btn btn-primary shadow-none" id="search-button">Search</button>
						                 	</span>
						               	</div>
									</div>

									<!-- Table -->

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
									  	<tbody id="display">
									  		<tr>
									  			<?php 
										  			if($count > 0)
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
														echo "<h5 class='text-danger mb-3'>No data to display.<h5>";
													}	
												?> 
									  	</tbody>
									</table>

									<!-- Pagination -->

									<nav aria-label="Page navigation example" style="background-color: transparent;">
		                              <ul class="pagination justify-content-end">

		                                <?php if($page > 1) { ?>  
		                                     
		                                  <li class="page-item"><a href="<?php  echo 'manage_user.php?page=' . $page_previous ?>" class="page-link">Previous</a></li>               
		                                  
		                                <?php } ?>   

		                                  <?php
		                                    for ($page = 1; $page <= $number_of_pages ; $page++) 
		                                { 
		                                  echo '<li class="page-item"><a href="manage_user.php?page=' . $page . '" class="page-link">' . $page . ' ' . '</a></li>';
		                                }
		                                  ?>

		                                <?php if($page >= 1) { ?>  
		                                      
		                                  <li class="page-item "><a href="<?php  echo 'manage_user.php?page=' . $page_next ?>" class="page-link">Next</a></li>

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

		<!-- Update Group Modal -->

	<div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="UpdateModalTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
	    	<div class="modal-content">
	    		<div class="modal-header">
	        		<h4 class="modal-title text-center text-info" id="exampleModalCenterTitle">Update User</h4>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		<div class="modal-body">
	      			<form method="POST" action="" id="update_form">
						<div class="form-group">
					    	<label for="firstNameUpdate" style="font-weight: 600;">First Name</label>
					    	<input type="text" name="firstNameUpdate" class="form-control shadow-none" id="firstNameUpdate" placeholder="Enter First Name">
					  	</div>
						<div class="form-group">
					    	<label for="usernameUpdate" style="font-weight: 600;">Username</label>
					    	<input type="text" name="usernameUpdate" class="form-control shadow-none" id="usernameUpdate" placeholder="Enter Username">
					  	</div>
					  	<div class="form-group">
					    	<label for="emailUpdate" style="font-weight: 600;">Email</label>
					    	<input type="email" name="emailUpdate" class="form-control shadow-none" id="emailUpdate" placeholder="Enter Email">
					  	</div>
						<label style="font-weight: 600;">Gender</label>
					  	<div class="form-group">
					  		<div class="form-check form-check-inline">
							  	<input class="form-check-input" type="radio" name="optionUpdate" id="maleUpdate" value="male">
							  	<label class="form-check-label" for="maleUpdate">Male</label>
							</div>
							<div class="form-check form-check-inline">
							  	<input class="form-check-input" type="radio" name="optionUpdate" id="femaleUpdate" value="female">
							  	<label class="form-check-label" for="femaleUpdate">Female</label>
							</div>
					  	</div>
					  	<button type="hidden" id="user_id" class="d-none"></button>
					  	<button type="submit" name="update" id="update" class="btn btn-primary">Update User</button>
					  	<button type="button" class="btn btn-danger shadow-none" data-dismiss="modal" aria-label="Close">Cancel</button>
					</form>
	      		</div>
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
		function SearchField() {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "user_search.php?search="+document.getElementById('search').value, false);
			xmlhttp.send(null);

			document.getElementById('display').innerHTML=xmlhttp.responseText;
      	}
	</script>

	<script type="text/javascript">
		/* Getting Data as json */

		$(document).on('click','.edit_data',function(){
			var user_id = $(this).attr('id');
			$.ajax({
				url:"update_user.php",
				method:"POST",
				data:{user_id:user_id},
				dataType:"json",
				success:function(data){
					$('#firstNameUpdate').val(data.firstName);
					$('#usernameUpdate').val(data.username);
					$('#emailUpdate').val(data.email);
					$('#user_id').val(data.id);
					if(data.gender == 'male')
						$('input:radio[name=optionUpdate]')[0].checked = true;
					else
						$('input:radio[name=optionUpdate]')[1].checked = true;
					$('#UpdateModal').modal('show');
				}
			});
		});

		/* Updating Data at backend */

		$('#update_form').on('submit', function(e){
			var user_id = $('#user_id').val();
			var firstNameUpdate = $('#firstNameUpdate').val();
			var usernameUpdate = $('#usernameUpdate').val();
			var emailUpdate = $('#emailUpdate').val();
			var genderUpdate = $('input:radio[name=optionUpdate]:checked').val();
			//alert("firstName: " + firstNameUpdate + " username: " + usernameUpdate + " email: " + emailUpdate + " gender: " + genderUpdate + " userID: " + user_id);
			e.preventDefault();
			if($('#firstNameUpdate').val() == "")
			{
				alert('Name is required.');
			}
			else if($('#usernameUpdate').val() == "")
			{
				alert('Username is required.');
			}
			else if($('#emailUpdate').val() == "")
			{
				alert('Email is required.');
			}
			else
			{
				$.ajax({
					url:"update_user_database.php",
					method:"POST",
					data: {
						firstNameUpdate: firstNameUpdate,
						usernameUpdate: usernameUpdate,
						emailUpdate: emailUpdate,
						genderUpdate: genderUpdate,
						user_id: user_id
					},
					success:function(data)
					{
						$('#UpdateModal').modal('hide');
						$('#user_table').html(data);
					}
				});
			}
		});

	</script>

</body>
</html>