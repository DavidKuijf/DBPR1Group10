<?php
    //Check if the user is logged in
  session_start();
  if(!isset($_SESSION['id']))
    {
        //if not redirect to index.php
        header('Location: index.php');
    } 
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Creëer tournooi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <link rel="stylesheet" type="text/css" media="screen" href="css/default.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/create_tournament.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/registerlogin.css" />
</head>

<body class='bgimg'>
<ul class="optionMenu">
    <li class="optionMenuContainerLeft"><a class="optionMenuButton" href="#" id="home">Thuis</a>
    <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="log-out">log uit</a>
    <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="create-user">Maak account</a>
</ul>
<div id='tournamentOptionForm' class='form'>
    <h1>Tournooi</h1><br>
    <span>Aantal deelnemers</span><br>
    <input id="deelnemersInput" type="number" name="time" value="6" min="6" max="10"><br>
    <span></span><br>
    <button id="optionButton">verder</button>
</div>
<div id="fillable" class="fillable"></div>
</body>

<script src='js/jquery.min.js'></script>
<script src='js/create_tournament.js'></script> 
<script src='js/navigationbar.js'></script> 


</html>