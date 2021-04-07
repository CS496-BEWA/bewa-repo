<?php require '../includes/dbh.inc.php';
require '../header.php';

//If a non-manager gets to this page, redirect them to the home page
if(!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== 1){
    header("location: ../home.php");
    exit;
}



//if they somehow got here without being logged in, redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login3.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employees</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Employee Details</h2>
                        <a href="addEmployee.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                    <?php

                    // Attempt select query execution
                    $sql = "SELECT * FROM employee, users WHERE employee.uid = users.uid GROUP BY users.uid";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Employee ID</th>";
                                        echo "<th>First Name</th>";
                                        echo "<th>Last Name</th>";
                                        echo "<th>Wage</th>";
                                        echo "<th>Total Hours</th>";
                                        echo "<th>Hours This Week</th>";
                                        echo "<th>Manager Status</th>";
                                        echo "<th>Actions</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['empID'] . "</td>";
                                        echo "<td>" . $row['firstName'] . "</td>";
                                        echo "<td>" . $row['lastName'] . "</td>";
                                        echo "<td>" . $row['wage'] . "</td>";
                                        echo "<td>" . $row['hoursWorked'] . "</td>";
                                        echo "<td>" . $row['hoursWorkedLastWeek'] . "</td>";
                                        echo "<td>";
                                        if($row['managerStatus']==1){
                                          echo "Manager";
                                        }else{
                                          echo "Employee";
                                        }
                                        echo "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['empID'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $row['empID'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $row['empID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
