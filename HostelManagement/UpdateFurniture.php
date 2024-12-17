<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hostel management system";
$connection = new mysqli($servername, $username, $password, $database);

$FurnitureID = "";
$nChair  = "";
$nTable = "";
$RoomID = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["FurnitureID"])) {
        header("location: ./IndexHostel.php");
        exit;
    }

    $FurnitureID = $_GET["FurnitureID"];

    $sql = "SELECT * FROM furniture WHERE FurnitureID='$FurnitureID'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./IndexHostel.php");
        exit;
    }

    $FurnitureID = $row["FurnitureID"];
    $nChair  = $row["nChair"];
    $nTable = $row["nTable"];
    $RoomID = $row["RoomID"];
} else {

    $FurnitureID = $_POST["FurnitureID"];
    $nChair  = $_POST["nChair"];
    $nTable = $_POST["nTable"];
    $RoomID = $_POST["RoomID"];


    do {
        if (empty($FurnitureID) || empty($nChair) || empty($nTable) || empty($RoomID)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE furniture " . "SET nChair='$_POST[nChair]',nTable='$_POST[nTable]',RoomID='$_POST[RoomID]'
                WHERE FurnitureID='$_POST[FurnitureID]'";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Furniture updated successfully";
        echo "Furniture updated successfully";
        header("location: ./IndexFurniture.php");
        exit;
    } while (true);
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
        <h2>Update Furniture</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alerrt-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }

        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Hostel ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="FurnitureID" value="<?php echo $FurnitureID; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Super ID</label>
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
                <label class="col-sm-3 col-form-label">RoomID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="RoomID" value="<?php echo $RoomID; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alerrt-dismissible fade show' rolnte='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-head">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="./IndexFurniture.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>