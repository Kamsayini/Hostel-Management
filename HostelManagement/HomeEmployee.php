<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Hostel Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="EditDeleteButton.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body,
        h1 {
            font-family: "Raleway", Arial, sans-serif;
            background: url(BackGroundImage.jpg)no-repeat center center fixed;
            background-size: cover;
        }

        h1 {
            letter-spacing: 6px
        }

        .w3-row-padding img {
            margin-bottom: 12px
        }
    </style>
</head>

<body>
    <center>
        <div class="w3-content" style="max-width:1500px">
            <header class="w3-panel w3-center" style="padding:128px 16px">
                <h1>EMPLOYEE</h1>
                <div class="w3-padding-32">
                    <div class="w3-bar">
                        <a class="btn btn-head" href="./index.php" role="button">
                            <ion-icon name="home-sharp"></ion-icon>
                        </a>
                        <a class="btn btn-head" href="./IndexEmployee.php" role="button">
                            <ion-icon name="person"></ion-icon>Employee Details
                        </a>
                        <a class="btn btn-head" href="./IndexStudent.php" role="button">
                            <ion-icon name="person"></ion-icon>Student
                        </a>
                        <a class="btn btn-head" href="./IndexFurniture.php" role="button">Furniture</a>
                        <a class="btn btn-head" href="./IndexHostel.php" role="button">Hostel</a>
                        <a class="btn btn-head" href="./IndexRoom.php" role="button">Room</a>
                        <a class="btn btn-head" href="./IndexRent.php" role="button">
                            <ion-icon name="logo-paypal"></ion-icon>Payment History
                        </a>
                        <a class="btn btn-head" href="./IndexVisitor.php" role="button">Visitor</a>
                    </div>
                </div>
            </header>
        </div>
    </center>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>