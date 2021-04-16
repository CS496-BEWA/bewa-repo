<?php

require '../header.php';
require_once '../includes/dbh.inc.php';

$start_date = $end_date = "";
$start_err = $end_err = "";

if($_SERVER['REQUEST_METHOD']=="POST"){

  //validate start date
  $input_start = trim($_POST['startDate']);
  if(empty($input_start)){
    $start_err = "Please enter a start date";
  }else {
    $start_date = $input_start;
  }

  //validate end date
  $input_end = trim($_POST['endDate']);
  if(empty($input_end)){
    $end_err = "Please enter an end date";
  }else{
    $end_date = $input_end;
  }

  $empID = $_SESSION['empID'];

  if(empty($start_err) && empty($end_err)){

    //Prepare an insert statement
    $sql = "INSERT INTO timeoffrequests (startTime, endTime) VALUES (?, ?)";

    if($stmt = mysqli_prepare($conn,$sql)){
      //Bind variables to prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ss", $param_start, $param_end);

      $param_start = $start_date;
      $param_end = $end_date;

      //Attempt to execute prepared statement
      if(mysqli_stmt_execute($stmt)){

        //if the request is successfully inserted, add it to requests table
        $sql2 = "INSERT INTO request (empID, reqType, timeOffID, resolved) VALUES (?, ?, ?, ?)";

        if($stmt2 = mysqli_prepare($conn,$sql2)){
          mysqli_stmt_bind_param($stmt2, "iisi", $param_empID, $param_reqType, $param_toID, $param_resolved);

          $param_empID = $empID;
          $param_reqType = 1;
          $param_toID = mysqli_insert_id($conn);

          //$param_start_time = date("Y-m-d H:i:s");
          $param_resolved = 0;

          if(mysqli_stmt_execute($stmt2)){
            header("location: ../home.php");
            exit();
          }else{
            echo "Oops! Something went wrong.";
            echo "<br>".$param_empID."<br>";
            echo "<br>".$param_reqType."<br>";
            echo "<br>".$param_toID."<br>";
            //echo "<br>".$param_start_time."<br>";
            echo "<br>".$param_resolved."<br>";
          }

        }

      }else {
        echo "Oops! Something went wrong.";
      }
      mysqli_stmt_close($stmt);
    }

  }
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
                     <h2 class="mt-5">Time Off</h2>
                     <p>Please fill this form and submit to request time off.</p>
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                         <div class="form-group">
                             <label>Start Date</label>
                             <input type="date" name="startDate" class="form-control <?php echo (!empty($start_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $start_date; ?>">
                             <span class="invalid-feedback"><?php echo $start_err;?></span>
                         </div>

                         <div class="form-group">
                             <label>End Date</label>
                             <input type="date" name="endDate" class="form-control <?php echo (!empty($end_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $end_date; ?>">
                             <span class="invalid-feedback"><?php echo $end_err;?></span>
                         </div>

                         <input type="hidden" name="empID" value="<?=$empID?>">
                         <input type="submit" class="btn btn-primary" value="Submit">
                         <a href="employeeList.php" class="btn btn-secondary ml-2">Cancel</a>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </body>
 </html>
