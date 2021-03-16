<?php
//Include the database config file
require_once "/includes/dbh.inc.php";

//define variables and init them to empty
$username = $password = $confirm_password ="";
$username_err = $password_err = $confirm_password_err = "";

//Process form data when submitted
if($_SERVER["REQUEST_METHOD"]=="POST"){

  //validate username
  if(empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username"
  }else{
    //prepare a select statment
    $sql = "SELECT uid FROM users WHERE username = ?";

    if($stmt = mysqli_prepare($conn,$sql)) {
      //bind variables to the prepared statement as parameters
      mysqli_bind_param($stmt, "s", $param_username);
      //set parameters
      $param_username = trim($_POST["username"]);
      //attempt to execute the prepared statement
      if(mysqli_stmt_execute($stmt)) {
        //store result
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt)==1){
          $username_err = "This USername is already taken, please try another";
        }else{
          $username = trim($_PSOT["username"]);
        }
      }else{
        echo "Something went wrong";
      }
    }
  }

  //validate password
  if(empty(trim($_PSOT["password"]))){
    $password_err = "Please Enter a Password"
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
    //Prepare SQL statement
    $sql = "INSERT INTO users (username,password) VALUES (?,?)";

  }





}
 ?>
