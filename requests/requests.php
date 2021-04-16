<?php
// Initialize the session
require '../header.php';

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login3.php");
    exit;
}

// Include config file
require_once "../includes/dbh.inc.php";


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>
</head>
<body>

<br><br><br>

<div class="container mx-5">
    <div class="row fs-3 border-bottom border-3 border-dark">
    Requests
    </div>
    <div class="row mb-2">
        <div class="col">
        Date Requested
        </div>
        <div class="col">
        Resolved
        </div>
        <div class="col">
        Employee
        </div>
        <div class="col">
        Request Type
        </div>
        <div class="col">
        Go To
        </div>
    </div>

    <?php $sql = "SELECT * FROM request, employee, users WHERE request.empID=employee.empID AND employee.uid=users.uid ORDER BY request.start_req";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                if ($row["resolved"] == 0) {
                  echo "<div class='row fw-bold mb-2'>";
                }
                elseif($row["resolved"] == 2) {
                  echo "<div class='row fst-italic mb-2'>";
                }else{
                  echo "<div class='row mb-2'>";
                }
                  echo "<div class='col fs-5'>";
                    echo $row["start_req"];
                  echo "</div>";


                  echo "<div class='col fs-5'>";
                    if ($row["resolved"] == 0) {
                        echo "No";
                    }
                    elseif($row["resolved"] == 2) {
                      echo "Rejected";
                    }else{
                      echo "Yes";
                    }
                  echo "</div>";

                  echo "<div class='col fs-5'>";
                    echo $row["firstName"]." ".$row['lastName'];
                  echo "</div>";

                  echo "<div class='col fs-5'>";
                      if($row["reqType"]==0){
                        echo "Shift Swap";
                      }else{
                        echo "Time Off";
                      }
                  echo "</div>";



                  echo "<div class='col fs-5'>";
                    echo '<a href="viewRequest.php?rid='. $row['rid'] .'" class="mr-3" title="View Record">View</a>';
                  echo "</div>";

                  echo "</div>";

            }
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>

  </div>

</body>
</html>
