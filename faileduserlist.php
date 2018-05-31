<!DOCTYPE html>
<html>

<script>
        function newElement(sender) {
            var li = document.createElement("li");
            var inputValue = document.getElementById();
            var t = document.createTextNode(inputValue);
            li.appendChild(t);
           
            document.getElementById("selectedUserList").appendChild(li);
            
            
            

            for (i = 0; i < close.length; i++) {
                close[i].onclick = function() {
                var div = this.parentElement;
                div.style.display = "none";
                }
            }
        }

        

    </script>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="userlist.css" />
</head>
<body class="row">

 <div id="myDIV" class="header">
  <h2></h2>
  <input type="text" id="myInput" placeholder="Search...">
  <span onclick="" class="addBtn">Search</span>
</div>
<div id="leftColumn" class="column">
    <ul id="userList">
    

    <?php
        $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
        $query = $conn->prepare("SELECT id,roepnaam,achternaam FROM speler");
        $query->execute();
        $availablelist = array([]);
        
        while($result = $query->fetch()){
            
            echo "<li id='".$result['id']."' onclick='newElement(".$result['id'].")'>". 
            $result['id']. " ".
            $result['roepnaam']. " ".
            $result['achternaam'].
            
            "</li>";
            array_push($availablelist,$result['id']);
        }
    
    ?>
    
</div>

<div id="rightColumn" class="column">
    <ul id="selectedUserList">

    <?php
        $conn = new \PDO("mysql:host=localhost:3306;dbname=betjepongdb","phpconn","yRZNpD:W");
        $query = $conn->prepare("SELECT id,roepnaam,achternaam FROM speler");
        $query->execute();
        $availablelist = array([]);
        
       
    ?>
    <script>
    </script>
</div>
</ul>