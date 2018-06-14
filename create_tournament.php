<?php
  session_start();
  if(!isset($_SESSION['id']))
    {
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
    <div id='tournamentOptionForm' class='form'>
        
        <h1>Tournooi</h1><br>
        <span>Aantal deelnemers</span><br>
        <input id='deelnemersInput' type='number' name='time' value='6' min='6' max='10'><br>
        <span></span><br>
        <button id='optionButton'>verder</button>
    </div>


<div id='fillable' class='fillable'></div>
</body>

<script src='js/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js'></script>
<script src='js/jquery.multi-select.js'></script>
<script src='js/create_tournament.js'></script> 



</html>