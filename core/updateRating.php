<?php

  session_start();
  include 'db.php';

  // echo $_SESSION['username'];
  $user = $_SESSION['username'];
  $rating = $_POST['rating'];
  $date = $_POST['date'];
  $movie = $_POST['movieId'];

  $query = "INSERT INTO Watches (UserID, MovieID, WatchDate, Rating)
            VALUES ('$user','$movie', '$date', $rating);
            ";
  $query = "UPDATE Watches W SET RATING=$rating,watchdate='$date' WHERE w.movieId='$movie' AND w.userid='$user';
            INSERT INTO watches (UserID, MovieID, WatchDate, Rating)
	             SELECT '$user','$movie', '$date', $rating
               WHERE NOT EXISTS (SELECT 1 FROM watches w WHERE w.movieId='$movie' AND w.userid='$user');";

  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());


?>
