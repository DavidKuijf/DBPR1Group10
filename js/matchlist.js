$("a").click(function() {
  var matchid = $(this).data("value");
  var score1 = $("#score1input" + matchid).val();
  var score2 = $("#score2input" + matchid).val();
  var time = $("#timeinput" + matchid).val();

  $(this)
    .parents(".upcomingmatchblock")
    .fadeOut();
  $.ajax({
    type: "GET",
    url: "write_match.php",
    data: {
      matchid: matchid,
      score1: score1,
      score2: score2,
      time: time,
      tournamentnr: tournamentnr
    },
    success: function(data) {
      $("#fillable").html(data);
    }
  });

  determineWinner();
});

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
