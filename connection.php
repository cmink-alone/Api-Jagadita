<?php
    $host	= "sql12.freemysqlhosting.net";
    $user	= "sql12380289";
    $pass	= "NLWwmMZaP1";
    $db 	= "sql12380289";
    

	$conn = new mysqli($host, $user, $pass, $db);

	if ($conn->connect_errno) {
		die('Koneksi Error: '.$mysqli->connect_errno. ' - '. $mysqli->connect_error);
	}