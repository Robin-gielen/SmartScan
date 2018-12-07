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
							<select name ='tri'>
								<option value ='chrono' >Ordre chronologique</option>
								<option value='alpha' selected='selected'>Ordre alphabétique</option>
							</select>
							<input id='button' type='submit' name = 'conf'></button>
							<input id='rech' type='search' placeholder='Entrez votre recherche' name='q' />
						</form>
					</div>	
					<nav id='cartes'>
					</nav>
				</div>
			</div>
	</body>
</html>