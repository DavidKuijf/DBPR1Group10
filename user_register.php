<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/registerlogin.css" />    
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/userregistration.js"></script>
</head>
<body>
<div id="container">
    <h1>User Registration</h1>
    <form method="post" name="registerform" id="registerform">
        <ul>
            <li>
                <label for="firstname">First Name</label>
                <span><input type="text" name="firstname" required></span><br>
            </li>
            <li>
                <label for="lastname">Last Name</label>
                <span><input type="text" name="lastname" required></span><br>
            </li>
            <li>
                <label for="username">Username</label>
                <span><input type="text" name="username" required></span><br>
            </li>
            <li>
                <label for="password">Password</label>
                <span><input type="password" name="password" id="password" onkeyup="check();" required></span><br>
            </li>
            <li>
                <label for="confirm_password">Confirm Password</label>
                <span><input type="password" name="confirm_password" id="confirm_password" onkeyup="check();" required></span><br>
            </li>
            <li>
                <span id="message"></span><br><br>
                <button type="submit" id="register">Register</button>
            </li>
        </ul>
    </form>

    <div id="pswd_info">
        <h4>Password must meet the following requirements:</h4>
        <ul>
            <li id="letter" class="invalid">At least <strong>one letter</strong></li>
            <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
            <li id="number" class="invalid">At least <strong>one number</strong></li>
            <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
        </ul>
    </div>
</div>
</body>
</html>

<?php

if (isset($_POST['username']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['confirm_password'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");

    $check_query = $conn->prepare("SELECT username FROM users WHERE username = :username");

    $check_query->execute(['username' => $username]);

    if (!$check_query->fetch())
    {
        $query = $conn->prepare("INSERT INTO speler (roepnaam, achternaam, username, password, skill, isadmin) 
                                VALUES (:firstname, :lastname, :username, :password, 0, :isadmin)");
    
        $query->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'password' => $password_hash,
            'isadmin' => 0
        ]);
        
        header('Location: user_login.php');
        die();
    }
    else
    {
        echo "Error: username is already taken!";
    }

    
}

?>