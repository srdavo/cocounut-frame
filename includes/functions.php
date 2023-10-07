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
    }
    else {
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
         } // Activando estas lineas tendremos inicio de sesion automatico con cookies (peligroso en seguridad)
  
    if ($uidExist === false) {echo "user_doesnt_exist";exit();}
  
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
        echo "access_accepted";
    }
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

// function pageSeparator($conn, $limit, $offset, $page, $table_name, $userid, $function_name){
//   //Obtener numero de registros
//   $sql = "SELECT COUNT(*) FROM $table_name WHERE user_id = '$userid';";
//   $result = mysqli_query($conn, $sql);
//   if (mysqli_num_rows($result) > 0) {
//     while ($row = mysqli_fetch_assoc($result)){
//       $count = $row["COUNT(*)"];
//     }
//   }

//   $page_limit = ceil($count / $limit);
//   echo "<psholder>";
//   for ($i=0; $i < $page_limit; $i++) { 
//       if ($page_limit != 1) {
//         if ($page == $i) {echo "<ps onclick='{$function_name}(".$i."); window.scrollTo(0, 0);' class='selected'>".($i+1)."</ps>";}
//         else{echo "<ps onclick='{$function_name}(".$i."); window.scrollTo(0, 0);'>".($i+1)."</ps>";}        
//       }
//   }
//   echo "</psholder>";
// }

// function getProfileInformation($conn, $userid){
//   $stmt = $conn->prepare("
//     SELECT u.name, u.email, ud.*
//     FROM users u
//     LEFT JOIN users_data ud ON u.id = ud.user_id
//     WHERE u.id = ?"
//   );
//   $stmt->bind_param("i", $userid);
//   $stmt->execute();
//   $result = $stmt->get_result();

//   $profileInfo = [];

//   if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//       $profileInfo['user_name'] = $row["name"];
//       $profileInfo['user_email'] = $row["email"];
//       $profileInfo["store_name"] = $row["store_name"];
//     }
//   }

//   return $profileInfo;
// }
?>