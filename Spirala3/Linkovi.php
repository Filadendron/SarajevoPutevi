<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stil1.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Linkovi</title>
</head>
<body>
	<?php
	session_start();
		if (isset($_SESSION['username'])) {
	        print'<div class="admindiv">';
			print'<ul class="adminlista">';
			print'<li class="adminmeni"><a href="UnosNovosti.php">Dodaj novost</a></li>';
			print'<li class="adminmeni"><a href="Logout.php">Logout</a></li>';
			print'</ul>';
			print'</div>';
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
			<li class="nav"><a href="Login.php">LOGIN</a></li>
		</ul>
	</div>
	<div class="Glavno">
		<h2>Korisni linkovi:</h2>
		<ul class="Llinkovi">

			<li class="linkovana">
			<a href="https://www.facebook.com">Facebook</a>
			</li>

			<li class="linkovana">
			<a href="http://www.jpautoceste.ba/ba/">Autoceste</a>
			</li>

			<li class="linkovana">
			<a href="http://www.klix.ba/">Klix</a>
			</li>

			<li class="linkovana">
			<a href="https://www.youtube.com/">Youtube</a>
			</li>

			<li class="linkovana">
			<a href="http://bihamk.ba/">Bihamk</a>
			</li>

		</ul>
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