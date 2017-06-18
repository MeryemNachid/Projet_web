<?php
include("dbconnect.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Simply</title>
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
</head>

  <body>
    <header>
    <div class="wrapper">
      <h1>Slogan<span class="color">.</span></h1>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="photographers.php">Photographers</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li>
            <?php 
              if(!(isset($_SESSION['userSession'])) || $_SESSION['userSession']==''){
                ?>
                <a href="login.php">Sign in / Sign up</a>
                <?php
              } else {
                ?>
                <a href="logout.php">Sign out</a>
                <?php 
              }
            ?>
          </li>
        </ul>
      </nav>
    </div>
  </header>
      <section class="row">
        <div class="col-lg-2"><img src="images/logo.jpg" alt="test-image"> <a href="profil.php">coucou</a></div>
        <div class="col-lg-2"><img src="images/logo.jpg" alt="test-image"> <a href="profil.php">coucou</a></div>
        <div class="col-lg-2"><img src="images/logo.jpg" alt="test-image"> <a href="profil.php">coucou</a></div>
        <div class="col-lg-2"><img src="images/logo.jpg" alt="test-image"> <a href="profil.php">coucou</a></div>
        
        
      </section>
  <footer>
        <p>Copyright-2017 CompanyName. All rights reserved.</p>
        <p><a href="#">Terms of Service</a> I <a href="#">Privacy</a></p>
  </footer>
  </body>
</html>
