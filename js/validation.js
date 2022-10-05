// Login
$(document).ready(function(){
  $("#login").validate({
    // Specify validation rules
    rules: {
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
    },
    messages: {
      password: {
        required: "Please provide a password",
      },
      email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

// Register
$(document).ready(function(){
  $("#register").validate({
    // Specify validation rules
    rules: {
      fname: "required",
      lname: "required",
      address : "required",
      contactno : "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      cpassword: {
        equalTo: "#password"
      },
      "agree": {
        required: true,
        minlength: 1
      },
    },
    messages: {
      fname: "Please enter your first name",
      lname: "Please enter your last name",
      "agree": " You must agree with our Terms and Conditions",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      cpassword: {
        required: "Your both passwords should match"
      },
      email: "Please enter a valid email address"    
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});