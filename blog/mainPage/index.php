<?php 
session_start();
include "../global/gUserInfo.php";

if( empty($_SESSION['u_name_r'])){
    header("Location: ../error_file/index.php");
    die;
}else{

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global/global.css">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <div class="bg"><img  class="bg_img" src="./images/bg.png" alt=""></div>
    <header>
        <nav class="menu">
            <div class="menu_con">
                <div class="mri"> <a href="../mainPage/index.php" class="mri_li"> <h4 class="mri_l">Anipo</h4></a></div>
                <div class="mle">
                   <ul class="mle_list">

                        <li class="mle_i">
                           <a href="../userPage/index.php">
                             <img  class="mle_i_img mle_user_img noselect" src="<?= $_SESSION['u_pi_r'] ?>" alt="">
                           </a>
                        </li>

                        <li class="mle_i mle_i_img_bell"><img class="mle_i_img mle_not_img" src="./images//bell.png" alt="">
                            <div class="mlenoti">2</div>

                                <div class="not_con">
                                    <ul class="not_list">
                                        <li class="noli">
                                            <div class="noli_ui">
                                                <img src="./images//user_ico.png" alt="" class="noliimg">
                                                <div class="noliname">Mikasa Akerman</div>
                                            </div> 
                                            <div class="noli_info">Add new post !</div>
                                        </li>
                                    </ul>
                                </div>
                        </li>
                   </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="main_cont">
            <ul class="main_content">


<?php 
    $stmt = $db->query("
        SELECT p.*, u.name, u.profile_image 
        FROM posters p 
        JOIN users u ON p.userId = u.id
    ");

    while ($row = $stmt->fetch_assoc()) {
        $imageData = base64_encode($row['image']);
        ?>

        <li class="mc_li">
            <div class="mc_li_img_cont">
                <img class="mc_li_img" src="data:image/jpeg;base64,<?= $imageData ?>" alt="">
                <div post-id ="<?=  $row['id'] ?>" class="mc_li_img_like_cont">
                    <div  class="like_count"><?php echo $row['likes']; ?></div>
                    <img  class="mc_li_img_like" src="./images//i_like_nf.png" alt="">
                </div>
            </div>
            <div class="stp">
                <div class="stp_gexb">
                    <img src="./images/user_ico.png" alt="" class="stp_desc_img">
                    <h4 class="stp_desc_name"><?php echo $row['name']; ?></h4>
                </div>
                <h4 class="stp_tit"><?php echo $row['title']; ?></h4>
                <div class="stp_desc_cont">
                    <div class="stp_des_p">
                        <div class="stp_des_p_cont">
                            <?php echo $row['des'];  ?> 
                        </div>
                        <button class="stp_des_p_btn">Číst dále</button>
                    </div>
                </div>
                <div class="comts_cont">
                    <button value="<?= $row['commId'] ?>" class="stp_com_p_btn">Okomentovat</button>
                    <div class="cfc">
                        <textarea class="cfc_ta" style="resize:none" name="cfc_ta" id="" rows="3"></textarea>
                    </div>
                    <ul class="cos_list">
                        <?php 
                        $stmt2 = $db->query("
                            SELECT c.*, u.name, u.profile_image
                            FROM comments c
                            JOIN users u
                            WHERE c.commId = '{$row['commId']}' AND c.userId = u.id
                        ");

                        while ($row2 = $stmt2->fetch_assoc()) {
                            ?>
                            <li class="cos_li">
                                <div class="cos_li_us">
                                    <img src="<?php echo $row2['profile_image']; ?>" alt="" class="cosi_img">
                                    <div class="cos_li_us_name"><?php echo $row2['name']; ?></div>
                                </div>
                                <div class="cos_li_con">
                                    <?php echo $row2['value']; ?>
                                </div>
                            </li>
                            <?php
                        } 
                        ?>
                    </ul>
                </div>
            </div>
        </li>
        <?php
    } 
?>











            </ul>
        </div>

        <div class="cd_cont">
            <div class="cd_items">
                <button class="cd_close">X</button>
                <div class="cd_content">
                    Kono subaraší sekai ni šukufuku o!, zkráceně též KonoSuba, je japonská série light novel napsaná spisovatelem Nacumem Akacukim. Série sleduje příběh kluka, který je po své smrti poslán do fantastického světa, ve kterém je společně s bohyní... .
                </div>
            </div>
        </div>
    </main>
    

    <section class="fr">
        <div class="fr_cont">
            <button class="fr_close">X</button>
                <ul class="fr_list">
                    <li class="fr_li">
                        <div class="fr_li_imna">
                            <div class="fr_li_img"><img src="./images/user_ico.png" alt="" class="fr_img"></div>
                            <div class="fri_name">Mikasa Akerman</div>
                        </div>
                            
                        <div class="fri_btns">
                            <button class="fri_btn_f">Unfolow</button>
                        </div>
                    </li>
                    <li class="fr_li">
                        <div class="fr_li_imna">
                            <div class="fr_li_img"><img src="./images/user_ico.png" alt="" class="fr_img"></div>
                            <div class="fri_name">Mikasa Akerman</div>
                        </div>
                            
                        <div class="fri_btns">
                            <button class="fri_btn_f">Unfolow</button>
                        </div>
                    </li>
                </ul>
        </div>
    </section>

    

<script src="../global/jquery.js"></script>
<script src="./pageSet.js"> </script>
<script src="../global//global.js"></script>
</body>
</html>