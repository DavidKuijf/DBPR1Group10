var scoreTeamOne = 0;
var scoreTeamTwo = 0;

function addScoreOne() 
{
    scoreTeamOne++;
    updateText(0);
}

function decScoreOne()
{
    scoreTeamOne--;
    updateText(0);
}

function addScoreTwo() 
{
    scoreTeamTwo++;
    updateText(2);
}

function decScoreTwo()
{
    scoreTeamTwo--;
    updateText(2);
}

function updateText(team)
{
    if (team === 0)
    {
        document.getElementById("scoreteamone").innerHTML = scoreTeamOne;
    }
    else
    {
        document.getElementById("scoreteamtwo").innerHTML = scoreTeamTwo;
    }
}