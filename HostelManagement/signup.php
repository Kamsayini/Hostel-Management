<?php
session_start();

include("connection.php");
include("functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

		//save to database
		$user_id = random_num(20);
		$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

		mysqli_query($connection, $query);

		header("Location: login.php");
		die;
	} else {
		echo "Please enter some valid information!";
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Signup Page </title>
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
			color: orange;
			padding: 15px;
			margin: 10px 0px;
			border: none;
			cursor: pointer;
		}

		form {
			border: 3px solid #f1f1f1;
		}

		input[type=text],
		input[type=password] {
			width: 100%;
			margin: 8px 0;
			padding: 12px 20px;
			display: inline-block;
			border: 2px solid green;
			box-sizing: border-box;
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
		}
	</style>
</head>

<body style="margin:0 auto;width:24%;text-align:left">
	<center>
		<h1>Signup Form</h1>
	</center>
	<form method="POST">
		<div class="container">
			<label>Username : </label>
			<input type="text" placeholder="Enter Username" name="user_name" required>
			<label>Password : </label>
			<input type="password" placeholder="Enter Password" name="password" required>
			<button type="submit">Login</button>
			<a href="login.php" style="color: #fff">Doesn't have an account?</a>
		</div>
	</form>
</body>

</html>