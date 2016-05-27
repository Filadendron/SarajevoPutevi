<?php
	$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
	$veza->exec("set names utf8");
	$upit2 = $veza->query("delete from komentarikomentara where id_komentara='".$_REQUEST['idk']."'");
	if (!$upit2) {
		          $greska = $veza->errorInfo();
		          print "SQL greška: " . $greska[2];
		          exit();
		     }
	$upit1 = $veza->query("delete from komentari where id='".$_REQUEST['idk']."'");
	if (!$upit1) {
		          $greska = $veza->errorInfo();
		          print "SQL greška: " . $greska[2];
		          exit();
		     }
	
	header("Location: NovostDetaljno.php?id=".$_REQUEST['id']);
?>