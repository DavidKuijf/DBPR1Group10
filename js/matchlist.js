//add a listener to all the links on the page
$("a").click(function() {
  //get all hte date from the correct field
  var matchid = $(this).data("value");
  var score1 = $("#score1input" + matchid).val();
  var score2 = $("#score2input" + matchid).val();
  var time = $("#timeinput" + matchid).val();

  //fade out the parent with the activated element
  $(this)
    .parents(".upcomingmatchblock")
    .fadeOut();

  //make an ajax call to write_match.php with all the data
  $.ajax({
    type: "GET",
    url: "write_match.php",
    data: {
      matchid: matchid,
      score1: score1,
      score2: score2,
      time: time,
      tournamentnr: tournamentnr
    }
  });

  determineWinner();
});

//this function checks if there are no more matches in this tournament and if so calls write_data.php with the tournament number
function determineWinner() {
  if ($("#matches").children().length == 0) {
    $.ajax({
      type: "POST",
      url: "write_winner.php",
      data: { tournamentnr: tournamentnr },
      success: function(data) {
        console.log("confirm");
        $("#scoreboard").html(data);
      }
    });
  }
}
