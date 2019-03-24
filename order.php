<?php

	include 'auth/database.php';

	session_start();

    $email = $_SESSION['email'];

    if(!isset($email))
    {
    	header('Location: login.php');
    }

    $query = "SELECT table_name FROM book_table WHERE availability = 'available' AND status = 'active'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Restaurant - order</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/store.css">
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

	                <li class="active">
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
									<p class="d-inline ml-2">Orders</p>
									<a href="dashboard.php" class="d-inline text-dark mt-2" style="text-decoration: none; float: right; font-weight: 500;"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
								</div>
								<div class="row">

									<!-- Add Group Button -->

									<div class="col-md-2">
										<button type="button" id="addrow" class="btn btn-primary mb-3 add-group shadow-none w-100">Add Order</button>
									</div>

									<div class="col-md-3">
										<select class="form-control shadow-none" id="table">
											<?php  

												if($count > 0)
												{
													while($data = mysqli_fetch_assoc($result))
													{
											?>
									    				<option value="<?php echo $data['table_name']; ?>"><?php echo $data['table_name']; ?></option>
									    	<?php
									    			}
									    		}
									    		else
									    		{	
									    	?>	
									    			<option>No Table is available</option>
									    	<?php
									    		}
									    	?>				
									    </select>
									</div>	

								</div>

								<table class="table table-hover order-list" id="myTable">
									<thead class="thead-dark">
										<tr>
											<th>Id</th>
											<th>Product</th>
											<th>Quantity</th>
											<th>Price</th>
											<th>Total Amount</th>
											<th>Action</th>
										</tr>
									</thead>
								</table>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$('#toggle').click(function(e){
			e.preventDefault();
			$('.wrapper').toggleClass('menuDisplayed');
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function () 
		{
    		var counter = 0;

		    $("#addrow").on("click", function () 
		    {
		        var newRow = $("<tr>");
		        var cols = "";

		        cols += '<td><input type="text" class="form-control shadow-none" name="id' + counter + '"/></td>';
		        cols += '<td><select class="form-control" id="name' + counter + '"><option>Main Course</option></select></td>';
		        cols += '<td><input type="text" class="form-control shadow-none" name="qty' + counter + '"/></td>';
		        cols += '<td><input type="text" class="form-control shadow-none" name="price' + counter + '"/></td>';
		        cols += '<td><input type="text" class="form-control shadow-none" name="tamount' + counter + '"/></td>';

		        cols += '<td><input type="button" class="delete btn btn-md btn-danger "  value="Delete"></td>';
		        newRow.append(cols);
		        $("table.order-list").append(newRow);
		        counter++;
    		});

		    $("table.order-list").on("click", ".delete", function (event) 
		    {
		        $(this).closest("tr").remove();       
		        counter -= 1;
	    	});

		});
	</script>

</body>
</html>