function clearInputs () 
{  
    $('input[type=text]').each( (i,input) => $(input).val(null) );
    $('input[type=number]').each( (i,input) => $(input).val(null) );
}

