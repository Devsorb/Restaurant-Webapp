<?php

	include 'auth/database.php';

	session_start();

	$message = "";
    $email = $_SESSION['email'];

    if(!isset($email))
    {
    	header('Location: login.php');
    }

    if(isset($_POST['update']))
    {
    	$oldPassword = $_POST['old_password'];
    	$newPassword = $_POST['new_password'];
    	$confirmPassword = $_POST['confirm_password'];

    	$query = "SELECT * from users WHERE email = '$email'";
    	$result = mysqli_query($connect, $query);
    	$count = mysqli_num_rows($result);

    	if($count > 0)
    	{
    		while($data = mysqli_fetch_assoc($result))
    		{
    			if($data['password'] == sha1(md5($oldPassword)))
    			{
    				if($newPassword === $confirmPassword)
    				{
    					$hashedpassword = sha1(md5($newPassword));
    					mysqli_query($connect, "UPDATE users SET password = '$hashedpassword' WHERE email = '$email'");
    					$message = "Password Updated.";
    					header("refresh:1;url=login.php");
    				}
    				else
    				{
    					$message = "Both password fields must be same.";
    				}
    			}
    			else
    			{
    				$message = "Current password is incorrect.";
    			}
    		}
    	}
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Restaurant - settings</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/settings.css">
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

	                <li class="active">
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
						<nav>
							<a href="#" id="toggle"><i class="fas fa-bars ml-3"></i></a>
						</nav>
						<div class="below-toggle-content">
							<div class="col-md-12">
								<div class="top-part mb-3">
									<h2 class="d-inline">User</h2>
									<p class="d-inline ml-2">Settings</p>
									<a href="dashboard.php" class="d-inline text-dark mt-2" style="text-decoration: none; float: right; font-weight: 500;"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
								</div>
								<div class="row">
									<h5 class="ml-3 mb-2 text-danger"><?php echo $message; ?></h5>
									<form method="POST" action="" class="w-100 p-3">
									  	<div class="form-group">
									    	<label for="old-password" style="font-weight: 600;">Old Password</label>
									    	<input type="password" name="old_password" class="form-control shadow-none" id="old-password" placeholder="Enter Old Password">
									  	</div>
									  	<div class="form-group">
									    	<label for="new-password" style="font-weight: 600;">New Password</label>
									    	<input type="password" name="new_password" class="form-control shadow-none" id="new-password" placeholder="Enter New Password">
									  	</div>
									  	<div class="form-group">
									    	<label for="confirm-password" style="font-weight: 600;">Confirm Password</label>
									    	<input type="password" name="confirm_password" class="form-control shadow-none" id="confirm-password" placeholder="Enter Password Again">
									  	</div>
									  	<button type="submit" name="update" class="btn btn-primary">Update Password</button>
									  	<button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
									</form>
								</div>
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

</body>
</html>