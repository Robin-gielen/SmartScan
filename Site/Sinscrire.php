<html>
    <head>
       <meta charset="utf-8">
		<title>Inscription</title>
        <link rel="stylesheet" href="CSS/inscription.css" media="screen" type="text/css" />
		<link rel="icon" type="image/png" href="CSS/IMG/logo.png"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script>
			$('#password, #confform').on('keyup', function () {
				  if ($('#mdpform').val() == $('#confform').val()) {
				    $('#message').html('Matching').css('color', 'green');
				  } else 
				    $('#message').html('Not Matching').css('color', 'red');
				});
		</script>
    </head>
    <body>
		<a href="index.php"><img id="logoCond" src="CSS/IMG/logo.png" alt="SmartScanBC"></a>
		<div id="container2">    
            <form action="" method="POST">
                <h1 id="Inscription">Inscription</h1>
                
                <label id="nom">Nom</label>
				<input id="nomform" type="text" name="cli_name" placeholder="Entrez votre nom" required="required" placeholder="Please Enter Name">
				
				<div id="prenom">
				<label>Prénom</label>
				<input id="prenomform" type="text" name="cli_firstname" placeholder="Entrez votre prénom" required="required" placeholder="Please Enter Firstname">
				</div>
				<p></p>

				<label id="adresse">Adresse</label>
				<input id="adresseform" type="text" name="cli_add" placeholder="Entrez votre adresse" required="required" placeholder="Please Your Address">
				
				<div id="ville">
				<label>Ville</label>
				<input id ="villeform" type="text" name="cli_city" placeholder="Entrez votre ville" required="required" placeholder="Please Enter Your City">
				</div>
				<p></p>
				
				<label id="mail">Email</label>
				<input id="emailform" type="text" name="cli_mail" placeholder="Entrez l'adresse email" required="required" placeholder="Please Your E-mail">
				
				<div id="pseudo">
				<label>Pseudo</label>
				<input id="pseudoform" type="text" name="cli_username" placeholder="Entrez le nom d'utilisateur" required="required" placeholder="Please Enter Username">
				</div>
				<p></p>
				
				<label id="mdp">mdp</label>
				<input id="mdpform" type="password" name="cli_password" placeholder="Entrez un mot de passe" required="required" placeholder="Please Enter Password">
				
				<div id="conf">
				<label>Conf mdp</label>
                <input id="confform" type="password" placeholder="Ré-entrez le mot de passe" name="passwordConf" required>
				</div>
				<p></p>
				<span id='message'></span>
				
				<input id="checkbox" type="checkbox" name="confirmer" required>
				<label><b>Je suis d'accord avec les conditions d'utilisation</b></label>
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
						header("Location: http://www.smartscan-bc.ovh");
					}
					else{
						echo "<br>Il existe déjà un compte lié à cet E-mail";
					}
				}
		?>
    </body>
</html>