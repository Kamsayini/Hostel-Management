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
        left: 74%;
        top: 13%;
        transform: translate(-50%, -50%);
        padding: 70px;
        line-height: 70px;
    }

    div2 {
        color: #000000;
        position: absolute;
        left: 82.4%;
        top: 13%;
        transform: translate(-50%, -50%);
        padding: 70px;
        line-height: 70px;
    }
</style>

<body>
    <div class="container my-5">
        <h2>Students</h2>
        <form action="" method="GET">
            <a class="btn btn-head" href="/HostelManagement/HomeEmployee.php" role="button">
                <ion-icon name="home-sharp"></ion-icon>
            </a>
            <div1>
                <button type="submit" class="btn btn-head">
                    <ion-icon name="search"></ion-icon>Search
                </button>
            </div1>
            <div2>
                <input type="text" class="form-control" name="StudentID" value="<?php if (isset($_GET['StudentID'])) {
                                                                                    echo $_GET['StudentID'];
                                                                                } ?>">
            </div2>

        </form>
        <form>
            <table class="styled-table">
                <thead>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['StudentID'])) {

                        $ID = $_GET['StudentID'];

                        $sql = "SELECT * FROM student WHERE StudentID='$ID' OR RoomID='$ID' OR Fname='$ID' OR Lname='$ID' OR Department='$ID'";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->error);
                        }
                        echo "
                        <thead>
                        <tr>
                        <th>StudentID</th>
                        <th>RoomID</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        <th>Age</th>
                        <th>MobileNo</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th></th>`
                        <th></th>
                        </thead>
                        </tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "
                    <tr>
                    <td>$row[StudentID]</td>
                    <td>$row[RoomID]</td>
                    <td>$row[Fname]</td>
                    <td>$row[Lname]</td>
                    <td>$row[Age]</td>
                    <td>$row[MobileNo]</td>
                    <td>$row[Department]</td>
                    <td>$row[Status]</td>
                    <td>$row[Address]</td>
                    <td>
                        <a class='btn btn-head btn-sm' href='./UpdateStudent.php?StudentID=$row[StudentID]'><ion-icon name='create-sharp'></ion-icon>Update</a>
                    </td>
                    <td>
                        <a class='btn btn-delete btn-sm' href='./DeleteStudent.php?StudentID=$row[StudentID]'><ion-icon name='trash-sharp'></ion-icon>Delete</a>
                    </td>
                    </tr>
                    ";
                        }
                    }
                    ?>

                </tbody>
                <thead>
                    <tr>
                        <th>StudentID</th>
                        <th>RoomID</th>
                        <th>Fname</th>
                        <th>Lname</th>
                        <th>Age</th>
                        <th>MobileNo</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th></th>
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

                    $sql = "SELECT * FROM student";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                    <tr>
                    <td>$row[StudentID]</td>
                    <td>$row[RoomID]</td>
                    <td>$row[Fname]</td>
                    <td>$row[Lname]</td>
                    <td>$row[Age]</td>
                    <td>$row[MobileNo]</td>
                    <td>$row[Department]</td>
                    <td>$row[Status]</td>
                    <td>$row[Address]</td>
                    <td>
                        <a class='btn btn-update btn-sm' href='./UpdateStudent.php?StudentID=$row[StudentID]'><ion-icon name='create-sharp'></ion-icon>Update</a>
                    </td>
                    <td>
                        <a class='btn btn-delete btn-sm' href='./DeleteStudent.php?StudentID=$row[StudentID]'><ion-icon name='trash-sharp'></ion-icon>Delete</a>
                    </td>
                    </tr>
                    ";
                    }
                    ?>

                </tbody>
            </table>
        </form>
        <br>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>