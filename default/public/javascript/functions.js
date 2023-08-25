function clearInputs () 
{  
    $('input[type=text]').each( (i,input) => $(input).val(null) );
    $('input[type=number]').each( (i,input) => $(input).val(null) );
}

$(document).ready(function() {
    $('li.active').removeClass('active').removeAttr('aria-current');
    $('a[href="' + location.pathname + '"]').closest('li').addClass('active').attr('aria-current', 'page'); 
  });