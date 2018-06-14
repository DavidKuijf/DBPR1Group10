<?php 
  session_start();
  if(!isset($_SESSION['id']))
    {
      header('Location: index.php');
    } 
    $matchId = $_GET['matchid'];
    $score1 = $_GET['score1'];
    $score2 = $_GET['score2'];
    $time = $_GET['time'];
    $tournamentnr = $_GET['tournamentnr'];
    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
    $gameWriteQuery = $conn->prepare("UPDATE wedstrijd SET score1 = :score1, score2 = :score2 ,tijd = :tijd, datum = CURRENT_DATE() WHERE nummer = :id");
    $gameWriteQuery->execute([
                                'id'=>$matchId,
                                'score1'=>$score1,
                                'score2'=>$score2,
                                'tijd'=>$time
    ]);

    if($score1>$score2){
        $getWinnersQuery = $conn->prepare("SELECT speler1,speler2 FROM wedstrijd WHERE nummer = :id");
        $getWinnersQuery->execute(['id'=>$matchId]);
        $winners = $getWinnersQuery->fetch();
        
        $awardPointsQuery =$conn->prepare("UPDATE deelnemer SET score=score+3 WHERE spelerid = :id AND toernooinr= :toernooinr");
        $awardPointsQuery->execute([
                                    'id'=>$winners['speler1'],
                                    'toernooinr'=>$tournamentnr
        ]);
        
        $awardPointsQuery->execute([
                                    'id'=>$winners['speler2'],
                                    'toernooinr'=>$tournamentnr
        ]);
    }
    elseif($score2>$score1){
        $getWinnersQuery = $conn->prepare("SELECT speler3,speler4 FROM wedstrijd WHERE nummer = :id");
        $getWinnersQuery->execute(['id'=>$matchId]);
        $winners = $getWinnersQuery->fetch();
      
        $awardPointsQuery =$conn->prepare("UPDATE deelnemer SET score=score+3 WHERE spelerid = :id AND toernooinr= :toernooinr");
        $awardPointsQuery->execute([
                                    'id'=>$winners['speler3'],
                                    'toernooinr'=>$tournamentnr
        ]);
        
        $awardPointsQuery->execute([
                                    'id'=>$winners['speler4'],
                                    'toernooinr'=>$tournamentnr
        ]);
    }
    elseif($score1==$score2){
        $getWinnersQuery = $conn->prepare("SELECT speler1,speler2,speler3,speler4 FROM wedstrijd WHERE nummer = :id");
        $getWinnersQuery->execute(['id'=>$matchId]);
        $winners = $getWinnersQuery->fetch();
      
        $awardPointsQuery =$conn->prepare("UPDATE deelnemer SET score=score+1 WHERE spelerid = :id AND toernooinr= :toernooinr");
        $awardPointsQuery->execute([
                                    'id'=>$winners['speler1'],
                                    'toernooinr'=>$tournamentnr
        ]);
        $awardPointsQuery->execute([
                                    'id'=>$winners['speler2'],
                                    'toernooinr'=>$tournamentnr
        ]);
        $awardPointsQuery->execute([
                                    'id'=>$winners['speler3'],
                                    'toernooinr'=>$tournamentnr
        ]);
        
        $awardPointsQuery->execute([
                                    'id'=>$winners['speler4'],
                                    'toernooinr'=>$tournamentnr
        ]);
    }
?>