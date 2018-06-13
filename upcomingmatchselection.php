<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select what matches you want to see!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/default.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/registerlogin.css" />
    
</head>
<body class="bgimg">
<div id="container" class="center">

    <form method="GET" name="matchselector" id="matchselector" action="/upcomingmatchlist.php">
        <ul>
            <li>
                <label for="toernooinr">Toernooi id</label><br>
                <span><input type="number" name="toernooinr" ></span><br>
            </li>
            <li>
                <span>Of</span>
            </li>
            <li>
                <label for="spelerid">Speler ID</label><br>
                <span><input type="number" name="spelerid" id="spelerid"></span><br>
            <li>
                <button type"submit" name="search" id="search">zoek</button>
            </li>
    </form>
</div>
</body>
<script src='js/jquery.min.js'></script>>
<script src='js/userlogin.js'></script>
</html>
