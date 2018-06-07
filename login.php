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