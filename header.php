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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEWA - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/bewa-repo/home.php">BEWA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <!--<a class="nav-link" href="#">Workplace Policy</a>-->
            <!--<a class="nav-link" href="/bewa-repo/PHPTesting/testing4/Calendar/index.php">Calendar</a>-->
            <?php if ($_SESSION["isAdmin"]==1) {
              //if the logged-in user is a manager/admin, show certain links
              echo "<a class=\"nav-link\" href=\"/bewa-repo/announcement.php\">Make Announcement</a>";
              echo "<a class=\"nav-link\" href=\"/bewa-repo/requests/requests.php\">View Requests</a>";
              echo "<a class=\"nav-link\" href=\"/bewa-repo/employees/employeeList.php\">Employee Info</a>";
            }
            echo "<a class=\"nav-link\" href=\"/bewa-repo/requests/myRequests.php\">My Requests</a>";
            ?>
          </div>
        </div>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <?php echo "<p class=\"nav-link\">Hello ".htmlspecialchars($_SESSION["firstName"])."</p>";
                  echo '<a class=nav-link href=/bewa-repo/account.php?empID='. $_SESSION['empID'] .'">View Account</a>';?>

            <a class="nav-link" href="/bewa-repo/logout2.php">Log Out</a>
            <a class="nav-link" href="/bewa-repo/reset-password2.php">Change Password</a>
          </div>
        </div>
    </nav>
</body>
</html>
