<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hostel management system";
$connection = new mysqli($servername, $username, $password, $database);

$RoomID = "";
$HostelID  = "";
$nBed = "";
$Capacity = "";
$nPeople = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["RoomID"])) {
        header("location: ./IndexHostel.php");
        exit;
    }

    $RoomID = $_GET["RoomID"];

    $sql = "SELECT * FROM room WHERE RoomID='$RoomID'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./IndexHostel.php");
        exit;
    }

    $RoomID = $row["RoomID"];
    $HostelID  = $row["HostelID"];
    $nBed = $row["nBed"];
    $Capacity = $row["Capacity"];
    $nPeople = $row["nPeople"];
} else {

    $RoomID = $_POST["RoomID"];
    $HostelID  = $_POST["HostelID"];
    $nBed = $_POST["nBed"];
    $Capacity = $_POST["Capacity"];
    $nPeople = $_POST["nPeople"];


    do {
        if (empty($RoomID) || empty($HostelID) || empty($nBed) || empty($Capacity) || empty($nPeople)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE room " . "SET HostelID='$_POST[HostelID]',nBed='$_POST[nBed]',Capacity='$_POST[Capacity]',nPeople='$_POST[nPeople]'
                WHERE RoomID='$_POST[RoomID]'";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Room upCapacityd successfully";
        echo "Room upCapacityd successfully";
        header("location: ./IndexRoom.php");
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
        <h2>Update Room</h2>

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
                <label class="col-sm-3 col-form-label">Room ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="RoomID" value="<?php echo $RoomID; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Hostel ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="HostelID" value="<?php echo $HostelID; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nBed</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nBed" value="<?php echo $nBed; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Capacity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Capacity" value="<?php echo $Capacity; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nPeople</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nPeople" value="<?php echo $nPeople; ?>" readonly>
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
                    <a class="btn btn-outline-primary" href="./IndexRoom.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>