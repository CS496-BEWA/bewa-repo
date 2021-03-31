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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEWA - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php">BEWA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link" href="PHPTesting/testing4/testing5/index.php">Calendar</a>
            <a class="nav-link" href="announcement.php">Add Announcement</a>
          </div>
        </div>
        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">



          <div class="navbar-nav">
            <?php echo "<p class=\"nav-link\">Hello ".htmlspecialchars($_SESSION["firstName"])."</p>"    ; ?>
            <a class="nav-link" href="requests.php">Requests</a>
            <a class="nav-link" href="logout2.php">Log Out</a>
            <a class="nav-link" href="reset-password2.php">Change Password</a>
          </div>




        </div>
    </nav>

    <br><br><br>

    <div class="container">
      <div class="row">
        <div class="col-9 mb-3">
          <button type="button" class="btn btn-secondary" data-bs-toggle="button" autocomplete="off">Request Shift Swap</button>
          <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="button" autocomplete="off">Ask For Time Off</button>
        </div>
      </div>
      <div class="row">
        <div class="col-9 mb-3">
          <div class="row">
            <div class="col-4">
              <input type="text" class="form-control" style="width:200px" id="startDateInput">
            </div>
            <div class="col-3">
              <input type="text" class="form-control" style="width:200px" id="endDateInput">
            </div>
            <div class="col">
              <button type="button" class="btn btn-success">Submit Request</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-9">
          <a href="https://calendar.google.com/calendar/u/0/r?cid=bewaproject@gmail.com" target="_blank">Manage Shifts</a>
          <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=America%2FChicago&amp;src=YmV3YXByb2plY3RAZ21haWwuY29t&amp;color=%23039BE5" style="border:solid 1px #777" width="980" height="600" frameborder="0" scrolling="no"></iframe>
        </div>
        <div class="col border border-primary">
          <div class="row ml-3 h5 ms-5 mt-2">
            Announcement Feed
          </div><br>
            <?php $sql = "SELECT subject, title, text FROM announcement";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo "<div class='row'>";
                  /*echo "<div class='fs-5 fw-bold'>".$row["subject"]."</div><br>".-*/
                  echo "<div class='fs-5'>".$row["title"]."</div><br>"."<div class='fw-light'>".$row["text"]."</div><br><br>";
                  echo "</div>";
                }
              } else {
                echo "0 results";
              }
              $conn->close();
            ?>
        </div>
      </div>
    </div>

    <footer class="footer mt-5 py-3 bg-secondary">
      <div class="container">
        <span>Developed in 2021 by the BEWA Team.</span>
        <span class="float-end">Contact us at bewaproject@gmail.com</span>
      </div>
    </footer>

</body>
</html>
