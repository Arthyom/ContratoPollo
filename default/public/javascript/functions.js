function clearInputs () 
{  
    $('input[type=text]').each( (i,input) => $(input).val(null) );
    $('input[type=number]').each( (i,input) => $(input).val(null) );
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