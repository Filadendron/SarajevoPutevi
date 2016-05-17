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

				$sveNovosti=explode("**",file_get_contents("novosti.csv"));
				$brojnovosti=count($sveNovosti);
				$brojnovosti=$brojnovosti-2;

				if(isset($_REQUEST['sort']) && $_REQUEST['sort']=="abc"){
					rsort($sveNovosti);
					for($i=$brojnovosti;$i>=0;$i--){
						$novost=explode(",",$sveNovosti[$i]);
							print '<div class="Novost">';
							print '<h2>'.$novost[0].'</h2>';
							print '<div class="sadrzaj"><p>'.$novost[1].'</p></div>';
							print '<p class="Kontrola">0</p>';
							print '<p class="ObjavljenoPrije">'.$novost[2].'</p>';
							print '</div>';
					}
				}
				else if(isset($_REQUEST['sort']) && $_REQUEST['sort']=="vrijeme"){
					for($i=$brojnovosti;$i>=0;$i--){
						$novost=explode(",",$sveNovosti[$i]);
							print '<div class="Novost">';
							print '<h2>'.$novost[0].'</h2>';
							print '<div class="sadrzaj"><p>'.$novost[1].'</p></div>';
							print '<p class="Kontrola">0</p>';
							print '<p class="ObjavljenoPrije">'.$novost[2].'</p>';
							print '</div>';
					}
				}
				else{
					for($i=$brojnovosti;$i>=0;$i--){
						$novost=explode(",",$sveNovosti[$i]);
							print '<div class="Novost">';
							print '<h2>'.$novost[0].'</h2>';
							print '<div class="sadrzaj"><p>'.$novost[1].'</p></div>';
							print '<p class="Kontrola">0</p>';
							print '<p class="ObjavljenoPrije">'.$novost[2].'</p>';
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