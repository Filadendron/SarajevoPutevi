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
	$upit1 = $veza->query("select naslov,tekst,datumobjave,autor_id,otvorena from novosti where id='".$_REQUEST['id']."'");
		    if (!$upit1) {
		          $greska = $veza->errorInfo();
		          print "SQL greška: " . $greska[2];
		          exit();
		     }
	$novost=$upit1->fetch(PDO::FETCH_ASSOC);
	if($novost['otvorena']=="1"){
		//zatvori
		$upit2=$veza->query("update novosti set otvorena=0 where id='".$_REQUEST['id']."'");
	}
	else{
		//otvori
		$upit2=$veza->query("update novosti set otvorena=1 where id='".$_REQUEST['id']."'");
	}
	header("Location: NovostDetaljno.php?id=".$_REQUEST['id']);
?>