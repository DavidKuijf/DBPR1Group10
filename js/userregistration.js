var matching = false;

// when page is loaded
$(document).ready(function() {
  // bind a keyup listener to the confirm password text box
  $("input[id=confirm_password]").keyup(function() {
    // set password variable
    var confirm = $(this).val();

    // check if the entered passwords match
    if (confirm == document.getElementById("password").value) {
      $("#confirm_password")
        .removeClass("nomatch")
        .addClass("match");
      matching = true;
    } else {
      $("#confirm_password")
        .removeClass("match")
        .addClass("nomatch");
      document.getElementById("register").disabled = true;
    }

    checkPassword();
  });

  // bind a keyup listener to the password text box
  $("input[id=password]")
    .keyup(function() {
      checkPassword();
    })
    .focus(function() {
      // show and hide the password info box when the password text box is or is not selected
      $("#pswd_info").show();
    })
    .blur(function() {
      $("#pswd_info").hide();
    });
});

function checkPassword() {
  // set password variable
  var password = $("input[id=password]").val();
  var length = false;
  var letter = false;
  var capital = false;
  var number = false;

  // validate the length
  if (password.length < 8) {
    $("#length")
      .removeClass("valid")
      .addClass("invalid");
    document.getElementById("register").disabled = true;
    length = false;
  } else {
    $("#length")
      .removeClass("invalid")
      .addClass("valid");
    length = true;
  }

  // validate letter
  if (password.match(/[A-z]/)) {
    $("#letter")
      .removeClass("invalid")
      .addClass("valid");
    letter = true;
  } else {
    $("#letter")
      .removeClass("valid")
      .addClass("invalid");
    document.getElementById("register").disabled = true;
    letter = false;
  }

  // validate capital letter
  if (password.match(/[A-Z]/)) {
    $("#capital")
      .removeClass("invalid")
      .addClass("valid");
    capital = true;
  } else {
    $("#capital")
      .removeClass("valid")
      .addClass("invalid");
    document.getElementById("register").disabled = true;
    capital = false;
  }

  // validate number
  if (password.match(/\d/)) {
    $("#number")
      .removeClass("invalid")
      .addClass("valid");
      number = true;
    } else {
      $("#number")
        .removeClass("valid")
        .addClass("invalid");
      document.getElementById("register").disabled = true;
      number = false;
  }

  if (length && letter && capital && number && matching) {
    document.getElementById("register").disabled = false;
  }
}

