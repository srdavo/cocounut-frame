<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "cocounutframe";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
if (!$conn) {die("connectino failed: ". mysqli_connect_error());}
?>