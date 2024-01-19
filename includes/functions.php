<?php
function userexists($conn, $name, $email) {
  $sql = "SELECT  * FROM users WHERE name = ? OR email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $name, $email);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}

function openuser($conn, $name, $pwd) {
    $uidExist = userexists($conn, $name, $name);
    //  COOKIES...
      if (isset($_COOKIE['uid'])) {
        unset($_COOKIE['uid']);
        unset($_COOKIE['pwd']);
      } 
    //
    if($uidExist === false){echo "user_doesnt_exist";exit();}
  
    $pwdHashed = $uidExist["pwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {echo "wrong_password";exit();}
    else if ($checkPwd === true){
      session_start();
      // COOKIES:
        setcookie("uid", "$name",  time()+(10 * 365 * 24 * 60 * 60), "/");
        setcookie("pwd", "$pwd", time()+(10 * 365 * 24 * 60 * 60), "/");
      $_SESSION["id"] = $uidExist["id"];
      $_SESSION["user"] = $uidExist["name"];

      // Get Account data
      $userid = $_SESSION["id"];
      $sql = "SELECT u.id, u.name, u.email, d.user_token
              FROM users AS u JOIN users_data AS d ON u.id = d.user_id WHERE u.id='$userid';";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){
          $_SESSION["user_email"] = $row["email"];
          $_SESSION["user_token"] = $row["user_token"];
        }
      }
      //

      echo "access_accepted";
    }
}

function generateToken(){
  $length = 8; 
  $token = bin2hex(random_bytes($length / 2));
  return $token;
}
function signup($conn, $email, $pwd){
  $sql = "INSERT INTO users (email, pwd) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../signup.php?error=stmtfailed");
    exit();}
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

?>