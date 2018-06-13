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


            
            if(isset($_GET['toernooinr'])){
                $toernooinr = $_GET['toernooinr'];
                $wedstrijdQuery = $conn->prepare("SELECT nummer,speler1,speler2,speler3,speler4,tafel FROM wedstrijd WHERE toernooi = :toernooinr AND tijd is null");
                $wedstrijdQuery->execute([
                    'toernooinr'=> $toernooinr
                    
                ]);
            }

            if(isset($_GET['spelerid'])){
                $playerid = $_GET['spelerid'];
                $wedstrijdQuery = $conn->prepare("SELECT nummer,speler1,speler2,speler3,speler4,tafel FROM wedstrijd WHERE (speler1 = :id OR speler2 =:id OR speler3=:id OR speler4=:id) AND tijd is null");
                $wedstrijdQuery->execute([
                    'id'=> $playerid
                ]);
            }

           

            $nameQuery = $conn->prepare("SELECT roepnaam,achternaam FROM speler WHERE id = :id");
            
            
            while($result1 = $wedstrijdQuery->fetch()){
                
                $nameQuery->execute(['id'=>$result1['speler1']]);
                $speler1Naam = $nameQuery->fetch();
                $nameQuery->execute(['id'=>$result1['speler2']]);
                $speler2Naam = $nameQuery->fetch();
                $nameQuery->execute(['id'=>$result1['speler3']]);
                $speler3Naam = $nameQuery->fetch();
                $nameQuery->execute(['id'=>$result1['speler4']]);
                $speler4Naam = $nameQuery->fetch();
                
                
                if($result1['speler2']==null){
                    echo 
                    "<div ' class='upcomingmatchblock'>" .
                        "<div class='matchblocknumber'>".
                            $result1['nummer'].
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
                            "Tijd:<input id='timeinput".$result1['nummer']."' class='matchinput' type='number' name='time' value='0'>".
                        "</div>".

                        "<div class='matchblockinput1'>".
                            "<input id='score1input".$result1['nummer']."' class='matchinput' type='number' name='score1' value='0'>".
                        "</div>".

                        "<div class='matchblockinput2'>".
                            "<input id='score2input".$result1['nummer']."' class='matchinput' type='number' name='score2' value='0'>".
                        "</div>".
                        
                        "<div class='matchbutton'>".
                            "<a href='#' id='matchbutton'  data-value='".$result1['nummer']."'>Beëindig</a>".
                        "</div>".
                        
                        "<div class='matchblockfooter'>".
                            
                        "</div>".
                    "</div>"
                ;
                }
                if($result1['speler2']!=null){
                //." ".$result1['score1']." ".$result1['score2']
                echo 
                    "<div  class='upcomingmatchblock'>" .
                        "<div  class='matchblocknumber'>".
                            $result1['nummer'].
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
                            "Tijd:<input id='timeinput".$result1['nummer']."' class='matchinput' type='number' name='time' value='0'>".
                        "</div>".

                        "<div class='matchblockinput1'>".
                            "<input id='score1input".$result1['nummer']."' class='matchinput' type='number' name='score1' value='0'>".
                        "</div>".

                        "<div class='matchblockinput2'>".
                            "<input id='score2input".$result1['nummer']."' class='matchinput' type='number' name='score2' value='0'>".
                        "</div>".
                        
                        "<div class='matchbutton' >".
                            "<a href='#' id='matchbutton'  data-value='".$result1['nummer']."'>Beëindig</a>".
                        "</div>".
                        
                        "<div class='matchblockfooter'>
                        </div>".
                    "</div>"
                ;
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
    <script> <?php echo "var tournamentnr ='{$toernooinr}';" ?> </script>
        
        
    </script>
    
</html> 