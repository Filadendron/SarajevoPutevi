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
		<h2>Unos novosti:</h2>
		<form name="FormaUnosNovosti" method="get" onsubmit="return ValidirajFormu(this);" action="UnosNovosti.php" >
			  Naslov novosti:<br>
			  <input id="Naslov" type="text" name="Naslov" placeholder="Naslov" oninput="ValidacijaInputa(this);"><br>	  
			  Tekst novosti:<br>
			  <textarea id="TxtNovosti" class="TextNovosti" name="TextNovosti" placeholder="Tekst novosti" oninput="ValidacijaInputa(this);"></textarea><br>
			  Dvoslovni kod države autora:<br>
			  <input id="dkd" type="text" name="DvoslovniKod" placeholder="npr. ba" oninput="provjeriDvoslovniKod(this);"><br>
			  Telefonski broj autora:<br>
			  <input id="tbroj" type="text" name="TelefonskiBroj" placeholder="npr. +38761222222" oninput="provjeriBroj(this);"><br>
			  <input class="cbox" type="checkbox" name="status" value="1">Novost otvorena za komentare<br>
			  <input id="Dugme" class="Dugme" type="submit" name="SpasiNovost" value ="Spasi novost">
		</form> 
	</div>
	<?php 

        if (isset($_REQUEST['SpasiNovost']) && $_REQUEST['SpasiNovost'] == 'Spasi novost') {

            $datum=date("Y-m-d")."T".date("H:i:s");
            $statusNovosti=0;
            if(isset($_REQUEST['status'])){
            	$statusNovosti=1;
            }
			define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
			define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
			define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
			define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
			define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
			$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
			$veza = new PDO($dsn, DB_USER, DB_PASS);            
            //$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
	     	$veza->exec("set names utf8");
	     	$id = $veza->query("select id from users where username='".$_SESSION['username']."'");
			    if (!$status) {
			          $greska = $veza->errorInfo();
			          print "SQL greška: " . $greska[2];
			          exit();
			     }
			$id_autora=$id->fetch(PDO::FETCH_ASSOC);
			define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
			define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
			define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
			define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
			define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
			$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
			$veza2 = new PDO($dsn, DB_USER, DB_PASS);
			//$veza2 = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
	     	$veza2->exec("set names utf8");
			$upit = $veza2->prepare("INSERT INTO novosti SET naslov=?, tekst=?, datumobjave=?, autor_id=?, dvoslovnikod=?, telefonskibroj=? ,otvorena=?");
			$rez = $upit->execute(array($_REQUEST['Naslov'],$_REQUEST['TextNovosti'],$datum,$id_autora['id'],$_REQUEST['DvoslovniKod'],$_REQUEST['TelefonskiBroj'],$statusNovosti));
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