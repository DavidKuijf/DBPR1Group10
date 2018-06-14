<!DOCTYPE html>
<html>
<title>DBPRGroup10</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    
<head>
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="css/default.css"> 
    <link rel="stylesheet" type="text/css" media="screen" href="css/registerlogin.css" />
</head>
        
    
    <body id='body' class="bgimg">
        <ul class="optionMenu">
            <li class="optionMenuContainerLeft"><a class='optionMenuButton' href='#' id='home'>Thuis</a>
            <li class="optionMenuContainerRight"><a class='optionMenuButton' href='#' id='log-out'>log uit</a>
            <li class="optionMenuContainerRight"><a class='optionMenuButton' href='#' id='create-user'>Maak account</a>
        </ul>
        <div id="centerscreen" class="center">
            <div class="fade-in"> 
                
                <div id="menu" class="menu">
                    <a href="scoreboard.php" class"menuButton"><img src="Images/vs.png" class='reframe'></a>
                    <a href="upcomingmatchselection.php" class"menuButton"><img src="Images/podium.png" class='reframe'></a>
                    <a href="create_tournament.php" class"menuButton"><img src="Images/tournament.png" class='reframe'></a>
                    <a href="testpage.php" class"menuButton"><img src="Images/gears.png" class='reframe'></a>

                </div>
            </div>
        </div>
    </div>
</div>
<div id='overlay' class='overlay'</div>
</body>
<!--including jquery-->
<script src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script src="js/navigationbar.js"></script>
<script src="js/user_login.js"></script>
<script>
        $.ajax({
        url: 'sessioncheck.php',
        type: 'POST',
        success: function(result) {
            if(result == 'success'){
                $('#overlay').css({'display' : 'none'});
            }
            else{
                $('#overlay').load('user_login.php');
                $('#overlay').css({'display' : 'Block'});
            }
        }
    });  
</script>
    
</html> 