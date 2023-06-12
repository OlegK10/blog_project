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
    <link rel="stylesheet" href="../global//global.css">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
    <div class="bg"><img  class="bg_img" src="./images//bg.png" alt=""></div>
    <header>
        <nav class="menu">
            <div class="menu_con">
                <div class="mri"> <a href="../mainPage/index.php" class="mri_li"> <h4 class="mri_l">Anipo</h4></a></div>
                <div class="mle">
                   <ul class="mle_list">

                        <li class="mle_i">
                            <img  class="mle_i_img mle_user_img noselect" src="<?= $_SESSION['u_pi_r'] ?>" alt="">
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

    <main class="up_mp">

    <section class="mp_cont">
        <div class="mp_tit">Moje příspěvky <button class="mp_plus">+</button></div>
        <div class="mpc_con">
            <?php 
            $stmp = $db->prepare("SELECT * FROM posters WHERE userId = ?");
            $stmp->bind_param('s', $_SESSION['u_id_r']);
            if($stmp->execute()) {
                $result = $stmp->get_result();
                while ($row = $result->fetch_assoc()) {
                $imageData = base64_encode($row['image']);
            ?>
            <div  class="mpc_i">
                <button value="<?= $row['id'] ?>" class="mpc_i_set">...</button>    
                <div class="mpc_img_cont">
                    <div class="mpc_likes">
                        <span class="mpcl_count"><?= $row['likes']?></span> 
                        <img src="./images/i_like_f.png"  class="mpc_likes_img" alt="">
                    </div>
                    <img src="data:image/jpeg;base64,<?= $imageData ?>" alt="" class="mpc_img">
                </div>
                <div class="mpc_tit"><?= $row['title'] ?></div>
                <div class="mpc_des">
                <?= $row['des'] ?>
                </div>
            </div>
            <?php
                }
            } 
            ?>
        </div> 
    </section>
        <section class="us_cont">
            <div class="us_tit">Nastavení účtu</div>
                <a href="../signIn/signIn.php" style="position:absolute;  right: 4px; color:var(--c-m-1); cursor:pointer;" class="odhlasit">Odhlásit</a>
             <div class="us_content">
                <div class=" us_i_usi">
                    <img src="<?= $_SESSION['u_pi_r'] ?>" class="us_img" style="border-radius:50px;" alt="">
                    <button class="us_img_btn">Změnit</button>
                </div>

                    <form action="./userSetting.php" method="GET">
                        <div class="us_i_usi ">
                            <input class="us_name" name="usName" value="<?=  $_SESSION['u_name_r']?>" >
                            <button  value="1" class="us_name_btn">Změnit</button>
                        </div>
                    </form>
             </div>
                <div class="usf_content">
                    <div class="usf_tit">Přátele
                        <button class="btff">Najít</button>
                    </div>
                    <div class="us_i">
                    <ul class="us_list">
<?php 
    $usi = $_SESSION['u_id_r'];
    $stmp = $db->query("SELECT name, profile_image
                        FROM users u
                        JOIN friendships f ON f.friend_id = u.id
                        WHERE f.user_id = $usi");
    while ($row = $stmp->fetch_assoc()) {
?>
    <li class="us_li">
        <div class="us_li_usi">
            <img src="<?php echo $row['profile_image']; ?>" class="usl_img" alt="">
            <div class="usl_n"><?php echo $row['name']; ?></div>
        </div>
        <button class="usf_uf">Odebrat</button>
    </li>
<?php
    }
?>
</ul>
                    </div>
                </div>
        </section>
    </main>



    <form action="./newPost.php" enctype="multipart/form-data"  method="POST">
        <div class="newp">
            <div class="newp_cont">
            <button type="button" class="newp_close">X</button>
            <div class="npib_cont">
                    <div class="npib_img_cont">
                        <img  src="./images/i_img.png" class="npib_img" alt=""> 
                         <input type="file" name="np_img" class="np_fl" accept="image/*"> 
                    </div>
                    <button type="button" class="npib_btn">Načíst obrázek</button>
                </div>

                <div class="np_tit_cont">
                    <div class="np_tit_t">Titulek</div>
                    <input type="text" class="np_tit_inp" name="np_tit" placeholder=". . .">
                </div>

                <div class="np_des_cont">
                    <div class="np_des_t">Popis</div>
                    <textarea class="np_des_ta" name="np_des" id="" ></textarea>
                </div>
                <div class="btn_save_cont">
                    <button class="btn_np_save">Vytvořit</button>
                </div>
            </div>
        </div>
    </form>


 <form method="POST" action="./updatePost.php" enctype="multipart/form-data">
    <div class="cp">
        <div  class="cp_cont">
            <button type="button" class="cp_close">X</button>
            <input value="" name="cp_ac" class="cp_cont" style="display:none">
            <div class="cp_img_cont"><img src="./images/test.jpg" alt="" class="cp_img">
                <input type="file" name="cp_fl" id="" class="cp_fl" accept="image/*">
                <button type="button" class="cp_img_btn">Změnit</button>
            </div>
            <div class="cp_tit"><input type="text" name="cp_tit_in" class="cp_tit_in"></div>    
            <div class="cp_des"><textarea type="text" name="cp_des_in" cols="30" rows="5\" class="cp_des_in"> </textarea></div>
            <button name="set_1" class="cp_save">Uložit</button>
            <button name="set_2" class="cp_del">Smazat příspěvek</button>
        </div>
    </div>
</form>

<form action="./chPpfoto.php" method="POST">
    <div class="pf">
        <div class="pf_cont">
            <button class="pf_close">Zavřit</button>
            <div class="pf_item">
                <button class="pf_i_btn" name="pf_i_btn" value="../global/u_icons/ui_1.png"> <img src="../global/u_icons/ui_1.png" alt="" class="pf_i"> </button>
                <button class="pf_i_btn" name="pf_i_btn" value="../global/u_icons/ui_2.png"> <img src="../global/u_icons/ui_2.png" alt="" class="pf_i"> </button>
                <button class="pf_i_btn" name="pf_i_btn" value="../global/u_icons/ui_3.jpg"> <img src="../global/u_icons/ui_3.jpg" alt="" class="pf_i"> </button>
                <button class="pf_i_btn" name="pf_i_btn" value="../global/u_icons/ui_4.png"> <img src="../global/u_icons/ui_4.png" alt="" class="pf_i"> </button>
                <button class="pf_i_btn" name="pf_i_btn" value="../global/u_icons/ui_5.jpg"> <img src="../global/u_icons/ui_5.jpg" alt="" class="pf_i"> </button>
                <button class="pf_i_btn" name="pf_i_btn" value="../global/u_icons/ui_6.jpg"> <img src="../global/u_icons/ui_6.jpg" alt="" class="pf_i"> </button>
                <button class="pf_i_btn" name="pf_i_btn" value="../global/u_icons/ui_7.jpg"> <img src="../global/u_icons/ui_7.jpg" alt="" class="pf_i"> </button>
            </div>
        </div>
    </div>
</form>

                <div class="ff">
                    <div class="ff_cont">
                        <button type="button" class="ff_close">X</button>
                            <div class="ff_in_t">Najít</div>
                        <div class="ff_in_cont">
                            <input type="text" value="" name="ff_in" class="ff_in">

                            <button name="btn_search" class="ff_inb">
                                <img src="./images/i_search.png" alt="" class="ff_in_i">
                            </button>
                        </div>

                        <ul class="ff_list">
                        </ul>

                    </div>
                </div>



<script src="../global/jquery.js"></script>
<script src="./setPage.js"></script>
</body>
</html>