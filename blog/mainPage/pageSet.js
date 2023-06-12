$('.mc_li_img_like_cont').click(function() {
    var child = $(this).children(".like_count");
        var lco = parseInt(child.text());
    var isLiked = $(this).data('is-liked');
    var post_id = $(this).attr("post-id");
    var imgl = $(this).children('.mc_li_img_like');


    if(!isLiked){
        lco += 1;
        child.text(lco);
        imgl.attr('src', './images/i_like_f.png')

        imgl.css({
            transform:"scale(70%)"
        }); setTimeout(() => {
            imgl.css({
                transform:"scale(100%)"
            });
        }, 120);

        $.ajax({
            url: './likeMan.php',
            method: 'POST',
            data: {like: null, param2 : lco, param3 : post_id},
            success: function(response) {
            console.log(response)
            }
        });
        $(this).data('is-liked', true);

    }else{
        lco -= 1;
        child.text(lco);
        imgl.attr('src', './images/i_like_nf.png')
        
        imgl.css({
            transform:"scale(70%)"
        }); setTimeout(() => {
            imgl.css({
                transform:"scale(100%)"
            });
        }, 120);

        $.ajax({
            url: './likeMan.php',
            method: 'POST',
            data: {like: null, param2 : lco, param3 : post_id},
            success: function(response) {
            console.log(response)
            }
        });
        $(this).data('is-liked', false);

    }
});





$('.cd_close').click(function(){
    $('.cd_cont').css({display:"none" })
})
                                            
if( parseInt($('.stp_des_p_cont').css("height")) >= 49) {
    $('.stp_des_p_btn').css({display:"flex"})
}

$('.stp_des_p_btn').click(function() {
    $('.cd_cont').css({display:"flex" })
    $('.cd_content').text($(this).siblings(".stp_des_p_cont").text())
})

$('.mleu_name').text($('.mleu_name').text().slice(0,15))

if($('.mleu_name').text().length = 15){
$('.mleu_name').text($('.mleu_name').text().slice(0,14)+ "...")
}



$('.fr_close').click(function () {
    $('.fr').hide()
})

$('.mleu_frd').click(function () {
    $('.fr').css({display:"flex"})
})

var copmc = false;
$('.stp_com_p_btn').click(function (e) { 
        e.preventDefault();
        if(!copmc){

        copmc = !copmc
        $('.cfc_ta').show();
        $('.stp_com_p_btn').text('Přidat');

    }else{
        copmc = !copmc  
        $('.cfc_ta').hide();
        $('.stp_com_p_btn').text('Okomentovat');

        $.ajax({
            url: './newComm.php',
            method: 'POST',
            data: {param1: $(this).val() , param2: $(this).siblings(".cfc").children(".cfc_ta").val()},
            success: function(response) {
              console.log(response)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error: " + textStatus + " - " + errorThrown);
            }
          });

          location.reload();
    }

    
});