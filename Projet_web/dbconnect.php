<?php

	 $DBhost = "localhost";
	 $DBuser = "pho";
	 $DBpass = "pho";
	 $DBname = "pho";
	 
	 $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);

     if ($DBcon->connect_errno) {
     	var_dump($DBcon);
         die("ERROR : -> ".$DBcon->connect_error);
     }
