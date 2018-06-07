<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="registerlogin.css" />
    <script src="userlogin.js"></script>
</head>
<body class="bgimg">
<div id="container">
    <h1>Login</h1>
    <form method="post" class="center" name="loginform" id="loginform">
        <ul>
            <li>
                <label for="username">Username</label>
                <span><input type="text" name="username" required></span><br>
            </li>
            <li>
                <label for="password">Password</label>
                <span><input type="password" name="password" id="password" required></span><br>
            <li>
                <button name="login" id="login">Log In</button>
            </li>
    </form>
</div>
</body>
</html>

<?php

if (isset($_POST['username']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");

    $query = $conn->prepare("SELECT password, id FROM speler WHERE username LIKE '".$username."'");

    $query->execute();

    $result = $query->fetch();

    $verify = password_verify($password, $result['password']);

    if ($verify)
    {
        session_start();
        $_SESSION['id'] = $result['id'];
    }
    else
    {
        echo '<script type="text/javascript">document.getElementById("message").innerHTML = "Incorrect username and/or password.";</script>';
    }

    var_dump($verify);

    if (isset($_SESSION['id']))
    {
        var_dump($_SESSION);
    }
}

?>