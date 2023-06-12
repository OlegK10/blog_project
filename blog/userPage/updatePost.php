<?php
include "../global/db.php";

if(isset($_POST['set_1'])){
    $oldImgData = $db->prepare("SELECT `image` FROM `posters` WHERE id = ?");
    $oldImgData->bind_param("i", $_POST['cp_ac']);
    $oldImgData->execute();
    $oldImgData->bind_result($oldImageData);
    $oldImgData->fetch();
    $oldImgData->close();
    
    if(isset($_FILES['cp_fl']) && is_uploaded_file($_FILES['cp_fl']['tmp_name'])) {
        $imgData = file_get_contents($_FILES['cp_fl']['tmp_name']);
    } else {
        $imgData = $oldImageData;
    }

    $stmt = $db->prepare("UPDATE `posters` SET `title` = ?, `des` = ?, `image` = ? WHERE id = ?");
    $stmt->bind_param("sssi", $_POST['cp_tit_in'], $_POST['cp_des_in'], $imgData, $_POST['cp_ac']);
    
    $stmt->execute();
    $stmt->close();
    header("Location: ./index.php");
}


if(isset($_POST['set_2'])){
    $stmd = $db->prepare("DELETE FROM `posters` WHERE id = ?");  
    $stmd->bind_param("i", $_POST['cp_ac']);
    
    if($stmd->execute()){
        header("Location: ./index.php");
    } else {
        echo "ERROR" ;
    }
    $stmd->close();
}

$db->close();
?>
