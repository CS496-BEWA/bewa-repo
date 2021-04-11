<?php require 'header.php';
require 'includes/dbh.inc.php'; ?>

<?php

# here database details

$sql = "SELECT * FROM employee, users WHERE employee.uid=users.uid";
$result = mysqli_query($conn,$sql);

echo "<select name='employee'>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['empID']."'>" . $row['firstName'] ." ".$row['lastName']."</option>";
}
echo "</select>";

# here username is the column of my table(userregistration)
# it works perfectly
?>
