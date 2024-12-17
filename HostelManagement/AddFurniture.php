<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$FurnitureID = "";
$nChair  = "";
$nTable = "";
$RoomID = "";
$Salary = "";

$query = "SELECT * From Furniture order by FurnitureID desc Limit 1";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
$lastid = $row['FurnitureID'];
if ($lastid == "") {
    $empid = "F001";
} else {
    $empid = substr($lastid, 1);
    $empid = intval($empid);
    $empid = "F0" . ($empid + 1);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FurnitureID = $_POST["FurnitureID"];
    $nChair  = $_POST["nChair"];
    $nTable = $_POST["nTable"];
    $RoomID = $_POST["RoomID"];

    do {
        if (empty($FurnitureID) || empty($nChair) || empty($nTable) || empty($RoomID)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSERT Into Furniture (FurnitureID,nChair,nTable,RoomID) values ('$FurnitureID','$nChair','$nTable','$RoomID')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $FurnitureID = "";
        $nChair  = "";
        $nTable = "";
        $RoomID = "";

        $successMessage = "Furniture added successful.";
    } while (false);
}

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
</style>

<body>
    <div class="container my-5">
        <h2>New Furniture</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }

        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Furniture ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="FurnitureID" value="<?php echo $empid; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nChair</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nChair" value="<?php echo $nChair; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nTable</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nTable" value="<?php echo $nTable; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Room ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="RoomID" value="<?php echo $RoomID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-head">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="./IndexFurniture.php" role="button">Cancel</a>
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                    </div>
                </div>
                ";
            }
            ?>
        </form>
    </div>
</body>

</html>