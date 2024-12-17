<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "hostel management system";
$connection = new mysqli($servername, $username, $password, $database);

$StudentID = "";
$Fname  = "";
$Lname = "";
$Age = "";
$RoomID = "";
$Address = "";
$MobileNo = "";
$Department = "";
$Status = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET["StudentID"])) {
        header("location: /HostelManagement/IndexStudent.php");
        exit;
    }

    $StudentID = $_GET["StudentID"];

    $sql = "SELECT * FROM student WHERE StudentID='$StudentID'";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /HostelManagement/IndexStudent.php");
        exit;
    }

    $StudentID = $row["StudentID"];
    $Fname  = $row["Fname"];
    $Lname = $row["Lname"];
    $Age = $row["Age"];
    $RoomID = $row["RoomID"];
    $Address = $row["Address"];
    $MobileNo = $row["MobileNo"];
    $Department = $row["Department"];
    $Status = $row["Status"];
} else {

    $StudentID = $_POST["StudentID"];
    $Fname  = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $Age = $_POST["Age"];
    $RoomID = $_POST["RoomID"];
    $Address = $_POST["Address"];
    $MobileNo = $_POST["MobileNo"];
    $Department = $_POST["Department"];
    $Status = $_POST["Status"];


    do {
        if (empty($StudentID) || empty($Fname) || empty($Lname) || empty($Age) || empty($RoomID) || empty($Address) || empty($MobileNo) || empty($Department) || empty($Status)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE student " . "SET RoomID='$_POST[RoomID]',Fname='$_POST[Fname]',Lname='$_POST[Lname]',Age='$_POST[Age]',MobileNo='$_POST[MobileNo]',Department='$_POST[Department]',Status='$_POST[Status]',
                Address='$_POST[Address]' WHERE Studentid='$_POST[StudentID]'";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $successMessage = "Student updated successfully";
        echo "Student updated successfully";
        header("location: /HostelManagement/IndexStudent.php");
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

    .box {
        top: 37%;
        left: 80%;
    }

    .box select {
        background-color: whitesmoke;
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
        <h2>New Student</h2>

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
                <label class="col-sm-3 col-form-label">Student ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="StudentID" value="<?php echo $StudentID; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Room ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="RoomID" value="<?php echo $RoomID; ?>">
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
                <label class="col-sm-3 col-form-label">Age</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Age" value="<?php echo $Age; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mobile No</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="MobileNo" value="<?php echo $MobileNo; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Department" value="<?php echo $Department; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Status" value="<?php echo $Status; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Address" value="<?php echo $Address; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alerrt-dismissible fade show' role='alert'>
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
                    <a class="btn btn-outline-primary" href="/HostelManagement/IndexStudent.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>