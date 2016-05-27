<?php
	if (isset($_REQUEST['SpasiKomentar']) && $_REQUEST['SpasiKomentar'] == 'Spasi komentar') {
		$veza0 = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
	    $veza0->exec("set names utf8");
	    $upit = $veza0->prepare("INSERT INTO komentari SET id_novosti=?, autor=?, tekst=?");
		$rez = $upit->execute(array($_REQUEST['id'],$_REQUEST['Autor'],$_REQUEST['TextKomentara']));
		header("Location: NovostDetaljno.php?id=".$_REQUEST['id']);
	}

	if (isset($_REQUEST['SpasiKomentarKomentara']) && $_REQUEST['SpasiKomentarKomentara'] == 'Odgovori na komentar') {
		$veza0 = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
	    $veza0->exec("set names utf8");
	    $upit = $veza0->prepare("INSERT INTO komentarikomentara SET id_komentara=?, autor=?, tekst=?");
		$rez = $upit->execute(array($_REQUEST['idkom'],$_REQUEST['Autor'],$_REQUEST['TextKomentara']));
		header("Location: NovostDetaljno.php?id=".$_REQUEST['id']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="stil1.css">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="skripta.js"></script>
	<title>Novosti</title>
</head>
<body onload="Racunaj2();">
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
		<div class="NovostDetaljno">
		<?php
			$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
     		$veza->exec("set names utf8");
     		$upit1 = $veza->query("select naslov,tekst,datumobjave,autor_id,otvorena from novosti where id='".$_REQUEST['id']."'");
		    if (!$upit1) {
		          $greska = $veza->errorInfo();
		          print "SQL greška: " . $greska[2];
		          exit();
		     }
		     $novost=$upit1->fetch(PDO::FETCH_ASSOC);
		     $upit2 = $veza->query("select username from users where id='".$novost['autor_id']."'");
		    if (!$upit2) {
		          $greska = $veza->errorInfo();
		          print "SQL greška: " . $greska[2];
		          exit();
		     }
		     $autor=$upit2->fetch(PDO::FETCH_ASSOC);

		     print '<h1 class="Detaljno">'.$novost['naslov'].'</h1>';
		     print '<p class="ObjavljenoPrijeDetaljno">'.$novost['datumobjave'].'</p>';
		     print '<p class="AutorLink">Autor : <a class="AutorLink" href="prva.php?sort=autor&idautora='.$novost['autor_id'].'">'.$autor['username'].'</a></p>';
		     print '<p class="Detaljno">'.$novost['tekst'].'</p>';

		     if(isset($_SESSION['username']) && $_SESSION['username']=="admin"){
			     print '<h5 class="buttonObrisi" onclick="BrisanjeNovosti('.$_REQUEST['id'].')">Obriši novost</h5>';
			     if($novost['otvorena']=="1"){
			     	print '<h5 class="buttonObrisi" onclick="OdobriKomentare('.$_REQUEST['id'].')">Zatvori komentare</h5>';
			     }
			     else{
			     	print '<h5 class="buttonObrisi" onclick="OdobriKomentare('.$_REQUEST['id'].')">Odobri komentare</h5>';
			     }
			     
		 	 }
		     if($novost['otvorena']=="1"){
		     	$komentari = $veza->query("select id,autor,tekst from komentari where id_novosti='".$_REQUEST['id']."'");
		     	$BrojKomantara=$veza->query("select count(id) as broj from komentari where id_novosti='".$_REQUEST['id']."'");
		     	$BKom=$BrojKomantara->fetch(PDO::FETCH_ASSOC);
			    if (!$komentari) {
			          $greska = $veza->errorInfo();
			          print "SQL greška: " . $greska[2];
			          exit();
			    }

			     print '<p class="BrojKomantara">Komentari('.$BKom['broj'].')</p>';
			     print '<div class="UnosKomentara">';
			     print '<form class="Komentar" name="FormaUnosKomentara" method="get" action="NovostDetaljno.php" >';
			     print '<textarea class="TextKomentara" name="TextKomentara" placeholder="Tekst komentara"></textarea>';
			     print '<input type="hidden" name="id" value="'.$_REQUEST['id'].'" >';
			     if (!isset($_SESSION['username'])) {
			     	print '<input class="nick" type="text" placeholder="nick" name="Autor">';
			     }
			     else{
			     	print '<input type="hidden" name="Autor" value="'.$_SESSION['username'].'" >';
			     }
			     print '<input class="DugmeKomentar" type="submit" name="SpasiKomentar" value ="Spasi komentar" >';
			     
			     print '</form>';
			     print '</div>';
			     $brojac=1;
			     foreach($komentari as $komentar){
				     print '<div class="Komentar">';
				     print '<p class="AutorKomentara">Autor : '.$komentar['autor'].'</p>';
				     print '<p class="TekstKomentara">'.$komentar['tekst'].'</p>';
				     if(isset($_SESSION['username']) && $_SESSION['username']=="admin"){
			     		print '<h6 class="buttonBrisanjeKomentara" onclick="BrisanjeKomentara('.$_REQUEST['id'].','.$komentar['id'].')">Obriši</h6>';
			     	 }
				     print '<h6 id="'.$brojac.'" class="buttonOdgovori" onclick="UcitajDiv(this);">Odgovori</h6>';
				     print '</div>';
				    $komentariKomentara = $veza->query("select id,autor,tekst from komentarikomentara where id_komentara='".$komentar['id']."'");
			     	$BrojKomKom=$veza->query("select count(id) as broj from komentarikomentara where id_komentara='".$komentar['id']."'");
			     	$BKomKom=$BrojKomKom->fetch(PDO::FETCH_ASSOC);
				    if (!$komentari) {
				          $greska = $veza->errorInfo();
				          print "SQL greška: " . $greska[2];
				          exit();
				    }

				     //print '<p class="BrojOdgovora">Odgovori('.$BKomKom['broj'].')</p>';
				     print '<div id="div'.$brojac.'" class="UnosKomentaraKomentara" style="display: none;">'; //style="display: none;"
				     $brojac=$brojac+1;
				     print '<form class="KomentarKomentara" name="FormaUnosKomentaraKomentara" type="hidden" method="get" action="NovostDetaljno.php" >';
				     print '<textarea class="TextKomentaraKomentara" name="TextKomentara" placeholder="Tekst odgovora na komentar"></textarea>';
				     print '<input type="hidden" name="id" value="'.$_REQUEST['id'].'" >';
				     print '<input type="hidden" name="idkom" value="'.$komentar['id'].'" >';
				     if (!isset($_SESSION['username'])) {
				     	print '<input class="nick" type="text" placeholder="nick" name="Autor">';
				     }
				     else{
				     	print '<input type="hidden" name="Autor" value="'.$_SESSION['username'].'" >';
				     }
				      print '<input class="DugmeKomentarKomentara" type="submit" name="SpasiKomentarKomentara" value ="Odgovori na komentar" >';
			     
				     print '</form>';
				     print '</div>';
				     foreach($komentariKomentara as $komentarKomentara){
					     print '<div class="KomentarKomentara">';
					     print '<p class="AutorKomentara">Autor : '.$komentarKomentara['autor'].'</p>';
					     print '<p class="TekstKomentara">'.$komentarKomentara['tekst'].'</p>';
					     print '</div>';
				 		}

				     
				 }
			}

		?>
		</div>
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