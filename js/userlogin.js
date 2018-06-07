var login_failed = function() 
{
    $('#message').html('Incorrect username and/or password.');
}

$('#loginform').submit(function(event){
    event.preventDefault();
    var formData = $('#loginform').serialize();
    $.ajax({
        type: 'POST',
        url:'login.php',
        data:formData,
        success: function(result) {
            if(result == 'success'){
                $('#overlay').css({'display' : 'none'});
            }
            if (result == 'fail'){
                $('message').html('incorrect username an/or password');
            }
        }
    })
});