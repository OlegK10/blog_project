<?php 
session_start();
include "../global/gUserInfo.php";
$uname = $_GET['usName'];
$uid = $_SESSION['u_id_r'];
$_SESSION['u_name'] = $uname;

$stmt = $db->prepare("UPDATE users SET `name`='$uname' WHERE id = ?");
$stmt->bind_param("s", $uid);
$stmt->execute();
$result = $stmt->get_result();
header ("Location: ./index.php")

?>