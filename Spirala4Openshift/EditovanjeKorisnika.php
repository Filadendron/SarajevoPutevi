<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stil1.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="skripta.js"></script>
	<script src="AjaxSkripta.js"></script>
	<title>Linkovi</title>
</head>
<body>
<?php
	session_start();
		if (isset($_SESSION['username'])) {
			define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
			define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
			define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
			define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
			define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
			$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
			$veza = new PDO($dsn, DB_USER, DB_PASS);
			//$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
	     		$veza->exec("set names utf8");
	     		$status = $veza->query("select status from users where username='".$_SESSION['username']."'");
			    if (!$status) {
			          $greska = $veza->errorInfo();
			          print "SQL greška: " . $greska[2];
			          exit();
			     }
			     $status2=$status->fetch(PDO::FETCH_ASSOC);

			if($status2['status']=='korisnik'){
				print'<div class="admindiv">';
				print'<ul class="adminlista">';
				print'<li class="adminmeni"><a href="UnosNovosti.php">Dodaj novost</a></li>';
				print'<li class="adminmeni"><a href="PromjenaSifre.php">Promijeni sifru</a></li>';
				print'<li class="adminmeni"><a href="Logout.php">Logout</a></li>';
				print'</ul>';
				print'</div>';
			}
			else if($status2['status']=='admin'){
				print'<div class="admindiv">';
				print'<ul class="adminlista">';
				print'<li class="adminmeni"><a href="UnosKorisnika.php">Dodaj korisnika</a></li>';
				print'<li class="adminmeni"><a href="EditovanjeKorisnika.php">Edit korisnika</a></li>';
				print'<li class="adminmeni"><a href="BrisanjeKorisnika.php">Obriši korisnika</a></li>';
				print'<li class="adminmeni"><a href="UnosNovosti.php">Dodaj novost</a></li>';
				print'<li class="adminmeni"><a href="PromjenaSifre.php">Promijeni sifru</a></li>';
				print'<li class="adminmeni"><a href="Logout.php">Logout</a></li>';
				print'</ul>';
				print'</div>';
			}
		}
		else{
			header("Location: prva.php");
		}
    ?>
	<div class="Gore">
		<div class="Logo">
			<div class="KrugVanjski">
				<div class="KrugUnutrasnji"></div>
				<div class="Most"></div>
				<div class="TravaLijevo"></div>
				<div class="TravaDesno"></div>
				<div class="Put1"></div>
				<div class="Put2"></div>
				<div class="TravaPreko"></div>
				<div class="Providni"></div>
				<div class="Providni2"></div>
			</div>
		</div>
		<div class="Naslov">
			<h1>"SARAJEVOPUTEVI"d.d.</h1>
		</div>
	</div>
	<div class="meni">
		<ul class="lista">
			<li class="nav"><a href="prva.php">NOVOSTI</a></li>
			<li class="nav"><a href="Tabela.php">KAPITAL</a></li>
			<li class="nav"><a href="KontaktForma.php">KONTAKT</a></li>
			<li class="nav"><a href="Linkovi.php">LINKOVI</a></li>
			<?php
				if (isset($_SESSION['username'])) {
					print '<li class="nav"><a href="Logout.php">LOGOUT</a></li>';
				}
				else{
					print '<li class="nav"><a href="Login.php">LOGIN</a></li>';
				}
			?>
		</ul>
	</div>
	<div class="Glavno">
		<h2>Promjena šifre:</h2>
		<form name="FormaBrisanjeKorisnika" method="get"  action="EditovanjeKorisnika.php" >
			  Odabir korisnika :<br> 
			  <select name="Korisnik">
			    <?php
					define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
					define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
					define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
					define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
					define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
					$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
					$veza4 = new PDO($dsn, DB_USER, DB_PASS);
			    	//$veza4 = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
					$veza4->exec("set names utf8");
					$upit4=$veza4->query("select id,username from users where username<>'admin'");
					if (!$upit4) {
				          $greska = $veza4->errorInfo();
				          print "SQL greška: " . $greska[2];
				          exit();
				     }
					//$users=$upit4->fetch(PDO::FETCH_ASSOC);
					foreach($upit4 as $user)
					{
						print '<option value="'.$user['id'].'">'.$user['username'].'</option>';
					}
			    ?>
			  </select>
			  <br>
			  Novi username :<br> <input type="text" name="NoviUsername" > 
			  <input id="Dugme" class="Dugme" type="submit" name="PromjenaUsername" value ="Promijeni username"><br>	
			  Novi password :<br><input type="password" name="NoviPassword" > 
			  <input id="Dugme" class="Dugme" type="submit" name="PromjenaPassworda" value ="Promijeni password">
		</form> 
	</div>
	<?php 

        if (isset($_REQUEST['PromjenaPassworda']) && $_REQUEST['PromjenaPassworda'] == 'Promijeni password') {
        	define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
			define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
			define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
			define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
			define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
			$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
			$veza = new PDO($dsn, DB_USER, DB_PASS);
			//$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
			$veza->exec("set names utf8");
			$upit2=$veza->query("update users set password='".md5($_REQUEST['NoviPassword'])."' where id='".$_REQUEST['Korisnik']."'");
				if (!$upit2) {
			          $greska = $veza2->errorInfo();
			          print "SQL greška: " . $greska[1];
			          exit();
			     }

				echo '<script language="javascript">';
				echo 'alert("Uspjesno ste promijenili šifru")';
				echo '</script>';
			
        }

        if (isset($_REQUEST['PromjenaUsername']) && $_REQUEST['PromjenaUsername'] == 'Promijeni username') {
        	define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
			define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
			define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
			define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
			define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
			$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
			$veza = new PDO($dsn, DB_USER, DB_PASS);
			//$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
			$veza->exec("set names utf8");
			$upit2=$veza->query("update users set username='".$_REQUEST['NoviUsername']."' where id='".$_REQUEST['Korisnik']."'");
				if (!$upit2) {
			          $greska = $veza2->errorInfo();
			          print "SQL greška: " . $greska[1];
			          exit();
			     }

				echo '<script language="javascript">';
				echo 'alert("Uspjesno ste promijenili username")';
				echo '</script>';
			
        }
        
    ?>
	<div class="Dno">
		<h3 class="lijevo">Info:</h3>
		<p class="Info">„SARAJEVOPUTEVI“dd <br> Ul.Mustajbega Fadilpašića 17<br>Sarajevo,BiH<br>Tel:033/667-499<br>Fax: 033/667-500<br>E-m
		ail:info@saputevi.ba</p>
		<p class="cpr">2016 © Sva prava zadržava |<br> "SARAJEVOPUTEVI" d.d. Sarajevo <br>Bosna i Hercegovina</p>
		<h3 class="desno">Copyright</h3>
	</div>

</body>
</html>