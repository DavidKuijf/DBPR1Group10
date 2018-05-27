<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="default.css" />
    <script src="userregistration.js"></script>
</head>
<body class="bgimg">
    <form method="post" class="center" name="registerform" id="registerform">
        <div class="formfont"><label for="firstname">First Name</label></div>
        <input type="text" name="firstname" required><br>
        <div class="formfont"><label for="lastname">Last Name</label></div>
        <input type="text" name="lastname" required><br>
        <div class="formfont"><label for="username">Username</label></div>
        <input type="text" name="username" required><br>
        <div class="formfont"><label for="password">Password</label></div>
        <input type="password" name="password" id="password" onkeyup="check();" required><br>
        <div class="formfont"><label for="confirm_password">Confirm Password</label></div>
        <input type="password" name="confirm_password" id="confirm_password" onkeyup="check();" required><br>
        <span id="message"></span><br><br>
        <input type="submit" value="Register">
    </form>
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