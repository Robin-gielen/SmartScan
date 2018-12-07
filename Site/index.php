<?php
	session_start();
	

echo"<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
		<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
		<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
		<title>SmartScanBC</title>
		<link rel='stylesheet' href='CSS/accueil.css'>
	</head>
	<body>
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
		<script src='bootstrap/js/bootstrap.min.js'></script>
		<div id='header'>
			<nav>
				<a href='https://play.google.com/store/apps'><img id='googleplay' src='CSS/IMG/googleplay.png' alt='GooglePlay'></a>
			</nav>
			<nav>
				<img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'>
			</nav>
			";
			if($_SESSION['logged_in'] == false){
			echo"<nav id = 'connexion'>
					<a href='SeConnecter.php'>Se connecter</a>
			</nav>
			<nav id ='inscription'>
				<a href='Sinscrire.php'>S'inscrire</a>
			</nav>";
	}
			
			
			if($_SESSION['logged_in'] == true){
			echo"
				<div id='deco'>
					<a href='?hello=true'>Deconnexion</a>
				</div>
				<div id='mesCartes'>
					<a href='userHomePage.php'>Mes Cartes</a>
				</div>";
	}
	echo"
				<div id='toutesCartes'>
					<a href='toutesCartes.php'>Voir toutes les cartes</a>
				</div>
		</div>	
		
		<div id='content'>
		
			<nav>
				<img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'>
			</nav>
			
			<nav id='annonce'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
				<img class='card_1' src='CSS/IMG/1.jpg' alt='BusinessCard'>
			</nav>
		</div>
		<div id='footer'>
			<div class='equipe'>
				<h3>Qui sommes-nous?</h3>
				<p>Nous sommes 7 etudiants de l'Ephec, devores par notre passion commune qu'est l'informatique.
				   Plus d'informations concernant notre equipe <a href='team.php'>ici</a>
				</p>
			</div>
			<div class='equipe'>
				<h3>A quoi sert le site web?</h3>
				<p>Ce site permet de recencer toutes les cartes de visites scannees via 'SmartScan BC'. Vous pouvez donc chercher ici les informations
				relatives au corps de metier qui vous interesse. </p>
			</div>
			<div class='equipe'>
				<h3>A quoi sert l'app?</h3>
				<p>Avec l'application 'SmartScan BC', vous pouvez scanner les cartes de visites que vous possedez et les ajouter automatiquement dans vos contacts
				telephoniques.</p>
			</div>
		</div>
		<div id='test2'>
				<a href='condGenerales.php' id='cond'>Conditions generales</a>
				<a href='faq.php' id='questions'>Foire aux questions</a>
				<a href='contact.php' id='contact'>Contact</a>
				<a href='' id='donnees'>A propos de vos donnees</a>
				<a href='https://www.facebook.com/SmartScanBC/'><img id='fcb' src='CSS/IMG/fcb.png' alt='Facebook'></a>
				<a href='https://twitter.com/SmartScanBC'><img id='twitter' src='CSS/IMG/Twitter.png' alt='Twitter'></a>
				<!-- <select>
					<option>francais</option>
					<option>anglais</option>
					<option>neerlandais</option>
				</select>-->
		</div>
</body>
</html>";
if (isset($_GET['hello'])) {
											//remove PHPSESSID from browser
											if ( isset( $_COOKIE[session_name()] ) )
											setcookie( session_name(), “”, time()-3600, “/” );
											//clear session from globals
											$_SESSION = array();
											//clear session from disk
											session_destroy();
											header("Location: http://www.smartscan-bc.ovh");
										  }
?>