var notCot = false
$('.mle_i_img_bell').click(function() {
    if(!notCot){
        $('.not_con').show()
        notCot =!notCot
    }else{
        notCot =!notCot
        $('.not_con').hide()
    }
})