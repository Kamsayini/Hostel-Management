<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

$EmployeeID = "";
$Fname  = "";
$Lname = "";
$MobileNo = "";
$Salary = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $EmployeeID = $_POST["EmployeeID"];
    $Fname  = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $MobileNo = $_POST["MobileNo"];
    $Salary = $_POST["Salary"];

    do {
        if (empty($EmployeeID) || empty($Fname) || empty($Lname) || empty($MobileNo) || empty($Salary)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $SELECT = "SELECT EmployeeID From Employee Where EmployeeID = ? Limit 1";
        $INSERT = "INSERT Into Employee (EmployeeID,Fname,Lname,MobileNo,Salary)values(?,?,?,?,?)";

        $stmt = $connection->prepare($SELECT);
        $stmt->bind_param("s", $EmployeeID);
        $stmt->execute();
        $stmt->bind_result($EmployeeID);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();
            $stmt = $connection->prepare($INSERT);
            $stmt->bind_param("ssssi", $EmployeeID, $Fname, $Lname, $MobileNo, $Salary);
            $stmt->execute();
            $successMessage = "Employee added successfully";
        } else
            $errorMessage = "Invalid query: " . $connection->error;


        $EmployeeID = "";
        $Fname  = "";
        $Lname = "";
        $Age = "";
        $HostelID = "";
        $RoomID = "";
        $Address = "";
        $MobileNo = "";
        $Salary = "";
        $Status = "";
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
        <h2>New Employee</h2>

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
                <label class="col-sm-3 col-form-label">Employee ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="EmployeeID" value="<?php echo $EmployeeID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Fname" value="<?php echo $Fname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Lname" value="<?php echo $Lname; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mobile No</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="MobileNo" value="<?php echo $MobileNo; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Salary</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Salary" value="<?php echo $Salary; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-head">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/HostelManagement/IndexEmployee.php" role="button">Cancel</a>
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