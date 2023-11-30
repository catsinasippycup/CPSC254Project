<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "notedb";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName); // Connection string

if (!$conn) { // If failed, kill the connection
    die("Connection Failed: ".mysqli_connect_error());
}
?>