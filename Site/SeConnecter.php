<?php
	session_start();
	$_SESSION['logged_in']= false; //to know if the user is already logged and by default no
	print $_SESSION['message'];
?>
<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="CSS/accueil.css" media="screen" type="text/css" />
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
<<<<<<< HEAD
				if (isset($_POST["cli_username"]) && isset($_POST["cli_password"])){
				$cli_username = $_POST["cli_username"];
				$cli_password = $_POST["cli_password"];
					/*$query=mysqli_query($conn,"select password from Utilisateurs where username ='$cli_username'";)
						if(mysqli_num_rows($query)>0){
							echo 'Connected';
						}*/
					
=======
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
						print "test";
						$user =$result->fetch_assoc();
						print "test2";
						if($cli_password === $user['password']){
							$_SESSION['pseudo'] = $cli_username;
							$_SESSION['password'] = $cli_password;
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
>>>>>>> 1f649e35b96d790a5d9e1611012aacacdbfce9a5
				}
			}
				
				
		?>
    </body>
</html>