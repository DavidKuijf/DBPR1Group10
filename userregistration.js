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
    }).focus(function() 
    {
        $('#pswd_info').show();
    }).blur(function() 
    {
        $('#pswd_info').hide();
    });

    
});



var check = function() {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value) 
    {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'matching';
        return true;
    } 
    else 
    {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'not matching';
        return false;
    }
}
