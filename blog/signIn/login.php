<?php
session_start();

include "../global/db.php";

$userMail = $_POST['u_mail'];
$userPass = $_POST['u_pass'];

if(strlen($userMail)<=0 || strlen($userPass) <=0 ){
    $_SESSION["log_err"] = "Chyba";
    header("Location: ./signIn.php");
    die;
}

$stmt = $db->prepare("SELECT id, name, password FROM users WHERE mail = ?");
$stmt->bind_param("s", $userMail);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0 ){
    $row = $result->fetch_assoc();
    $password = $row['password'];
    if($userPass === $password){
        $_SESSION['u_mail'] = $userMail;
        $_SESSION['u_pass'] = $userPass;
        $_SESSION['u_pi'] = '../global/u_icons/ui_1.png';
        $_SESSION['u_name'] = $row['name']; 
        $_SESSION['u_id'] = $row['id'];
        header("Location: ../userPage/index.php");
    }else{
        $_SESSION["log_err"] = "Chyba loginu";
        $_SESSION['cmaex'] = "Špatný login nebo heslo"; 
        header("Location: ./signIn.php");
    }
}else{
    $_SESSION["log_err"] = "Chyba loginu";
    $_SESSION['cmaex'] = "E-mail neexistuje";
    header("Location: ./signIn.php");
    die;
}

$stmt->close();
$db->close();
?>
