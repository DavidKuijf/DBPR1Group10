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
        echo 'success';
        
    }
    else
    {
        echo 'fail';
    }
}

?>