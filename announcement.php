<?php
require 'header.php';
require_once 'includes/dbh.inc.php';

$title = $subject = $text = "";
$title_err = $subject_err = $text_err = "";

if($_SERVER['REQUEST_METHOD']=="POST"){

  //Validate Title
  $input_title = trim($_POST['title']);
  if(empty($input_title)){
    $title_err = "Please enter a Title";
  }elseif(!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z \d]+$/")))){
    $title_err = "Please enter a valid Title ";
  }else {
    $title = $input_title;
  }

  //Validate Subject
  $input_subject = trim($_POST['subject']);
  if(empty($input_subject)){
    $subject_err = "Please enter a Subject";
  }elseif(!filter_var($input_subject, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z \d]+$/")))){
    $subject_err = "Please enter a valid Subject";
  }else {
    $subject = $input_subject;
  }

  //Validate text
  $input_text = trim($_POST['text']);
  if(empty($input_text)){
    $text_err = "Please enter some text";
  }elseif(!filter_var($input_text, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z \d]+$/")))){
    $text_err = "Please enter a valid Title";
  }else {
    $text = $input_text;
  }

  //get the empID of the current logged-in user
  $empID = $_SESSION['empID'];

  if(empty($title_err) && empty($subject_err) && empty($text_err)){

    //Prepare an insert statement
    $sql = "INSERT INTO announcement (title, subject, text, empID) VALUES (?,?,?,?)";

    if($stmt=mysqli_prepare($conn,$sql)){
      //Bind variables to the prepared statemrnt as parameters
      mysqli_stmt_bind_param($stmt, "sssi", $param_title, $param_subject, $param_text, $param_empID);

      //Set parameters
      $param_title = $title;
      $param_subject = $subject;
      $param_text = $text;
      $param_empID = $empID;

      if(mysqli_stmt_execute($stmt)){
        header("location: home.php");
        exit();
      }else {
          echo "Oops! Something went wrong. Please try again later.";
      }
      mysqli_stmt_close($stmt);
    }

  }


  mysqli_close($conn);
}






?>

<br><br><br>

<div class="fs-3 mb-5 text-center">
Post New Announcement
</div>

  <form action="announcement.php" method="post" class="mx-auto" style="width: 400px;">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                <span class="invalid-feedback"><?php echo $title_err;?></span>
            </div><br>

            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control <?php echo (!empty($subject_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $subject; ?>">
                <span class="invalid-feedback"><?php echo $subject_err;?></span>
            </div><br>

            <div class="form-group">
                <label>Text</label>
                <input type="text" name="text" class="form-control <?php echo (!empty($text_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $text; ?>">
                <span class="invalid-feedback"><?php echo $text_err;?></span>
            </div><br>

            <div class="form-group">
                <input type="hidden" name="empID" value="<?=$empID?>">
                <input type="submit" class="btn btn-primary" value="Post Announcement">
            </div>
  </form>
