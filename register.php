<?php

	include 'auth/database.php';

	$msg = "";

	if(isset($_POST['signup']))
	{
		
		$firstName       = $connect->real_escape_string($_POST['firstName']);
		$lastName        = $connect->real_escape_string($_POST['lastName']);
		$email           = $connect->real_escape_string($_POST['email']);
		$password        = $connect->real_escape_string($_POST['password']);
		$confirmPassword = $connect->real_escape_string($_POST['confirmPassword']);

		if($password === $confirmPassword)
		{
			$hashedpassword = sha1(md5($password));
			$query = "INSERT INTO users(first_name, last_name, email, password) VALUES('$firstName', '$lastName', '$email', '$hashedpassword')";
			$success = mysqli_query($connect, $query);
			if($success)
			{
				$msg = "Successfully registered. Redirecting...";
				header("refresh:3;url=login.php");
			}
			else
			{
				$msg = "There is some error. Try later..";
			}
		}
		else
		{
			$msg = "Both password fields must be same.";
		}

	}	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Restaurant - register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container-fluid" style="padding: 0;">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding: 8px 50px;">
			<a class="navbar-brand" href="#">The Indian Cuisine</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
			  		<li class="nav-item active">
			    		<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			  		</li>
			  		<li class="nav-item">
			  			<a class="nav-link" href="#">Menu</a>
			  		</li>
			  		<li class="nav-item">
			  			<a class="nav-link" href="#">Gallery</a>
			  		</li>
			  		<li class="nav-item">
			  			<a class="nav-link" href="#">Contact</a>
			  		</li>
				</ul>
				<form class="form-inline ml-auto">
		    		<a href="login.php" class="text-white" style="text-decoration: none;"><span class="fa fa-user"></span> Login</a>
		  		</form>
			</div>
		</nav>
		<div class="col-md-8 mx-auto">
			<h2 class="text-center text-inverse mb-4 mt-4">Signup</h2>
		</div>
		<div class="text-center text-success mb-4">
			<h5><?php echo $msg; ?></h5>
		</div>
		<div class="col-md-7 mx-auto">
			<form method="POST" action="" class="needs-validation" novalidate>
  				<div class="form-row">
    				<div class="col-md-6 mb-3">
      					<label for="validationCustom01">First name</label>
      					<input type="text" name="firstName" class="form-control" id="validationCustom01" placeholder="First name" required>
      					<div class="invalid-feedback">
        					Please enter your first name!
      					</div>
    				</div>
    				<div class="col-md-6 mb-3">
						<label for="validationCustom02">Last name</label>
						<input type="text" name="lastName" class="form-control" id="validationCustom02" placeholder="Last name" required>
						<div class="invalid-feedback">
							Please enter your last name!
						</div>
    				</div>
  				</div>
  				<div class="form-row">
    				<div class="col-md-12 mb-3">
      					<label for="validationCustom03">Email</label>
      					<input type="email" name="email" class="form-control" id="validationCustom03" placeholder="Email" required>
      					<div class="invalid-feedback">
        					Please provide a valid email.
      					</div>
    				</div>
				    <div class="col-md-12 mb-3">
				    	<label for="validationCustom04">Password</label>
				    	<input type="password" name="password" class="form-control" id="validationCustom04" placeholder="Password" required>
				    	<div class="invalid-feedback">
				        	Please provide a valid password.
				      	</div>
				    </div>
				    <div class="col-md-12 mb-3">
				    	<label for="validationCustom05">Confirm Password</label>
				    	<input type="password" name="confirmPassword" class="form-control" id="validationCustom05" placeholder="Confirm Password" required>
				    	<div class="invalid-feedback">
				      		Please enter same password.
				    	</div>
				    </div>
  				</div>
  				<div class="form-group">
    				<div class="form-check">
      					<input class="form-check-input" name="checkbox" type="checkbox" value="" id="invalidCheck" required>
      					<label class="form-check-label" for="invalidCheck">
        					Agree to terms and conditions
      					</label>
						<div class="invalid-feedback">
							You must agree before submitting.
						</div>
    				</div>
  				</div>
  				<button class="btn btn-primary w-100" name="signup" type="submit">Signup</button>
			</form>
		</div>
	</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</body>
</html>