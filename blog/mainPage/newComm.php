<?php 

    include "../global/gUserInfo.php";
    $usi = $_SESSION['u_id_r'];

    $stmt = $db->prepare("INSERT INTO `comments`(`id`, `userId`, `commId`, `value`) VALUES (NULL, ?, ?, ?)");
    $stmt->bind_param("iss",$usi, $_POST['param1'], $_POST['param2'] );

    if ($stmt->execute()) {
    } else {
        die("<b>Error:</b> Problem on Image Insert<br/>" . $db->error);
    }
    echo ("true");

echo ($_POST['param1']);
echo ($_POST['param2']);

?>