//For sending them off later

var selected = [];

$('#selectableUserList').multiSelect({
    selectableHeader: "<div class='custom-header'>Beschikbare spelers</div>",
    selectionHeader: "<div class='custom-header'>Gekozen spelers</div>",
    
    afterSelect: function(values){
      selected.push(values);
      if (selected.length==parseInt(maxselected)){
        $('#selectableUserList').attr('disabled','disabled');
        $('#selectableUserList').multiSelect('refresh');
      }
    }
    
  });

    
  $('#select-all').click(function(){
    $('#selectableUserList').multiSelect('select_all');
    return false;
  });

  $('#deselect-all').click(function(){
    $('#selectableUserList').multiSelect('deselect_all');
    return false;
  }); 
    
  $('#ok').click(function(){
    
    $('#hideable').hide();
    $.ajax({
      type: "GET",
      url: "testpage.php",
      data: {selected : selected},
      success: function(data){
          $('#fillable').html(data);
      }     
    });
    })

  