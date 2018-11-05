<html>
    <head>
       <meta charset="utf-8">
		<title>SmartScanBC</title>
        <link rel="stylesheet" href="CSS/inscription.css" media="screen" type="text/css" />
		<link rel="icon" type="image/png" href="CSS/IMG/logo.png"/>
    </head>
    <body>
		<div id="container2">    
            <form action="" method="POST">
                <h1 id="Inscription">Inscription</h1>
                
                <label id="nom">Nom</label>
				<input id="nomForm" type="text" name="cli_name" placeholder="Entrez votre nom" required="required" placeholder="Please Enter Name"/><br /><br />
				<label id="prenom">Prénom</label>
				<input id="prenomForm" type="text" name="cli_firstname" placeholder="Entrez votre prénom" required="required" placeholder="Please Enter Firstname"/><br /><br />
				<label id="adresse">Adresse</label>
				<input id ="adresseForm" type="text" name="cli_add" placeholder="Entrez votre adresse" required="required" placeholder="Please Your Address"/><br/><br />
				<label id ="ville">Ville</label>
				<input id="villeForm" type="text" name="cli_city" placeholder="Entrez votre ville" required="required" placeholder="Please Enter Your City"/><br/><br />
				<label id="email">Email</label>
				<input id="emailForm" type="text" name="cli_mail" placeholder="Entrez l'adresse email" required="required" placeholder="Please Your E-mail"/><br/><br />
				<label id="pseudo">Pseudo</label>
				<input id="pseudoForm" type="text" name="cli_username" placeholder="Entrez le nom d'utilisateur" required="required" placeholder="Please Enter Username"/><br/><br />
				<label id="mdp">mdp</label>
				<input id="mdpForm" type="password" name="cli_password" placeholder="Entrez un mot de passe" required="required" placeholder="Please Enter Password"/><br/><br />
				<label id="conf"><b>Conf mdp</b></label>
                <input id="confForm" type="password" placeholder="Ré-entrez le mot de passe" name="passwordConf" required>
				<input id="checkForm" type="checkbox" name="confirmer" required>
				<label id="check"><b>Je suis d'accord avec les conditions d'utilisation</b></label>
                <input type="submit" id='submit' name='submit' value='Créer mon compte' >
            </form>
        </div>
		<?php
			if(isset($_POST["submit"])){
				$servername = "172.17.0.4:3306";
				$username = "compte";
				$password = "smart123";
				$dbname = "smartscan";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn -> connect_error) {
				die("Connection failed: " . $conn -> connect_error);
				}
				$name = $_POST["cli_name"];
				$firstname = $_POST["cli_firstname"];
				$address = $_POST["cli_add"];
				$mail = $_POST["cli_mail"];
				$city = $_POST["cli_city"];
				$username = $_POST["cli_username"];
				$password = $_POST["cli_password"];
					if(mysqli_query($conn,"insert into Utilisateurs(Nom, Prenom, Adresse, Mail, Localite, pseudo, password)
					values ('$name','$firstname','$address','$mail','$city','$username','$password')")){
						echo "<br>Inscription réussie";
					}
					else{
						echo "<br>Il existe déjà un compte lié à cet E-mail";
					}
				}
		?>
    </body>