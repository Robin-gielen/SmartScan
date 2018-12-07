<?php
	session_start();
	$_SESSION['logged_in']= false; //to know if the user is already logged and by default no
	print $_SESSION['message'];
?>
<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/accueil.css" media="screen" type="text/css" />
		<title>Connexion</title>
		<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
		<script>
function myFunctionConn()
{
alert("Connected"); // this is the message in ""
}
function myFunctionNotConn()
{
alert("Not Connected"); // this is the message in ""
}
</script>
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
				$username = "compte";
				$password = "smart123";
				$dbname = "smartscan";
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
					$cli_username = $conn->escape_string($_POST['cli_username']);
					$cli_password =$conn->escape_string($_POST['cli_password']);
					$_SESSION['pseudo']=$cli_username;
					$_SESSION['password']= $cli_password;
					
					$result = $conn->query("select * from Utilisateurs where pseudo ='$cli_username'")or die($mysqli->error());

					if( $result->num_rows == 0){
						$_SESSION['message']= "This user doesn't exist !";
						print $_SESSION['message'];
						header("Location: SeConnecter.php");
					}
					else{
						$user =$result->fetch_assoc();

						if($cli_password === $user['password']){
							$_SESSION['pseudo'] = $cli_username;
							$_SESSION['password'] = $cli_password;
							$_SESSION['id_Utilisateur'] = $cli_uid;
							$_SESSION['mail'] = $user['Mail'];
							$_SESSION['nom']=$user['Nom'];
							$_SESSION['prenom']=$user['Prenom'];
							$_SESSION['localite']=$user['Localite'];
							$_SESSION['logged_in'] = true;
							$_SESSION['message'] = "You are connected!";
							print $_SESSION['message'];
							header("Location: userHomePage.php");die;
						}
						else{
							$_SESSION['message'] =$_POST['cli_password'];
							print $_SESSION['message'];
							header("Location: SeConnecter.php");die;
						}
					}
				}
				
				
		?>
    </body>
</html>