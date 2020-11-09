<?php
	require_once "functions.php";
	$url = explode("/",$_SERVER['QUERY_STRING']);
	if ($url[0] == '') { include("home.php"); } else { include($url[0].".php"); }
?>
