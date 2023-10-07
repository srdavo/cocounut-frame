<?php
require_once 'dbh.inc.php';
require_once 'functions.php';

if (isset($_COOKIE['uid'])) {
$name= $_COOKIE['uid'];
$pwd= $_COOKIE['pwd'];
openuser($conn, $name, $pwd);
header("location: ../home.php");
exit();
}

if (!isset($_POST["user"])) {
  echo "acces denied";
  exit();
}
$name = $_POST["user"];
$pwd = $_POST["pwd"];
openuser($conn, $name, $pwd);
exit();


?>