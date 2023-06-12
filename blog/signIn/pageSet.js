var msrt_click = false;
$('.msrs_span').click((e) => { 

    if(!msrt_click){
        $('.si_tit').text("Login")
        $('.si_li_tl').css({
            transform:"scale(1%)"
        })
        msrt_click = !msrt_click
        setTimeout(() => {
            $('.si_li_tl').fadeOut();
        }, 100);
    $('.si_form').attr("action", "login.php")
    $('.r').text("Přihlásit se")
        $('.msrs_span').text(" Zde ho regestrujte")
    }else{

        $('.si_li_tl').css({
            transform:"scale(100%)"
        })
        msrt_click = !msrt_click
        $('.si_form').attr("action", "register.php")

    $('.r').text("Registrovat")
    $('.si_tit').text("Registrace")
        setTimeout(() => {
            $('.si_li_tl').fadeIn();
        }, 100);
        
        $('.msrs_span').text("Přihlaste se zde")

    }

    
});

if($('.le_phh').text() === "Chyba loginu" ){
    $('.msrs_span').click()
}