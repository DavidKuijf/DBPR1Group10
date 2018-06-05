<!DOCTYPE html>
<html lang="">
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
  <link rel="stylesheet" type="text/css" href="default.css">
</head>

<body class="bgimg">
  <!-- start -->

    <ul class="optionMenu">

      <li class="optionMenuContainer"><a class='optionMenuButton' href='#' id='select-all' >alle spelers</a>
      <li class="optionMenuContainer"><a class='optionMenuButton' href='#' id='deselect-all'>geen spelers</a>
      <li class="optionMenuContainer"><a class='optionMenuButton' href='#' id='ok'>ok</a>
      <li class="optionMenuContainer"><a class='optionMenuButton' href='#' id='stop'>stop</a>
    </ul>

  <div id='hideable'>

  <select id='selectableUserList'  style="text-shadow:none" multiple='multiple'>

    <?php
        $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
        $query = $conn->prepare("SELECT id,roepnaam,achternaam FROM speler");
        $query->execute();
        
        
        while($result = $query->fetch()){
            
            echo "<option value=".$result['id'].">" .$result['id']." ". $result['roepnaam']." ". $result['achternaam']."</option>";
            
        }
    
      ?>
    </select>
  </div>
  <div id = 'fillable'>
  </div>
  <!-- ends -->
  <!-- jQuery -->
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
  <script src="../js/jquery.multi-select.js"></script>
  <script type="text/javascript">
  // run callbacks
    var selected = [];
    $('#selectableUserList').multiSelect({
      selectableHeader: "<div class='custom-header'>Beschikbare spelers</div>",
      selectionHeader: "<div class='custom-header'>Gekozen spelers</div>",
      
      afterSelect: function(values){
        selected.push(values);
      }
    });

    
    $('#select-all').click(function(){
      $('#selectableUserList').multiSelect('select_all');
      return false;
    });
    $('#deselect-all').click(function(){
      $('#selectableUserList').multiSelect('deselect_all');
      return false;
    }); 
    $('#ok').click(function(){
    
      $('#hideable').hide();
      $.ajax({
       type: "GET",
       url: "testpage.php",
       data: {selected : selected},
       success: function(data){
            alert("OK");
            $('#fillable').html(data);
        }     
      });
    })
  </script>
</body>

</html>

