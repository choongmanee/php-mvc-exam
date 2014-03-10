<?php
date_default_timezone_set('UTC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login/Registration</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>
<body>
<div id="container">
	<?php echo validation_errors();?>
	<?php
	if ($this->session->flashdata('login_error')) 
	{
		echo "<h2>".$this->session->flashdata('login_error')."</h2>";
	}
	?>
	<div class="main">
		<h4>Login</h4>
		<form action="/quotes/login" method="post">
			<label for="email">Email: </label>
			<input type="text" name="email" id="email"></br>
			<label for="password">Password: </label>
			<input type="password" name="password" id="password"></br>
			<input type="submit" value="Login" class="btn btn-info">
		</form>
	</div>
	<div class="main">
		<h4>Register</h4>
		<form action="/quotes/register" method="post" >
			<label for="name">Name: </label>
			<input type="text" name="name" id="name"></br>
			<label for="alias">Alias: </label>
			<input type="text" name="alias" id="alias"></br>
			<label for="emailaddress">Email Address: </label>
			<input type="text" name="emailaddress" id="emailaddress"></br>
			<label for="rpassword">Password: </label>
			<input type="password" name="rpassword" id="rpassword"></br>
			<label for="dob">Date of Birth: </label>
			<input type="date" name="dob" id="dob"></br>
			<input type="submit" value="Register" class="btn btn-info">
		</form>
	</div>
</div><!--end of container div-->
</body>
</html>