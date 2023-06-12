<?php 
include "../global/gUserInfo.php";
$usi = $_SESSION['u_id_r'];
$nli =  $_POST['pf_i_btn'];
$stmt = $db->query("UPDATE `users` SET `profile_image` = '$nli' WHERE id = $usi ");


header("Location: ./index.php")
?>
