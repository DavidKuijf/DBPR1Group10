<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Select players for a tournament">
  <meta name="author" content="D Kuijf">
  <link rel="stylesheet" type="text/css" href="css/default.css">
</head>

<body>

<?php
    $players = $_GET['selected'];
    $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");

    $query = $conn->prepare("SELECT id,roepnaam,achternaam FROM speler WHERE id = :id");
    $amountOfPlayers = count($players);
    class player{
        public $played = [];
        public $id;
        public $name;
        public $surname;

        public function __construct($conid,$conname,$consurname){
            $this->id = $conid;
            $this->name = $conname;
            $this->surname = $consurname;
        }
    }
    $playerArray = [];
    for($i = 0; $i < $amountOfPlayers ;$i++){
        $query->execute(['id'=>$players[$i]]);
        $result = $query->fetch();
        $playerArray[$i] = new player($result['id'],$result['roepnaam'],$result['achternaam']);
    }
    function generate_match($player1,$player2,$tournament){

    }
    generate_round($amountOfPlayers ,$playerArray);
    function generate_round($amountOfPlayers, $playerArray){
        $done = false;
        if($amountOfPlayers%2!=0){
            //if uneven give a random player a buy
        }

        for($i=0; $i < 6; $i++){
         
    
            $random = rand(0,$amountOfPlayers-1);
            $randomPlayer1 =$playerArray[$random];
            

            $random = rand(0,$amountOfPlayers-1);
            $randomPlayer2 =$playerArray[$random];
            
            var_dump($playerArray[$random]->{'name'});
            if ($randomPlayer1==$randomPlayer1){
                echo "true";
            }

            //var_dump($randomPlayer1);
            //echo ($randomPlayer1->name +" "+$randomPlayer2->name);

            if ($randomPlayer1!=$randomPlayer2 && !in_array($randomPlayer2,$randomPlayer1->played)){
                echo($randomPlayer1->{'name'});
                echo($randomPlayer2->{'name'});

            }

        }
    }
    
?>
</body>
<!--including jquery, bootstrapjs -->
    <script src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="js/jquery.multi-select.js"></script>


</html>
