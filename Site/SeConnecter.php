<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/accueil.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <form action="verification.php" method="POST">
                <h1 id="titre">Connexion</h1>
                
                <label><b>Nom d utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="cli_username" required>
				
				<br>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="cli_password" required>

                <input type="submit" id='submit' value='LOGIN' >
				<p>Nom d'utilisateur ou mot de passe oublié ?</p> 
            </form>
        </div>
		<?php
			if(isset($_POST["submit"])){
				$servername = "172.17.0.4:3306";
				$username = "show";
				$password = "vue123";
				$dbname = "smartscan";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
				
				$cli_username = $_POST["cli_username"];
				$cli_password = $_POST["cli_password"];
					mysqli_query($conn,"select password from Utilisateurs where username ='$cli_username'";)
				}
				
		?>
    </body>
</html>