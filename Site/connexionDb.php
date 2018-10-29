<!DOCTYPE html>
<html>
<body>

<h1>Bienvenue sur le site SmartScan BC</h1>

<div id="main">
<h1>Insert data into database using mysqli</h1>
<div id="login">
<h2>Client's Form</h2>
<hr/>
<form action="" method="post">
<label>Client Name :</label>
<input type="text" name="cli_name" id="name" required="required" placeholder="Please Enter Name"/><br /><br />
<label>Client Firstame :</label>
<input type="text" name="cli_firstname" id="firstname" required="required" placeholder="Please Enter Firstname"/><br /><br />
<label>Client Adresse :</label>
<input type="text" name="cli_add" id="add" required="required" placeholder="Please Your Address"/><br/><br />
<label>Client Mail :</label>
<input type="text" name="cli_mail" id="add" required="required" placeholder="Please Your E-mail"/><br/><br />
<label>Client Locality :</label>
<input type="text" name="cli_city" id="city" required="required" placeholder="Please Enter Your City"/><br/><br />
<label>Username :</label>
<input type="text" name="cli_username" id="user" required="required" placeholder="Please Enter Username"/><br/><br />
<label>Password :</label>
<input type="text" name="cli_password" id="pswd" required="required" placeholder="Please Enter Password"/><br/><br />




<input type="submit" value=" Submit " name="submit"/><br />
</form>

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




/*$sql = "insert into Utilisateurs(Nom, Prenom, Adresse, Mail, Localite, pseudo, password)
values ('".$_POST["cli_name"]."','".$_POST["cli_firstname"]."','".$_POST["cli_add"]."','".$_POST["cli_mail"]."','".$_POST["cli_city"]."','".$_POST["cli_username"]."','".$_POST["cli_password"]."', 0)";
*/
?>

</body>
</html>