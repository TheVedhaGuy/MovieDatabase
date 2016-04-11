$(':radio').change(
  function(){

    var newRating = this.value;
    var movieName = $("#moviename").text;
    var url = window.location.href;
    var regex = url.match(/movieID=(\d+)/i);
    var movieId = regex[1];

    // $('.choice').text(newRating + ' stars\n' + newRating + "\nmovieId:" + movieId);

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    var dateString= mm + "-" + dd + "-" + yyyy;

    // alert(newRating + ' stars\n' + newRating + "\n" + movieId + "\n" + dateString);
    $.ajax({
        url: "././core/updateRating.php",
        type: "POST",
        data: {
            movieId: movieId,
            rating: newRating,
            date: dateString,
        },
          success: function(data) {
            console.log("Beginning of data\n" + data + "\nendof");
            $(".choice").text("Thanks for Rating!");
          }

      });
  }
);

// $("#rating").mouseover(function(){
//   alrt("lol");
// }
// )
