<?php
				$servername = "172.17.0.4:3306";
				$username = "show";
				$password = "vue123";
				$dbname = "smartscan";
				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
				$result = $conn->query("select Nom, Prenom,Mail, Telephone, Adresse, Localite, NomSociete, Activite, SiteWeb  from Contacts where premium =1")or die($mysqli->error());
				if( $result->num_rows == 0){
						$_SESSION['message']= "Il n'y a pas encore de cartes mises en avant";
						print $_SESSION['message'];
						}
				else{
				$primeCards = mysqli_fetch_all($result,MYSQLI_ASSOC);
				$str = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>Nom Société</th><th>Activite</th><th>Site web</th></tr>";
										if($primeCards) {
											  foreach($primeCards as $val) {
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Nom'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Prenom'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['Mail'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Telephone'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['Adresse'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Localite'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['NomSociete'] . "</td>";
											    $str .= "<td style='font-size: 1.2vw;'>" . $val['Activite'] . "</td>";
												$str .= "<td style='font-size: 1.2vw;'>" . $val['SiteWeb'] . "</td>";
											    $str .= "</tr>";
											    
	 										 }
										}
											$str.= "</table>";
											
				if(!isset($_POST['conf'])){
				echo"
				<html lang='fr'>
						<head>
							<meta charset='utf-8'>
							<title>Toutes les cartes</title>
							<link rel='stylesheet' href='CSS/toutesCartes.css'>
							<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
						</head>
						<body>
							<div id='header'>
								<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
								<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
							</div>	
							<div id='content'>		
								<div id='center'>
									<div id='tri'>
										<form method = 'POST'>
											<input id='rech' type='search' placeholder='Entrez votre recherche' name='q' />
											<input id='button' type='submit' name = 'conf'></button>
										</form>
									</div>	
									<nav id='cartes'>
									$str
									</nav>
								</div>
							</div>
					</body>
				</html>";
				}
				}
				if(isset($_POST['conf'])){
					$search = $_POST['q'];
					$servername = "172.17.0.4:3306";
					$username = "show";
					$password = "vue123";
					$dbname = "smartscan";
					$conn2 = new mysqli($servername, $username, $password, $dbname);
					$result2 = $conn2->query("SELECT Nom, Prenom,Mail, Telephone, Adresse, Localite, NomSociete, Activite, SiteWeb  from Contacts WHERE premium = 1 and CONCAT(Nom, Prenom,Mail, Telephone, Adresse, Localite, NomSociete, Activite, SiteWeb) LIKE '%".$search."%'")or die($mysqli->error());
					if( $result->num_rows != 0){
				$primeCardsSearch = mysqli_fetch_all($result2,MYSQLI_ASSOC);
				$strSearch = "<table><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>Telephone</th><th>Adresse</th><th>Localite</th><th>Nom Société</th><th>Activite</th><th>Site web</th></tr>";
										if($primeCardsSearch) {
											  foreach($primeCardsSearch as $val) {
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
											echo"
				<html lang='fr'>
						<head>
							<meta charset='utf-8'>
							<title>Toutes les cartes</title>
							<link rel='stylesheet' href='CSS/toutesCartes.css'>
							<link rel='icon' type='image/png' href='CSS/IMG/logo.png'/>
						</head>
						<body>
							<div id='header'>
								<a href='index.php'><img id='logo' src='CSS/IMG/logo.png' alt='SmartScanBC'></a>
								<a href='index.php'><img id='smartscanbc' src='CSS/IMG/smartscanbc.png' alt='SmartScanBC'></a>
							</div>	
							<div id='content'>		
								<div id='center'>
									<div id='tri'>
										<form method = 'POST'>
											<input id='rech' type='search' placeholder='Entrez votre recherche' name='q' />
											<input id='button' type='submit' name = 'conf'></button>
										</form>
									</div>	
									<nav id='cartes'>
									$strSearch
									</nav>
								</div>
							</div>
					</body>
				</html>";
		}
		else {
		echo "No result";
		}
	}
php?>