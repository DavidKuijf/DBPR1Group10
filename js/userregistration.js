$(document).ready(function() 
{
    $('input[id=password]').keyup(function() 
    {
        // set password variable
        var password = $(this).val();

        //validate the length
        if (password.length < 8) 
        {
            $('#length').removeClass('valid').addClass('invalid');
        } 
        else 
        {
            $('#length').removeClass('invalid').addClass('valid');
        }

        //validate letter
        if (password.match(/[A-z]/)) {
            $('#letter').removeClass('invalid').addClass('valid');
        } 
        else 
        {
            $('#letter').removeClass('valid').addClass('invalid');
        }

        //validate capital letter
        if (password.match(/[A-Z]/)) {
            $('#capital').removeClass('invalid').addClass('valid');
        } 
        else 
        {
            $('#capital').removeClass('valid').addClass('invalid');
        }

        //validate number
        if (password.match(/\d/)) 
        {
            $('#number').removeClass('invalid').addClass('valid');
        } 
        else 
        {
            $('#number').removeClass('valid').addClass('invalid');
        }

        if (password == document.getElementById('confirm_password').value)
        {
            $('#confirm_password').removeClass('nomatch').addClass('match');
        }
        else
        {
            $('#confirm_password').removeClass('match').addClass('nomatch');
        }

    }).focus(function() 
    {
        $('#pswd_info').show();
    }).blur(function() 
    {
        $('#pswd_info').hide();
    });

    
    
});


$(document).ready(function() 
{
    $('input[id=confirm_password]').keyup(function() 
    {
        // set password variable
        var confirm = $(this).val();

        if (confirm == document.getElementById('password').value)
        {
            $('#confirm_password').removeClass('nomatch').addClass('match');
            document.getElementById('register').disabled = false;
        }
        else
        {
            $('#confirm_password').removeClass('match').addClass('nomatch');
            document.getElementById('register').disabled = true;
        }
    });
    
});
