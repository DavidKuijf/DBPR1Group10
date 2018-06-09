<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Creëer tournooi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/registerlogin.css" />    
    <link rel="stylesheet" type="text/css" media="screen" href="css/default.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/userregistration.js"></script>
</head>
<body class='bgimg'>
<div id="container">
    <h1>Tournooi</h1>
    <form method="post" action='user_select.php'  name="tournamentform" id="tournamentform">
        <ul>
            <li>
                <label for="amountofplayers">Aantal spelers</label>
                <span><input type="number" name="amountofplayers" value='6' required min='6' max='10'></span><br>
            </li>
            <li>
                <label for="startdatum">Startdatum</label>
                <span><input type="date" name="startdatum" required></span><br>
            </li>
           
          
            <li>
                <span id="message"></span><br><br>
                <button type="submit" id="register">confirm</button>
            </li>
        </ul>
    </form>
</div>
</body>
</html>