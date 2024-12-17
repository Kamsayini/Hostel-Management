<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hostel management system";
$connection = new mysqli($servername, $username, $password, $database);

$EmployeeID = "";
$Fname  = "";
$Lname = "";
$MobileNo = "";
$Salary = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["EmployeeID"])) {
        header("location: ./IndexEmployee.php");
        exit;
    }

    $EmployeeID = $_GET["EmployeeID"];

    $sql = "SELECT * FROM employee WHERE EmployeeID='$EmployeeID'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./IndexEmployee.php");
        exit;
    }

    $EmployeeID = $row["EmployeeID"];
    $Fname  = $row["Fname"];
    $Lname = $row["Lname"];
    $MobileNo = $row["MobileNo"];
    $Salary = $row["Salary"];
} else {

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

        $sql = "UPDATE employee " . "SET Fname='$_POST[Fname]',Lname='$_POST[Lname]',MobileNo='$_POST[MobileNo]',Salary='$_POST[Salary]'
                WHERE EmployeeID='$_POST[EmployeeID]'";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "employee updated successfully";
        echo "employee updated successfully";
        header("location: /HostelManagement/IndexEmployee.php");
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
        <h2>New employee</h2>

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
                    <a class="btn btn-outline-primary" href="/HostelManagement/IndexEmployee.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>