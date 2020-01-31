jQuery(function($) {
  $('#register').on('submit', function(event) {
    if ( validateForm() ) { // если есть ошибки возвращает true
      event.preventDefault();
    }
  });
  
  function validateForm() {
    $(".text-error").remove();
    
    // Проверка логина    
    var el_l    = $("#login");
    if ( el_l.val().length < 4 ) {
      var v_login = true;
      el_l.after('<span class="text-error for-login">Логин должен быть больше 3 символов</span>');
      $(".for-login").css({top: el_l.position().top + el_l.outerHeight() + 2});
    } 
    $("#login").toggleClass('error', v_login );
    
    // Проверка e-mail
    
    var reg     = /^\w+([\.-]?\w+)*@(((([a-z0-9]{2,})|([a-z0-9][-][a-z0-9]+))[\.][a-z0-9])|([a-z0-9]+[-]?))+[a-z0-9]+\.([a-z]{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/i;
    var el_e    = $("#email");
    var v_email = el_e.val()?false:true;
  
    if ( v_email ) {
      el_e.after('<span class="text-error for-email">Поле e-mail обязательно к заполнению</span>');
      $(".for-email").css({top: el_e.position().top + el_e.outerHeight() + 2});
    } else if ( !reg.test( el_e.val() ) ) {
      v_email = true;
      el_e.after('<span class="text-error for-email">Вы указали недопустимый e-mail</span>');
      $(".for-email").css({top: el_e.position().top + el_e.outerHeight() + 2});
    }
    $("#email").toggleClass('error', v_email );
    
    // Проверка паролей
    
    var el_p1    = $("#pass1");
    var el_p2    = $("#pass2");
    
    var v_pass1 = el_p1.val()?false:true;
    var v_pass2 = el_p1.val()?false:true;
    
    if ( el_p1.val() != el_p2.val() ) {
      var v_pass1 = true;
      var v_pass2 = true;
      el_p1.after('<span class="text-error for-pass1">Пароли не совпадают!</span>');
      $(".for-pass1").css({top: el_p1.position().top + el_p1.outerHeight() + 2});
    } else if ( el_p1.val().length < 6 ) {
      var v_pass1 = true;
      var v_pass2 = true;
      el_p1.after('<span class="text-error for-pass1">Пароль должен быть не менее 6 символов</span>');
      $(".for-pass1").css({top: el_p1.position().top + el_p1.outerHeight() + 2});
    } 
    
    $("#pass1").toggleClass('error', v_pass1 );
    $("#pass2").toggleClass('error', v_pass2 );
    
    return ( v_login || v_email || v_pass1 || v_pass2 );
  }
   
});