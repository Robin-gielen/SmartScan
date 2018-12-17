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
			header("Location: http://www.smartscan-bc.ovh");}
	if (isset($_GET['del'])) {		
		if(isset($_SESSION['pseudo'])) {
				$servername = "172.17.0.4:3306";
				$username = "admin";
				$password = "abc123";
				$dbname = "smartscan";
				$pseudo = $_SESSION['pseudo'];
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
				$result = $conn->query("DELETE FROM Utilisateurs WHERE pseudo ='$pseudo'")or die($mysqli->error());
				if ( isset( $_COOKIE[session_name()] ) )
			setcookie( session_name(), “”, time()-3600, “/” );
			//clear session from globals
			$_SESSION = array();
			//clear session from disk
			session_destroy();
			header("Location: http://www.smartscan-bc.ovh");
	}}
	
	
		if(isset($_SESSION['pseudo'])) {
				$servername = "172.17.0.4:3306";
				$username = "admin";
				$password = "abc123";
				$dbname = "smartscan";
				$idUser = $_SESSION['id_Utilisateur'];
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				
				// Check connection
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
	if(isset($_POST['conf1']) and $_POST['username']!=''){
		
			$username =$_POST['username'];
			$conn->query("UPDATE Utilisateurs SET pseudo = '".$username."' WHERE id_Utilisateur=".$idUser)or die($mysqli->error());
			$_SESSION['pseudo']=$username;
			header("Location: http://www.smartscan-bc.ovh/compte.php");
		
	}
	if(isset($_POST['conf2'])){
		if($_POST['nom']!=''){
		$nom = $_POST['nom'];
		$conn->query("UPDATE Utilisateurs SET Nom = '".$nom."' WHERE id_Utilisateur=".$idUser."")or die($mysqli->error());
		$_SESSION['nom']=$nom;
		header("Location: http://www.smartscan-bc.ovh/compte.php");
		}
	}
	if(isset($_POST['conf3'])){
		if($_POST['prenom']!=''){
			$prenom = $_POST['prenom'];
			$conn->query("UPDATE Utilisateurs SET Prenom = '".$prenom."' WHERE id_Utilisateur=".$idUser."")or die($mysqli->error());
			$_SESSION['prenom']=$prenom;
			header("Location: http://www.smartscan-bc.ovh/compte.php");
		}
	}
	if(isset($_POST['conf4'])){
		if($_POST['email']!=''){
			$mail = $_POST['email'];
			$conn->query("UPDATE Utilisateurs SET Mail = '".$mail."' WHERE id_Utilisateur=".$idUser."")or die($mysqli->error());
			$_SESSION['mail']=$mail;
			header("Location: http://www.smartscan-bc.ovh/compte.php");
		}
	}
	if(isset($_POST['conf5'])){
		if($_POST['localite']!=''){
			$loca = $_POST['localite'];
			$conn->query("UPDATE Utilisateurs SET Localite = '".$loca."' WHERE id_Utilisateur=".$idUser."")or die($mysqli->error());
			$_SESSION['localite']= $loca;
			header("Location: http://www.smartscan-bc.ovh/compte.php");
		}
	}
	if(isset($_POST['conf6'])){
		if($_POST['password']!=''){
				if($_POST['password']==$_POST['passwordConf']){
					$mdp = $_POST['password'];
			$conn->query("UPDATE Utilisateurs SET password = '".$mdp."' WHERE id_Utilisateur=".$idUser."")or die($mysqli->error());
			header("Location: http://www.smartscan-bc.ovh/compte.php");
				}
				else{
					echo " les mots de passes ne sont pas identiques";
				}
		}
		}
		}

	
	
			
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>SmartScan BC - Modification du compte</title>
		<link rel="stylesheet" href="CSS/monCompte.css">
		<link rel="icon" type="image/png" href="CSS/IMG/logo.png"/>
		<link rel="icon" type="image/png" href="CSS/IMG/logo.png"/>
	</head>
	<body>
		<div id="header">
			<a href="index.php"><img id="smartscanbc" src="CSS/IMG/smartscanbc.png" alt="SmartScanBC"></a>	
			<a href="index.php"><img id="logo" src="CSS/IMG/logo.png" alt="SmartScanBC"></a>
			<div id="supprimer">
				<a href='?del=true'name ='delete' >Supprimer mon compte</a>
			</div>
			<p></p>
			<div id="deco">
				<a href='?hello=true'>Déconnexion</a>
			</div>
			<nav id="compte">
					<form  method="POST">
					<label><b>Pseudo</b></label>
					<input type="text" placeholder="Modifier votre pseudo" name="username" required>
					<input type="submit" id='submit' value='Enregistrer'  name ='conf1'>
					</form>
					<form  method="POST">
					<label><b>Nom</b></label>
					<input type="text" placeholder="Modifier votre nouveau nom" name="nom" required>
					<input type="submit" id='submit' value='Enregistrer'  name ='conf2'>
					</form>
					<form  method="POST">
					<label><b>Prénom</b></label>
					<input type="text" placeholder="Modifier votre prénom" name="prenom" required>
					<input type="submit" id='submit' value='Enregistrer'  name ='conf3'>
					</form>
					<form  method="POST">
					<label><b>Adresse email</b></label>
					<input type="text" placeholder="Modifier votre adresse email" name="email" required>
					<input type="submit" id='submit' value='Enregistrer'  name ='conf4'>
					</form>
					<form  method="POST">
					<label><b>Localité</b></label>
					<input type="text" placeholder="Modifier votre localité" name="localite" required>
					<input type="submit" id='submit' value='Enregistrer'  name ='conf5'>
					</form>
					<form  method="POST">
					<label><b>Mot de passe</b></label>
					<input type="password" placeholder="Modifier votre mot de passe" name="password" required>
					
					<label><b>Confirmer le mot de passe</b></label>
					<input type="password" placeholder="Ré-entrer le mot de passe" name="passwordConf" required>
					<input type="submit" id='submit' value='Enregistrer'  name ='conf6'>
					</form>

					
					
				
			</nav>
		</div>
	</body>
</html>