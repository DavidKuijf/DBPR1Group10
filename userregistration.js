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
