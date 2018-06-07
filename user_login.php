<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/default.css" />
    
</head>
<body class="bgimg">
    <form method="post" class="center" name="loginform" id="loginform">
        <div class="formfont"><label for="username">Username</label></div>
        <input type="text" name="username" required><br>
        <div class="formfont"><label for="password">Password</label></div>
        <input type="password" name="password" id="password" required><br>
        <span name="message" id="message"></span><br>
        <input type="submit" value="Log in">
    </form>
</body>
<script src='js/jquery.min.js'></script>>
<script src='js/userlogin.js'></script>
</html>