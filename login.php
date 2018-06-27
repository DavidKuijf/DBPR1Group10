<?php
  require 'database.php'; 
  session_start();


if (isset($_POST['username']))
{
    //Retrieve the data from the post
    $username = $_POST['username'];
    $password = $_POST['password'];

    //make a connection with the database
    $conn = new \PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUserName,$dbPassword);

    //prepare the query to retrieve the password
    $query = $conn->prepare("SELECT password, id FROM speler WHERE username LIKE :username");
    //execute the query to retrieve the password
    $query->execute(['username'=>$username]);

    //fetch the results
    $result = $query->fetch();

    //compare the password to the retrieved hash
    $verify = password_verify($password, $result['password']);


    if ($verify)
    {
        //if the hash matches the password set the session id to the correct one to 'log in' the user
        $_SESSION['id'] = $result['id'];
        echo "success";
        
    }
    else
    {
        //else echo fail to let index.php know that it is incorrect
        echo "fail";
    }
}

