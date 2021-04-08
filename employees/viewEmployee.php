<?php
// Check existence of id parameter before processing further
if(isset($_GET["empID"]) && !empty(trim($_GET["empID"]))){
    // Include config file
    require_once "../includes/dbh.inc.php";
    require '../header.php';

    // Prepare a select statement
    //$sql = "SELECT * FROM employee WHERE empID = ?";
    $sql = "SELECT * FROM employee, users WHERE employee.uid = users.uid AND empID = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_empID);

        // Set parameters
        $param_empID = trim($_GET["empID"]);

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $firstName = $row["firstName"];
                $lastName = $row["lastName"];
                $wage = $row["wage"];
                $hoursWorked = $row["hoursWorked"];
                $hours2 = $row['hoursWorkedLastWeek'];
                $managerStatus = $row['managerStatus'];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }

        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>

                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["firstName"]." ".$row['lastName']; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Wage</label>
                        <p><b><?php echo $row["wage"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Total Hours Worked</label>
                        <p><b><?php echo $row["hoursWorked"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Hours Worked Last Week</label>
                        <p><b><?php echo $row["hoursWorkedLastWeek"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Position</label>
                        <p><b><?php
                          if ($row['managerStatus']==1) {
                            echo "Manager";
                          }else {
                            echo "Employee";
                          }
                          ?></b></p>
                    </div>

                    <p><a href="employeeList.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php 'require ../footer.php' ?>
