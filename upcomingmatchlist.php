<html>
<?php 
  session_start();
  if(!isset($_SESSION['id']))
    {
      header('Location: index.php');
    } 
?>
    <title>Matchlist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <head >
        <meta name="robots" content="noindex">
        <link rel="stylesheet" type="text/css" href="css/default.css"> 
        <link rel="stylesheet" type="text/css" href="css/matches.css">
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet"> 
    </head>
        
    
    <body id='body' class="bgimg">
        
        <?php

            
            

            $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");


            
            if($_GET['toernooinr']!='')
            {
                $toernooinr = $_GET['toernooinr'];
                $wedstrijdQuery = $conn->prepare("SELECT nummer,speler1,speler2,speler3,speler4,tafel FROM wedstrijd WHERE toernooi = :toernooinr AND tijd is null");
                $wedstrijdQuery->execute([
                    'toernooinr'=> $toernooinr
                    
                ]);
                $scoreQuery = $conn->prepare("SELECT roepnaam,achternaam,score FROM deelnemer JOIN speler on deelnemer.spelerid = speler.id  WHERE toernooinr = :toernooinr");
                $scoreQuery->execute(['toernooinr'=> $toernooinr]);
                echo "<div class ='scoreboard' name='scoreboard' id='scoreboard'><ul>";

                while($scoreQueryResult = $scoreQuery->fetch())
                {
                    echo "<li>".ucwords ( $scoreQueryResult['roepnaam'] ,"\t\r\n\f\v" )." ". ucwords ( $scoreQueryResult['achternaam'] ,"\t\r\n\f\v" )." heeft ".$scoreQueryResult['score']." punten</li>";
                }
                
                echo "</ul></div>'";
            }

            elseif($_GET['spelerid']!=''){
                $playerid = $_GET['spelerid'];
                $wedstrijdQuery = $conn->prepare("SELECT nummer,speler1,speler2,speler3,speler4,tafel FROM wedstrijd WHERE (speler1 = :id OR speler2 =:id OR speler3=:id OR speler4=:id) AND tijd is null");
                $wedstrijdQuery->execute([
                    'id'=> $playerid
                ]);
            }

            $nameQuery = $conn->prepare("SELECT roepnaam,achternaam FROM speler WHERE id = :id");
            
            echo "<div id ='matches'>";
            while($wedstrijdQueryResult = $wedstrijdQuery->fetch()){
                
                $nameQuery->execute(['id'=>$wedstrijdQueryResult['speler1']]);
                $speler1Naam = $nameQuery->fetch();
                $nameQuery->execute(['id'=>$wedstrijdQueryResult['speler2']]);
                $speler2Naam = $nameQuery->fetch();
                $nameQuery->execute(['id'=>$wedstrijdQueryResult['speler3']]);
                $speler3Naam = $nameQuery->fetch();
                $nameQuery->execute(['id'=>$wedstrijdQueryResult['speler4']]);
                $speler4Naam = $nameQuery->fetch();
                
                
                if($wedstrijdQueryResult['speler2']==null)
                {
                    echo 
                    "<div ' class='upcomingmatchblock' id='upcomingmatchblock'>" .
                        "<div class='matchblocknumber'>".
                            $wedstrijdQueryResult['nummer'].
                        "</div>".

                        "<div class='matchblockteam1'>".
                           ucwords ( $speler1Naam['roepnaam'] ,"\t\r\n\f\v" )." ". ucwords ( $speler1Naam['achternaam'] ,"\t\r\n\f\v" ).
                        "</div>".

                        "<div class='matchblockversus'>".
                        "<a href='https://www.youtube.com/watch?v=dQw4w9WgXcQ'>VS</a>".
                        "</div>".

                        "<div class='matchblockteam2'>".
                            ucwords ( $speler3Naam['roepnaam'] ,"\t\r\n\f\v" )." ". ucwords ( $speler3Naam['achternaam'] ,"\t\r\n\f\v" ).
                        "</div>".

                        "<div class='matchblocktime'>".
                            "Tijd:<input id='timeinput".$wedstrijdQueryResult['nummer']."' class='matchinput' type='number' name='time' value='0' AUTOCOMPLETE=OFF>".
                        "</div>".

                        "<div class='matchblockinput1'>".
                            "<input id='score1input".$wedstrijdQueryResult['nummer']."' class='matchinput' type='number' name='score1' value='0' AUTOCOMPLETE=OFF>".
                        "</div>".

                        "<div class='matchblockinput2'>".
                            "<input id='score2input".$wedstrijdQueryResult['nummer']."' class='matchinput' type='number' name='score2' value='0' AUTOCOMPLETE=OFF>".
                        "</div>".
                        
                        "<span class='matchbutton'>".
                            "<a href='#' id='matchbutton'  data-value='".$wedstrijdQueryResult['nummer']."'>Beëindig</a>".
                        "</span>".
                        
                        "<div class='matchblockfooter'>".
                            
                        "</div>".
                    "</div>"
                ;
                }
                if($wedstrijdQueryResult['speler2']!=null){
                echo 
                    "<div  class='upcomingmatchblock'>" .
                        "<div  class='matchblocknumber'>".
                            $wedstrijdQueryResult['nummer'].
                        "</div>".

                        "<div class='matchblockteam1'>".
                            ucwords ( $speler1Naam['roepnaam'] ,"\t\r\n\f\v" )." ". ucwords ( $speler1Naam['achternaam'] ,"\t\r\n\f\v" ). " en ". ucwords ( $speler2Naam['roepnaam'] ,"\t\r\n\f\v" )." ". ucwords ( $speler2Naam['achternaam'] ,"\t\r\n\f\v" ).
                        "</div>".

                        "<div class='matchblockversus'>".
                        "<a href='https://www.youtube.com/watch?v=dQw4w9WgXcQ'>VS</a>".
                        "</div>".

                        "<div class='matchblockteam2'>".
                            ucwords ( $speler3Naam['roepnaam'] ,"\t\r\n\f\v" )." ". ucwords ( $speler3Naam['achternaam'] ,"\t\r\n\f\v" ). " en ". ucwords ( $speler4Naam['roepnaam'] ,"\t\r\n\f\v" )." ". ucwords ( $speler4Naam['achternaam'] ,"\t\r\n\f\v" ).
                        "</div>".

                        "<div class='matchblocktime'>".
                            "Tijd:<input id='timeinput".$wedstrijdQueryResult['nummer']."' class='matchinput' type='number' name='time' value='0' AUTOCOMPLETE=OFF>".
                        "</div>".

                        "<div class='matchblockinput1'>".
                            "<input id='score1input".$wedstrijdQueryResult['nummer']."' class='matchinput' type='number' name='score1' value='0' AUTOCOMPLETE=OFF>".
                        "</div>".

                        "<div class='matchblockinput2'>".
                            "<input id='score2input".$wedstrijdQueryResult['nummer']."' class='matchinput' type='number' name='score2' value='0' AUTOCOMPLETE=OFF>".
                        "</div>".
                        
                        "<div class='matchbutton' >".
                            "<a href='#' id='matchbutton'  data-value='".$wedstrijdQueryResult['nummer']."'>Beëindig</a>".
                        "</div>".
                        
                        "<div class='matchblockfooter'>
                        </div>".
                    "</div>"
                ;
                }
                
                
                
            }
            echo "</div>"

        ?>

    </div>
    


    <div id='overlay' class='overlay'</div>
    </body>
    <!--including jquery-->
    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="js/matchlist.js"></script>
    <script> 
    <?php echo "var tournamentnr ='{$toernooinr}';" ?>
    determineWinner();
    </script>
        
        
    
    
</html> 