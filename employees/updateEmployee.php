<?php
// Include config file
require_once "../includes/dbh.inc.php";

// Define variables and initialize with empty values
$firstName = $lastName = $wage = $hoursWorked = $hoursWorked2 = $managerStatus = "";
$first_name_err = $last_name_err = $wage_err = $hours1_err = $hours2_err = "";

// Processing form data when form is submitted
if(isset($_POST["empID"]) && !empty($_POST["empID"])){
    // Get hidden input value
    $empID = $_POST["empID"];

    // Validate first name
    $input_f_name = trim($_POST["firstName"]);
    if(empty($input_f_name)){
        $first_name_err = "Please enter a valid first name.";
    } elseif(!filter_var($input_f_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $first_name_err = "Please enter a valid first name.";
    } else{
        $firstName = $input_f_name;
    }

    //Validate last name
    $input_l_name = trim($_POST["lastName"]);
    if(empty($input_l_name)){
        $last_name_err = "Please enter a valid last name.";
    } elseif(!filter_var($input_l_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $last_name_err = "Please enter a valid last name.";
    } else{
        $lastName = $input_l_name;
    }


    // Validate salary
    $input_wage = trim($_POST["wage"]);
    if(empty($input_wage)){
        $wage_err = "Please enter the wage amount.";
    } elseif(!ctype_digit($input_wage)){
        $wage_err = "Please enter a positive integer value.";
    } else{
        $wage = $input_wage;
    }

    // Validate total hours worked
    $input_hours = trim($_POST["hoursWorked"]);
    if(empty($input_hours)){
        $hours1_err = "Please enter the amount of hours.";
    } elseif(!ctype_digit($input_hours)){
        $hours1_err = "Please enter a positive number of hours.";
    } else{
        $hoursWorked = $input_hours;
    }

    // Validate hours worked this week
    $input_hours_2 = trim($_POST["hoursWorkedLastWeek"]);
    if(empty($input_hours_2)){
        $hours2_err = "Please enter the amount of hours.";
    } elseif(!ctype_digit($input_hours_2)){
        $hours2_err = "Please enter a positive number of hours.";
    } else{
        $hoursWorked2 = $input_hours_2;
    }

    $managerStatus = $isAdmin = trim($_POST["managerStatus"]);

    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($last_name_err) && empty($wage_err) && empty($hours1_err) && empty($hours2_err)){
        // Prepare an update statement
        $sql = "UPDATE employee, users SET users.firstName=?, users.lastName=?, employee.wage=?, employee.hoursWorked=?, employee.hoursWorkedLastWeek=?, employee.managerStatus=?, users.isAdmin=?  WHERE empID=? AND employee.uid=users.uid";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssiiiiii", $param_first_name, $param_last_name, $param_wage, $param_hours_1, $param_hours_2, $param_manager_status, $param_is_admin, $param_empID);

            // Set parameters
            $param_first_name = $firstName;
            $param_last_name = $lastName;
            $param_wage = $wage;
            $param_hours_1 = $hoursWorked;
            $param_hours_2 = $hoursWorked2;
            $param_manager_status = $param_is_admin = $managerStatus;
            $param_empID = $empID;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: employeeList.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of empid parameter before processing further
    if(isset($_GET["empID"]) && !empty(trim($_GET["empID"]))){
        // Get URL parameter
        $empID =  trim($_GET["empID"]);

        // Prepare a select statement
        $sql = "SELECT * FROM employees, users WHERE empID = ? AND users.uid=employee.uid";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_empID);

            // Set parameters
            $param_empID = $empID;

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
                    $hoursWorked = $row['hoursWorked'];
                    $hoursWorked2 = $row['hoursWorkedLastWeek'];

                    mysqli_stmt_close($stmt);
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement


        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <p class="small">(If this is your account, logout then log back in to see all changes)</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstName" class="form-control <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstName; ?>">
                            <span class="invalid-feedback"><?php echo $first_name_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lastName" class="form-control <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastName; ?>">
                            <span class="invalid-feedback"><?php echo $last_name_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Wage</label>
                            <input type="number" name="wage" class="form-control <?php echo (!empty($wage_err)) ? 'is-invalid' : ''; ?>"><?php echo $wage; ?></input>
                            <span class="invalid-feedback"><?php echo $wage_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Hours Worked (Total)</label>
                            <input type="text" name="hoursWorked" class="form-control <?php echo (!empty($hours1_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hoursWorked; ?>">
                            <span class="invalid-feedback"><?php echo $hours1_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Hours Worked (Last Week)</label>
                            <input type="text" name="hoursWorkedLastWeek" class="form-control <?php echo (!empty($hours2_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hoursWorked2; ?>">
                            <span class="invalid-feedback"><?php echo $hours2_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Manager</label>
                            <input type="radio" name="managerStatus" value="1">
                            <label>Employee</label>
                            <input type="radio" name="managerStatus" value="0" checked>
                        </div>



                        <input type="hidden" name="empID" value="<?php echo $empID; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="employeeList.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
