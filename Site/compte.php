<?php
 session_start();
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
 $pseudo = $_SESSION['pseudo'];
 $mail = $_SESSION['mail'];
 $nom = $_SESSION['nom'];
 $prenom= $_SESSION['prenom'];
 $localite =$_SESSION['localite'];
 
echo "<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='utf-8'>
		<title>SmartScan BC - Mon Compte</title>
		<link rel='stylesheet' href='CSS/compte.css'>
		<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
		<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
	</head>
	<body>
		<div id='header'>
				<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
				<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
				
				
				<div id='compteModif'>
					<a href='monCompte.php'>Modifier mon compte</a>
				</div>
				<p></p>
				<div id='deco'>
					<a href='?hello=true'>Déconnexion</a>
				</div>
				
				
			<nav id='compte'>
				<form action='userHomePage.php' method='POST'>
					<h1 id='Inscription'>Votre compte</h1>
					
					<label><b>Nom d'utilisateur</b></label>
					<input type='text' name='username' value=$pseudo disabled='disabled'>
					
					<label><b>Nom</b></label>
					<input type='text' name='nom' value=$nom disabled='disabled'>
					
					<label><b>Prénom</b></label>
					<input type='text' name='prenom' value=$prenom disabled='disabled'>
					
					<label><b>Adresse Email</b></label>
					<input type='text' name='email' value=$mail disabled='disabled'>
					
					<br>
					
					<label><b>Localité</b></label>
					<input type='text' name='localite' value=$localite disabled='disabled'>
					
					
				</form>
			</nav>
		</div>
	</body>
</html>";

?>