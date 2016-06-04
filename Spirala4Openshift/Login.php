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
			$username = "";
		    if (isset($_SESSION['username']))
		        $username = $_SESSION['username'];
		    else if (isset($_REQUEST['username'])) 
		    {
				define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST')); 
				define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
				define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME')); 
				define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD')); 
				define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME')); 
				$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT; 
				$veza = new PDO($dsn, DB_USER, DB_PASS);	    	
			    //$veza = new PDO("mysql:dbname=saputevibaza;host=localhost;charset=utf8", "sapuser", "sapuser");
	     		$veza->exec("set names utf8");
	     		$users = $veza->query("select username, password, status from users");
			    if (!$users) {
			          $greska = $veza->errorInfo();
			          print "SQL greška: " . $greska[2];
			          exit();
			     }
			     $test=true;
		    	foreach($users as $user){
			        if ($_REQUEST['username'] == $user['username'] && md5($_REQUEST['password']) == $user['password']) 
			        {
			            $username = $_REQUEST['username'];
			            $_SESSION['username'] = $username;
			            echo '<script language="javascript">';
						echo 'alert("Uspjesno ste se ulogovali kao '.$user['status'].'")';
						echo '</script>';
						$test=false;

			        }
		    	}
		    	if($test){
		    			echo '<script language="javascript">';
						echo 'alert("Greška!")';
						echo '</script>';
		    	}
		    }
		?>
	<?php
		if (isset($_SESSION['username'])) {
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
		<form method="post" action="Login.php">
			<h2>Login</h2>
			Username: <input name="username"/> <br>
			Password :  <input type="password" name="password"/> <br>
			<input id="Dugme" type="submit" value="Login"/>
		</form> 
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