<?php

    include 'database.php';
    $name = $_POST['name'];
    $password = $_POST['password'];
    
    $nameCheckQuery = $conn->prepare("SELECT name FROM user WHERE name = :name");
    $nameCheckQuery->execute(['name' => $name]);
    
    if(!$nameCheckQuery->fetch()){
        $queryone = $conn->prepare("INSERT INTO user(Name,Password,Age) VALUES(:name,:password,:age)");
        $queryone->execute(['name'=>$name,
                        'password'=>$password,
                        'age'=>$age]);
        $queryone->fetch();
    }
    else{
        echo "name is taken biatch!";
    }
    

  
