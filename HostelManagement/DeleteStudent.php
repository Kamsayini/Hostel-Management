<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$sql = "DELETE FROM student WHERE StudentID='$_GET[StudentID]'";

$room = "SELECT RoomID FROM student WHERE StudentID='$_GET[StudentID]'";
$sqlupdate = "UPDATE room " . "SET nPeople=nPeople-1 WHERE RoomID in ($room)";
$result = $connection->query($sqlupdate);

if (mysqli_query($connection, $sql)) {
    header("refresh:1; url=IndexStudent.php");
    exit;
} else
    echo "Deletion Failed";
