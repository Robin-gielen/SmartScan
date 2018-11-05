<?php
	session_start();
	$_SESSION['logged_in']= false; //to know if the user is already logged and by default no
?>
<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/accueil.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <form action="" method="POST">
                <h1 id="titre">Connexion</h1>
                
                <label><b>Nom d utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="cli_username" required>
				
				<br>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="cli_password" required>

                <input type="submit" id='submit' value='LOGIN' name ="login" >
				<p>Nom d'utilisateur ou mot de passe oublié ?</p> 
            </form>
        </div>
		<?php
			
				if(isset($_POST['login'])){
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
					$cli_username = $mysqli->escape_string($_POST['cli_username']);
					$cli_password =$mysqli->escape_string($_POST['cli_password']);
					$_SESSION['pseudo']=$cli_username;
					$_SESSION['password']= $cli_password;
					$result = $mysqli->query("select * from Utilisateurs where pseudo ='$cli_username' and password='$cli_password'")or die($mysqli->error());
					if( $result->num_rows == 0){
						$_SESSION['message']= "This user doesn't exist !";
						header("location: SeConnecter.php");
					}
					else{
						$user =$result->fetch_assoc();
						echo $user;
						if($_POST['password'] === $user['password']){
							$_SESSION['pseudo'] = $cli_username;
							$_SESSION['password'] = $cli_password;
							$_SESSION['logged_in'] = true;
							header("Location: userHomePage.html");die;
						}
						else{
							$_SESSION['message'] = "You have enter a wrong password, try again!";
							header("Location: SeConnecter.php");die;
						}
					}
				}
				
				
		?>
    </body>
</html>