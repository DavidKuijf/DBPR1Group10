<html>
    <title>Matchlist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <head >
        <meta name="robots" content="noindex">
        <link rel="stylesheet" type="text/css" href="css/default.css"> 
        <link rel="stylesheet" type="text/css" href="css/matches.css">
    </head>
        
    
    <body id='body' class="bgimg">
        
        <?php 
            $toernooinr = 1;
            $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
            $query = $conn->prepare("SELECT nummer,speler1,speler2,speler3,speler4,tafel,score1,score2 FROM wedstrijd WHERE toernooi = :toernooinr");
            $query->execute([
                                'toernooinr'=> $toernooinr
                            ]);
            

            while($result = $query->fetch()){
                //." ".$result['score1']." ".$result['score2']
                echo 
                    "<div class='upcomingmatchblock'>" .
                        "<div class='matchblocknumber'>".
                            $result['nummer'].
                        "</div>".

                        "<div class='matchblockteam1'>".
                            "speler ".$result['speler1']." en ".$result['speler2'].
                        "</div>".

                        "<div class='matchblockversus'>".
                        "< <a href='https://www.youtube.com/watch?v=dQw4w9WgXcQ'>VS</a>".
                        "</div>".

                        "<div class='matchblockteam2'>".
                        "speler ".$result['speler3']." en  ".$result['speler4'].
                        "</div>".

                        "<div class='matchblocktime'>".
                            "   ".
                        "</div>".

                        "<div class='matchblockinput1'>".
                            "<input class='matchinput' type='number' name='score1'>".
                        "</div>".

                        "<div class='matchblockinput2'>".
                            "<input class='matchinput' type='number' name='score2'>".
                        "</div>".
                        
                        "<div class='matchbutton'>".
                            "Beëindig".
                        "</div>".
                        
                        "<div class='matchblockfooter'>
                        </div>".
                    "</div>"
                ;
                
                
                
                
            }

        ?>

    </div>
    


    <div id='overlay' class='overlay'</div>
    </body>
    <!--including jquery-->
    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script>
        
        
    </script>
    
</html> 