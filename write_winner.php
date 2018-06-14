<?php 
    $toernooinr = $_POST['tournamentnr'];
    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W"); 
    $winnerQuery = $conn->prepare("SELECT roepnaam,achternaam,score,id FROM deelnemer JOIN speler on deelnemer.spelerid = speler.id  WHERE toernooinr = :toernooinr and score = (SELECT MAX(score) FROM deelnemer where toernooinr = :toernooinr)");
    $winnerQuery->execute(['toernooinr'=> $toernooinr]);
                        
    while($winnerQueryResult = $winnerQuery->fetch())
    {
        echo (ucwords ($winnerQueryResult['roepnaam'] ,"\t\r\n\f\v" )." ". ucwords ( $winnerQueryResult['achternaam'] ,"\t\r\n\f\v" )." heeft gewonnen met een score van ".$winnerQueryResult['score']." punten<br>");
    }

    $IsThereAWinnerQuery = $conn->prepare("SELECT winnaar FROM winnaar where toernooi = :toernooinr");
    $IsThereAWinnerQuery->execute(['toernooinr'=>$toernooinr]);
    if(($IsThereAWinnerQuery->fetch()<=0))
    {
        $winnerQuery->execute(['toernooinr'=> $toernooinr]);
        $WriteWinnerQuery =$conn->prepare("INSERT INTO winnaar(toernooi,winnaar) VALUES(:toernooinr,:winnaarid)");
        while($winnerQueryResult = $winnerQuery->fetch())
        {
            $WriteWinnerQuery->execute([
                'toernooinr'=> $toernooinr,
                'winnaarid'=> $winnerQueryResult['id']
            ]);

        }
        
    }           