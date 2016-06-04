<?php
	define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
	define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
	define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
	define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
	define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
	$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
	$veza = new PDO($dsn, DB_USER, DB_PASS);
	//$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
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