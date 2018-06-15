var pointsTeamOne = 0;
var pointsTeamTwo = 0;
var setsTeamOne = 0;
var setsTeamTwo = 0;
var pointWinCount = 11;

function addPointOne() {
    calculateScore(1, 0);
}

function addPointTwo() {
    calculateScore(0, 1);
}

function subPointOne() {
    calculateScore(-1, 0);
}

function subPointTwo() {
    calculateScore(0, -1);
}

function calculateScore(varTeamOne, varTeamTwo) {
    if (pointsTeamOne === 0 && varTeamOne === -1) varTeamOne = 0; // Makes sure score can't go minus.
    if (pointsTeamTwo === 0 && varTeamTwo === -1) varTeamTwo = 0;
    pointsTeamOne += varTeamOne;
    pointsTeamTwo += varTeamTwo;
    calculateWinner();
    updateText();
}

function calculateWinner() {
    if (pointsTeamOne >= 10 && pointsTeamOne === pointsTeamTwo) { // Ping pong has to be won with a score difference of two if the score reaches 10 to 10.
        pointWinCount++;
    }
    if (pointsTeamOne === pointWinCount || pointsTeamTwo === pointWinCount) {  // When a team equals the winning score they win a set.
        if (pointsTeamOne === pointWinCount) {
          setsTeamOne++;
        } else {
          setsTeamTwo++;
        }
        resetPoints();
    }
}

function resetGame() {  // Hard resets the game.
    pointsTeamOne = 0;
    pointsTeamTwo = 0;
    setsTeamOne = 0;
    setsTeamTwo = 0;
    updateText();
}

function resetPoints() { // Resets only the point system.
    pointWinCount = 11;
    pointsTeamOne = 0;
    pointsTeamTwo = 0;
}

function updateText() {  // Updates all the text on the webpage.
    document.getElementById("pointsteamone").innerHTML = pointsTeamOne;
    document.getElementById("pointsteamtwo").innerHTML = pointsTeamTwo;
    document.getElementById("setsteamone").innerHTML = setsTeamOne;
    document.getElementById("setsteamtwo").innerHTML = setsTeamTwo;
}

$("#home").click(function() {
    window.location.replace("index.php");
});

$("#create-user").click(function() {
    window.location.replace("user_register.php");
});

$("#log-out").click(function() {
    window.location.replace("logout.php");
});
