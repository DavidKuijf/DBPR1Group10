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

        checkPassword();
    });

    $('input[id=password]').keyup(function() 
    {
        checkPassword();
        
    }).focus(function() 
    {
        $('#pswd_info').show();
    }).blur(function() 
    {
        $('#pswd_info').hide();
    });
});

function checkPassword()
{
    // set password variable
    var password = $('input[id=password]').val();

    //validate the length
    if (password.length < 8) 
    {
        $('#length').removeClass('valid').addClass('invalid');
        document.getElementById('register').disabled = true;
    } 
    else 
    {
        $('#length').removeClass('invalid').addClass('valid');
    }

    //validate letter
    if (password.match(/[A-z]/)) {
        $('#letter').removeClass('invalid').addClass('valid');
        document.getElementById('register').disabled = true;
    } 
    else 
    {
        $('#letter').removeClass('valid').addClass('invalid');
    }

    //validate capital letter
    if (password.match(/[A-Z]/)) {
        $('#capital').removeClass('invalid').addClass('valid');
        document.getElementById('register').disabled = true;
    } 
    else 
    {
        $('#capital').removeClass('valid').addClass('invalid');
    }

    //validate number
    if (password.match(/\d/)) 
    {
        $('#number').removeClass('invalid').addClass('valid');
        document.getElementById('register').disabled = true;
    } 
    else 
    {
        $('#number').removeClass('valid').addClass('invalid');
    }

    if (password == document.getElementById('confirm_password').value)
    {
        $('#confirm_password').removeClass('nomatch').addClass('match');
        document.getElementById('register').disabled = false;
    }
    else
    {
        $('#confirm_password').removeClass('match').addClass('nomatch');
    }
}

$('#home').click(function(){
    window.location.replace('index.php');
});

$('#create-user').click(function(){
    window.location.replace('user_register.php');
});

$('#log-out').click(function(){
    window.location.replace('logout.php');
});