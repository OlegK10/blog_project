<?php
session_start();
include "../global/gUserInfo.php";
    $usi = $_SESSION['u_id_r'];


    $sql = $db->query("SELECT name, profile_image 
    FROM users u
    JOIN friendships f ON f.friend_id = u.id
    WHERE f.user_id = $usi");

    $result = $sql->fetch_all(MYSQLI_ASSOC);
    echo json_encode($result);
    



?>