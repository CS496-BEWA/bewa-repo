<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login3.php");
    exit;
}

// Include config file
require_once "includes/dbh.inc.php";

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>
</head>
<body>
    
    <?php $sql = "SELECT start_req, end_req, resolved, empID FROM request";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div class='row'>";
                echo "<div class='col fs-5'>".$row["start_req"]."</div><br>"."<div class='col fw-light'>".$row["end_req"]."</div><br>"."<div class='col fs-5'>".$row["resolved"]."</div><br>"."<div class='col fs-5'>".$row["empID"]."</div><br><br>";
                echo "</div>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>

</body>
</html>