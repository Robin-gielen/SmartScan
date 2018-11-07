<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>SmartScanBC</title>
		<link rel="stylesheet" href="CSS/ajoutCartes.css">
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
			<nav id="carte">
				<form action="userHomePage.php" method="POST">
					<h1 id="Inscription">Ajout d'une carte de visite</h1>
					
					<label><b>Nom de la personne</b></label>
					<input type="text" placeholder="Entrez le nom de la personne" name="nomPersonnne" required>
					
					<label><b>Prénom de la personne</b></label>
					<input type="text" placeholder="Entrez le prénnom de la personne" name="prénomPersonnne" required>
					
					<label><b>Adresse Email</b></label>
					<input type="email" placeholder="Entrez l'adresse email" name="email" required>
					
					<label><b>Numéro de telephone</b></label>
					<input type="text" placeholder="Entrez le numéro de telephone" name="numero" required>
					
					<label><b>Adresse</b></label>
					<input type="text" placeholder="Entrez l'adresse" name="adresse">
					
					<label><b>Ville</b></label><br>
					<input type="text" placeholder="Entrez la ville" name="ville">
					
					<label><b>Nom de l'entreprise</b></label>
					<input type="text" placeholder="Entrez le nom de l'entreprise" name="nomEntreprise" required>
					
					<label><b>Activité</b></label>
					<input type="text" placeholder="Entrez l'activite de l'entreprise" name="actiEntreprise" required>
					
					<label><b>Site web</b></label>
					<input type="text" placeholder="Entrez l'url du site web" name="siteWeb">
					<!--
					<label><b>Lieu</b></label>
					<input type="text" placeholder="Entrer votre lieu d'habitation" name="lieu" required>
					
					<label><b>Entreprise</b></label>
					<input type="text" placeholder="Entrer le nom de votre entreprise" name="entreprise" required> -->
					
					<input type="submit" id='submit' value='Ajouter cette carte' >
				</form>
			</nav>
		</div>
	</body>
</php>