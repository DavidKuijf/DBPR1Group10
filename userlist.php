<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
 
  <style>
  #feedback { font-size: 1.4em; }
  #selectable .ui-selecting { background: #FECA40; }
  #selectable .ui-selected { background: #F39814; color: white; }
  #selectable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
  #selectable li { margin: 3px; padding: 0.4em; font-size: 1.4em; height: 18px; }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#selectable" ).selectable({
      stop: function() {
        var result = $( "#select-result" ).empty();
        $( ".ui-selected", this ).each(function() {
          var index = $( "#selectable li" ).index( this );
          result.append( " #" + ( index + 1 ) );
        });
      }
    });
  } );
  </script>
</head>
<body>
 
<p id="feedback">
<span>You've selected:</span> <span id="select-result">none</span>.
</p>
 
<ol id="selectable">
<?php
        $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
        $query = $conn->prepare("SELECT id,roepnaam,achternaam FROM speler");
        $query->execute();
        $availablelist = array([]);
        
        while($result = $query->fetch()){
            
            echo "<li>". 
            $result['id']. " ".
            $result['roepnaam']. " ".
            $result['achternaam'].
            
            "</li>";
            array_push($availablelist,$result['id']);
        }
    
    ?>
</ol>
 
 
</body>
