// on loading the page
$(document).ready(function() {
  // bind 'click' listener to the 'loaduser' button
  $("#loaduser").on("click", function() {
    // get the index (index is the same as the id in the db) of the selected user and send a post request
    var e = document.getElementById("userlist");
    var selectedUser = e.options[e.selectedIndex].value;
    post("user.php", { id: selectedUser });
  });

  // set the selected index of the user selection box to the currently selected user
  document.getElementById("userlist").selectedIndex =
    document.getElementById("id").value - 1;
  // set the selected index of the skill selection box to the correct skill level
  document.getElementById(
    "skillselect"
  ).selectedIndex = document.getElementById("skill").innerHTML;
});

// create an invisible form which posts to 'path' with 'parameters'
function post(path, parameters) {
  var form = $("<form></form>");

  form.attr("method", "post");
  form.attr("action", path);

  $.each(parameters, function(key, value) {
    var field = $("<input></input>");

    field.attr("type", "hidden");
    field.attr("name", key);
    field.attr("value", value);

    form.append(field);
  });

  $(document.body).append(form);
  form.submit();
}
