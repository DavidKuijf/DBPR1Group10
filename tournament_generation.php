<?php

require 'sessioncheck.php';
require 'database.php';


//make a database connection
$conn = new \PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUserName,$dbPassword);

//set players to the ones passed of the post
$players = $_GET['selected'];



//prepare a query that select all info from selected players
$playerQuery = $conn->prepare("SELECT id,roepnaam,achternaam FROM speler WHERE id = :id");
$amountOfPlayers = count($players);

//declare a player object
class player
{
    public $played = [];
    public $id;
    public $name;
    public $surname;

    public function __construct($conid, $conname, $consurname){
        $this->id = $conid;
        $this->name = $conname;
        $this->surname = $consurname;
    }
}

$playerArray = [];

//for each of the players fetch their info and make a player object withtthat info
for($i = 0; $i < $amountOfPlayers ;$i++)
{
    
    $playerQuery->execute(['id'=>$players[$i]]);
    $playerQueryResult = $playerQuery->fetch();
    $playerArray[$i] = new player($playerQueryResult['id'],$playerQueryResult['roepnaam'],$playerQueryResult['achternaam']);
}

//this function inserts a new entry into the tounament tanle then fetches the number of that tournament
//then adds all the players as participants to that tournament
//lastly it calls the generate rounds function
function generate_tournament($players,$amountOfPlayers,$playerArray)
{
    
    $conn = new \PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUserName,$dbPassword);
    $makeTournament = $conn->prepare("INSERT INTO toernooi VALUES()");
    $makeTournament->execute();

    $gettournamentcount = $conn->prepare("SELECT count(*) from toernooi");
    $gettournamentcount->execute();
    $tournamentcountArray = $gettournamentcount->fetch();

    $makeParticipants = $conn->prepare("INSERT INTO deelnemer(toernooinr,spelerid) VALUES(:tournamentnr,:id)");

    foreach($playerArray as $participant)
    {
        $makeParticipants->execute([
            'tournamentnr'=>$tournamentcountArray[0],
            'id'=>$participant->{'id'}
        ]);
    }
    
    generate_rounds($amountOfPlayers, $playerArray ,intval($tournamentcountArray[0]));
       
}

//  Credit to https://thydzik.com/php-factorial-and-combination-functions/ for doing this for me cuz im dumb
//calculates factorial of the given number
function factorial($n) 
{
    if ($n <= 1) 
    {
        return 1;
    } 
    else 
    {
        return factorial($n - 1) * $n;
    }
}
     
//Credit to https://thydzik.com/php-factorial-and-combination-functions/ for doing this for me cuz im dumb
//calculates the amount of possible pairings
function combinations($n, $k) 
{
    //note this defualts to 0 if $n < $k
    if ($n < $k) 
    {
        return 0;
    } else 
    {
        return factorial($n)/(factorial($k)*factorial(($n - $k)));
    }
}

//this function makes all possible pairings and then calls write_2player_match for each of those pairings
function generate_rounds($amountOfPlayers, $playerArray, $toernooinr)
{
    $pastMatchups = [];
    $totalAmountOfPairings = combinations($amountOfPlayers, 2);

    //while the amount of pairings isn't what it should be
    while(count($pastMatchups) < $totalAmountOfPairings)
    {
        //get 2 random players
        $random = rand(0, $amountOfPlayers - 1);
        $randomPlayer1 = $playerArray[$random];
            

        $random = rand(0, $amountOfPlayers - 1);
        $randomPlayer2 = $playerArray[$random];
            
        //if the players arent the same and the pairing doesn't exist 
        if ($randomPlayer1 != $randomPlayer2 && 
            !in_array($randomPlayer2, $randomPlayer1->played) && 
            !in_array(($randomPlayer1->{'id'} . " " . $randomPlayer2->{'id'}), $pastMatchups) && 
            !in_array(($randomPlayer2->{'id'} . " " . $randomPlayer1->{'id'}), $pastMatchups))
        {
            //add the newly discovered matchup to the past pairings
            $contstring = $randomPlayer1->{'id'} . " " . $randomPlayer2->{'id'};
            array_push($pastMatchups, $contstring);

            //generate the match for this pairing
            write_2player_match($randomPlayer1, $randomPlayer2, $toernooinr, 1);
        }
    }
}

function write_2player_match($player1, $player2, $toernooinr, $tafel)
{
    //re-establish the connection because if you don't it doesnt work for some reason
    $conn = new \PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUserName,$dbPassword);

    //prepare a query to insert the macth into the database
    $match = $conn->prepare("INSERT INTO wedstrijd(speler1,speler3,toernooi,tafel) VALUES(:id1,:id2,:toernooi,:tafel)");

    //execute the query
    $match-> execute([
        'id1'=>$player1->{'id'},
        'id2'=>$player2->{'id'},
        'toernooi'=>$toernooinr,
        'tafel'=>$tafel
    ]);
}
generate_tournament(2, $amountOfPlayers, $playerArray);  
exit;

