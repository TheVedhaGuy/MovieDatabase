$(function() {

    $("#signInForm input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            // Prevent spam click and default submit behaviour
            $("#btnSubmit").attr("disabled", true);
            event.preventDefault();

            // get values from FORM
            var username = $("input#username").val();
            var password = $("input#password").val();

            console.log("js received " + username + " and " + password);

            $.ajax({
                url: "././core/connect.php",
                type: "POST",
                data: {
                    username: username,
                    password: password,
                },

                cache: false,
                success: function(data) {
                  console.log("ajax request was a success");
                  console.log("Beginning of data\n" + data + "\nendof");

                  if(data === "false")
                  {
                      console.log("Incorrect username/password");
                      $('#success').html("<div class='alert alert-danger'>");
                      $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                          .append("</button>");
                      $('#success > .alert-danger').append("<strong>Incorrect username/password combination.  Please try again ;P");
                      $('#success > .alert-danger').append('</div>');
                      //clear all fields
                      $('#contactForm').trigger("reset");
                  }
                  else if(data.indexOf("Could not connect: ") != -1)
                  {
                    console.log("Could not connect to database");
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Incorrect username/password combination.  Please try again ;P");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm').trigger("reset");
                  }
                  else {
                    // Enable button & show success message
                    $("#btnSubmit").attr("disabled", false);

                    window.location="movies.php";
                  }

                    // $('#success').html("<div class='alert alert-success'>");
                    // $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                    //     .append("</button>");
                    // $('#success > .alert-success')
                    //     .append("<strong>Your message has been sent. </strong>");
                    // $('#success > .alert-success')
                    //     .append('</div>');
                    //
                    // //clear all fields
                    // $('#contactForm').trigger("reset");
                },
                error: function(data) {
                  console.log("ajax request had a failure" + data);
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + username + ", it seems that my mail server is not responding. Hope you have more luck next time xD!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm').trigger("reset");
                },
            })
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

// When clicking on Full hide fail/success boxes
$('#name').focus(function() {
    $('#success').html('');
});
