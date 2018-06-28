// when page is loaded
$(document).ready(function() {
  // bind a keyup listener to the confirm password text box
  $("input[id=confirm_password]").keyup(function() {
    canRegister(checkPassword(), checkLengths());
  });

  // bind a keyup listener to the password text box
  $("input[id=password]")
    .keyup(function() {
      canRegister(checkPassword(), checkLengths());
    })
    .focus(function() {
      // show and hide the password info box when the password text box is or is not selected
      $("#pswd_info").show();
    })
    .blur(function() {
      $("#pswd_info").hide();
    });

  $("input[id=username]")
    .keyup(function() {
      canRegister(checkPassword(), checkLengths());
    });

  $("input[id=firstname]")
    .keyup(function() {
      canRegister(checkPassword(), checkLengths());
    });

  $("input[id=lastname]")
  .keyup(function() {
    canRegister(checkPassword(), checkLengths());
  });
});

function checkPassword() {
  // set password variable
  var password = $("input[id=password]").val();
  var length = false;
  var letter = false;
  var capital = false;
  var number = false;
  var confirm = $("input[id=confirm_password]").val();
  var matching = false;

  // check if the entered passwords match
  if (confirm == password) {
    $("#confirm_password")
      .removeClass("nomatch")
      .addClass("match");
    matching = true;
  } else {
    $("#confirm_password")
      .removeClass("match")
      .addClass("nomatch");
    matching = false;
  }

  // validate the length
  if (password.length < 8) {
    $("#length")
      .removeClass("valid")
      .addClass("invalid");
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
      number = false;
  }

  if (length && letter && capital && number && matching) {
    return true;
  } else {
    return false;
  }
}

// Backup check, for if something goes wrong on the html form.
function checkLengths() {
  var username = $("input[id=username]").val();
  var firstname = $("input[id=firstname]").val();
  var lastname = $("input[id=lastname]").val();

  if (username.length < 20 && firstname.length < 20 && lastname.length < 20) {
    return true;
  } else {
    return false;
  }
}

function canRegister(checkOne, checkTwo) {
  if (checkOne && checkTwo) {
    document.getElementById("register").disabled = false;
  } else {
    document.getElementById("register").disabled = true;
  }
}