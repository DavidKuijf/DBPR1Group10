<?php

session_start();

var_dump($_SESSION);

if (isset($_SESSION['id']))
{
    $userid = $_SESSION['id'];
    
    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
    
    $query = $conn->prepare("SELECT roepnaam, achternaam, username FROM speler WHERE id = :id");
    
    $query->execute(['id' => $userid]);

    $result = $query->fetchAll();

    $firstname = $result[0]['roepnaam'];
    $lastname = $result[0]['achternaam'];
    $username = $result[0]['username'];

    var_dump($result);
}

?>

<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="user.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
<div id="mastercontainer">
    <div id="infocontainer">
        <ul>
            <li>
                <span class="type">Naam: </span>
                <span id="name"><?php echo "$firstname $lastname"?></span>
            </li>
            <li>
                <span class="type">Gebruikersnaam: </span>
                <span id="username">username</span>
            </li>
        </ul>
    </div>
    <div id="changepswdcontainer">

    </div>
</div>
</body>
</html>