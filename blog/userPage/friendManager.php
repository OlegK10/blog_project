<?php
session_start();
include "../global/gUserInfo.php";
$usi = $_SESSION['u_id_r'];

if(isset($_POST['param1'])) {
  $par1 = $_POST['param1'];
  $sql = $db->query("SELECT id, name, profile_image FROM users WHERE id <> $usi  AND name LIKE '%$par1%' LIMIT 10");
}

  $result = $sql->fetch_all(MYSQLI_ASSOC);
  echo json_encode($result);



?>
