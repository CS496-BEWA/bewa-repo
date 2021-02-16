<?php
//FILE: dbh.inc.php
//CS 496, WKU 2021

//this is a seperate connection to the database, this time specifying the database
//this file will be included in every file that requires a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "496";

$conn = mysqli_connect($servername, $username, $password, $dbName);


if (!$conn) {
  die("Connection Failed: ".mysqli_connect_error());
}
