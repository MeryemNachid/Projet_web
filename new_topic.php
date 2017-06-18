<?php 
include("dbconnect.php");
	if ($_POST) {
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$content = isset($_POST['content']) ? $_POST['content'] : false;
				$title = isset($_POST['title']) ? $_POST['title'] : false;
				$id_author=$_SESSION['userSession'];}

				$datenow= date("Y-m-d H:i:s");
				$stmt = $DBcon->prepare("INSERT INTO thread (id_author,date_creation,title,nbr_post,last_post) VALUES ('$id_author','$datenow',?,0,'$datenow')");
				$stmt->bind_param("s", $param);
				$param=$title;
				$stmt->execute();
				$stmt->close();
				
				$req = $DBcon->query("SELECT MAX(id_thread) as id_topic FROM thread");
				$row = $req->fetch_assoc();
				$id_topic = $row['id_topic'];

				$stmt = $DBcon->prepare("INSERT INTO post (id_author,date_creation,id_thread,content,rate) VALUES ('$id_author','$datenow','$id_topic',?,0)");
				$stmt->bind_param("s", $param);
				$param=$content;
				$stmt->execute();
				$stmt->close();
				
			header('Location: topic.php?id_topic=' .$id_topic,true,303);
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
	<div>
		<h3>Create a new topic</h3>
		<?php 
			if(!(isset($_SESSION['userSession'])) || $_SESSION['userSession']==''){
			?>
				<div id="post_1">
				<a href="login.php">Please Sign in/Sign up to create a new topic</a>
				</div>
			<?php
			} else {
			?>
				<div id="post_2">
					<form method="post">
						<h5>Title:</h5> <input type="text" name="title" size="53" required><br>
						<h5>Post:</h5>
						<textarea name="content" autocomplete="off" wrap="hard" rows="10" required></textarea>
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