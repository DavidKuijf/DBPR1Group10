var amountOfPlayers
$('#optionButton').click(function(){
    amountOfPlayers = $('#deelnemersInput').val();
    $.ajax({
            type: "POST",
            url: "user_select.php",
            data: {amountOFPlayers:amountOfPlayers},
            success: function(data){
                $('#fillable').html(data);
                $('#tournamentOptionForm').hide();
            }    
          
        });
});

var selected = [];

$('#selectableUserList').multiSelect({
    selectableHeader: "<div class='custom-header'>Beschikbare spelers</div>",
    selectionHeader: "<div class='custom-header'>Gekozen spelers</div>",
    
    afterSelect: function(values){
      selected.push(values[0]);
      if (selected.length>=parseInt(amountOfPlayers)){
        $('#selectableUserList').attr('disabled','disabled');
        $('#selectableUserList').multiSelect('refresh');
      }
    },
    afterDeselect: function(values){
      var index = selected.indexOf(values[0]);
      if (index > -1){
        selected.splice(index,1);
      }
    }
    
  });


  $('#deselectAll').click(function(){
    $('#selectableUserList').multiSelect('deselect_all');
    $('#selectableUserList').removeAttr('disabled','disabled');
    $('#selectableUserList').multiSelect('refresh');
    selected = [];
    return false;
  }); 

  $('#stop').click(function(){
    window.location.replace('index.php');
  });


  $('#ok').click(function(){
     if(selected.length<parseInt(amountOfPlayers)){
         alert("Selecteer "+parseInt(amountOfPlayers)+' spelers');
     }
     else{
        
        $.ajax({
          type: "GET",
          url: "tournament_generation.php",
          data: {selected : selected},
          success: function(data){
            $('#fillable').html(data);
          }     
        });


     }
    
    })

  $('#create-user').click(function(){
      window.location.replace('user_register.php');
  });
  
  $('#log-out').click(function(){
      window.location.replace('logout.php');
  });