<script>
			function catFind(element){
				document.getElementById("rech").value=element;
			}
</script>
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
							$catResult = $conn2->query("select Cat from Contacts where id_Utilisateur ='$id_Utilisateur' and Cat IS NOT NULL order by Cat")or die($mysqli->error());
							if( $catResult-> num_rows > 0){
							$cat = mysqli_fetch_all($catResult,MYSQLI_ASSOC);
							$categories='';
								if($cat){
									foreach($cat as $val){
										$value =(string)$val['Cat'];
										$categories.='<br><a onclick = catFind("'.$val['Cat'].'")>'.$value.'</a><br><br>';
									}
								}
							}
								if(isset($_POST['conf'])){
									if($_POST['tri']=='alpha' and !$_POST['q']){
									$result2 =$conn2->query("select * from Contacts where id_Utilisateur ='$id_Utilisateur' order by NomSociete")or die($mysqli->error());
										if( $result2->num_rows == 0){
									$_SESSION['message']= "You don't have save any BC";
									print $_SESSION['message'];
									}
								else{
									$myCards = mysqli_fetch_all($result2,MYSQLI_ASSOC);
										$str = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>Nom Société</th><th>Activite</th><th>Site web</th></tr>";
										if($myCards) {
											  foreach($myCards as $val) {
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Nom'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Prenom'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['Mail'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Telephone'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['Adresse'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Localite'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['NomSociete'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Activite'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['SiteWeb'] . "</td>";
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
			<title>SmartScan BC - Mes cartes</title>
			<link rel='stylesheet' href='CSS/userHomePage.css'>
			<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
		</head>
		<body>
			<div id='header'>
				<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
				<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
				<div id='compte'>
					<a href='compte.php'>Mon compte</a>
				</div>
				<div id='deco'>
					<a href='?hello=true'>Déconnexion</a>
				</div>
			</div>
			
			
			<div id='content'>
			
				<div id='left'>
					<nav id='groupe'>
						<img id='addGroup' src='CSS/IMG/ajouter4.png' alt='SmartScanBC'>
						$categories
					</nav>
				</div>
				
				
				<div id='center'>
					<div id='tri'>
						<form method = 'POST'>
							<select name ='tri'>
								<option value ='chrono' >Ordre chronologique</option>
								<option value='alpha' selected='selected'>Ordre alphabétique</option>
							</select>
							<input id='button' type='submit' name = 'conf'></button>
							<input id='rech' type='search' placeholder='Entrez votre recherche' name='q' />
						</form>
					</div>
					
					<div id='ajoutCarte'>
						<a href='ajoutCartes.php'>Ajouter une carte</a>
					</div>
					<nav id='cartes'>
						$table
					</nav>
				</div>
			</div>
	</body>
</html>";
									}
									if($_POST['tri']=='chrono' and !$_POST['q']){
									$result2 =$conn2->query("select * from Contacts where id_Utilisateur ='$id_Utilisateur' order by id_Contact")or die($mysqli->error());
										if( $result->num_rows == 0){
									$_SESSION['message']= "You don't have save any BC";
									print $_SESSION['message'];
									}
								else{
									$myCards = mysqli_fetch_all($result2,MYSQLI_ASSOC);
										$str = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>Nom Société</th><th>Activite</th><th>Site web</th></tr>";
										if($myCards) {
											  foreach($myCards as $val) {
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Nom'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Prenom'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['Mail'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Telephone'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['Adresse'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Localite'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['NomSociete'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Activite'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['SiteWeb'] . "</td>";
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
			<title>SmartScan BC - Mes cartes</title>
			<link rel='stylesheet' href='CSS/userHomePage.css'>
			<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
		</head>
		<body>
			<div id='header'>
				<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
				<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
				<div id='compte'>
					<a href='compte.php'>Mon compte</a>
				</div>
				<div id='deco'>
					<a href='?hello=true'>Déconnexion</a>
				</div>
			</div>
			
			
			<div id='content'>
			
				<div id='left'>
					<nav id='groupe'>
						<img id='addGroup' src='CSS/IMG/ajouter4.png' alt='SmartScanBC'>
						$categories
					</nav>
				</div>
				
				
				<div id='center'>
					<div id='tri'>
						<form method = 'POST'>
							<select name ='tri'>
								<option value ='chrono' selected='selected'>Ordre chronologique</option>
								<option value='alpha'>Ordre alphabétique</option>
							</select>
							<input id='button' type='submit' name = 'conf'></button>
							<input id='rech' type='search' placeholder='Entrez votre recherche' name='q' />
						</form>
					</div>
					
					<div id='ajoutCarte'>
						<a href='ajoutCartes.php'>Ajouter une carte</a>
					</div>
					<nav id='cartes'>
						$table
					</nav>
				</div>
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
									$str = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>Nom Société</th><th>Activite</th><th>Site web</th></tr>";
									if($myCards) {
										  foreach($myCards as $val) {
										    $str .= "<tr>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Nom'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Prenom'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['Mail'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Telephone'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['Adresse'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Localite'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['NomSociete'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Activite'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['SiteWeb'] . "</td>";
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
				
			if($_POST['q']!='' and isset($_POST['conf'])){	
						
					$search = $_POST['q'];
					$servername = "172.17.0.4:3306";
					$username = "show";
					$password = "vue123";
					$dbname = "smartscan";
					$id =$_SESSION['id_Utilisateur'];
					$conn7 = new mysqli($servername, $username, $password, $dbname);
					$result7 = $conn7->query("SELECT Nom, Prenom,Mail, Telephone, Adresse, Localite, NomSociete, Activite, SiteWeb  from Contacts WHERE id_Utilisateur ='.$id.' and CONCAT(Nom, Prenom,Mail, Telephone, Adresse, Localite, NomSociete, Activite, SiteWeb, Cat) LIKE '%".$search."%'")or die($mysqli->error());
					if( $result7->num_rows != 0){
				$cardsSearch = mysqli_fetch_all($result7,MYSQLI_ASSOC);
				$strSearch = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>Nom Société</th><th>Activite</th><th>Site web</th></tr>";
										if($cardsSearch) {
											  foreach($cardsSearch as $val) {
											    $strSearch .= "<td style='font-size: 1.2vw;'>" . $val['Nom'] . "</td>";
											    $strSearch .= "<td style='font-size: 1.2vw;'>" . $val['Prenom'] . "</td>";
												$strSearch .= "<td style='font-size: 1.2vw;'>" . $val['Mail'] . "</td>";
											    $strSearch .= "<td style='font-size: 1.2vw;'>" . $val['Telephone'] . "</td>";
												$strSearch .= "<td style='font-size: 1.2vw;'>" . $val['Adresse'] . "</td>";
											    $strSearch .= "<td style='font-size: 1.2vw;'>" . $val['Localite'] . "</td>";
												$strSearch .= "<td style='font-size: 1.2vw;'>" . $val['NomSociete'] . "</td>";
											    $strSearch .= "<td style='font-size: 1.2vw;'>" . $val['Activite'] . "</td>";
												$strSearch .= "<td style='font-size: 1.2vw;'>" . $val['SiteWeb'] . "</td>";
											    $strSearch .= "</tr>";
											    
	 										 }
										}
											$strSearch.= "</table>";
					
					echo"<!DOCTYPE html>
	<html lang='fr'>
		<head>
			<meta charset='utf-8'>
			<title>SmartScan BC - Mes cartes</title>
			<link rel='stylesheet' href='CSS/userHomePage.css'>
			<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
		</head>
		<body>
			<div id='header'>
				<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
				<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
				<div id='compte'>
					<a href='compte.php'>Mon compte</a>
				</div>
				<div id='deco'>
					<a href='?hello=true'>Déconnexion</a>
				</div>
			</div>
			
			
			<div id='content'>
			
				<div id='left'>
					<nav id='groupe'>
						<img id='addGroup' src='CSS/IMG/ajouter4.png' alt='SmartScanBC'>
						$categories
					</nav>
				</div>
				
				
				<div id='center'>
					<div id='tri'>
						<form method = 'POST'>
							<select name ='tri'>
								<option value ='chrono' selected='selected'>Ordre chronologique</option>
								<option value='alpha'>Ordre alphabétique</option>
							</select>
							<input id='button' type='submit' name = 'conf'></button>
							<input id='rech' type='search' placeholder='Entrez votre recherche' name='q' />
						</form>
					</div>
					
					<div id='ajoutCarte'>
						<a href='ajoutCartes.php'>Ajouter une carte</a>
					</div>
					<nav id='cartes'>
						$strSearch
					</nav>
				</div>
			</div>
	</body>
</html>";
						
					}
				
				}

				if(!$_POST['q'] and !isset($_POST['conf']) ){
				echo"<!DOCTYPE html>
	<html lang='fr'>
		<head>
			<meta charset='utf-8'>
			<title>SmartScan BC - Mes cartes</title>
			<link rel='stylesheet' href='CSS/userHomePage.css'>
			<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
		</head>
		<body>
			<div id='header'>
				<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
				<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
				<div id='compte'>
					<a href='compte.php'>Mon compte</a>
				</div>
				<div id='deco'>
					<a href='?hello=true'>Déconnexion</a>
				</div>
			</div>
			
			
			<div id='content'>
			
				<div id='left'>
					<nav id='groupe'>
						<img id='addGroup' src='CSS/IMG/ajouter4.png' alt='SmartScanBC'>
						$categories
					</nav>
				</div>
				
				
				<div id='center'>
					<div id='tri'>
						<form method = 'POST'>
							<select name ='tri'>
								<option value ='chrono' selected='selected'>Ordre chronologique</option>
								<option value='alpha'>Ordre alphabétique</option>
							</select>
							<input id='button' type='submit' name = 'conf'></button>
							<input id='rech' type='search' placeholder='Entrez votre recherche' name='q' />
						</form>
					</div>
					
					<div id='ajoutCarte'>
						<a href='ajoutCartes.php'>Ajouter une carte</a>
					</div>
					<nav id='cartes'>
						$table
					</nav>
				</div>
			</div>
	</body>
</html>";
	}
}
?>
