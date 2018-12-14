<?php
	session_start();
?>
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
				<a href="index.php"><img id="smartscanbc" src="CSS/IMG/smartscanbc.png" alt="SmartScanBC"></a>
				<a href="index.php"><img id="logo" src="CSS/IMG/logo.png" alt="SmartScanBC"></a>
		</div>
		<nav id="carte">
			<form action="" method="POST">
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
				
				<label><b>Catégorie (un seul mot)</b></label>
				<input type="text" placeholder="Entrez un nom de catégorie" name="cat">
				
				
				<input type="submit" id='submit' name ="submit" value='Ajouter cette carte' >
			</form>
		</nav>
		<?php
			if(isset($_POST["submit"])){
				$servername = "172.17.0.4:3306";
				$username = "contact";
				$password = "scan123";
				$dbname = "smartscan";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn -> connect_error) {
				die("Connection failed: " . $conn -> connect_error);
				}
				$nom = $_POST["nomPersonnne"];
				$prenom = $_POST["prénomPersonnne"];
				$mail = $_POST["email"];
				$telephone= $_POST["numero"];
				$adresse = $_POST["adresse"];
				$ville = $_POST["ville"];
				$nomEntreprise = $_POST["nomEntreprise"];
				$actiEntreprise = $_POST["actiEntreprise"];
				$id_Utilisateur = $_SESSION['id_Utilisateur'];
				$site = $_POST["siteWeb"];
				$cat = $_POST["cat"];
					if(mysqli_query($conn,"insert into Contacts(Nom, Prenom, Mail, Telephone, Adresse, Localite, NomSociete,Activite,id_Utilisateur,SiteWeb, Cat)
					values ('$nom','$prenom','$mail','$telephone','$adresse','$ville','$nomEntreprise','$actiEntreprise','$id_Utilisateur','$site','$cat')")){
						echo "<br>carte ajoutée";
						header("Location: http://www.smartscan-bc.ovh/userHomePage.php");
					}
					
				}
		?>
	</body>
</html>
