var pointsTeamOne = 0;
var pointsTeamTwo = 0;
var setsTeamOne = 0;
var setsTeamTwo = 0;
var pointWinCount = 11;
var setOver = false;
var gameOver = false;

function addPointOne()
{
    calculateScore(1, 0)
}

function addPointTwo()
{
    calculateScore(0, 1)
}

function subPointOne()
{
    calculateScore(-1, 0)
}

function subPointTwo()
{
    calculateScore(0, -1)
}

function calculateScore(varTeamOne, varTeamTwo)
{
    if (pointsTeamOne === 0 && varTeamOne === -1)
        varTeamOne = 0;
    if (pointsTeamTwo === 0 && varTeamTwo === -1) 
        varTeamTwo = 0;
    pointsTeamOne += varTeamOne;
    pointsTeamTwo += varTeamTwo;
    calculateWinner();
    updateText();
}


function calculateWinner()
{
    if (pointsTeamOne >= 10 && pointsTeamOne === pointsTeamTwo)
    {
        pointWinCount++;
    }
    if (pointsTeamOne === pointWinCount || pointsTeamTwo === pointWinCount)
    {
        setOver = true;
        if (pointsTeamOne === pointWinCount)
        {
            setsTeamOne++;
        }
        else
        {
            setsTeamTwo++;
        }
        resetPoints()
    }
    if (setsTeamOne === 3 || setsTeamTwo === 3)
    {
        gameOver = true;
    }
}

function resetGame()
{
    pointsTeamOne = 0;
    pointsTeamTwo = 0;
    setsTeamOne = 0;
    setsTeamTwo = 0;
    updateText();
}

function resetPoints()
{
    pointWinCount = 11;
    pointsTeamOne = 0;
    pointsTeamTwo = 0;
}

function updateText()
{
    document.getElementById("pointsteamone").innerHTML = pointsTeamOne;
    document.getElementById("pointsteamtwo").innerHTML = pointsTeamTwo;
    document.getElementById("setsteamone").innerHTML = setsTeamOne;
    document.getElementById("setsteamtwo").innerHTML = setsTeamTwo;
}

$('#home').click(function(){
    window.location.replace('index.php');
});

$('#create-user').click(function(){
    window.location.replace('user_register.php');
});

$('#log-out').click(function(){
    window.location.replace('logout.php');
});