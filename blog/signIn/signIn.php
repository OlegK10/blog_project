<?php
include "../global/db.php";
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../global//global.css">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="bg"><img class="bg_i" src="images/bg_2.jpg" alt=""></div>
    <div class="si_cont">
        <form class="si_form" method="POST" action="register.php">

        <div class="si_tit">Registration</div>
        <ul>
            <li class="si_li">
                <div class="si_li_tit si_li_tl"> Username </div>
                <input type="text" class="si_li_i si_li_tl" name="u_name" placeholder="<?php echo $_SESSION["warMess_leng_reg"]; ?>
                " id="">
            </li>

            <li class="si_li ">    
            <div style="margin-top:4px; color:var(--c-m-1);" class="hns"><?php echo $_SESSION["warMess_ex_mail"]; ?></div>
                <div class="si_li_tit"> E-mail </div>
                <div class="mslphp"><?= $_SESSION['cmaex'];?></div>
                <input    class="si_li_i" name="u_mail" placeholder="<?php echo $_SESSION["warMess_leng_reg"];?>" id="">
            </li>

            <li class="si_li">
                <div class="si_li_tit">Heslo </div>
                <input  type="password"  class="si_li_i" name="u_pass" placeholder="<?php echo $_SESSION["warMess_leng_reg"];?>" id="">
            </li>

            <li class="si_li si_li_tl">
                <div class="si_li_tit">Podtvrdit heslo </div>
                <input type="password" class="si_li_i" name="u_conpass" placeholder="<?php echo $_SESSION["warMess_leng_reg"];?>" id="">
        <div style="margin-top:4px; color:var(--c-m-1);" class="hns"><?php echo $_SESSION["passNpass"]; ?></div>
        <div style="margin-top:4px; color:var(--c-m-1);" class="le_phh"><?php echo $_SESSION["log_err"]; ?></div>
            </li>
        </ul>
            <div class="ssop">Souhlasím s<span class="ssop_span"> podmínkami pro použití</span> 

             <input class="ssop_inp" type="checkbox" name="" id=""></div>

           <div class="r_cont">
            <button class="r">Registrovat</button>
           </div>  
        <div class="msrs noselect">Máte účet ?<span class="msrs_span"> Přihlaste se zde </span></div>
        </form>
    </div>

<script src="../global/jquery.js"></script>
<script src="./pageSet.js"> </script>
</body>
</html>