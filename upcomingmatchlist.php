<html>
<?php 
require 'sessioncheck.php';
?>

<title>Matchlist</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    
<head>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="css/default.css"> 
    <link rel="stylesheet" type="text/css" href="css/matches.css">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet"> 
</head>
      
<body id='body' class="bgimg">
<ul class="optionMenu">
    <li class="optionMenuContainerLeft"><a class="optionMenuButton" href="#" id="home">Thuis</a>
    <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="log-out">log uit</a>
    <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="create-user">Maak account</a>
</ul>
<?php
// establish a connection to the database
$conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");

//if the Get has a tournament number
if($_GET['toernooinr'] != "")
{
    $toernooinr = $_GET['toernooinr'];

    //prepare a query that gets all unfinished matches form the database
    $wedstrijdQuery = $conn->prepare("SELECT nummer,speler1,speler2,speler3,speler4,tafel FROM wedstrijd WHERE toernooi = :toernooinr AND tijd is null");
    //gets all unfinished matches form the database
    $wedstrijdQuery->execute([
        'toernooinr'=> $toernooinr
    ]);

    //prepare a query to see what the score is at this moment
    $scoreQuery = $conn->prepare("SELECT roepnaam,achternaam,score FROM deelnemer JOIN speler on deelnemer.spelerid = speler.id  WHERE toernooinr = :toernooinr");
    //see what the score is at this moment
    $scoreQuery->execute(['toernooinr'=> $toernooinr]);
    //open up a <div>
    echo "<div class ='scoreboard' name='scoreboard' id='scoreboard'><ul>";

    //for each participant retrieve their score and echo it to the page
    while($scoreQueryResult = $scoreQuery->fetch())
    {
        
        echo "<li>" . ucwords($scoreQueryResult['roepnaam'], "\t\r\n\f\v") . " " . ucwords($scoreQueryResult['achternaam'], "\t\r\n\f\v") . " heeft " . $scoreQueryResult['score'] . " punten</li>";
    }
    
    //close the <div>
    echo "</ul></div>";
}

//else if the player id is not ''
elseif($_GET['spelerid']!='')
{
    $playerid = $_GET['spelerid'];
    //prepare a query that fetches games based on a participating player
    $wedstrijdQuery = $conn->prepare("SELECT nummer,speler1,speler2,speler3,speler4,tafel FROM wedstrijd WHERE (speler1 = :id OR speler2 =:id OR speler3=:id OR speler4=:id) AND tijd is null");
    $wedstrijdQuery->execute([
        'id'=> $playerid
    ]);
}

//prepare a query to get player info
$nameQuery = $conn->prepare("SELECT roepnaam,achternaam FROM speler WHERE id = :id");
            
//open a <div>
echo "<div id ='matches'>";

//for each of the results of the query make a new matchblock
while($wedstrijdQueryResult = $wedstrijdQuery->fetch())
{  
    //get all the players their info
    $nameQuery->execute(['id'=>$wedstrijdQueryResult['speler1']]);
    $speler1Naam = $nameQuery->fetch();

    $nameQuery->execute(['id'=>$wedstrijdQueryResult['speler2']]);
    $speler2Naam = $nameQuery->fetch();

    $nameQuery->execute(['id'=>$wedstrijdQueryResult['speler3']]);
    $speler3Naam = $nameQuery->fetch();

    $nameQuery->execute(['id'=>$wedstrijdQueryResult['speler4']]);
    $speler4Naam = $nameQuery->fetch();
    
    //if it is a 2 player game us this template
    if($wedstrijdQueryResult['speler2'] == null)
    {
        echo 
        "<div class='upcomingmatchblock' id='upcomingmatchblock'>" .
            "<div class='matchblocknumber'>" .
                $wedstrijdQueryResult['nummer'] .
            "</div>".

            "<div class='matchblockteam1'>" .
                ucwords ($speler1Naam['roepnaam'], "\t\r\n\f\v") . " " . ucwords($speler1Naam['achternaam'], "\t\r\n\f\v") .
            "</div>" .

            "<div class='matchblockversus'>" .
                "VS" .
            "</div>".

            "<div class='matchblockteam2'>" .
                ucwords($speler3Naam['roepnaam'], "\t\r\n\f\v") . " " . ucwords($speler3Naam['achternaam'], "\t\r\n\f\v") .
            "</div>" .

            "<div class='matchblocktime'>" .
                "Tijd:<input id='timeinput" . $wedstrijdQueryResult['nummer'] . "' class='matchinput' type='number' name='time' value='0' AUTOCOMPLETE=OFF>" .
            "</div>" .

            "<div class='matchblockinput1'>" .
                "<input id='score1input" . $wedstrijdQueryResult['nummer'] . "' class='matchinput' type='number' name='score1' value='0' AUTOCOMPLETE=OFF>" .
            "</div>" .

            "<div class='matchblockinput2'>" .
                "<input id='score2input" . $wedstrijdQueryResult['nummer'] . "' class='matchinput' type='number' name='score2' value='0' AUTOCOMPLETE=OFF>" .
            "</div>" .
                        
            "<span class='matchbutton'>" .
                "<a href='#' id='matchbutton'  data-value='".$wedstrijdQueryResult['nummer']."'>Beëindig</a>" .
            "</span>" .
                        
            "<div class='matchblockfooter'>" .
                            
            "</div>" .
        "</div>";
    }

    //if it is a 4 player game use this template
    if($wedstrijdQueryResult['speler2'] != null)
    {
        echo 
        "<div  class='upcomingmatchblock'>" .
            "<div  class='matchblocknumber'>" .
                $wedstrijdQueryResult['nummer'] .
            "</div>" .

            "<div class='matchblockteam1'>" .
                ucwords($speler1Naam['roepnaam'], "\t\r\n\f\v") . " " . ucwords($speler1Naam['achternaam'], "\t\r\n\f\v") . " en " . ucwords($speler2Naam['roepnaam'], "\t\r\n\f\v" ) . " " . ucwords($speler2Naam['achternaam'] ,"\t\r\n\f\v") .
            "</div>" .

            "<div class='matchblockversus'>" .
                "VS" .
            "</div>" .

            "<div class='matchblockteam2'>".
                ucwords($speler3Naam['roepnaam'], "\t\r\n\f\v") . " " . ucwords($speler3Naam['achternaam'], "\t\r\n\f\v") . " en " . ucwords($speler4Naam['roepnaam'], "\t\r\n\f\v") . " " . ucwords($speler4Naam['achternaam'], "\t\r\n\f\v" ) .
            "</div>" .

            "<div class='matchblocktime'>".
                "Tijd:<input id='timeinput" . $wedstrijdQueryResult['nummer'] . "' class='matchinput' type='number' name='time' value='0' AUTOCOMPLETE=OFF>" .
            "</div>" .

            "<div class='matchblockinput1'>" .
                "<input id='score1input" . $wedstrijdQueryResult['nummer'] . "' class='matchinput' type='number' name='score1' value='0' AUTOCOMPLETE=OFF>" .
            "</div>" .

            "<div class='matchblockinput2'>" .
                "<input id='score2input".$wedstrijdQueryResult['nummer']."' class='matchinput' type='number' name='score2' value='0' AUTOCOMPLETE=OFF>" .
            "</div>" .
                        
            "<div class='matchbutton' >" .
                "<a href='#' id='matchbutton'  data-value='" . $wedstrijdQueryResult['nummer'] . "'>Beëindig</a>" .
            "</div>" .
                        
            "<div class='matchblockfooter'>
            </div>" .
        "</div>";
    }
}
?>

</div>

<div id='overlay' class='overlay'</div>
    </body>
    <!--including jquery-->
    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="js/matchlist.js"></script>
    <script src="js/navigationbar.js"></script>
    <script> 
    <?php 
    echo "var tournamentnr = '{$toernooinr}';" 
    ?>

    determineWinner();
    </script>
</html> 