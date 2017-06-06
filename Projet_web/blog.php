<?php
include("dbconnect.php");
?>






<html>

	<head>
		<meta charset="utf-8">
		<title>Blog</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<link href="css/blog.css" rel="stylesheet">
	</head>

	<body>
		<header>
		<div class="wrapper">
			<h1>Slogan<span class="color">.</span></h1>
			<nav>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Photographers</a></li>
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
		<div class="container">	
			<div class="row" id="search">
				<!-- SEARCH -->
				<div class="col-lg-4">
					<form method="post">
					<input class='button_1' name="search" type="search" placeholder="Search all topics" autocomplete="off"></input>
					<input name="set" type="submit"></input>
					</form>
				</div>
				<!--CREATE NEW TOPIC-->
				<div class="col-lg-2">
					<input class="button_2" value="Create new topic" type="button"></input>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-offset-2 col-lg-3">
					<h3>Rules</h3>
				</div>
			</div>



			<div class="row" id="rules">
			<div class="row-heigth">
				<?php
				$rules = $DBcon->query("SELECT nom, title, nbr_post, last_post FROM thread LEFT JOIN users ON thread.id_author=users.code WHERE id_thread=0");
				$rules = $rules->fetch_assoc();
				?>

				<div class="col-lg-offset-2 col-lg-4 col-height title">
				<div class="inside inside-full-height">
				<?php
				print '<form method="post" action="topic.php">
    			<input type="hidden" name="id_topic" value=0>
    			<input type="submit" class="button_3" value="'.$rules["title"].'">
				</form>'
				?>
				</div>
				</div>

				<div class="col-lg-1 col-height">
				<div class="inside inside-full-height">
				<?php
				print '<p>'.$rules["nbr_post"].'</p>';
				?>
				</div>
				</div>

				<div class="col-lg-1 col-height">
				<div class="inside inside-full-height">
				<?php
				print '<p>'.$rules["nom"].'</p>';
				?>
				</div>
				</div>

				<div class="col-lg-2 col-height">
				<div class="inside inside-full-height">
				<?php
				print '<p>'.$rules["last_post"].'</p>';
				?>
				</div>
				</div>
			</div>
			</div>
			<?php
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$SEARCH = isset($_POST['search']) ? $_POST['search'] : false;}

			if ($SEARCH!=''){

				print '<div class="row" id="last">
				<div class="col-lg-offset-2 col-lg-4">
					<h3>Search '.$SEARCH.'</h3>
				</div>
			</div>';
				/*$query = "SELECT nom, title, nbr_post, last_post FROM thread LEFT JOIN users ON thread.id_author=users.code WHERE title LIKE ? ORDER BY last_post DESC";
				$stmt = $DBcon->prepare($query);
				$stmt->mysqli_bind_param("s", $param);
				$param ="%".$SEARCH."%";
				print '<p>'.$param.'</p>';
				$stmt->mysqli_execute();
				$stmt->mysqli_bind_result($nom, $title, $nbr_post, $last_post);
				$max=$stmt->num_rows;
				print '<p>'.$max.'</p>';

				//$stmt = $DBcon->query("SELECT nom, title, nbr_post, last_post FROM thread LEFT JOIN users ON thread.id_author=users.code WHERE title LIKE CONCAT('%','$SEARCH','%') ORDER BY last_post DESC");
				print_r($stmt);
				$row=$stmt->fetch_assoc();
				print '<p>'.$row["title"].'</p>';*/
				$results = $DBcon->query("SELECT nom, title, nbr_post, last_post, id_thread FROM thread LEFT JOIN users ON thread.id_author=users.code WHERE title LIKE CONCAT('%','$SEARCH','%') ORDER BY last_post DESC");
				$max=$results->num_rows;
			if ($max>10) {
				$max = 10;
			}
			for($i=0;$i<$max;$i++) {
				$row=$results->fetch_assoc();
				print '<div class="row results"><div class="row-heigth">';
				print '<div class="col-lg-offset-2 col-lg-4 col-height"><div class="inside inside-full-height">
				
				<form method="post" action="topic.php">
    			<input type="hidden" name="id_topic" value='.$row["id_thread"].'>
    			<input type="submit" class="button_3" value="'.$row["title"].'">
				</form>

				
				</div></div>

				<div class="col-lg-1 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["nbr_post"].'</p>
				
				</div></div>

				<div class="col-lg-1 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["nom"].'</p>
				
				</div></div>

				<div class="col-lg-2 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["last_post"].'</p>
				
				</div></div>';
				print '</div></div>';
			}
			}






			else {
			print '<div class="row" id="last">
				<div class="col-lg-offset-2 col-lg-4">
					<h3>Last</h3>
				</div>
			</div>';
			$results = $DBcon->query("SELECT nom, title, nbr_post, last_post, id_thread FROM thread LEFT JOIN users ON thread.id_author=users.code ORDER BY last_post DESC");
			$max=$results->num_rows;
			if ($max>10) {
				$max = 10;
			}
			for($i=0;$i<$max;$i++) {
				$row=$results->fetch_assoc();
				print '<div class="row results"><div class="row-heigth">';
				print '<div class="col-lg-offset-2 col-lg-4 col-height"><div class="inside inside-full-height">
				
				<form method="post" action="topic.php">
    			<input type="hidden" name="id_topic" value='.$row["id_thread"].'>
    			<input type="submit" class="button_3" value="'.$row["title"].'">
				</form>

				
				</div></div>

				<div class="col-lg-1 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["nbr_post"].'</p>
				
				</div></div>

				<div class="col-lg-1 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["nom"].'</p>
				
				</div></div>

				<div class="col-lg-2 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["last_post"].'</p>
				
				</div></div>';
				print '</div></div>';
			}
			}?>


		</div>
		<footer>
				<p>Copyright-2017 CompanyName. All rights reserved.</p>
				<p><a href="#">Terms of Service</a> I <a href="#">Privacy</a></p>
		</footer>
	</body>
</html>