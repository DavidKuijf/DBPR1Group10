var amountOfPlayers;
//add click listener to the button at the bottom of the form
$("#optionButton").click(function() {
  amountOfPlayers = $("#deelnemersInput").val();
  $.ajax({
    type: "POST",
    url: "user_select.php",
    data: { amountOFPlayers: amountOfPlayers },
    success: function(data) {
      $("#fillable").html(data);
      $("#tournamentOptionForm").hide();
    }
  });

  //hide the first set of buttons to prevent double nav bar
  $("#home").hide();
  $("#log-out").hide();
  $("#create-user").hide();
});

var selected = [];
//make the list a multislect list
$("#selectableUserList").multiSelect({
  //set the headers at the top
  selectableHeader: "<div class='custom-header'>Beschikbare spelers</div>",
  selectionHeader: "<div class='custom-header'>Gekozen spelers</div>",

  //after selecting something add it to the list and check if we havent reached the player cap
  afterSelect: function(values) {
    selected.push(values[0]);
    if (selected.length >= parseInt(amountOfPlayers)) {
      $("#selectableUserList").attr("disabled", "disabled");
      $("#selectableUserList").multiSelect("refresh");
    }
  },

  //after deselecting remove it from the list
  afterDeselect: function(values) {
    var index = selected.indexOf(values[0]);
    if (index > -1) {
      selected.splice(index, 1);
    }
  }
});

//add a listener to the deselect all button to deselect all and empty the list
$("#deselectAll").click(function() {
  $("#selectableUserList").multiSelect("deselect_all");
  $("#selectableUserList").removeAttr("disabled", "disabled");
  $("#selectableUserList").multiSelect("refresh");
  selected = [];
  return false;
});

//add a listener to the stop button to redirect to index.php
$("#stop").click(function() {
  window.location.replace("index.php");
});

//add a listener to the ok button to check if the correct amount of players have been selected and then
//make an ajax call to tournament_generation to do all the generation stuff after that redirect to the match selection screen
$("#ok").click(function() {
  if (selected.length < parseInt(amountOfPlayers)) {
    alert("Selecteer " + parseInt(amountOfPlayers) + " spelers");
  } else {
    $.ajax({
      type: "GET",
      url: "tournament_generation.php",
      data: { selected: selected },
      success: function(data) {
        console.log("clicked");
        window.location.replace("upcomingmatchselection.php"); 
        
      }
    });
    
  }
});


//add a bunch of nav bar listeners
$("#create-user").click(function() {
  window.location.replace("user_register.php");
});

$("#createuser").click(function() {
  window.location.replace("user_register.php");
});

$("#logout").click(function() {
  window.location.replace("logout.php");
});

$("#log-out").click(function() {
  window.location.replace("logout.php");
});
