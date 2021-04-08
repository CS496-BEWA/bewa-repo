<?php
// Include config file
require_once '../includes/dbh.inc.php';
session_start();

// Define variables and initialize with empty values
$name = $wage = $firstName = $lastName = "";
$first_name_err = $last_name_err = $wage_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate First Name
    $input_f_name = trim($_POST["firstName"]);
    if(empty($input_f_name)){
        $first_name_err = "Please enter a name.";
    } elseif(!filter_var($input_f_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $first_name_err = "Please enter a valid name.";
    } else{
        $firstName = $input_f_name;
    }
    //Validate Last Name
    $input_l_name = trim($_POST["lastName"]);
    if(empty($input_l_name)){
        $last_name_err = "Please enter a name.";
    } elseif(!filter_var($input_l_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $last_name_err = "Please enter a valid name.";
    } else{
        $lastName = $input_l_name;
    }

    // Validate salary
    $input_wage = trim($_POST["wage"]);
    if(empty($input_wage)){
        $wage_err = "Please enter the salary amount.";
    } elseif(!ctype_digit($input_wage)){
        $wage_err = "Please enter a positive integer value.";
    } else{
        $wage = $input_wage;
    }

    // Check input errors before inserting in database
    if(empty($first_name_err) && empty($last_name_err) && empty($wage_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);

            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add an Employee to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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
                            <label>Manager</label>
                            <input type="radio" name="managerStatus" value="1">
                            <label>Employee</label>
                            <input type="radio" name="managerStatus" value="0" checked>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="employeeList.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
