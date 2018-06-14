<!DOCTYPE html>
<html>

<?php 
  session_start();
  if(!isset($_SESSION['id']))
    {
      header('Location: index.php');
    } 
?>

    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <meta name="robots" content="noindex">
        <link rel="stylesheet" type="text/css" href="scoreboard.css">
        <link rel"animationsheet" type="text/css" hraf="animation.css">
        <link rel="stylesheet" type="text/css" href="css/default.css">
    </head>
    <body class="bgimg">
    <ul class="optionMenu">
      <li class="optionMenuContainerLeft"><a class='optionMenuButton' href='#' id='home'>Thuis</a>
      <li class="optionMenuContainerRight"><a class='optionMenuButton' href='#' id='log-out'>log uit</a>
      <li class="optionMenuContainerRight"><a class='optionMenuButton' href='#' id='create-user'>Maak account</a>
    </ul>
        <div class="center">
            <div id="container">
                <div id="header">
                    <h1>Quick Match</h1>
                </div>
                <div id="scorecontainer"> 
                    <div id="setcontainer">
                        <h2>sets</h2>
                        <text id="setsteamone">0</text>
                        <text id="setsteamtwo">0</text>
                    </div>
                    <text id="pointsteamone">0</text>
                    <text id="pointsteamtwo">0</text>
                    <button id="addpointone" type="button" onclick="addPointOne()">+</button> 
                    <button id="subpointone" type="button" onclick="subPointOne()">-</button> 
                    <button id="subpointtwo" type="button" onclick="subPointTwo()">-</button> 
                    <button id="addpointtwo" type="button" onclick="addPointTwo()">+</button>
                    <button id="resetgame" type="button" onclick="resetGame()">Reset</button>
                </div>
            </div>
        </div>
    </body>
    </body>
    <script>
    var maxSelected = '<?php echo $_POST["amountOfPlayers"]?>;'

    </script>
    <script src="js/scoreboard.js"></script>
    <script src='js/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js'></script>
    <script src='js/jquery.multi-select.js'></script>
    <script src='js/create_tournament.js'></script> 
    <script src='js/navigationbar.js'></script> 
</html>
