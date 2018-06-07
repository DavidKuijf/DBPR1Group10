var login_failed = function() 
{
    document.getElementById('message').innerHTML = 'Incorrect username and/or password.';
}

$('#loginform').submit(function(event){
    event.preventDefault();
    var formData = $('#loginform').serialize();
    $.ajax({
        type: 'POST',
        url:'login.php',
        data:formData
    })
    $('#overlay').css({'display' : 'none'});
});