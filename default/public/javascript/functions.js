function clearInputs () 
{  
    $('input[type=text]').each( (i,input) => $(input).val(null) );
    $('input[type=number]').each( (i,input) => $(input).val(null) );
}



function checkFormIsValid() {

 checkInvalidInputs();
 checkValidForm();

}


function checkInvalidInputs() {
  $('input[required]')
  .each( 
    (i,input) => {
      if(input.value <= 0 ){
        swal
          .fire(
            {
              title: '<strong>Error</strong>',
              icon: 'error',
              html:
                'El campo <b> <u>'+input.name+'</u></b> es obligatorio ' ,
              showCloseButton: false,
            }
          );
          return 0;
        }
        return 1;
      }
    );
}

function checkValidForm( isUnRequiredField ) {
  var valid = true;
  $('input[required]')
  .each( 
    (i,input) => {
      if(input.value <= 0 ){
        valid = false
      }
    }
  );
  
  if (valid) {
    swal
    .fire(
      {
        title: '<strong>Correcto</strong>',
        icon: 'success',
        html:
          'Generando documento por favor espere' ,
        showCloseButton: false,
      }
    );
  }
  
}

if(window.location.href.includes('localhost')){
    $(document).ready(function() {
        $('li.active').removeClass('active').removeAttr('aria-current');
        $('a[href="' + location.pathname + '"]').closest('li').addClass('active').attr('aria-current', 'page'); 
      });
}
else{
    $(document).ready(function() {
        $('li.active').removeClass('active').removeAttr('aria-current');
        $('a[href="' + window.location.href + '"]').closest('li').addClass('active').attr('aria-current', 'page'); 
      });
    }