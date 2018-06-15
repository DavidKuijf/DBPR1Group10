//add a listener for when the loginForm gets submitted
$("#loginForm").submit(function(event) {
  //prevent the actual event
  event.preventDefault();
  //instead make an ajax request to login php with the form data
  var formData = $("#loginForm").serialize();
  $.ajax({
    type: "POST",
    url: "login.php",
    data: formData,
    success: function(result) {
      if (result == "success") {
        //if successfull the overlay dissapears
        $("#overlay").css({ display: "none" });
      
      }
      if (result == "fail") {
        //else show this message
        $("#message").html("incorrect username an/or password");
      }
    }
  });
});

//add a listener for the nav bar
$("#makeAccountButton").click(function() {
  window.location.assign("user_register.php");
});
