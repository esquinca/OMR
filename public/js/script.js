$('#btnlogin').on('click', function(){
  var xa = validarEmail('email_addess');
  var xb = validarcheck('checkbox-signup');
  var xc= validarcaptcha('g-recaptcha-response');
  // $('#g-recaptcha-response').val();

  if (xa == false) {
     toast_error_email();
  }
  if (xb == false) {
     toast_error_check();
  }
  if (xc == false) {
    toast_error_checkcaptchap();
  }

  if ( xa == true &&  xb == true && xc == true ) {
    var objData = $("#loginform").find("select,textarea, input").serialize();
    $.ajax({
      url: "/submit_inputs",
      type: "POST",
      data: objData,
      success: function (data) {
        //console.log('success:', data);
        if (data === 'OK') {
          console.log('OK');
          $('#loginform').submit();
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
  }


});
function validarcaptcha(campo){
  var xca =$('#'+campo).val();
  if (xca != ''){
    return true;
  }
  else {
    return false;
  }
}

function validarcheck(campo) {
  if($('input[name='+campo+']').is(':checked')){
    return true;
  }
  else {
    return false;
  }
}
function validarEmail(campo) {
  var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  if (campo != '') {
    select=document.getElementById(campo).value;
    if( select == null || select == 0 ) {
      return false;
    }
    else {
       if (regex.test(select)) {
         return true;
       }
       else {
         return false;
       }
    }
  }
}

function toast_error_email() {
    $.toast({
          heading: 'Mensaje',
          text: 'Error email',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'error',
          hideAfter: 3500
    });
}
function toast_error_check() {
    $.toast({
          heading: 'Mensaje',
          text: 'Error check',
          position: 'top-right',
          loaderBg: '#ff6849',
          icon: 'error',
          hideAfter: 3500
    });
}

function toast_error_checkcaptchap() {
  $.toast({
        heading: 'Mensaje',
        text: 'Error captcha',
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'error',
        hideAfter: 3500
  });
}
