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
        <h2>Payments</h2>
        <form action="" method="GET">
            <div class="row mb-0">
                <div class=" offset-sm-0 col-sm-2">
                    <a class="btn btn-head" href="./HomeEmployee.php" role="button">Home</a>
                </div>
                <div class=" offset-sm-1 col-sm-1 d-grid">
                    <button type="submit" class="btn btn-head">Search</button>
                </div>
                <div class=" offset-sm-0 col-sm-2">
                    <input type="text" class="form-control" name="ID" value="<?php if (isset($_GET['ID'])) {
                                                                                    echo $_GET['ID'];
                                                                                } ?>">
                </div>
            </div>
        </form>
        <form>
            <br>
            <table class="styled-table">
                <thead>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['ID'])) {

                        $ID = $_GET['ID'];

                        $sql = "SELECT * FROM rent WHERE PayID='$ID' OR StudentID='$ID' OR Date='$ID'";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Invalid query: " . $connection->error);
                        }
                        echo "
                        <thead>
                        <tr>
                        <th>PayID</th>
                        <th>StudentID</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Medium</th>`
                        <th></th>
                        </tr>
                        </thead>";

                        while ($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                <td>$row[PayID]</td>
                                <td>$row[StudentID]</td>
                                <td>$row[Amount]</td>
                                <td>$row[Date]</td>
                                <td>$row[Medium]</td>
                                <td>
                                <a class='btn btn-head btn-sm' href='./UpdateRent.php?PayID=$row[PayID]'><ion-icon name='create-sharp'></ion-icon>Update</a>
                                </td>
                                </tr>
                                ";
                        }
                    }
                    ?>

                </tbody>
                <thead>
                    <tr>
                        <th>PayID</th>
                        <th>StudentID</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Medium</th>
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

                    $sql = "SELECT * FROM rent";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        echo "
                    <tr>
                    <td>$row[PayID]</td>
                    <td>$row[StudentID]</td>
                    <td>$row[Amount]</td>
                    <td>$row[Date]</td>
                    <td>$row[Medium]</td>
                    <td>
                        <a class='btn btn-head btn-sm' href='./UpdateRent.php?PayID=$row[PayID]'><ion-icon name='create-sharp'></ion-icon>Update</a>
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