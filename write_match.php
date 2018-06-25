<?php 

require 'sessioncheck.php';





$matchId = $_GET['matchid'];
$score1 = $_GET['score1'];
$score2 = $_GET['score2'];
$time = $_GET['time'];
$tournamentnr = $_GET['tournamentnr'];
//create a database connection
$conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
//prepare a query to update the score of the passed match
$gameWriteQuery = $conn->prepare("UPDATE wedstrijd SET score1 = :score1, score2 = :score2 ,tijd = :tijd, datum = CURRENT_DATE() WHERE nummer = :id");
//execute the query with the data from the get
$gameWriteQuery->execute([
    'id'=>$matchId,
    'score1'=>$score1,
    'score2'=>$score2,
    'tijd'=>$time
]);

//if team1 won
if($score1 > $score2)
{
    //get the members of team 1
    $getWinnersQuery = $conn->prepare("SELECT speler1,speler2 FROM wedstrijd WHERE nummer = :id");
    $getWinnersQuery->execute(['id'=>$matchId]);
    $winners = $getWinnersQuery->fetch();
     
    //give the players of team 1 points
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
//if team2 won
elseif($score2 > $score1)
{
    //get the members of team 2
    $getWinnersQuery = $conn->prepare("SELECT speler3,speler4 FROM wedstrijd WHERE nummer = :id");
    $getWinnersQuery->execute(['id'=>$matchId]);
    $winners = $getWinnersQuery->fetch();
    
    //give the players of team 2 points
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
//if it was a draw
elseif($score1 == $score2)
{
    //get all players
    $getWinnersQuery = $conn->prepare("SELECT speler1,speler2,speler3,speler4 FROM wedstrijd WHERE nummer = :id");
    $getWinnersQuery->execute(['id'=>$matchId]);
    $winners = $getWinnersQuery->fetch();
     
    //give all players points
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