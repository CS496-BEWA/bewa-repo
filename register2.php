<?php
//Include the database config file
require_once "includes/dbh.inc.php";

//define variables and init them to empty
$username = $password = $confirm_password ="";
$firstName = $lastName = "";
$username_err = $password_err = $confirm_password_err = "";
$first_err = $last_err = "";

//Process form data when submitted
if($_SERVER["REQUEST_METHOD"]=="POST"){

  //validate username
  if(empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username";
  }else{
    //prepare a select statment
    $sql = "SELECT uid FROM users WHERE username = ?";

    if($stmt = mysqli_prepare($conn,$sql)) {
      //bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      //set parameters
      $param_username = trim($_POST["username"]);
      //attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)) {
        //store result
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt)==1){
          $username_err = "This Username is already taken, please try another";
        }else{
          $username = trim($_POST["username"]);
        }
      }else{
        echo "Something went wrong";
      }
    }
  }

  //validate first name
  if(empty(trim($_POST['firstName']))){
    $first_err = "Please enter a First Name";
  }else{
    $firstName = trim($_POST['firstName']);
  }

  if (empty(trim($_POST['lastName']))) {
    $last_err = "Please enter a Last Name";
  }else {
    $lastName = trim($_POST['lastName']);
  }



  //validate password
  if(empty(trim($_POST["password"]))){
    $password_err = "Please Enter a Password";
  }elseif(strlen(trim($_POST['password']))<6) {
    $password_err = "Password must have at least 6 characters";
  }else{
    $password = trim($_POST['password']);
  }

  //validate confirm password
  if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
  }

  //Check input errors before inserting anything into database
  if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
    //Prepare SQL statement to insert
    $sql = "INSERT INTO users (username,password,firstName,lastName) VALUES (?,?,?,?)";

    if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_first_name, $param_last_name);


            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_first_name = $firstName;
            $param_last_name = $lastName;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login3.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand">BEWA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <br><br><br><br>

    <div class="mx-auto fs-2 fw-bolder mb-4 " style="width: 400px;">
        Create An Account
    </div>

    <div class="mx-auto" style="width: 400px;">
        <p class="mx-auto fw-light text-muted mb-5" style="width: 400px;">Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group mb-4 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group mb-4 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group mb-4 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group mb-4 <?php echo (!empty($first_err)) ? 'has-error' : ''; ?>">
                <label>First Name</label>
                <input type="text" name="firstName" class="form-control" value="<?php echo $firstName; ?>">
                <span class="help-block"><?php echo $first_err; ?></span>
            </div>
            <div class="form-group mb-4 <?php echo (!empty($last_err)) ? 'has-error' : ''; ?>">
                <label>Last Name</label>
                <input type="text" name="lastName" class="form-control" value="<?php echo $lastName; ?>">
                <span class="help-block"><?php echo $last_err; ?></span>
            </div>
            <div class="form-group mb-4">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>

    <div class="mx-auto fw-light text-muted mb-5" style="width: 400px;">
      Already have an account? Log in <a href="login3.php">here.</a>
    </div>

</body>
</html>
