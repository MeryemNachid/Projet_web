<?php
session_start();
require_once 'dbconnect.php';

if (isset($_SESSION['userSession'])!="") {
    header("Location: index.html");
    exit;
}
if(isset($_POST["signup"])) {
	$email = strip_tags($_POST['email']);
	$password = strip_tags($_POST['Password']);
	$passwordp = strip_tags($_POST['Password2']);
	$usr = strip_tags($_POST['username']);
//	print_r($_POST);

	$email = $DBcon->real_escape_string($email);
	$password = $DBcon->real_escape_string($password);
	$passwordp = $DBcon->real_escape_string($passwordp);
	$usr = $DBcon->real_escape_string($usr);

	if($email && $usr && $password && ($password == $passwordp) ) {
		$query = $DBcon->query("SELECT code, nom,email, password FROM users WHERE email='$email' or nom='$usr'");
		if($query->num_rows <= 0) {
			$query = $DBcon->query("INSERT INTO users (nom, password, email) VALUES ('$usr', '$password', '$email')");
		}
		else { echo "A user with this name or this email already exists";}
	}
	else { echo "Something has gone wrong";}

}

if (isset($_POST['login'])) {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    $email = $DBcon->real_escape_string($email);
    $password = $DBcon->real_escape_string($password);

    $query = $DBcon->query("SELECT code, nom, email, password FROM users WHERE email='$email'");
    $row=$query->fetch_array();
    $count = $query->num_rows; // if email/password are correct returns must be 1 row

    if (($password == $row['password']) && $count==1) {
        $_SESSION['userSession'] = $row['code'];
        $_SESSION['userNameSession'] = $row['nom'];
        header("Location: index.html");
        die();
    } 
    else { echo "Wrong username or password"; }
 
}
$DBcon->close();
?>

<html>
	<head>
		<title>Login and Signup Form </title>
		<!-- custom-theme -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Simple Login and Signup Form " />
		<!-- //custom-theme -->
		<link href="css/style2.css" rel="stylesheet" type="text/css" media="all" />
		<!-- js -->
		<script src="js/jquery-1.9.1.min.js"></script>
		<!--// js -->
		<link rel="stylesheet" type="text/css" href="css/easy-responsive-tabs.css " />
		<link href="//fonts.googleapis.com/css?family=Questrial" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
	</head>
<body class="bg agileinfo">
   <div class="w3layouts_main wrap">
    <!--Horizontal Tab-->
        <div id="parentHorizontalTab_agile">
            <ul class="resp-tabs-list hor_1">
                <li>LogIn</li>
                <li>SignUp</li>
            </ul>
            <div class="resp-tabs-container hor_1">
               <div class="w3_agile_login">
                    <form action="#" method="post" class="agile_form">
                    	<input type="hidden" name="login" value="true">
 					  <input type="email" name="email" placeholder="Email" required="required" />
					  <input type="password" name="password" placeholder="Password" required="required" class="password" /> 
					  <div class="check">
							<label class="checkbox w3l"><input type="checkbox" name="checkbox" required="required"><i> </i>I accept the terms and conditions</label>

					 </div>
					  <input type="submit" value="LogIn" class="agileinfo" />
					</form>
					 <div class="login_w3ls">
				        <a href="#">Forgot Password</a>
					 </div>
                    
                </div>
                <div class="agile_its_registration">
                    <form action="#" method="post" class="agile_form">
                   		<input type="hidden" name="signup" value="true">
					  <input type="text" name="username" placeholder="Username" required="required" />
					  <input type="email" name="email" placeholder="Email" required="required" />
					  <input type="password" name="Password" id="password1" placeholder="Password"  required="required">
					  
					  <input type="password" name="Password2" id="password2"  placeholder="Confirm Password" required="required">
         	  			<div class="check w3_agileits">
							<label class="checkbox w3"><input type="checkbox" name="checkbox" required="required" ><i> </i>I accept the terms and conditions</label>
						</div>
					   <input type="submit" value="Signup"/>
					   <input type="reset" value="annuler" />
					</form> 
				</div>
            </div>
        </div>
		 <!-- //Horizontal Tab -->
    </div>
	<!--tabs-->
<script src="JS/easyResponsiveTabs.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	//Horizontal Tab
	$('#parentHorizontalTab_agile').easyResponsiveTabs({
		type: 'default', //Types: default, vertical, accordion
		width: 'auto', //auto or any width like 600px
		fit: true, // 100% fit in a container
		tabidentify: 'hor_1', // The tab groups identifier
		activate: function(event) { // Callback function if tab is switched
			var $tab = $(this);
			var $info = $('#nested-tabInfo');
			var $name = $('span', $info);
			$name.text($tab.text());
			$info.show();
		}
	});
});
</script>
<script type="text/javascript">
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}
		function validatePassword(){
			var pass2=document.getElementById("password2").value;
			var pass1=document.getElementById("password1").value;
			if(pass1!=pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');	 
				//empty string means no validation error
		}

</script>
<!--//tabs-->
</body>
</html>

