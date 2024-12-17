<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hostel management system";
$connection = new mysqli($servername, $username, $password, $database);

$VisitorID = "";
$StudentID  = "";
$TimeIn = "";
$TimeOut = "";
$Date = "";
$Sex = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["VisitorID"])) {
        header("location: /HostelManagement/IndexVisitor.php");
        exit;
    }

    $VisitorID = $_GET["VisitorID"];

    $sql = "SELECT * FROM visitor WHERE VisitorID='$VisitorID'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /HostelManagement/IndexVisitor.php");
        exit;
    }

    $VisitorID = $row["VisitorID"];
    $StudentID  = $row["StudentID"];
    $TimeIn = $row["TimeIn"];
    $TimeOut = $row["TimeOut"];
    $Date = $row["Date"];
    $Sex = $row["Sex"];
} else {

    $VisitorID = $_POST["VisitorID"];
    $StudentID  = $_POST["StudentID"];
    $TimeIn = $_POST["TimeIn"];
    $TimeOut = $_POST["TimeOut"];
    $Date = date('Y-m-d', strtotime(($_POST['DateOF'])));
    $Sex = $_POST["Sex"];


    do {
        if (empty($VisitorID) || empty($StudentID) || empty($TimeIn) || empty($TimeOut) || empty($Sex)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE visitor " . "SET StudentID='$_POST[StudentID]',TimeIn='$_POST[TimeIn]',TimeOut='$_POST[TimeOut]',Sex='$_POST[Sex]'
                WHERE VisitorID='$_POST[VisitorID]'";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "visitor updated successfully";
        header("location: /HostelManagement/IndexVisitor.php");
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
        <h2>New Visitor</h2>

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
                <label class="col-sm-3 col-form-label">Visitor ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="VisitorID" value="<?php echo $VisitorID; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Student ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="StudentID" value="<?php echo $StudentID; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Time In</label>
                <div class="col-sm-6">
                    <input type="time" class="form-control" name="TimeIn" value="<?php echo $TimeIn; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Time Out</label>
                <div class="col-sm-6">
                    <input type="time" class="form-control" name="TimeOut" value="<?php echo $TimeOut; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="Date" value="<?php echo $Date; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sex</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Sex" value="<?php echo $Sex; ?>" readonly>
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
                    <a class="btn btn-outline-primary" href="/HostelManagement/IndexVisitor.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>