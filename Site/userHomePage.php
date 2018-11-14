

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
											header("Location: http://www.smartscan-bc.ovh");
										  }
 
if(isset($_SESSION['pseudo'])) {
				$servername = "172.17.0.4:3306";
				$username = "compte";
				$password = "smart123";
				$dbname = "smartscan";
				$pseudo = $_SESSION['pseudo'];
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
				$result = $conn->query("select id_Utilisateur from Utilisateurs where pseudo ='$pseudo'")or die($mysqli->error());
				if( $result->num_rows == 0){
						$_SESSION['message']= "Please connect you tou your account";
						print $_SESSION['message'];
						header("Location: SeConnecter.php");
						}
				else{
							$userId =$result->fetch_assoc();
							$id_Utilisateur=$userId['id_Utilisateur'];
							$_SESSION['id_Utilisateur']=$id_Utilisateur;
							$username2 = "show";
							$password2 = "vue123";
							$conn2 = new mysqli($servername, $username2, $password2, $dbname);
							$result2 =$conn2->query("select * from Contacts where id_Utilisateur ='$id_Utilisateur' order by id_Contact")or die($mysqli->error());
								if(isset($_POST['conf'])){
									if($_POST['tri']=='alpha'){
									$result2 =$conn2->query("select * from Contacts where id_Utilisateur ='$id_Utilisateur' order by NomSociete")or die($mysqli->error());
										if( $result->num_rows == 0){
									$_SESSION['message']= "You don't have save any BC";
									print $_SESSION['message'];
									}
								else{
									$myCards = mysqli_fetch_all($result2,MYSQLI_ASSOC);
										$str = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>NomSociete</th><th>Activite</th><th>Site web</th></tr>";
										if($myCards) {
											  foreach($myCards as $val) {
											    $str .= "<tr>";
											    $str .= "<td>" . $val['Nom'] . "</td>";
											    $str .= "<td>" . $val['Prenom'] . "</td>";
												$str .= "<td>" . $val['Mail'] . "</td>";
											    $str .= "<td>" . $val['Telephone'] . "</td>";
												$str .= "<td>" . $val['Adresse'] . "</td>";
											    $str .= "<td>" . $val['Localite'] . "</td>";
												$str .= "<td>" . $val['NomSociete'] . "</td>";
											    $str .= "<td>" . $val['Activite'] . "</td>";
												$str .= "<td>" . $val['SiteWeb'] . "</td>";
											    // add other td here if there's more
											    // end of tr
											    $str .= "</tr>";
											    
	 										 }
										}
											$str.= "</table>";
											$_SESSION['table']=$str;
											$table=$_SESSION['table'];
										
									} 
									echo"<!DOCTYPE html>
	<html lang='fr'>
		<head>
			<meta charset='utf-8'>
			<title>SmartScanBC</title>
			<link rel='stylesheet' href='CSS/userHomePage.css'>
			<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
			
		</head>
		<body>
			<div id='header'>
				<nav>
					<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
				</nav>	
				<nav>
					<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
				</nav>
				<nav>
					<div id='compte'>
						<a href='compte.php'>Mon compte</a>
					</div>
				</nav>
				<nav>
					<div id='deco'>
						<a href='?hello=true''>Déconnexion</a>
					</div>
				</nav>
				<nav>
					<div id='ajoutCarte'>
						<a href='ajoutCartes.php'>Ajouter une carte</a>
					</div>
				</nav>
				<nav>
					<div id='supprCarte'>
						<a href='ajoutCartes.html'>Supprimer une/des carte(s)</a>
					</div>
				</nav>
				<nav id='groupe'>
				</nav>
				<nav id='cartes'>
					$table
				</nav>
				<nav id='tri'>
					<form method = 'POST'>
					<select name ='tri'>
						<option value ='chrono' >Ordre chronologique</option>
						<option value='alpha' selected='selected'>Ordre alphabétique</option>
					</select>
					<input type='submit' name = 'conf'></button>
					</form>
				</nav>
			</div>
	</body>
	</html>";
									}
									if($_POST['tri']=='chrono'){
									$result2 =$conn2->query("select * from Contacts where id_Utilisateur ='$id_Utilisateur' order by id_Contact")or die($mysqli->error());
										if( $result->num_rows == 0){
									$_SESSION['message']= "You don't have save any BC";
									print $_SESSION['message'];
									}
								else{
									$myCards = mysqli_fetch_all($result2,MYSQLI_ASSOC);
										$str = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>NomSociete</th><th>Activite</th><th>Site web</th></tr>";
										if($myCards) {
											  foreach($myCards as $val) {
											    $str .= "<tr>";
											    $str .= "<td>" . $val['Nom'] . "</td>";
											    $str .= "<td>" . $val['Prenom'] . "</td>";
												$str .= "<td>" . $val['Mail'] . "</td>";
											    $str .= "<td>" . $val['Telephone'] . "</td>";
												$str .= "<td>" . $val['Adresse'] . "</td>";
											    $str .= "<td>" . $val['Localite'] . "</td>";
												$str .= "<td>" . $val['NomSociete'] . "</td>";
											    $str .= "<td>" . $val['Activite'] . "</td>";
												$str .= "<td>" . $val['SiteWeb'] . "</td>";
											    // add other td here if there's more
											    // end of tr
											    $str .= "</tr>";
											    
	 										 }
										}
											$str.= "</table>";
											$_SESSION['table']=$str;
											$table=$_SESSION['table'];
										
									} 
									echo"<!DOCTYPE html>
	<html lang='fr'>
		<head>
			<meta charset='utf-8'>
			<title>SmartScanBC</title>
			<link rel='stylesheet' href='CSS/userHomePage.css'>
			<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
			
		</head>
		<body>
			<div id='header'>
				<nav>
					<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
				</nav>	
				<nav>
					<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
				</nav>
				<nav>
					<div id='compte'>
						<a href='compte.php'>Mon compte</a>
					</div>
				</nav>
				<nav>
					<div id='deco'>
						<a href='?hello=true''>Déconnexion</a>
					</div>
				</nav>
				<nav>
					<div id='ajoutCarte'>
						<a href='ajoutCartes.php'>Ajouter une carte</a>
					</div>
				</nav>
				<nav>
					<div id='supprCarte'>
						<a href='ajoutCartes.html'>Supprimer une/des carte(s)</a>
					</div>
				</nav>
				<nav id='groupe'>
				</nav>
				<nav id='cartes'>
					$table
				</nav>
				<nav id='tri'>
					<form method = 'POST'>
					<select name ='tri'>
						<option value ='chrono' selected='selected'>Ordre chronologique</option>
						<option value='alpha'>Ordre alphabétique</option>
					</select>
					<input type='submit' name = 'conf'></button>
					</form>
				</nav>
			</div>
	</body>
	</html>";
								}
								
							}
							
							if( $result->num_rows == 0){
								$_SESSION['message']= "You don't have save any BC";
								print $_SESSION['message'];
								}
							else{
								$myCards = mysqli_fetch_all($result2,MYSQLI_ASSOC);
									$str = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>NomSociete</th><th>Activite</th><th>Site web</th></tr>";
									if($myCards) {
										  foreach($myCards as $val) {
										    $str .= "<tr>";
										    $str .= "<td>" . $val['Nom'] . "</td>";
										    $str .= "<td>" . $val['Prenom'] . "</td>";
											$str .= "<td>" . $val['Mail'] . "</td>";
										    $str .= "<td>" . $val['Telephone'] . "</td>";
											$str .= "<td>" . $val['Adresse'] . "</td>";
										    $str .= "<td>" . $val['Localite'] . "</td>";
											$str .= "<td>" . $val['NomSociete'] . "</td>";
										    $str .= "<td>" . $val['Activite'] . "</td>";
											$str .= "<td>" . $val['SiteWeb'] . "</td>";
										    // add other td here if there's more
										    // end of tr
										    $str .= "</tr>";
										    
 										 }
									}
										$str.= "</table>";
										$_SESSION['table']=$str;
										$table=$_SESSION['table'];
									
								} 
								    
								    	  
							
							
				}
				if(!isset($_POST['conf'])){
				echo"<!DOCTYPE html>
	<html lang='fr'>
		<head>
			<meta charset='utf-8'>
			<title>SmartScanBC</title>
			<link rel='stylesheet' href='CSS/userHomePage.css'>
			<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
			
		</head>
		<body>
			<div id='header'>
				<nav>
					<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
				</nav>	
				<nav>
					<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
				</nav>
				<nav>
					<div id='compte'>
						<a href='compte.php'>Mon compte</a>
					</div>
				</nav>
				<nav>
					<div id='deco'>
						<a href='?hello=true''>Déconnexion</a>
					</div>
				</nav>
				<nav>
					<div id='ajoutCarte'>
						<a href='ajoutCartes.php'>Ajouter une carte</a>
					</div>
				</nav>
				<nav>
					<div id='supprCarte'>
						<a href='ajoutCartes.html'>Supprimer une/des carte(s)</a>
					</div>
				</nav>
				<nav id='groupe'>
				</nav>
				<nav id='cartes'>
					$table
				</nav>
				<nav id='tri'>
					<form method = 'POST'>
					<select name ='tri'>
						<option value ='chrono' selected='selected'>Ordre chronologique</option>
						<option value='alpha'>Ordre alphabétique</option>
					</select>
					<input type='submit' name = 'conf'></button>
					</form>
				</nav>
			</div>
	</body>
	</html>";}
}
?>
