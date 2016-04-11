<?php
  //Start the session
  session_start();
  // print_r($_SESSION);

  $userId = $_SESSION['username'];

  include 'core/db.php';
  //Test Query for now
  $query = "SELECT * FROM Users U WHERE U.userId='$userId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $userInfo = pg_fetch_assoc($result);

  $query = "SELECT M.MovieId, M.Name, W.Rating FROM Users U, Watches W, Movie M WHERE U.userId=W.userid AND W.MovieId=M.MovieId AND U.userid='$userId';";
  $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  $movieRatings = pg_fetch_all($result);

  // print_r($movieRatings);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $userInfo["firstname"] . " " . $userInfo["lastname"];?></title>

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
                      <a href="UserPage?userId="<?php echo $userId;?>>My Account</a>
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
                    <?php echo $userInfo['firstname'] . " " . $userInfo['lastname'];?>
                    <!-- <small id = ""> </small> -->
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row" align="center">
            <p id="ratings"></p>
            <table style="width:60%" align="center">
              <h2>Movie Ratings</h2>
              <tr>
                <th><h4>Movie</h4></th>
                <th><h4>Rating</h4></th>
              </tr>
              <?php
                if(!empty($movieRatings))
                {
                  foreach($movieRatings as $movieRating)
                  {
                    $movieId = $movieRating['movieid'];
                    $movieName = $movieRating['name'];
                    $rating = $movieRating['rating'];
                    echo "<tr><td><a href=\"MoviePage.php?movieId=$movieId\"><h4>$movieName</h4></a></td><td>$rating</td></tr>";
                  }
                }
              ?>
            </table>



        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

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
