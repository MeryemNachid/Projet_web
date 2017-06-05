<?php
session_start();
header("Location: index.php");

if(isset($_SESSION['userSession']))
	unset($_SESSION['userSession']);
unset($_SESSION);
session_destroy();
