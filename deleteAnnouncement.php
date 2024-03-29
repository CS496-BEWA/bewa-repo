<?php

require 'header.php';

if(isset($_POST['id']) && !empty($_POST['id'])){
  require_once 'includes/dbh.inc.php';

  $sql = 'DELETE FROM announcement WHERE id = ?';

  if($stmt = mysqli_prepare($conn,$sql)){
    //Bind variables to the prepared statement
    mysqli_stmt_bind_param($stmt, "i", $param_id);
      $param_id = trim($_POST['id']);

      if(mysqli_stmt_execute($stmt)){

        header("location: home.php");
        exit();

      } else{
        echo "Oops! something went wrong. Please try again later.";
      }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
  if(empty(trim($_GET['id']))){
    header('location: error.php');
    exit();
  }
}


 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <title>Delete Record</title>
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
                     <h2 class="mt-5 mb-3">Delete Announcement</h2>
                     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                         <div class="alert alert-danger">
                             <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                             <p>Are you sure you want to delete this announcement?</p>
                             <p>
                                 <input type="submit" value="Yes" class="btn btn-danger">
                                 <a href="home.php" class="btn btn-secondary">No</a>
                             </p>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </body>
 </html>
