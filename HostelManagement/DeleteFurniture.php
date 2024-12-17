<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$sql = "DELETE FROM furniture WHERE FurnitureID='$_GET[FurnitureID]'";

if (mysqli_query($connection, $sql)) {
    header("refresh:1; url=IndexFurniture.php");
    exit;
} else
    echo "Deletion Failed";
