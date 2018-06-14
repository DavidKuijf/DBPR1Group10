$('#optionButton').click(function(){
    var amountOfPlayers = $('#deelnemersInput').val();
    $.ajax({
            type: "POST",
            url: "user_select.php",
            data: {amountofplayers:amountOfPlayers},
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
      if (selected.length>=parseInt(maxSelected)){
        $('#selectableUserList').attr('disabled','disabled');
        $('#selectableUserList').multiSelect('refresh');
      }
    },
    afterDeselect: function(values){
      var index = selected.indexOf(values[0]);
      if (index > -1){
        console.log('lol');
        selected.splice(index,1);
      }
    }
    
  });

    
  /*$('#select-all').click(function(){
    $('#selectableUserList').multiSelect('select_all');
    return false;
  });*/

  $('#deselect-all').click(function(){
    $('#selectableUserList').multiSelect('deselectAll');
    $('#selectableUserList').removeAttr('disabled','disabled');
    $('#selectableUserList').multiSelect('refresh');
    selected = [];
    return false;
  }); 

  $('#home').click(function(){
    window.location.replace('index.php');
  });


  $('#ok').click(function(){
    if(selected.length<parseInt(maxselected)){
        alert("Selecteer "+parseInt(maxselected)+' spelers');
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

  