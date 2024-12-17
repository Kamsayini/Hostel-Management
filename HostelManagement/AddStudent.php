<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($connection);

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $StudentID = $_POST["StudentID"];
    $Fname  = $_POST["Fname"];
    $Lname = $_POST["Lname"];
    $Age = $_POST["Age"];
    $RoomID = $_POST["RoomID"];
    $Address = $_POST["Address"];
    $MobileNo = $_POST["MobileNo"];
    $Department = $_POST["Department"];
    $Status = "Yes";

    do {
        if (empty($StudentID) || empty($Fname) || empty($Lname) || empty($Age) || empty($RoomID) || empty($Address) || empty($MobileNo) || empty($Department)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $SELECT = "SELECT StudentID From student Where StudentID = ? Limit 1";
        $INSERT = "INSERT Into student (StudentID,RoomID,Fname,Lname,Age,MobileNo,Department,Status,Address)values(?,?,?,?,?,?,?,?,?)";

        $stmt = $connection->prepare($SELECT);
        $stmt->bind_param("s", $StudentID);
        $stmt->execute();
        $stmt->bind_result($StudentID);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        $roomlimit = "SELECT nPeople FROM room WHERE RoomID='$_POST[RoomID]'";
        $result1 = $connection->query($roomlimit);
        $row = $result1->fetch_assoc();

        if ($rnum == 0 && $row["nPeople"] < 4) {
            $stmt->close();
            $stmt = $connection->prepare($INSERT);
            $stmt->bind_param("ssssissss", $StudentID, $RoomID, $Fname, $Lname, $Age, $MobileNo, $Department, $Status, $Address);
            $stmt->execute();
            $successMessage = "Student added successfully";
            $sql = "UPDATE room " . "SET nPeople=nPeople+1  WHERE RoomID='$_POST[RoomID]'";
            $result = $connection->query($sql);
        } else if ($row["nPeople"] > 3) {
            $errorMessage = "Room already full";
            break;
        } else {
            $errorMessage = "Student ID already exists " . $connection->error;
            break;
        }


        $StudentID = "";
        $Fname  = "";
        $Lname = "";
        $Age = "";
        $RoomID = "";
        $Address = "";
        $MobileNo = "";
        $Department = "";
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
        <h2>New Student</h2>

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
                <label class="col-sm-3 col-form-label">Student ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="StudentID" value="<?php echo $StudentID; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Room ID</label>
                <div class="col-sm-6">
                    <div class="box">
                        <select name="RoomID">
                            <option value="" disabled selected>Select Your Room ID</option>
                            <?php
                            $room = "SELECT * FROM room WHERE nPeople < 4";
                            $result = $connection->query($room);
                            while ($row = $result->fetch_assoc()) {
                                echo "
                        <option value=$row[RoomID]>$row[RoomID]</option>
                ";
                            }
                            ?>
                        </select>
                    </div>
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
                    <div class="box">
                        <select name="Department">
                            <option value="" disabled selected>Choose Department</option>
                            <option value="Computer">Computer</option>
                            <option value="Civil">Civil</option>
                            <option value="EEE">EEE</option>
                            <option value="Mechanical">Mechanical</option>
                        </select>
                    </div>
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