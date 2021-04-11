<?php
    require "database.php";

    $json = array();
    $sqlQuery = "SELECT * FROM events ORDER BY id";

    $result = mysqli_query($conn, $sqlQuery);
    $alldata = array();
    while ($row = mysqli_fetch_assoc($result))
    {
        array_push($alldata, $row);
    }
    mysqli_free_result($result);

    mysqli_close($conn);
    echo json_encode($alldata);
?>
