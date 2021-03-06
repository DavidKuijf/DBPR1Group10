<?php
    require 'sessioncheck.php';
    require 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select what matches you want to see!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/default.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/registerlogin.css"/> 
    <link rel="stylesheet" type="text/css" media="screen" href="css/tournamentlist.css"/>
</head>
<body class="bgimg">
<ul class="optionMenu">
    <li class="optionMenuContainerLeft"><a class="optionMenuButton" href="#" id="home">Thuis</a>
    <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="log-out">log uit</a>
    <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="create-user">Maak account</a>
</ul>
<div id="container" class="center" style="margin-top:20px;">

<form method="GET" name="matchselector" id="matchselector" action="upcomingmatchlist.php">
    <ul>
        <li>
            <label for="toernooinr">Toernooi id</label><br>
            <span><input type="number" name="toernooinr" id="toernooinr" ></span><br>
        </li>
        <li>
            <span>Of</span>
        </li>
        <li>
            <label for="spelerid">Speler ID</label><br>
            <span><input type="number" name="spelerid" min="1" id="spelerid" value=<?php echo($_SESSION['id']); ?>></span><br>
        <li>
            <button type"submit" name="search" id="search">zoek</button>
        </li>
</form>

</div>

<div class ="tournamentlistcontainer" id="tournamentlistcontainer">
    <?php
        //make a databse connection
        $conn = new \PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUserName,$dbPassword);
        //prepare a query that gets all tournaments that have unfinished games
        $onGoingGamesQuery = $conn->prepare("SELECT count(toernooi)as aantal,toernooi FROM wedstrijd where tijd is null group by toernooi ");
        $onGoingGamesQuery->execute();
        //foreach result make a box with tournament info in it
        while($onGoingGamesQueryResult = $onGoingGamesQuery->fetch())
        {
            echo ("<div class='tournamentblock' data-value='".$onGoingGamesQueryResult['toernooi']."' id='toernooi".$onGoingGamesQueryResult['toernooi']."'>"." Toernooi: ".$onGoingGamesQueryResult['toernooi']." Wedstrijden te spelen: ".$onGoingGamesQueryResult['aantal']."</div>");
        }
    ?>
</div>
</body>
<script src='js/jquery.min.js'></script>
<script src='js/upcomingmatchselection.js'></script>
<script src="js/navigationbar.js"></script>
</html>
