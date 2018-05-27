<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="default.css" />
    <script src="userlogin.js"></script>
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
</html>

<?php

if (isset($_POST['username']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");

    $query = $conn->prepare("SELECT password FROM speler WHERE username LIKE '".$username."'");

    $query->execute();

    $result = $query->fetch();

    $verify = password_verify($password, $result['password']);

    if ($verify)
    {
        session_start();
        $_SESSION['user'] = $username;
    }
    else
    {
        echo '<script type="text/javascript">document.getElementById("message").innerHTML = "Incorrect username and/or password.";</script>';
    }

    var_dump($verify);
    if (isset($_SESSION['user'])
    {
        var_dump($_SESSION);
    }
}

?>