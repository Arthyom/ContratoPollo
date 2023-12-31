function clearInputs () 
{  
    $('input[type=text]').each( (i,input) => $(input).val(null) );
    $('input[type=number]').each( (i,input) => $(input).val(null) );
}

function UpdateAutoRecipe() {
  //  var url = window.location.href+'recibos/'+arrendatarioId; 
  // $.ajax({
  //   url,
  //   success: function (data, status) {
  //     console.log(data, status);
  //   },
  //   error: function(data){
  //     console.log(data);
  //   }
  // }); 

  swal
  .fire(
    {
      title: '<strong>Correcto</strong>',
      icon: 'success',
      html:
        'Generando documento por favor espere' ,
      showCloseButton: false,
      didOpen: function (){
        setTimeout(() => {
          location.reload();
        }, 1600);
      }
    }
  );

}

function checkFormIsValid() {

 checkInvalidInputs();
 checkValidForm();

}

function enableCheck(itemChecked, itemForm, itemReplace) {
  var checked = $(itemChecked).prop('checked');
  var textBox = $(itemForm);


  if(checked){
    $(itemReplace).prop('disabled', false);
    textBox.prop('readonly', true);
  }
  else{
    $(itemReplace).prop('disabled', true);
    $(itemReplace).val('');

    textBox.prop('readonly', false);
    textBox.prop('value', '');
  }
}


function selectOption() {
  var checked = $('#reciboCheckId').prop('checked');
  var textBox = $('#recibo_ReceptorNombre');

  if(checked){
    $('#Nombre').prop('disabled', false);
    textBox.prop('readonly', true);
  }
  else{
    $('#Nombre').prop('disabled', true);
    textBox.prop('readonly', false);
    textBox.prop('value', '');
  }
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


$('#Nombre').change(
  function (item) {
    var textBox = $('#recibo_ReceptorNombre');
    var text = $('#Nombre option:selected').html();
    if('Seleccione un valor'!== text){
      textBox.prop('value',text);
    }
  }
);

$('#Direccion').change(
  function (item) {
    var fecha = new Date();
    var textBox = $('#recibo_Concepto');
    var textBox2 = $('#recibo_PrecioUnitario');

    var text = $('#Direccion option:selected').html();
    var precioIndex = $('#Direccion').val();
    var precio = $('#Precio').val(precioIndex);
    var valor = $('#Precio option:selected').html()


    
    if('Seleccione un valor'!== text){
      textBox.prop('value','Pago renta ' + fecha.toLocaleString('default', { month: 'long' }) +' - '+ fecha.getFullYear()+ ' - ' +text);
      textBox2.prop('value',valor);

    }
  }
);