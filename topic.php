<?php 
include("dbconnect.php");

	$id_topic = $_GET['id_topic'];
	$init = $DBcon->query("SELECT title FROM thread LEFT JOIN users ON thread.id_author=users.code WHERE id_thread=$id_topic");
	$init=$init->fetch_assoc();
	$title = $init['title'];

	if ($_POST['content']) {
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$content = isset($_POST['content']) ? $_POST['content'] : false;
				$id_author=$_SESSION['userSession'];}

				$datenow= date("Y-m-d H:i:s");
				//$DBcon->query("INSERT INTO post (id_author,date_creation,id_thread,content,rate) VALUES ('$id_author','$datenow','$id_topic','$content',0)");
				$stmt = $DBcon->prepare("INSERT INTO post (id_author,date_creation,id_thread,content,rate) VALUES ('$id_author','$datenow','$id_topic',?,0)");
				$stmt->bind_param("s", $param);
				$param=$content;
				$stmt->execute();
				$stmt->close();

				$req = $DBcon->query("SELECT MAX(date_creation) as last_post FROM post WHERE id_thread ='$id_topic'");
				$row = $req->fetch_assoc();
				$lastpost = $row['last_post'];
				$req = $DBcon->query("UPDATE thread SET nbr_post=nbr_post+1, last_post='$lastpost' WHERE id_thread='$id_topic'");				
			header('Location: '.$_SERVER['REQUEST_URI'],true,303);
			exit();
		}

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
	<div class="container">	
			<div class="row" id="search">
				<!-- SEARCH -->
				<div class="col-lg-4">
					<form method="post" action="blog.php">
					<input class='button_1' name="search" type="search" placeholder="Search all topics" autocomplete="off"></input>
					<input name="set" type="submit"></input>
					</form>
				</div>
				<!--CREATE NEW TOPIC-->
				<div class="col-lg-2">
					<input id="create_topic" class="button_2" value="Create new topic" type="button"></input>
					<script type="text/javascript">
    					document.getElementById("create_topic").onclick = function () {
        					location.href = "new_topic.php";
    					};
					</script>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-offset-2 col-lg-3">
					<h3><?php print $title; ?></h3>
				</div>
			</div>
			<?php
			$results = $DBcon->query("SELECT nom, date_creation, content, rate FROM post LEFT JOIN users ON post.id_author=users.code WHERE id_thread=$id_topic ORDER BY date_creation");
			$max=$results->num_rows;
			if ($max>10) {
				$max = 10;
			}
			for($i=0;$i<$max;$i++) {
				$row=$results->fetch_assoc();
				print '<div class="row results"><div class="row-heigth">';
				print '<div class="col-lg-offset-2 col-lg-2 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["nom"].'</p>
				<p>'.$row["date_creation"].'</p>
				
				</div></div>

				<div class="col-lg-5 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["content"].'</p>
				
				</div></div>

				<div class="col-lg-1 col-height"><div class="inside inside-full-height">
				
				<p>'.$row["rate"].'</p>
				
				</div></div>';
				print '</div></div>';
			}
				?>

		</div>

		<div>
		<?php 
							if(!(isset($_SESSION['userSession'])) || $_SESSION['userSession']==''){
								?>
								<div id="post_1">
								<a href="login.php">Please Sign in/Sign up to answer</a>
								</div>
								<?php
							} else {
								?>
								<div id="post_2">
								<form method="post">
									<textarea name="content" autocomplete="off" wrap="hard" rows="10" required></textarea>
									<?php print'<input type="hidden" name="id_topic" value='.$id_topic.'></input>'?>
									<input type="submit" value="Poster sur le blog"></input>
								</form>

								</div>
								<?php 
							}
				?>
		</div>






		<footer>
				<p>Copyright-2017 CompanyName. All rights reserved.</p>
				<p><a href="#">Terms of Service</a> I <a href="#">Privacy</a></p>
		</footer>
	</body>
</html>