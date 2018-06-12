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
      if (selected.length>=parseInt(maxselected)){
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
     if(selected.length<parseInt(maxselected)){
         alert("Selecteer "+parseInt(maxselected)+" spelers");
     }
     else{
        
        $('#deselect-all').fadeOut();
    
        $.ajax({
          type: "GET",
          url: "generate_match.php",
          data: {selected : selected},
          success: function(data){
              $('#fillable').empty();
              $('#fillable').html(data);
          }     
        });


     }
    
    })

  