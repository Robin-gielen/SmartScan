<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Modification du compte</title>
		<link rel="stylesheet" href="CSS/monCompte.css">
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
				<div id="supprimer">
					<a>Supprimer mon comtpe</a>
				</div>
			</nav>
			<nav>
				<div id="deco">
					<a">Déconnexion</a>
				</div>
			</nav>
			<nav id="compte">
				<form action="userHomePage.php" method="POST">
					<h1 id="Inscription">Modification de votre profil</h1>
					
					<label><b>Nom d'utilisateur</b></label>
					<input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>
					
					<label><b>Adresse Email</b></label>
					<input type="text" placeholder="Entrer l'adresse email" name="email" required>
	
					<label><b>Mot de passe</b></label>
					<input type="password" placeholder="Entrer le mot de passe" name="password" required>
					
					<label><b>Confirmer le mot de passe</b></label>
					<input type="password" placeholder="Ré-entrer le mot de passe" name="passwordConf" required>
					
					<label><b>Sexe</b></label>
					<input type="text" placeholder="Entrer le sexe" name="sexe" required>
					
					<label><b>Date</b></label><br>
					<input type="date" placeholder="Entrer le nom d'utilisateur" name="date" required>
					
					<br>
					
					<label><b>Lieu</b></label>
					<input type="text" placeholder="Entrer votre lieu d'habitation" name="lieu" required>
					
					<label><b>Entreprise</b></label>
					<input type="text" placeholder="Entrer le nom de votre entreprise" name="entreprise" required>
					
					<input type="submit" id='submit' value='Enregistrer' >
				</form>
			</nav>
		</div>
	</body>
</php>