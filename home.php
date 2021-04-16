
<?php
require 'header.php';
?>
    <br><br><br>

    <div class="container">

      <div class="row">
        <div class="col-9 mb-3">
          <button type="button" class="btn btn-secondary" onclick="location.href = 'requests/shiftSwap.php';" data-bs-toggle="button" autocomplete="off">Request Shift Swap</button>
          <button type="button" class="btn btn-secondary ms-2" onclick="location.href = 'requests/timeOff.php';" data-bs-toggle="button" autocomplete="off">Ask For Time Off</button>
        </div>
        <div class="col-9 mb-3">
          <?php if ($_SESSION["isAdmin"]==1) {?>
            <a href="https://calendar.google.com/calendar/u/0/r?cid=bewaproject@gmail.com" target="_blank" class="btn btn-secondary">Manage Shifts</a>
          <?php } ?>
        </div>
      </div>
<!--
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
-->

      <div class="row">
        <div class="col-9">
          <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=1&amp;bgcolor=%23ffffff&amp;ctz=America%2FChicago&amp;src=YmV3YXByb2plY3RAZ21haWwuY29t&amp;color=%23039BE5" style="border:solid 1px #777" width="978" height="600" frameborder="0" scrolling="no"></iframe>
        </div>
        <div class="col border border-primary">
          <div class="row ml-3 h5 ms-5 mt-2">
            Announcement Feed
          </div><br>
            <?php $sql = "SELECT id, subject, title, text FROM announcement";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo "<div class='row border-top border-2 border-dark'>";
                    echo "<div class='fs-5 fw-bold'>".$row["subject"]."</div><br>";
                    echo "<div class='fs-5'>".$row["title"]."</div><br>"."<div class='fw-light'>".$row["text"]."</div><br>";
                    if($_SESSION['isAdmin']){
                      echo '<a href="deleteAnnouncement.php?id='. $row['id'] .'" title="Delete Record">Delete</a>';
                    }
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


<?php require 'footer.php' ?>
