<html>
    <head>
       <meta charset="utf-8">
		<title>SmartScanBC</title>
        <link rel="stylesheet" href="CSS/accueil.css" media="screen" type="text/css" />
		<link rel="icon" type="image/png" href="CSS/IMG/logo.png"/>
    </head>
    <body>
		<div id="container2">    
            <form action="" method="POST">
                <h1 id="Inscription">Inscription</h1>
                
                <label>Nom</label>
				<input type="text" name="cli_name" placeholder="Entrer votre nom" required="required" placeholder="Please Enter Name"/><br /><br />
				<label>Prénom</label>
				<input type="text" name="cli_firstname" placeholder="Entrer votre prénom" required="required" placeholder="Please Enter Firstname"/><br /><br />
				<label>Adresse</label>
				<input type="text" name="cli_add" placeholder="Entrer votre adresse" required="required" placeholder="Please Your Address"/><br/><br />
				<label>Ville</label>
				<input type="text" name="cli_city" placeholder="Entrer votre ville" required="required" placeholder="Please Enter Your City"/><br/><br />
				<label>Adresse Email</label>
				<input type="text" name="cli_mail" placeholder="Entrer l'adresse email" required="required" placeholder="Please Your E-mail"/><br/><br />
				<label>Pseudo</label>
				<input type="text" name="cli_username" placeholder="Entrer le nom d'utilisateur" required="required" placeholder="Please Enter Username"/><br/><br />
				<label>Mot de passe</label>
				<input type="password" name="cli_password" placeholder="Entrer un mot de passe" required="required" placeholder="Please Enter Password"/><br/><br />
				<label><b>Confirmer le mot de passe</b></label>
                <input type="password" placeholder="Ré-entrer le mot de passe" name="passwordConf" required>
				<input type="checkbox" name="confirmer" required>
				<label><b>Je suis d'accord avec les conditions d'utilisations</b></label>
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
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
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
