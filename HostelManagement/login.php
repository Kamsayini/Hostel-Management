<?php

session_start();

include("connection.php");
include("functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

		$query = "select * from users where user_name = '$user_name' limit 1";
		$result = mysqli_query($connection, $query);

		if ($result) {
			if ($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);

				if ($user_data['password'] === $password) {

					$_SESSION['user_id'] = $user_data['user_id'];
					header("Location: index.php");
					die;
				}
			}
		}

		$errorMessage = "wrong username or password!";
		echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert' >
				<center>
				<strong>$errorMessage</strong>
				</center>
            </div>
            ";
	} else {
		$errorMessage = "wrong username or password!";
		echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
				<center>
                <strong>$errorMessage</strong>
				</center>
            </div>
            ";
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Login Page </title>
	<style>
		Body {
			font-family: Calibri, Helvetica, sans-serif;
			background: url(BackGroundOnly.jpg)no-repeat center center fixed;
			background-size: cover;
			width: 400px;
		}

		button {
			background-color: #4CAF50;
			width: 100%;
			color: black;
			padding: 15px;
			margin: 10px 0px;
			border: none;
			cursor: pointer;
			border-radius: 10px;
		}

		form {
			border: 3px solid #5626C4;
			border-radius: 10px;
		}

		input[type=text],
		input[type=password] {
			width: 100%;
			margin: 8px 0;
			padding: 12px 20px;
			display: inline-block;
			border: 2px solid green;
			box-sizing: border-box;
			border-radius: 10px;
		}

		button:hover {
			opacity: 0.7;
		}

		.cancelbtn {
			width: auto;
			padding: 10px 18px;
			margin: 10px 5px;
		}

		.container {
			padding: 30px;
			background-color: lightblue;
			border-radius: 20px;
		}
	</style>
</head>

<body style="margin:0 auto;width:24%;text-align:left">
	<center>
		<h1>Login Form</h1>
	</center>
	<form method="POST">
		<div class="container">
			<label>Username : </label>
			<input type="text" placeholder="Enter Username" name="user_name" required>
			<label>Password : </label>
			<input type="password" placeholder="Enter Password" name="password" required>
			<button type="submit">Login</button>
			<a href="signup.php" style="color: black">Doesn't have an account?</a>
		</div>
	</form>
</body>

</html>