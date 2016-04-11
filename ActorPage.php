<?php
  //Start the session
  session_start();
  // print_r($_SESSION);

  $actorId = $_GET['actorId'];

  include 'core/db.php';
  //Test Query for now
  $query = "SELECT * FROM Actor A WHERE A.actorId='$actorId'";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $actorInfo = pg_fetch_assoc($result);

//returns all movies that director has been apart of
  // $query = "SELECT movieId FROM Directs WHERE directorId='$directorId'";

  $query = "SELECT M.MovieId, M.name FROM Movie M,ActorStars S
WHERE M.MovieId=S.MovieId AND S.actorId='$actorId';;";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $movies = pg_fetch_all($result);

  // print_r($directorInfo);
  // print_r($movies);

  // $query = "SELECT * FROM Movie m WHERE m.movieId='$movieId'";
  // $average_rating

  $query="SELECT AVG(W.Rating) AS avgrating
          FROM Movie M, Watches W, Actor A, ActorStars S
          WHERE M.MovieId=W.MovieID AND A.actorID=S.actorID AND M.MovieId=S.MovieId AND A.actorId='$actorId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());

  //Should only be one result so don't need to fetch all
  $rating = pg_fetch_assoc($result);
  // print_r($rating);
  $average_rating=$rating['avgrating'];
  $rating=round($average_rating);

  $query="SELECT M.MovieId, M.Name FROM Movie M, ActorStars S WHERE M.MovieId=S.MovieId AND S.actorid='$actorId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $movies = pg_fetch_all($result);
  // print_r($movies);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $actorInfo["firstname"] . " " . $actorInfo["lastname"];?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/portfolio-item.css" rel="stylesheet">
    <link href="css/thumbnail-gallery.css" rel="stylesheet">
    <link href="css/freelancer.css" rel="stylesheet">
    <link href="css/dbcustom.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="movies.php">Movie Database</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                  <li class="hidden">
                      <a href="movies.php"></a>
                  </li>
                  <li class="page-scroll">
                      <a href="actors.php">Actors</a>
                  </li>
                  <li class="page-scroll">
                      <a href="UserPage.php?userId=<?php echo $_SESSION['username'];?>">My Account</a>
                  </li>
                  <li class="page-scroll" id="signout">
                      <a href="index.php">Sign Out</a>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 id = "moviename" class="page-header">
                    <?php echo $actorInfo['firstname'] . "  " . $actorInfo['lastname'];?>
                    <!-- <small id = ""> </small> -->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">
            <p id="demo"></p>

            <div class="col-md-8">
                <!-- <img class="img-responsive" src="img/FrontWallpaper/bvs.jpg" alt="http://placehold.it/750x500"> -->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                          <img src="img/actorPics/<?php echo $actorId;?>.jpg">
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-md-4">
                <h3>Country</h3>
                  <p>  <?php echo $actorInfo['country'];?> </p>
                <!-- <h3>Movies Directed</h3>
                  <ul>
                    <?php
                      // foreach($movies as &$movie){
                      //   //print_r($movie);
                      //   echo "<li><a href=\"MoviePage.php?movieId=" . $movie['movieid'] . "\"><p>" . $movie['name'] . "</p></a></li>";
                      // }
                      ?>
                 </ul> -->
                 <h3>Average Rating For Movies</h3>
                 <p>
                   <!-- <strong class="choice">Choose a rating</strong> -->
                   <div class="stars" id="rating">
                     <form action="">
                       <input class="star star-5" id="star-5" type="radio" name="star" value="5" <?php if($rating==5){echo "checked";}else{echo "disabled";} ?>/>
                       <label class="star star-5" for="star-5"></label>
                       <input class="star star-4" id="star-4" type="radio" name="star" value="4" <?php if($rating==4){echo "checked";}else{echo "disabled";} ?>/>
                       <label class="star star-4" for="star-4"></label>
                       <input class="star star-3" id="star-3" type="radio" name="star" value="3" <?php if($rating==3){echo "checked";}else{echo "disabled";} ?>/>
                       <label class="star star-3" for="star-3"></label>
                       <input class="star star-2" id="star-2" type="radio" name="star" value="2" <?php if($rating==2){echo "checked";}else{echo "disabled";} ?>/>
                       <label class="star star-2" for="star-2"></label>
                       <input class="star star-1" id="star-1" type="radio" name="star" value="1" <?php if($rating==1){echo "checked";}else{echo "disabled";} ?>/>
                       <label class="star star-1" for="star-1"></label>
                     </form>
                   </div>
            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Movies</h3>
            </div>

            <?php
              foreach($movies as $movie)
              {
                $movieid = $movie['movieid'];
                $name = $movie['name'];
                echo "<div class=\"col-sm-3 col-xs-6\">
                    <a href=\"MoviePage.php?movieId=$movieid\">
                        <img class=\"img-responsive portfolio-item\" src=\"img/moviePos/$movieid.jpg\" alt=\"http://placehold.it/500x300\"  onError=\"this.onerror=null;this.src='http://placehold.it/500x300';\">
                        <P>$name</p>
                    </a>
                </div>";
              }
             ?>
<!--

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive portfolio-item" src="http://placehold.it/500x300" alt="">
                </a>
            </div> -->

        </div>
        <!-- /.row -->

        <!-- Footer -->
        <footer class="text-center">
            <div class="footer-below">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            Copyright &copy; Movie Database 2014
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-top page-scroll visible-xs visible-sm">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

        <!-- Video / Generic Modal -->
        <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <!-- content dynamically inserted -->
            </div>
          </div>
        </div>


        <hr>



    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/youtube.js"></script>
    <script src="js/rating.js"></script>
    <!-- <script src="js/getmovie.js"></script> -->

</body>

</html>
