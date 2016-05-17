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
	        print'<div class="admindiv">';
			print'<ul class="adminlista">';
			print'<li class="adminmeni"><a href="UnosNovosti.php">Dodaj novost</a></li>';
			print'<li class="adminmeni"><a href="Logout.php">Logout</a></li>';
			print'</ul>';
			print'</div>';
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
			<li class="nav"><a href="Login.php">LOGIN</a></li>
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
			  <input id="Dugme" class="Dugme" type="submit" name="SpasiNovost" value ="Spasi novost"+>
		</form> 
	</div>
	<?php 

        if (isset($_REQUEST['SpasiNovost']) && $_REQUEST['SpasiNovost'] == 'Spasi novost') {
            $novosti = file("novosti.csv");
            $TekstNovosti=str_replace(',','#',$_REQUEST['TextNovosti']);
            $tekst=str_replace('\n', '%%',$TekstNovosti);
            $datum=date("Y-m-d")."T".date("H:i:s");
            $nov = $_REQUEST['Naslov'].",".$tekst.",".$datum.",".$_REQUEST['DvoslovniKod'].",".$_REQUEST['TelefonskiBroj']."**";
            array_push($novosti, $nov);
            file_put_contents("novosti.csv", $novosti);
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