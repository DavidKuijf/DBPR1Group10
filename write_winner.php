<?php 
require 'database.php';
require 'sessioncheck.php';

$toernooinr = $_POST['tournamentnr'];
//create database connection
$conn = new \PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUserName,$dbPassword); 
//prepare a query to determine 
$winnerQuery = $conn->prepare("SELECT roepnaam,achternaam,score,id FROM deelnemer JOIN speler on deelnemer.spelerid = speler.id  WHERE toernooinr = :toernooinr and score = (SELECT MAX(score) FROM deelnemer where toernooinr = :toernooinr)");
$winnerQuery->execute(['toernooinr'=> $toernooinr]);

//for everyone with the highest score in participants for the specified tournament add their name and score to the spage
while($winnerQueryResult = $winnerQuery->fetch())
{
    
    echo (ucwords($winnerQueryResult['roepnaam'], "\t\r\n\f\v") . " " . ucwords($winnerQueryResult['achternaam'], "\t\r\n\f\v") . " heeft gewonnen met een score van " . $winnerQueryResult['score'] . " punten<br>");
}


$IsThereAWinnerQuery = $conn->prepare("SELECT winnaar FROM winnaar where toernooi = :toernooinr");
$IsThereAWinnerQuery->execute(['toernooinr'=>$toernooinr]);
// if there are no winner written for the tournament yet
if(($IsThereAWinnerQuery->fetch() <= 0))
{
    //write the winners into the database
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
