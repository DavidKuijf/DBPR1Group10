<?php 
    // resume session
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/registerlogin.css" />
    
</head>
<body class="bgimg">
<div id="container" class="center">
    <h1>Login</h1>
    <form method="post" name="loginForm" id="loginForm">
        <ul>
            <li>
                <label for="username">Username</label>
                <span><input type="text" name="username" required></span><br>
            </li>
            <li>
                <label for="password">Password</label>
                <span><input type="password" name="password" id="password" required></span><br>
            <li>
                <button type='submit' name="login" id="login">Log In</button>
            </li>
           
           
    </form>
            <li>
                <button name="makeAccountButton" id="makeAccountButton">Registreer</button>
            </li>
            <li>
                <span id='message'></span><br>
            </li>
        </ul>
</div>
</body>
<script src='js/jquery.min.js'></script>>
<script src='js/user_login.js'></script>
</html>
