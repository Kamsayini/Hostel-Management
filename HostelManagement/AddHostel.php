<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$HostelID  = "";
$SuperID = "";
$nRooms = "";
$nFloors = "";
$nStudent = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $HostelID  = $_POST["HostelID"];
    $SuperID = $_POST["SuperID"];
    $nRooms = $_POST["nRooms"];
    $nFloors = $_POST["nFloors"];
    $nStudent = $_POST["nStudent"];

    do {
        if (empty($SuperID) || empty($HostelID) || empty($nRooms) || empty($nFloors) || empty($nStudent)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $SELECT = "SELECT HostelID From Hostel Where HostelID = ? Limit 1";
        $INSERT = "INSERT Into Hostel (HostelID,SuperID,nRooms,nFloors,nStudents)values(?,?,?,?,?)";

        $stmt = $connection->prepare($SELECT);
        $stmt->bind_param("s", $HostelID);
        $stmt->execute();
        $stmt->bind_result($HostelID);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();
            $stmt = $connection->prepare($INSERT);
            $stmt->bind_param("ssiii", $HostelID, $SuperID, $nRooms, $nFloors, $nStudent);
            $stmt->execute();
            $successMessage = "Hostel added successfully";
        } else
            $errorMessage = "Invalid query: " . $connection->error;


        $HostelID  = "";
        $SuperID = "";
        $nRooms = "";
        $nFloors = "";
        $nStudent = "";
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
        <h2>New Hostel</h2>

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
                <label class="col-sm-3 col-form-label">Hostel ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="HostelID" value="<?php echo $HostelID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Super ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="SuperID" value="<?php echo $SuperID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">No of Rooms</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nRooms" value="<?php echo $nRooms; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">No of Floors</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nFloors" value="<?php echo $nFloors; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">No of Floors</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nStudent" value="<?php echo $nStudent; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-head">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="./IndexHostel.php" role="button">Cancel</a>
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