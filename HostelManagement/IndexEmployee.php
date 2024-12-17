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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        background: url(BackGroundOnly.jpg)no-repeat center center fixed;
        font-family: sans-serif;
        background-size: cover;
    }

    div1 {
        color: #000000;
        position: absolute;
        left: 45%;
        top: 13%;
        transform: translate(-50%, -50%);
        padding: 70px;
        line-height: 70px;
    }

    div2 {
        color: #000000;
        position: absolute;
        left: 53.8%;
        top: 13%;
        transform: translate(-50%, -50%);
        padding: 70px;
        line-height: 70px;
    }
</style>

<body>
    <div class="container my-5">
        <h2>Employee</h2>
        <form action="" method="GET">
            <a class="btn btn-head" href="./index.php" role="button">
                <ion-icon name="home-sharp"></ion-icon>
            </a>
            <a class="btn btn-head" href="./AddEmployee.php" role="button">
                <ion-icon name="add"></ion-icon>New Employee
            </a>
            <div1>
                <button type="submit" class="btn btn-head">
                    <ion-icon name="search"></ion-icon>Search
                </button>
            </div1>
            <div2>
                <input type="text" class="form-control" name="ID" value="<?php if (isset($_GET['ID'])) {
                                                                                echo $_GET['ID'];
                                                                            } ?>">
            </div2>
        </form>
        <form>
            <table class="styled-table">
                <thead>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['ID'])) {

                        $ID = $_GET['ID'];

                        $sql = "SELECT * FROM employee WHERE EmployeeID='$ID' OR MobileNo='$ID' OR Fname='$ID' OR Lname='$ID'";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->error);
                        }
                        echo "
                        <thead>
                        <tr>
                        <th>EmployeeID</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        <th>MobileNo</th>
                        <th>Salary</th>
                        <th></th>
                        </tr>
                        </thead>";

                        while ($row = $result->fetch_assoc()) {
                            echo "
                    <tr>
                    <td>$row[EmployeeID]</td>
                    <td>$row[Fname]</td>
                    <td>$row[Lname]</td>
                    <td>$row[MobileNo]</td>
                    <td>$row[Salary]</td>
                    <td>
                    <a class='btn btn-head btn-sm' href='./UpdateEmployee.php?EmployeeID=$row[EmployeeID]'><ion-icon name='create-sharp'></ion-icon>Update</a>
                    <a class='btn btn-delete btn-sm' href='./DeleteEmployee.php?EmployeeID=$row[EmployeeID]'><ion-icon name='trash-sharp'></ion-icon>Delete</a>
                    </td>
                    </tr>
                    ";
                        }
                    }
                    ?>

                </tbody>
                <thead>
                    <tr>
                        <th>EmployeeID</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        <th>MobileNo</th>
                        <th>Salary</th>
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

                    $sql = "SELECT * FROM employee";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                    <tr>
                    <td>$row[EmployeeID]</td>
                    <td>$row[Fname]</td>
                    <td>$row[Lname]</td>
                    <td>$row[MobileNo]</td>
                    <td>$row[Salary]</td>
                    <td>
                        <a class='btn btn-head btn-sm' href='./UpdateEmployee.php?EmployeeID=$row[EmployeeID]'><ion-icon name='create-sharp'></ion-icon>Update</a>
                        <a class='btn btn-delete btn-sm' href='./DeleteEmployee.php?EmployeeID=$row[EmployeeID]'><ion-icon name='trash-sharp'></ion-icon>Delete</a>
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