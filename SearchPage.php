<?php
  //Start the session
  session_start();
  // print_r($_SESSION);

  //Test Query for now

  // include 'core/db.php';
  // //Test Query for now
  // $query = "SELECT * FROM Movie m WHERE m.movieId='$movieId'";
  // $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  // $movieInfo = pg_fetch_assoc($result);

  // // $query = "SELECT * FROM Movie m WHERE m.movieId='$movieId'";
  // // $average_rating

  // $query =
  //   "SELECT D.FirstName, D.LastName, D.DirectorId
  //   FROM Director D, Directs R, Movie M
  //   WHERE D.DirectorID=R.DirectorID AND R.MovieID=M.MovieID AND M.MovieID='$movieId';";
  // $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  // $directorInfo = pg_fetch_assoc($result);


  // $query="SELECT AVG(W.Rating) AS rating
  //         FROM Movie M, Watches W
  //         WHERE W.MovieId=M.MovieId AND M.MovieId='$movieId';";
  // $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  // $tempArr = pg_fetch_assoc($result);
  // $averageRating=$tempArr['rating'];
  // $rating=round($averageRating);

  // $query="SELECT A.ActorId, A.lastname, A.firstname FROM Actor A, Movie M, ActorStars S
  // WHERE A.ActorId=S.ActorId AND M.MovieId=S.MovieId AND M.MovieId='$movieId';";
  // $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  // $actors = pg_fetch_all($result);
  // // print_r($actors);
  // // $query="SELECT ";

  // $query = "SELECT S.Name FROM Movie M, Studio S, Sponsors P
  //           WHERE M.MovieID=P.MovieID AND S.StudioID=P.StudioID AND M.MovieID='$movieId';";
  // $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  // $studio = pg_fetch_assoc($result);
  // print_r($studio);

  // $query = "SELECT T.Descirption FROM Movie M, Topics T, MovieTopics R
  //           WHERE M.MovieID=R.MovieID AND T.TopicId=R.TopicId AND M.MovieID='$movieId';";
  // $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
  // $topics = pg_fetch_all($result);
  // // print_r($topics);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo "Search Page";?></title>

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
                      <a href="#WillGoToTheAccountPage">My Account</a>
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

    </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

    <section id="search">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8 col-lg-offset-2">
                     <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                     <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                     <form name="sentMessage" id="searchForm" novalidate>
                         <div class="row control-group">
                             <div class="form-group col-xs-12 floating-label-form-group controls">
                                 <label>Movies</label>
                                 <input type="text" class="form-control" placeholder="Movie Search" id="moviesearch" name="moviesearch" required data-validation-required-message="Please enter your username.">
                                 <p class="help-block text-danger"></p>
                             </div>
                         </div>
                         <div class="row control-group">
                             <div class="form-group col-xs-12 floating-label-form-group controls">
                                 <label>Actors</label>
                                 <input type="text" class="form-control" placeholder="Actor Search" id="actorsearch" name="actorsearch" required data-validation-required-message="Please enter your password.">
                                 <p class="help-block text-danger"></p>
                             </div>
                         </div>
                         <!-- <div class="row control-group">
                             <div class="form-group col-xs-12 floating-label-form-group controls">
                                 <label>Search Actors</label>
                                 <input type="text" class="form-control" placeholder="Search Actors" id="actorsearch" name="actorsearch" >
                             </div>
                         </div>
                         <div class="row control-group">
                             <div class="form-group col-xs-12 floating-label-form-group controls">
                                 <label>Search Studio</label>
                                 <input type="text" class="form-control" placeholder="Search Studio" id="studiosearch" name="studiosearch" >
                             </div>
                         </div>
                         <div class="row control-group">
                             <div class="form-group col-xs-12 floating-label-form-group controls">
                                 <label>Search Directors</label>
                                 <input type="text" class="form-control" placeholder="Search Directors" id="directorsearch" name="directorsearch">
                             </div>
                         </div> -->
                         <br>
                         <div id="success"></div>
                         <div class="row">
                             <div class="form-group col-xs-12">
                                 <button type="submit" class="btn btn-success btn-lg">Search Movies</button>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>

     <div id="results">


     </div>

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

        <hr>

        <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
        <div class="scroll-top page-scroll visible-xs visible-sm">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

    </div>
    <!-- /.container -->
    <script src="js/jquery.js"></script>

     <!-- Bootstrap Core JavaScript -->
     <script src="js/bootstrap.min.js"></script>
     <script src="js/search.js"></script>
     <!-- Plugin JavaScript -->
     <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
     <script src="js/classie.js"></script>
     <script src="js/cbpAnimatedHeader.js"></script>

     <!-- Signin Form JavaScript -->
     <script src="js/jqBootstrapValidation.js"></script>
     <script src="js/signin.js"></script>

     <!-- Custom Theme JavaScript -->
     <script src="js/freelancer.js"></script>
     <script src="js/custom.js"></script>

</body>

</html>
