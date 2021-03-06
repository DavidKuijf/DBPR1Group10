<?php
    require 'sessioncheck.php';
    require 'database.php';
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Select players for a tournament">
    <meta name="author" content="D Kuijf">
    <title>Kies uw spelers</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/multi-select.css">
    <link rel="stylesheet" type="text/css" href="css/default.css">
</head>
<body>
  <!-- start -->

    <ul class="optionMenu">
      <li class="optionMenuContainerLeft"><a class="optionMenuButton" href="#" id="stop">Thuis</a>
      <li class="optionMenuContainerLeft"><a class="optionMenuButton" href="#" id="ok">Creëer poule</a>
      <li class="optionMenuContainerLeft"><a class="optionMenuButton" href="#" id="deselectAll">Verwijder gekozen spelers</a>
      <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="logout">log uit</a>
      <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="createuser">Maak account</a>
    </ul>

  <div id='hideable'>
      <select id='selectableUserList' style='height:10vh' multiple='multiple' >
      <?php
      
      //make a connection to the database
      $conn = new \PDO('mysql:host=localhost:3306;dbname=betjepongdb','phpconn','yRZNpD:W');
      $query = $conn->prepare('SELECT id,roepnaam,achternaam FROM speler');
      $query->execute();
          
      //while we have results keep adding options to the list
      while($result = $query->fetch())
      {
        echo '<option value='.$result['id'].'>' .$result['id'].' '. $result['roepnaam']." ". $result['achternaam'].'</option>';
      }
      ?>
      </select>
  </div>
</body>
<script src='js/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js'></script>
<script src='js/jquery.multi-select.js'></script>
<script src='js/create_tournament.js'></script> 
</html>

