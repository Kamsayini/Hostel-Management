<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$sql = "DELETE FROM room WHERE RoomID='$_GET[RoomID]'";

if (mysqli_query($connection, $sql)) {
    header("refresh:1; url=IndexRoom.php");
    exit;
} else
    echo "Deletion Failed";
