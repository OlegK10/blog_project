<?php
include "../global/gUserInfo.php";


if(isset($_POST['like'])){
    $stmt = $db->prepare("UPDATE `posters` SET `likes`= ? WHERE id = ? ");
    $stmt->bind_param("ii", $_POST['param2'],  $_POST['param3']);
    $stmt->execute();
}




?>