<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$PayID = "";
$StudentID  = "";
$Amount = "";
$Date = "";
$Medium = "";

$errorMessage = "";
$successMessage = "";

$query = "SELECT * From rent order by PayID desc Limit 1";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
$lastid = $row['PayID'];
if ($lastid == "") {
    $empid = "PID1";
} else {
    $empid = substr($lastid, 3);
    $empid = intval($empid);
    $empid = "PID" . ($empid + 1);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $PayID = $_POST["PayID"];
    $StudentID  = $_POST["StudentID"];
    $Amount = $_POST["Amount"];
    $Date = date('Y-m-d', strtotime(($_POST['DateOF'])));
    $Medium = $_POST["Medium"];

    do {
        if (empty($PayID) || empty($StudentID) || empty($Amount) || empty($Medium) || empty($Date)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "INSERT Into rent (PayID,StudentID,Amount,Date,Medium) values ('$PayID','$StudentID','$Amount','$Date','$Medium')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $PayID = "";
        $StudentID  = "";
        $Amount = "";
        $Date = "";
        $Medium = "";

        $successMessage = "Payment is successfull.";
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
        <h2>New Payment</h2>

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
                <label class="col-sm-3 col-form-label">Rent ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="PayID" value="<?php echo $empid; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Student ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="StudentID" value="<?php echo $StudentID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Amount</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Amount" value="<?php echo $Amount; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="DateOF" value="<?php echo $Date; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Medium</label>
                <div class="col-sm-6">
                    <div class="box">
                        <select name="Medium">
                            <option value="" disabled selected>Choose option</option>
                            <option value="Online">Online</option>
                            <option value="VisaCard">Visa Card</option>
                            <option value="Cash">Cash</option>
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
                    <a class="btn btn-outline-primary" href="/HostelManagement/HomeStudent.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>