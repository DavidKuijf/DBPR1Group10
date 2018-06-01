<!DOCTYPE html>
<html>
    <title>DBPRGroup10</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <head >
        <meta name="robots" content="noindex">
        <link rel="stylesheet" type="text/css" href="default.css">
       
        
    </head>
        
   
    <body class="bgimg">


    <script>
    var variablejs = "<?php echo $variablephp; ?>" ;
    alert("category = " + variablejs);
    </script>
        <div id="loginbit">
        </div>
       
        <script>
            
            
            if(<?php echo $_SESSION ?>=null){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("loginbit").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "loginform.html", true);
            xhttp.send();
            }
        </script>
        
        

        
        <div id="centerscreen" class="center">
            <div class="fade-in"> 
                
                <div id="menu" class="menu">
                    <a href="scoreboard.php" class"menuButton"><img src="/Images/vs.png" class='reframe'></a>
                    <a href="testpage.php" class"menuButton"><img src="/Images/podium.png" class='reframe'></a>
                    <a href="userlist.php" class"menuButton"><img src="/Images/tournament.png" class='reframe'></a>
                    <a href="testpage.php" class"menuButton"><img src="/Images/gears.png" class='reframe'></a>

                </div>
            </div>
        </div>
    </body>

    
    
</html> 