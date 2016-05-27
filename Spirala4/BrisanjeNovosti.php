<?php
	$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
	$veza->exec("set names utf8");
	$upit = $veza->query("delete from novosti where id='".$_REQUEST	['id']."'");
	header("Location: prva.php");
?>