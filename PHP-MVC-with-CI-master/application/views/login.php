<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login and Registration</title>
	<style type="text/css">
	.login{
		border: 1px solid black;
		display: inline-block;
		text-align: right;
		padding-left: 15px;
		padding-right: 15px;
		padding-top: 10px;
		padding-bottom: 10px;
		vertical-align: top;
		margin-right: 20px;
	}
	h4{
		margin: 0px;
		text-align: left;
		margin-bottom: 20px;
	}
	label{
		text-align: left;
	}
	.error{
		color: red;
		font-size: 12px;
		margin: 0px;
	}
	.success{
		color: green;
		font-size: 12px;
		margin: 0px;
	}
	input{
		margin-bottom: 5px;
		margin-top: 5px;
	}
	p{
		font-size: 10px;
		text-align: center;
		margin: 2px;
	}

	</style>
</head>
<body>
		<h1>Welcome!</h1>
		<div class='success'> <?= $this->session->flashdata('messages'); ?></div>
		<div class = 'error'> <?= $this->session->flashdata('errors'); ?></div>
		<div class="login">
			<h4>Register</h4>
			<form action="/users/register" method="post">
				<!-- <input type="hidden" name="action" value="register"> -->
				<label for="name">Name:</label> 
				<input type="text" name="name"><br>
				<label for="alias">Alias:</label> 
				<input type="text" name="alias"><br>
				<label for="email">Email:</label> 
				<input type="text" name="email"><br>
				<label for="password">Password:</label> 
				<input type="password" name="password"><br>
				<p>*Password should be at least 8 characters</p>
				<label for="confirm_password">Confirm PW:</label> 
				<input type="password" name="confirm_password"><br>
				<label for="birth_date">Date of Birth:</label> 
				<input type="date" name="birth_date"><br>
				<input type="submit" value="Register">
			</form>
		</div>
		<div class="login">
			<h4>Log In</h4>
			<form action="/users/login" method="post">
<!-- 				<input type="hidden" name="action" value="login"> -->
				<label for="email">Email: </label>
				<input type="text" name="email"><br>
				<label for="password">Password:</label> <input type="password" name="password"><br>
				<input type="submit" value="Log in">
			</form>
		</div>
	</div>
</body>
</html>