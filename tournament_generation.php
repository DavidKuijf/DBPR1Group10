<?php

session_start();

if(!isset($_SESSION['id']))
{
    header("Location: index.php");
} 

$players = $_GET['selected'];
$conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");

$query = $conn->prepare("SELECT id,roepnaam,achternaam FROM speler WHERE id = :id");
$amountOfPlayers = count($players);

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

for($i = 0; $i < $amountOfPlayers ;$i++)
{
    $query->execute(['id'=>$players[$i]]);
    $result = $query->fetch();
    $playerArray[$i] = new player($result['id'],$result['roepnaam'],$result['achternaam']);
}

function generate_tournament($players,$amountOfPlayers,$playerArray)
{
    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
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
        
    if($players = 2)
    {
        generate_rounds($amountOfPlayers, $playerArray ,intval($tournamentcountArray[0]));
    }
        
    return intval($tournamentcountArray[0]);
}

//  Credit to https://thydzik.com/php-factorial-and-combination-functions/ for doing this for me cuz im dumb
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

function generate_rounds($amountOfPlayers, $playerArray, $toernooinr)
{
    $pastMatchups = [];

    //$done = false;
    if($amountOfPlayers%2 != 0)
    {
        //if uneven give a random player a buy
    }

    $totalAmountOfPairings = combinations($amountOfPlayers, 2);

    //for($i=0; $i < 10000; $i++){
    while(count($pastMatchups) < $totalAmountOfPairings)
    {
        $random = rand(0, $amountOfPlayers - 1);
        $randomPlayer1 = $playerArray[$random];
            

        $random = rand(0, $amountOfPlayers - 1);
        $randomPlayer2 = $playerArray[$random];
            

        if ($randomPlayer1 != $randomPlayer2 && 
            !in_array($randomPlayer2, $randomPlayer1->played) && 
            !in_array(($randomPlayer1->{'id'} . " " . $randomPlayer2->{'id'}), $pastMatchups) && 
            !in_array(($randomPlayer2->{'id'} . " " . $randomPlayer1->{'id'}), $pastMatchups))
        {
            $contstring = $randomPlayer1->{'id'} . " " . $randomPlayer2->{'id'};
            array_push($pastMatchups, $contstring);

            generate_2player_match($randomPlayer1, $randomPlayer2, $toernooinr, 1);

            //echo(($randomPlayer1->{'id'}." ".$randomPlayer2->{'id'}));
            //echo("<br>");
        }
    }
}

function generate_2player_match($player1, $player2, $toernooinr, $tafel)
{
    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
    $match = $conn->prepare("INSERT INTO wedstrijd(speler1,speler3,toernooi,tafel) VALUES(:id1,:id2,:toernooi,:tafel)");
    $match-> execute([
        'id1'=>$player1->{'id'},
        'id2'=>$player2->{'id'},
        'toernooi'=>$toernooinr,
        'tafel'=>$tafel
    ]);
}

$count = generate_tournament(2, $amountOfPlayers, $playerArray);

header("Location: upcomingmatchlist.php?toernooinr=$count");
    
exit;

