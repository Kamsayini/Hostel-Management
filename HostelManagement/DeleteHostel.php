<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$sql = "DELETE FROM Hostel WHERE HostelID='$_GET[HostelID]'";

if (mysqli_query($connection, $sql)) {
    header("refresh:1; url=IndexHostel.php");
    exit;
} else
    echo "Deletion Failed";
