<?php
require_once 'dbh.inc.php';
require_once 'functions.php';

// if (isset($_COOKIE['uid'])) {
// $name= $_COOKIE['uid'];
// $pwd= $_COOKIE['pwd'];
// openuser($conn, $name, $pwd);
// }

if (!isset($_POST["email"])) {
  header("location: ../");
  exit();
}

$email = htmlspecialchars($_POST["email"]);
$pwd = $_POST["pwd"];
$user = null;
$permissions = 1; 
if (userexists($conn, $user, $email) !== false) {
  echo "user_already_exists";
  exit();
}




signup($conn, $email, $pwd);
openuser($conn, $email, $pwd);

$userid = $_SESSION["id"];
$sql = "INSERT INTO users_data (user_id, permissions) VALUES (?, ?);";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) { echo "error"; exit();}
mysqli_stmt_bind_param($stmt, "ii", $userid, $permissions);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);


?>