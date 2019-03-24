<?php

	include 'auth/database.php';
	session_start();

    $email = $_SESSION['email'];
    $msg = "";

    if(!isset($email))
    {
    	header('Location: login.php');
    }

    $query_store = "SELECT * FROM store WHERE status = 'active'";
    $result_store = mysqli_query($connect, $query_store);
    $count_store = mysqli_num_rows($result_store);

    $query_category = "SELECT * FROM category WHERE status = 'active'";
    $result_category = mysqli_query($connect, $query_category);
    $count_category = mysqli_num_rows($result_category);

    if(isset($_POST['add']))
    {
    	$file_name = $_FILES['file']['name'];
		$file_size = $_FILES['file']['size'];
		$location = $_FILES['file']['tmp_name'];
		$path = "file/".$file_name;

		if(filesize($_FILES['file']['tmp_name']))
		{
			if(move_uploaded_file($location, $path))
			{
				$name = mysqli_real_escape_string($connect, $_POST['name']);
				$price = mysqli_real_escape_string($connect, $_POST['price']);
				$description = mysqli_real_escape_string($connect, $_POST['description']);
				$category = mysqli_real_escape_string($connect, $_POST['category']);
				$status = mysqli_real_escape_string($connect, $_POST['status']);

				if(!empty($name) || !empty($price) || !empty($description) || !empty($category) || !empty($status))
				{
					mysqli_query($connect, "INSERT INTO add_product(image, name, price, description, category, status) VALUES('$file_name', '$name', '$price', '$description', '$category', '$status')");
					$msg = "Product added";
				}
				else
				{
					$msg = "Some field is empty.";
				}

			}
			else
			{
				$msg = "Image Not Uploaded.";
			}
		}
		else
        {
            $msg = "Please upload a file.";
        } 
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Restaurant - product</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/add_product.css">
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

	                <li data-toggle="collapse" data-target="#products" class="collapsed active">
	                	<a href="#"><i class="fas fa-cookie"></i> Products <i class="fas fa-caret-down"></i></a>
	                </li>
	                <ul class="sub-menu collapse" id="products">
	                  <li class="active"><a href="add_product.php">Add Products</a></li>
	                  <li><a href="manage_product.php">Manage Products</a></li>
	                </ul>

	                <li data-toggle="collapse" data-target="#order" class="collapsed">
	                	<a href="#"><i class="fas fa-book-open"></i> Orders <i class="fas fa-caret-down"></i></a>
	                </li>
	                <ul class="sub-menu collapse" id="order">
	                  <li><a href="order.php">Manage Orders</a></li>
	                </ul>

	                <li data-toggle="collapse" data-target="#report" class="collapsed">
	                	<a href="#"><i class="fab fa-accusoft"></i> Report <i class="fas fa-caret-down"></i></a>
	                </li>
	                <ul class="sub-menu collapse" id="report">
	                  <li><a href="report.php">Manage Report</a></li>
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
									<h2 class="d-inline">Add</h2>
									<p class="d-inline ml-2">Products</p>
									<a href="dashboard.php" class="d-inline text-dark mt-2" style="text-decoration: none; float: right; font-weight: 500;"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
								</div>
							</div>
							<div class="row">
								<h5 class="text-danger" style="margin-left: 32.5px;"><?php echo $msg; ?></h5>
								<form method="POST" action="" enctype="multipart/form-data">
									<h1>Upload Image</h1>
							    	<div class="avatar-upload">
							        	<div class="avatar-edit">
							            	<input type="file" name="file" id="imageUpload" accept=".png, .jpg, .jpeg" />
							            	<label for="imageUpload"><i class="fas fa-edit"></i></label>
							        	</div>
							        	<div class="avatar-preview">
							            	<div id="imagePreview" style="background-image: url(img/preview.jpg);"></div>
							        	</div>
							    	</div>
							    	<div class="form-group">
								    	<label for="name" style="font-weight: 600;">Product Name</label>
								    	<input type="text" name="name" class="form-control shadow-none" id="name" placeholder="Enter Product Name">
								  	</div>
								  	<div class="form-group">
								    	<label for="price" style="font-weight: 600;">Price</label>
								    	<input type="text" name="price" class="form-control shadow-none" id="price" placeholder="Enter Price">
								  	</div>
								  	<div class="form-group shadow-textarea">
										<label for="description" style="font-weight: 600;">Description</label>
										<textarea class="form-control z-depth-1 shadow-none" name="description" id="description" rows="4" placeholder="Write description here..."></textarea>
									</div>
									<div class="form-group">
									    <label for="groups" style="font-weight: 600;">Category</label>
									    <select class="form-control shadow-none" id="category" name="category">
									    	<?php
									    		if($count_category > 0)
												{
													while($data = mysqli_fetch_assoc($result_category))
													{	
									    	?>
									    				<option value="<?php echo $data['category_name']; ?>"><?php echo $data['category_name']; ?></option>
									    	<?php
									    			}
									    		}
									    		else
									    		{	
									    	?>	
									    				<label for="store" style="font-weight: 600;">Category</label>
													    <select class="form-control shadow-none" id="category" name="category">
													    	<option>No Category</option>
													    </select>		
											<?php
												}
											?>		    
									    </select>
									</div>
									<div class="form-group">
								    	<label for="status">Active</label>
								    	<select class="form-control shadow-none" id="status" name="status">
								      		<option value="yes">Yes</option>
								      		<option value="no">No</option>
								    	</select>
								  	</div>
								  	<button type="submit" name="add" class="btn btn-primary shadow-none mt-3 mb-2">Add Product</button>
					  				<button type="button" class="btn btn-danger shadow-none mt-3 mb-2">Cancel</button>
								</form>
							</div>
						</div>		
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

	<script type="text/javascript" src="js/add_product.js"></script>

</body>
</html>