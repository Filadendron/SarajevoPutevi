<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stil1.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="skripta.js"></script>
	<title>Novosti</title>
</head>
<body onload="Racunaj();">
<?php
	session_start();
		if (isset($_SESSION['username'])) {
			$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
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
		<div class="FilterNovosti">
			<ul class="FilterNovostiLista" method="get">
				<li class="FilterNov" onclick="OdabirNovosti(0);">Sve novosti</li>
				<li class="FilterNov" onclick="OdabirNovosti(1);">Današnje novosti</li>
				<li class="FilterNov" onclick="OdabirNovosti(2);">Novosti ove sedmice</li>
				<li class="FilterNov" onclick="OdabirNovosti(3);">Novosti ovog mjeseca</li>
				<li class="FilterNov" name="Nesto" onclick="Redirect1();">Novosti po abecedi</li>
				<li class="FilterNov" name="Nesto" onclick="Redirect2();">Novosti po vremenu objave</li>
			</ul>
		</div>
			<?php

				if(isset($_REQUEST['sort']) && $_REQUEST['sort']=="abc"){
					$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
		     		$veza->exec("set names utf8");
		     		$novosti = $veza->query("select id,naslov,tekst,datumobjave,dvoslovnikod from novosti order by naslov asc");

					foreach($novosti as $novost){
							print '<div class="Novost">';

							print '<ul class="DetaljnijeLista" method="get">';
							print '<li class="Detaljnije" onclick="RedirectDetaljnije('.$novost['id'].');">Detaljnije</li>';
							print '</ul>';
							print '<h2>'.$novost['naslov'].'</h2>';
							print '<div class="sadrzaj"><p>'.$novost['tekst'].'</p></div>';
							print '<p class="Kontrola">0</p>';
							print '<p class="ObjavljenoPrije">'.$novost['datumobjave'].'</p>';
							print '</div>';
					}
				}
				else if(isset($_REQUEST['sort']) && $_REQUEST['sort']=="vrijeme"){
					$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
		     		$veza->exec("set names utf8");
		     		$novosti = $veza->query("select id,naslov,tekst,datumobjave,dvoslovnikod from novosti order by datumobjave desc");
					foreach($novosti as $novost){
							print '<div class="Novost">';
							print '<ul class="DetaljnijeLista" method="get">';
							print '<li class="Detaljnije" onclick="RedirectDetaljnije('.$novost['id'].');">Detaljnije</li>';
							print '</ul>';
							print '<h2>'.$novost['naslov'].'</h2>';
							print '<div class="sadrzaj"><p>'.$novost['tekst'].'</p></div>';
							print '<p class="Kontrola">0</p>';
							print '<p class="ObjavljenoPrije">'.$novost['datumobjave'].'</p>';
							print '</div>';
					}
				}
				else if(isset($_REQUEST['sort']) && $_REQUEST['sort']=="autor"){
					if(isset($_REQUEST['idautora'])){
					$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
		     		$veza->exec("set names utf8");
		     		$novosti = $veza->query("select id,naslov,tekst,datumobjave,dvoslovnikod from novosti where autor_id=".$_REQUEST['idautora']."");
		     		//$novosti=$upit->fetch(PDO::FETCH_ASSOC);
					foreach($novosti as $novost){
							print '<div class="Novost">';
							print '<ul class="DetaljnijeLista" method="get">';
							print '<li class="Detaljnije" onclick="RedirectDetaljnije('.$novost['id'].');">Detaljnije</li>';
							print '</ul>';
							print '<h2>'.$novost['naslov'].'</h2>';
							print '<div class="sadrzaj"><p>'.$novost['tekst'].'</p></div>';
							print '<p class="Kontrola">0</p>';
							print '<p class="ObjavljenoPrije">'.$novost['datumobjave'].'</p>';
							print '</div>';
					}
				}
				}
				else{
					$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
		     		$veza->exec("set names utf8");
		     		$novosti = $veza->query("select id,naslov,tekst,datumobjave,dvoslovnikod from novosti");
					foreach($novosti as $novost){
							print '<div class="Novost">';
							print '<ul class="DetaljnijeLista" method="get">';
							print '<li class="Detaljnije" onclick="RedirectDetaljnije('.$novost['id'].');">Detaljnije</li>';
							print '</ul>';
							print '<h2>'.$novost['naslov'].'</h2>';
							print '<div class="sadrzaj"><p>'.$novost['tekst'].'</p></div>';
							print '<p class="Kontrola">0</p>';
							print '<p class="ObjavljenoPrije">'.$novost['datumobjave'].'</p>';
							print '</div>';
					}
				}

			?>
	</div>
	<div class="Dno">
		<h3 class="lijevo">Info:</h3>
		<p class="Info">„SARAJEVOPUTEVI“dd <br> Ul.Mustajbega Fadilpašića 17<br>Sarajevo,BiH<br>Tel:033/667-499<br>Fax: 033/667-500<br>E-m
		ail:info@saputevi.ba</p>
		<p class="cpr">2016 © Sva prava zadržava |<br> "SARAJEVOPUTEVI" d.d. Sarajevo <br>Bosna i Hercegovina</p>
		<h3 class="desno">Copyright</h3>
	</div>

</body>
</html>