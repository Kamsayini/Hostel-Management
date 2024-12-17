<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$sql = "DELETE FROM Employee WHERE EmployeeID='$_GET[EmployeeID]'";

if (mysqli_query($connection, $sql)) {
    header("refresh:1; url=IndexEmployee.php");
    exit;
} else
    echo "Deletion Failed";
