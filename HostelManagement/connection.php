<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "hostel management system";

if (!$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
	die("failed to connect!");
}
