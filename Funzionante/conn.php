<?php
	$myServer ="localhost";
	$myUser="perprova";
	$myPass="pucrunamca71";
	$myDB="my_perprova";
	
	//connessione
	$dbhandle = mysql_connect ($myServer,$myUser,$myPass)
	or die("couldn't connect to SQL server on $myServer");
	
	//seleziona database
	$selected = mysql_select_db($myDB,$dbhandle)
	or die("couldn't open database $myDB");
?>