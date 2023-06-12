$('.mp_plus').click(function() {
    $('.newp').css({display:"flex"})
})
$('.newp_close').click(function () {
    $('.newp').hide()

  })


$('.npib_btn').click(function() {
    $('.np_fl').click()
    const np_fi = $('.np_fl');
    np_fi.on('change', function() {
  
      if (np_fi[0].files && np_fi[0].files[0]) {
  
        const reader = new FileReader();
  
        reader.onload = function(e) {
          $('.npib_img').attr('src', e.target.result);
        };
  
        reader.readAsDataURL(np_fi[0].files[0]);
      }
  
    });
})

$('.cp_close').click(function() {
  $('.cp').hide()

})

$('.cp_img_btn').click(function (e) { 
    $('.cp_fl').click()
    
    const cp_fl = $('.cp_fl');
  cp_fl.on('change', function() {

  if (cp_fl[0].files && cp_fl[0].files[0]) {
    const cpreader = new FileReader();
    cpreader.onload = function(e) {
      $('.cp_img').attr('src', e.target.result);
    };
    cpreader.readAsDataURL(cp_fl[0].files[0]);
  }
});
  
});

$('.mpc_i_set').click(function() {
  $('.cp').css({display:"flex"})
  $('.cp_img').attr('src', $(this).siblings(".mpc_img_cont").children(".mpc_img").attr("src"))
  $('.cp_tit_in').val($(this).siblings(".mpc_tit").text())
  $('.cp_des_in').val($(this).siblings(".mpc_des").text().trim())
  $('.cp_cont').attr('value', $(this).val())
})

var nameIsChange = false
$('.us_name_btn').click(function (e) { 
  
  if(!nameIsChange){
    e.preventDefault();
    $('.us_name').css({background: "rgba(54,54,54)"})
    $(this).text("Uložit")
    $('.pf_close').css({
      height : " Calc(" + $('.pf_cont').css('height')  + " - 20px)"
    })
    nameIsChange = !nameIsChange
  }else{
    $(this).text("Změnit")
    $('.us_name').css({background: "none"})
    nameIsChange = !nameIsChange
  }
 
});

$('.pf_close').click(() => {
  $('.pf').hide()
})

$('.us_img_btn').click(function() {
  $('.pf').css({display:"flex"})
  $('.pf_close').css({
    height : " Calc(" + $('.pf_cont').css('height')  + " - 20px)"
  })
})


$('.ff_close').click(function() {
  $('.ff').hide();
})

$('.btff').click(function() {
  $('.ff').css({display:"flex"});
})

$('.ff_inb, .btff').click(function () {
  $.ajax({
    url: './friendManager.php',
    method: 'POST',
    data: {param1: $('.ff_in').val()},
    success: function(response) {
        var data = JSON.parse(response);
        if (data.length > 0) {  
            $('.ff_list').empty();
            data.forEach(function(row) {
                var html = '\
                  <li value="'+row.id+'" class="ff_li">\
                      <div class="ff_li_ui">\
                          <img src="'+row.profile_image+'" alt="" class="ff_i_img">\
                          <div class="ff_li_un">'+row.name+'</div>\
                      </div>\
                      <button name="btn_add" class="ff_adf">Přidat</button>\
                  </li>';
                $('.ff_list').append(html);
            });
        } else {
            console.log("No results found.");
            $('.ff_list').empty(); 
            $('.ff_list').append(' <li class="ff_li"> NO RESULT </li>');

        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error: " + textStatus + " - " + errorThrown);
    }
  });
});

$('.ff_list').on('click', '.ff_adf', function(e) {

  $.ajax({
    url: './friendship.php',
    method: 'POST',
    data: {param1: $(this).parent('.ff_li').val()},
    success: function(response) {
      console.log(response)
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error("AJAX Error: " + textStatus + " - " + errorThrown);
    }
  });

});

