$('a').click(function(){
    
    var matchid = $(this).data('value');
    var score1 = $('#score1input'+matchid).val();
    var score2 = $('#score2input'+matchid).val();
    var time = $('#timeinput' +matchid).val();

   /* console.log(matchid);
    console.log(score1);
    console.log(score2);
    console.log(time);
    console.log(tournamentnr);*/
    $(this).parents('div').fadeOut();
    $.ajax({
      type: "GET",
      url: "write_match.php",
      data: {matchid: matchid,
            score1:score1,
            score2:score2,
            time:time,
            tournamentnr:tournamentnr
            },
      success: function(data){
          $('#fillable').html(data);
      }     
    });
    })