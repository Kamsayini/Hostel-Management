<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8>
    <meta http-equiv=" X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="EditDeleteButton.css">
    <link rel="stylesheet" type="text/css" href="table.css">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background: url(BackGroundOnly.jpg)no-repeat center center fixed;
        font-family: sans-serif;
        background-size: cover;
    }
</style>

<body>
    <div class="container my-5">
        <h2>Rooms</h2>
        <a class="btn btn-head" href="/HostelManagement/HomeEmployee.php" role="button">Home</a>
        <a class="btn btn-head" href="/HostelManagement/AddRoom.php" role="button">New Room</a>

        <br>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>RoomID</th>
                    <th>HostelID</th>
                    <th>nBed</th>
                    <th>Capacity</th>
                    <th>nPeople</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "hostel management system";
                $connection = new mysqli($servername, $username, $password, $database);
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM room";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[RoomID]</td>
                    <td>$row[HostelID]</td>
                    <td>$row[nBed]</td>
                    <td>$row[Capacity]</td>
                    <td>$row[nPeople]</td>
                    <td>
                        <a class='btn btn-head btn-sm' href='/HostelManagement/UpdateRoom.php?RoomID=$row[RoomID]'><ion-icon name='create-sharp'></ion-icon>Update</a>
                        <a class='btn btn-delete btn-sm' href='/HostelManagement/DeleteRoom.php?RoomID=$row[RoomID]'><ion-icon name='trash-sharp'></ion-icon>Delete</a>
                    </td>
                    </tr>
                    ";
                }
                ?>

            </tbody>
        </table>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>