$(function() {
    window.onload = movieInfo;

        function movieInfo() {
            $.ajax({
                url: "././core/getmovie.php",
                type: "GET",
                dataType: "json",
                success: function(res) {
                  console.log(res[0][1]);
                  console.log("ajax request was a success");


                  // console.log("Beginning of data\n" + data + "\nendof");
                  document.getElementById('moviename').innerHTML = res[0][1];

                  if(res.indexOf("Could not connect: ") != -1)
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
                   

                    
                    // // if(data.indexOf("Batman") != -1)
                    // // {
                    // //   console.log("\nthis works");
                    // // }
                    // $.ajax({
                    //     url: "././core/destroysession.php",
                    //     type: "POST",
                    //     success: function(){
                    //       console.log("Should have destroyed php session");
                    //     }
                    //   }
                    // );

                    
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
                error: function(res) {
                  console.log("ajax request had a failure" + res);

                },
            })
        };

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});

// When clicking on Full hide fail/success boxes
$('#name').focus(function() {
    $('#success').html('');
});
