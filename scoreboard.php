<!DOCTYPE html>
<html>
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <meta name="robots" content="noindex">
        <link rel="stylesheet" type="text/css" href="scoreboard.css">
        <link rel"animationsheet" type="text/css" hraf="animation.css">
        <script src="scoreboard.js"></script>
    </head>
    <body class="bgimg">
        <div class="center">
            <text>Sets</text><br>
            <text id="setsteamone">0</text>
            <text id="setsteamtwo">0</text><br>
            <text>Score</text><br>
            <text id="pointsteamone">0</text>
            <text id="pointsteamtwo">0</text><br>
            <button type="button" onclick="addPointOne()">Point</button> 
            <button type="button" onclick="subPointOne()">Deduct Point</button> 
            <button type="button" onclick="subPointTwo()">Deduct Point</button> 
            <button type="button" onclick="addPointTwo()">Point</button><br><br>
            <button type="button" onclick="resetGame()">Reset</button> 
        </div>
    </body>
</html>