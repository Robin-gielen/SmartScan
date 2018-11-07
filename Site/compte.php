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
 ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Mon Compte</title>
		<link rel="stylesheet" href="CSS/compte.css">
		<link rel="icon" type="image/png" href="CSS/IMG/logo.png"/>
		<link rel="icon" type="image/png" href="CSS/IMG/logo.png"/>
	</head>
	<body>
		<div id="header">
			<nav>
				<a href="userHomePage.php"><img id="smartscanbc" src="CSS/IMG/smartscanbc.png" alt="SmartScanBC"></a>
			</nav>	
			<nav>
				<a href="userHomePage.php"><img id="logo" src="CSS/IMG/logo.png" alt="SmartScanBC"></a>
			</nav>
			<nav>
				<div id="compteModif">
					<a href="monCompte.php">Modifier mon compte</a>
				</div>
			</nav>
			<nav>
				<div id="deco">
					<a href='?hello=true''>Déconnexion</a>
				</div>
			</nav>
			<nav id="compte">
				<form action="userHomePage.php" method="POST">
					<h1 id="Inscription">Votre compte</h1>
					
					<label><b>Nom d'utilisateur</b></label>
					<input type="text" name="username" value="pseudo" disabled="disabled">
					
					<label><b>Adresse Email</b></label>
					<input type="text" name="email" value="test@gmail.com" disabled="disabled">
	
					<label><b>Sexe</b></label>
					<input type="text" name="sexe" value="homme" disabled="disabled">
					
					<label><b>Date</b></label><br>
					<input type="date" placeholder="Entrer le nom d'utilisateur" name="date" required>
					
					<br>
					
					<label><b>Lieu</b></label>
					<input type="text" name="lieu" value="Wavre" disabled="disabled">
					
					<label><b>Entreprise</b></label>
					<input type="text" name="entreprise" value="EPHEC" disabled="disabled">
				</form>
			</nav>
		</div>
	</body>
</html>