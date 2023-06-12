<?php
include "db.php";
session_start();

$_SESSION['u_mail_r'] = $_SESSION['u_mail'];
$_SESSION['u_name_r'] = $_SESSION['u_name'];
$_SESSION['u_pi_r'] = $_SESSION['u_pi'];
$_SESSION['u_id_r'] = $_SESSION['u_id'];
$usi = $_SESSION['u_id_r'];

$stmt = $db->prepare("SELECT profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $usi);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$_SESSION['u_pi_r'] = $row['profile_image'];



?>