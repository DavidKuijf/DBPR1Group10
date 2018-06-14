//var login_failed = function() 
//{
 //   $('#message').html('Incorrect username and/or password.');
//}

$('#loginForm').submit(function(event){
    event.preventDefault();
    
    var formData = $('#loginForm').serialize();
    $.ajax({
        type: 'POST',
        url:'login.php',
        data:formData,
        success: function(result) {
            
            if(result == 'success'){
                $('#overlay').css({'display' : 'none'});
                console.log("pressed");
            }
            if (result == 'fail'){
                $('#message').html('incorrect username an/or password');
            }
        }
    })
});

$('#makeAccountButton').click(function(){
    window.location.assign('user_register.php');
});