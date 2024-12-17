<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hostel management system";
$connection = new mysqli($servername, $username, $password, $database);

$HostelID = "";
$SuperID  = "";
$nRooms = "";
$nFloors = "";
$nStudents = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["HostelID"])) {
        header("location: /HostelManagement/IndexHostel.php");
        exit;
    }

    $HostelID = $_GET["HostelID"];

    $sql = "SELECT * FROM Hostel WHERE HostelID='$HostelID'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /HostelManagement/IndexHostel.php");
        exit;
    }

    $HostelID = $row["HostelID"];
    $SuperID  = $row["SuperID"];
    $nRooms = $row["nRooms"];
    $nFloors = $row["nFloors"];
    $nStudents = $row["nStudents"];
} else {

    $HostelID = $_POST["HostelID"];
    $SuperID  = $_POST["SuperID"];
    $nRooms = $_POST["nRooms"];
    $nFloors = $_POST["nFloors"];
    $nStudents = $_POST["nStudents"];


    do {
        if (empty($HostelID) || empty($SuperID) || empty($nRooms) || empty($nFloors) || empty($nStudents)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE hostel " . "SET SuperID='$_POST[SuperID]',nRooms='$_POST[nRooms]',nFloors='$_POST[nFloors]',nStudents='$_POST[nStudents]'
                WHERE HostelID='$_POST[HostelID]'";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Hostel updated successfully";
        echo "Hostel updated successfully";
        header("location: /HostelManagement/IndexHostel.php");
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

<body>
    <div class="container my-5">
        <h2>New Hostel</h2>

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
                    <input type="text" class="form-control" name="HostelID" value="<?php echo $HostelID; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Super ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="SuperID" value="<?php echo $SuperID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nRooms</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nRooms" value="<?php echo $nRooms; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nFloors</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nFloors" value="<?php echo $nFloors; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nStudents</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nStudents" value="<?php echo $nStudents; ?>">
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
                    <a class="btn btn-outline-primary" href="/HostelManagement/IndexHostel.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>