<?php

require_once "../includes/dbh.inc.php";
require "../header.php";

$resolved = "";

//Process form data when submitted
if(isset($_POST['rid']) && !empty($_POST['rid'])){
  //get form data
  $resolved = $_POST['resolved'];
  $rid = $_POST['rid'];

  $sql = "UPDATE request SET resolved = ? WHERE rid = ?";

  if($stmt = mysqli_prepare($conn,$sql)){

    mysqli_stmt_bind_param($stmt, "ii", $param_resolved, $param_rid);

    $param_resolved = $resolved;
    $param_rid = $rid;

    if(mysqli_stmt_execute($stmt)){
      header("location: requests.php");
      exit();
    }else{
      echo "Oops! Something went wrong. Please try again later.";
    }
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}else{
  //check existence of rid parameter before procesing further
  if(isset($_GET['rid']) && !empty(trim($_GET['rid']))){
    //get rid from url
    $rid = trim($_GET['rid']);

    //Prepare a statement
    $sql = "SELECT * FROM request, employee, users WHERE rid = ? AND request.empID=employee.empID AND employee.uid=users.uid";
    if($stmt = mysqli_prepare($conn,$sql)){
      //Bind variable to the prepared statement as parameter
      mysqli_stmt_bind_param($stmt, "i", $param_rid);

      //Set parameter
      $param_rid = $rid;

      if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result)==1){
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

          $firstName = $row['firstName'];
          $lastName = $row['lastName'];
          $reqType = $row['reqType'];
          $start_req = $row['start_req'];
          $timeOffID = $row['timeOffID'];
          $ssID = $row['shiftSwapID'];


          if($timeOffID != NULL){
            //if the request was for time off, grab data from that table
            $sql2 = "SELECT startTime, endTime FROM timeoffrequests WHERE timeOffID = ?";
            if($stmt2 = mysqli_prepare($conn,$sql2)){
                mysqli_stmt_bind_param($stmt2, "i", $param_timeOffID);

                //Set parameter
                $param_timeOffID = $timeOffID;

                if(mysqli_stmt_execute($stmt2)){
                  $result2 = mysqli_stmt_get_result($stmt2);

                  if(mysqli_num_rows($result2)==1){
                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                    $startTime = $row2['startTime'];
                    $endTime = $row2['endTime'];
                  }
                }
              }

          }else {
            //the data was from Shift swap, so grab that data
            //if the request was for time off, grab data from that table
            $sql2 = "SELECT * FROM shiftswaprequests, employee, users WHERE id = ? AND shiftswaprequests.empID2=employee.empID AND employee.uid = users.uid";
            if($stmt2 = mysqli_prepare($conn,$sql2)){
                mysqli_stmt_bind_param($stmt2, "i", $param_id);

                //Set parameter
                $param_id = $ssID;

                if(mysqli_stmt_execute($stmt2)){
                  $result2 = mysqli_stmt_get_result($stmt2);

                  if(mysqli_num_rows($result2)==1){
                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

                    $shiftDate = $row2['shiftDate'];
                    $empID2 = $row2['empID2'];
                  }
                }
              }
          }
          mysqli_stmt_close($stmt);
          mysqli_stmt_close($stmt2);
        }else {
          header("location: error.php");
          exit();
        }
      }else{
        echo "Oops! Something went wrong. Please try again later.";
      }
    }
    mysqli_close($conn);
  }else{
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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
                     <h2 class="mt-5 mb-4">View Request</h2>
                     <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                       <div class="form-group">
                           <label>Name</label>
                           <p><b><?php echo $row["firstName"]." ".$row['lastName']; ?></b></p>
                       </div>

                       <div class="form-group">
                           <label>Date Requested</label>
                           <p><b><?php echo $row["start_req"]?></b></p>
                       </div>

                       <div class="form-group">
                           <label>Request Type</label>
                           <p><b><?php if($row["reqType"]==0){
                             echo "Shift Swap";
                           }else{
                             echo "Time Off";
                           }?></b></p>
                       </div>

                       <div class="form-group">
                           <label>Request ID</label>
                           <p><b><?php if($timeOffID==NULL){
                             echo $ssID;
                           }else{
                             echo $timeOffID;
                           }?></b></p>
                       </div>

                       <div class="form-group">
                             <?php
                             if($timeOffID != NULL){
                               echo '<label>Requested Days Off</label><p><b>';
                               echo $row2['startTime'];
                               echo ' - ';
                               echo $row2['endTime'];
                               echo '</b></p>';
                           }else{
                             echo '<label>Requested Shift to be Swapped With: <b>'.$row2['firstName']." ".$row['lastName'].'</b></label><p><b>';
                            echo $row2['shiftDate'];
                            echo '</b></p>';
                           }?>
                       </div>

                       <div class="form-group">
                         <input type="radio" name="resolved" value="1">Approve</input>
                         <input type="radio" name="resolved" value="2">Reject</input>
                       </div>
                       <br>








                         <input type="hidden" name="rid" value="<?=$rid?>">
                         <input type="submit" class="btn btn-primary" value="Submit">
                         <a href="requests.php" class="btn btn-secondary ml-2">Cancel</a>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </body>
 </html>
