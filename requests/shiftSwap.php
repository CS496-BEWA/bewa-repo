<?php
require '../header.php';
require_once '../includes/dbh.inc.php';

$shift_date = $shift_err = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
  $empID = $_SESSION['empID'];
  $empID2 = $_POST['empID2'];

  $input_shift = trim($_POST['shiftDate']);
  if(empty($input_shift)){
    $shift_err = "Please enter a start date";
  }else {
    $shift_date = $input_shift;
  }

if(empty($shift_err)){
  $sql = "INSERT INTO shiftswaprequests (empID1, empID2, shiftDate) VALUES (?,?,?)";

  if($stmt = mysqli_prepare($conn,$sql)){
    //Bind varaibles to prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "iis", $param_emp_1, $param_emp_2, $param_shift);

    $param_emp_1 = $empID;
    $param_emp_2 = $empID2;
    $param_shift = $input_shift;

    if(mysqli_stmt_execute($stmt)){

      $sql2 = "INSERT INTO request (empID, reqType, shiftSwapID, resolved) VALUES (?,?,?,?)";
      if($stmt2 = mysqli_prepare($conn,$sql2)){
        mysqli_stmt_bind_param($stmt2, "iisi", $param_empID, $param_reqType, $param_ssID, $param_resolved);

        $param_empID = $empID;
        $param_reqType = 0;
        $param_ssID = mysqli_insert_id($conn);
        $param_resolved = 0;

        if(mysqli_stmt_execute($stmt2)){
          header("location: ../home.php");
          exit();
        }else {
          echo "Oops! something went wrong.";
        }
      }
    }else {
      echo "Oops! something went wrong";
    }
    mysqli_stmt_close($stmt);
  }
}
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
                     <h2 class="mt-5">Shift Swap</h2>
                     <p>Please fill this form and submit to request a shift swap.</p>
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                         <div class="form-group">
                             <label>Shift Date</label>
                             <input type="date" name="shiftDate" class="form-control <?php echo (!empty($shift_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $shift_date; ?>">
                             <span class="invalid-feedback"><?php echo $shift_err;?></span>
                         </div>

                         <?php
                         $sql3 = "SELECT * FROM employee, users WHERE employee.uid=users.uid";
                         $result = mysqli_query($conn,$sql3);
                          ?>
                         <div class="form-group">
                             <label>Other Employee</label>
                             <?php
                             echo "<select name='empID2'>";
                             while ($row = mysqli_fetch_array($result)) {
                               //User can't request to swap shifts with themselves 
                                  if($row['empID'] != $_SESSION['empID']){
                                    echo "<option value='" . $row['empID']."'>" . $row['firstName'] ." ".$row['lastName']."</option>";
                                  }
                             }
                             echo "</select>";?>
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
