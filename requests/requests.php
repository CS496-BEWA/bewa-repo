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
  <div class="col">
    <a href="addRequest.php" class="btn btn-secondary">Shift Swap</a>
  </div>
  <div class="col">
    <a href="addRequest.php" class="btn btn-secondary">Time Off</a>
  </div>

    <?php $sql = "SELECT * FROM request";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='row'>";

                  echo "<div class='col fs-5'>";
                    echo "Start Time: ".$row["start_req"];
                  echo "</div><br>";

                  echo "<div class='col fs-5'>";
                    echo "End Time: ".$row["end_req"];
                  echo "</div><br>";

                  echo "<div class='col fs-5'>";
                    echo "Is Resolved: ".$row["resolved"];
                  echo "</div><br>";

                  echo "<div class='col fs-5'>";
                    echo "Employee ID: ".$row["empID"];
                  echo "</div><br>";

                  echo "<div class='col fs-5'>";
                    echo "Request Type: ";
                      if($row["reqType"]==0){
                        echo "Shift Swap";
                      }else{
                        echo "Time Off";
                      }
                    ;
                  echo "</div><br><br>";

                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>

</body>
</html>
