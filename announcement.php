<?php
require 'header.php';
?>

<br><br><br>

<div class="fs-3 mb-5 text-center">
Post New Announcement
</div>

  <form action="announcement.php" method="post" class="mx-auto" style="width: 400px;">
            <div class="form-group mb-4">
                <label class="form-label">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" value="">
                <span class="form-text"></span>
            </div>
            <div class="form-group mb-4">
                <label>Title</label>
                <input type="text" name="title" id="title" class="form-control" value="">
                <span class="help-block"></span>
            </div>
            <div class="form-group mb-4">
                <label>Text</label>
                <input type="text" name="text" id="text" class="form-control" value="">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Post Announcement">
            </div>
  </form>
