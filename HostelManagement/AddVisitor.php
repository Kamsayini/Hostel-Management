<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$VisitorID = "";
$StudentID  = "";
$TimeIn = "";
$TimeOut = "";
$Date = "";
$Sex = "";

$errorMessage = "";
$successMessage = "";

$query = "SELECT * From visitor order by VisitorID desc Limit 1";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
$lastid = $row['VisitorID'];
if ($lastid == "") {
    $empid = "V01";
} else {
    $empid = substr($lastid, 1);
    $empid = intval($empid);
    $empid = "V" . ($empid + 1);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $VisitorID = $_POST["VisitorID"];
    $StudentID  = $_POST["StudentID"];
    $TimeIn = $_POST["TimeIn"];
    $TimeOut = $_POST["TimeOut"];
    $Date = date('Y-m-d', strtotime(($_POST['DateOF'])));
    $Sex = $_POST["Sex"];

    do {
        if (empty($VisitorID) || empty($StudentID) || empty($TimeIn) || empty($Sex) || empty($Date) || empty($TimeOut)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSERT Into visitor (VisitorID,StudentID,TimeIn,TimeOut,Date,Sex) values ('$VisitorID','$StudentID','$TimeIn','$TimeOut','$Date','$Sex')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $VisitorID = "";
        $StudentID  = "";
        $TimeIn = "";
        $TimeOut = "";
        $Date = "";
        $Sex = "";

        $successMessage = "Record insert successfully.";
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

    .box {
        top: 37%;
        left: 50%;
    }

    .box select {
        background-color: #ffffff;
        color: black;
        padding: 8px;
        width: 637px;
        border: none;
        font-size: 17px;
        outline: none;
        border-radius: 7px;
    }
</style>

<body>
    <div class="container my-5">
        <h2>New Visitor</h2>

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
                <label class="col-sm-3 col-form-label">Visitor ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="VisitorID" value="<?php echo $empid; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Student ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="StudentID" value="<?php echo $StudentID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">TimeIn</label>
                <div class="col-sm-6">
                    <input type="time" class="form-control" name="TimeIn" value="<?php echo $TimeIn; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">TimeOut</label>
                <div class="col-sm-6">
                    <input type="time" class="form-control" name="TimeOut" value="<?php echo $TimeOut; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="DateOF" value="<?php echo $Date; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sex</label>
                <div class="col-sm-6">
                    <div class="box">
                        <select name="Sex">
                            <option value="" disabled selected>Choose option</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
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

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-head">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="./HomeEmployee.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>