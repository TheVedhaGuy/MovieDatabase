<?php
  //Start the session
  session_start();
  print_r($_SESSION);

  $movieId = $_GET['movieId'];

  include 'core/db.php';
  //Test Query for now
  $query = "SELECT * FROM Movie m WHERE m.movieId='$movieId'";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $movieInfo = pg_fetch_assoc($result);

  // $query = "SELECT * FROM Movie m WHERE m.movieId='$movieId'";
  // $average_rating

  $query =
    "SELECT D.FirstName, D.LastName, D.DirectorId
    FROM Director D, Directs R, Movie M
    WHERE D.DirectorID=R.DirectorID AND R.MovieID=M.MovieID AND M.MovieID='$movieId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $directorInfo = pg_fetch_assoc($result);


  $query="SELECT AVG(W.Rating) AS rating
          FROM Movie M, Watches W
          WHERE W.MovieId=M.MovieId AND M.MovieId='$movieId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $tempArr = pg_fetch_assoc($result);
  $averageRating=$tempArr['rating'];
  $rating=round($averageRating);

  $query="SELECT A.ActorId, A.lastname, A.firstname FROM Actor A, Movie M, ActorStars S
  WHERE A.ActorId=S.ActorId AND M.MovieId=S.MovieId AND M.MovieId='$movieId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $actors = pg_fetch_all($result);
  // print_r($actors);
  // $query="SELECT ";

  $query = "SELECT S.Name FROM Movie M, Studio S, Sponsors P
            WHERE M.MovieID=P.MovieID AND S.StudioID=P.StudioID AND M.MovieID='$movieId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $studio = pg_fetch_assoc($result);
  // print_r($studio);

  $query = "SELECT T.Descirption FROM Movie M, Topics T, MovieTopics R
            WHERE M.MovieID=R.MovieID AND T.TopicId=R.TopicId AND M.MovieID='$movieId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $topics = pg_fetch_all($result);
  // print_r($topics);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $movieInfo["name"];?></title>

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
                      <a href="#page-top"></a>
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
                    <?php echo $movieInfo['name'];?>
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
                        <!-- <a href="<?php echo $movieInfo['trailerlink']?>"> -->
                        <a href="<?php echo $movieInfo['trailerlink']?>">
                          <img src="img/portfolio/<?php echo $movieId;?>/a.jpg">
                        </a>
                    </div>

                    <div class="item">
                      <a href="<?php echo $movieInfo['trailerlink']?>">
                        <img src="img/portfolio/<?php echo $movieId;?>/b.jpg">
                      </a>
                    </div>

                    <div class="item">
                      <a href="<?php echo $movieInfo['trailerlink']?>">
                        <img src="img/portfolio/<?php echo $movieId;?>/c.jpg">
                      </a>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-md-4">
                <h3>Movie Details</h3>
                <ul>
                    <li>
                      <strong id="#studioLabel" class="choice">Production Studio:</strong>
                      <p>
                        <?php echo $studio['name'];?>
                      </p>
                    </li>
                    <li>
                      <strong id="#releasedate" class="choice">Release date:</strong>
                      <p>
                        <?php echo $movieInfo['releasedate'];?>
                      </p>
                    </li>
                    <li>
                      <strong id="#ratingItem" class="choice">Average Rating</strong>
                      <p>
                        <!-- <strong class="choice">Choose a rating</strong> -->
                        <div class="stars" id="rating">
                          <form action="">
                            <input class="star star-5" id="star-5" type="radio" name="star" value="5" <?php if($rating==5){echo "checked";} ?>/>
                            <label class="star star-5" for="star-5"></label>
                            <input class="star star-4" id="star-4" type="radio" name="star" value="4" <?php if($rating==4){echo "checked";} ?>/>
                            <label class="star star-4" for="star-4"></label>
                            <input class="star star-3" id="star-3" type="radio" name="star" value="3" <?php if($rating==3){echo "checked";} ?>/>
                            <label class="star star-3" for="star-3"></label>
                            <input class="star star-2" id="star-2" type="radio" name="star" value="2" <?php if($rating==2){echo "checked";} ?>/>
                            <label class="star star-2" for="star-2"></label>
                            <input class="star star-1" id="star-1" type="radio" name="star" value="1" <?php if($rating==1){echo "checked";} ?>/>
                            <label class="star star-1" for="star-1"></label>
                          </form>
                        </div>
                      </p>
                    </li>
                    <li><strong id="#directorlabel" class="choice">Director:</strong>
                      <a href="DirectorPage.php?directorId=<?php echo $directorInfo['directorid'];?>">
                        <p>
                          <?php echo $directorInfo['firstname'] . " " . $directorInfo['lastname'];?>
                        </p>
                      </a>
                    </li>
                    <li><strong id="#topicsLabel" class="choice">Topics:</strong>
                        <p>
                          <ul>
                          <?php
                          if(!empty($topics))
                          {
                            foreach($topics as $topic)
                            {
                              $description = $topic['descirption'];
                              echo "<li>$description</li>";
                            }
                          }
                          else {
                            echo "None at the moment =P";
                          }
                          ?>
                        </ul>
                        </p>
                    </li>

                </ul>
            </div>
            <div class="col-lg-8">
                <h3>Description</h3>
                <p><?php echo $movieInfo['description'];?></p>
            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">



            <div class="col-lg-12">
                <h3 class="page-header">Cast</h3>
            </div>

            <?php
              foreach($actors as $actor)
              {
                $actorid = $actor['actorid'];
                $name = $actor['firstname'] . " " . $actor['lastname'];
                echo "<div class=\"col-sm-3 col-xs-6\">
                    <a href=\"ActorPage.php?actorId=$actorid\">
                        <img class=\"img-responsive portfolio-item\" src=\"img/actorPics/$actorid.jpg\" alt=\"http://placehold.it/500x300\"  onError=\"this.onerror=null;this.src='http://placehold.it/500x300';\">
                        <P>$name</p>
                    </a>
                </div>";
              }

             ?>
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
        <!-- /.footer -->


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

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-top page-scroll visible-xs visible-sm">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

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
