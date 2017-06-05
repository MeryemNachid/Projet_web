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
					<li><a href="#">Home</a></li>
					<li><a href="#">Photographers</a></li>
					<li><a href="#">Blog</a></li>
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
	
	<div class="container">
		<div id="hero-image">
			<div class="wrapper">
				<h2><strong>Discover</strong><br/></h2>
				<h3>numerous photography services.</h3>
				<a href="#" class="button-1">Get Started</a>
			</div>
		</div>
		
		<div id="features">
			<div class="wrapper">

				<ul>
					<li class="feature-1">
						<h4>What kind of service are you looking for?</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis turpis ac libero interdum, id fringilla purus feugiat. Etiam malesuada mattis nibh at bibendum.</p>
					</li>
					<li class="feature-2">
						<h4>Choose your photographer</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis turpis ac libero interdum, id fringilla purus feugiat. Etiam malesuada mattis nibh at bibendum.</p>
					</li>
					<li class="feature-3">
						<h4>Get in touch</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mollis turpis ac libero interdum, id fringilla purus feugiat. Etiam malesuada mattis nibh at bibendum.</p>
					</li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		
		<div id="cta">
			<div class="wrapper">
				<h3>Does it please to you?</h3>
				<p>Then call us to talk about what your needs are, or simply subscribe to our newsletter. </p>
			</div>
		</div>

	</div>

	<footer>
				<p>Copyright-2017 CompanyName. All rights reserved.</p>
				<p><a href="#">Terms of Service</a> I <a href="#">Privacy</a></p>
	</footer>
    
</body>
</html>