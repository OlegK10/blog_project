<?php
session_start();
include '../global/db.php';
$userName = $_POST['u_name'];
$userMail = $_POST['u_mail'];
$userPass = $_POST['u_pass'];
$userConpass = $_POST['u_conpass'];

if(strlen($userName) <= 0 || strlen($userMail) <= 0 || strlen($userPass) <= 0 || strlen($userConpass) <= 0){
  header("Location: ./signIn.php");
  $_SESSION["warMess_leng_reg"] = "Zapomněl jsi na něco !!!";
  die;
}else{
  $stmt = $db->prepare("SELECT id, name, password FROM users WHERE mail = ?");
  $stmt->bind_param("s", $userMail);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result ->num_rows > 0){
    $_SESSION["warMess_ex_mail"] = "Mail už existuje";
    header("Location: ./signIn.php");
    die;
  }else{}
  if($userPass !== $userConpass){
    header("Location: ./signIn.php");
    $_SESSION["passNpass"] = "Hesla nejsou stejná !!!";
    die;
  }else{
  }
}

if(
  $db->query("INSERT INTO `users`(`id`, `name`, `date`, `password`, `mail`,`profile_image` ) VALUES (NULL,'$userName',CURDATE(),'$userPass','$userMail', '../global/u_icons/ui_1.png')") === TRUE
){
        $_SESSION["log_err"] = "Chyba loginu";
        header("Location: ./signIn.php");
}else{
  die;
}



?>