<?php 
include "../global/gUserInfo.php";
    if (is_uploaded_file($_FILES['np_img']['tmp_name'])) {
        
        function generateRandomString($length) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charLength - 1)];
                $characters = str_replace($randomString[$i], '', $characters);
                $charLength = strlen($characters);
            }
            return $randomString;
        }

        $randomString = generateRandomString(20);
        $result = $db->query("SELECT id FROM posters WHERE commId = '$randomString'");
        if ($result->num_rows > 0) {
            $randomString = generateRandomString(20);
        }

        $imgData = file_get_contents($_FILES['np_img']['tmp_name']);
        $sql = "INSERT INTO posters(id, userId, title, des, image, likes, commId)
                VALUES(NULL, ?, ?, ?, ?, 0, ?)";
        $statement = $db->prepare($sql);
        $statement->bind_param('issss', $_SESSION['u_id_r'], $_POST['np_tit'], $_POST['np_des'], $imgData, $randomString);
        header("Location: ./index.php");

        if ($statement->execute()) {
        } else {
            die("<b>Error:</b> Problem on Image Insert<br/>" . $db->error);
        }
    }
?>