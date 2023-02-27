<?php
	include("include/oneDice.php");
	include("include/sixDices.php");

	function removeSession() {

		session_unset();
		
		if( ini_get( "session.use_cookies" ) ) {
			
			$sessionCookieData = session_get_cookie_params();

			$path = $sessionCookieData["path"];
			$domain = $sessionCookieData["domain"];
			$secure = $sessionCookieData["secure"];
			$httponly = $sessionCookieData["httponly"];
			
			setcookie( session_name(), "", time() - 3600, $path, $domain, $secure, $httponly );
		
		}
		session_destroy();
	}

	function publishData( $inSum, $inNbr ) {

		$avg = 0;

		if($inSum > 0 && $inNbr > 0) {
			$avg = number_format( ( $inSum / $inNbr ), 2 );
		}

		return "<div><p>Antal: $inNbr</p><p>Totalt: $inSum</p><p>Medel: $avg</p></div>";

	}

	$disabled = true;


?>
<!doctype html>
<html lang="en" >

	<head>
		<meta charset="utf-8">
		<title>Roll the dice...</title>
		<link href="style/style.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	</head>

	<body>
	
		<div>
			<?php 
				/*
					Till ert förfogande har ni för session två klasser och två funktioner så studera dessa noggrant innan ni börjar.

					Kravspecen:

					1. 	När användaren klickar på länken med variabeln linkNewGame skall:
						a. Texten ”New Game!” visas för användaren och
						b. Sessionsvariablerna nbrOfRounds och sumOfAllRounds skapas och tilldelas värdet 0.
						c. Länkarna linkRoll och linkExit skall göras användabara.

						Tips!
						En kontroll!
						Variabeln $disabled!
					
					2. 	Om användaren klickar på länken med variabeln linkExit och sessionsvariablerna nbrOfRounds och sumOfAllRounds finns på servern skall:
						a. 	sessionen avslutas.
						b. 	Sessionskakan tas bort på klienten.
						b. 	Länkarn linkExit och linkroll skall inte längre vara användbara. 

						Tips!
						Tre kontroller!
						Variabeln $disabled!

					3. 	Om användaren inte har klickat på någon av länkarna (varken linkNewGame, linkRoll eller linkExit) och ingen av sessionsvariablerna existerar i sessionen (varken nbrOfRounds eller sumOfAllRounds) skall: 
						a. 	sessionen avslutas.
						b. 	Sessionskakan tas bort på klienten.
						b. 	Länkarn linkExit och linkroll skall inte längre vara användbara. 

						Tips!
						Fem kontroller!
						Variabeln $disabled!	
					

					4. 	Om användaren inte har klickat på någon av länkarna (varken linkNewGame, linkRoll eller linkExit) men båda sessionsvariablerna (nbrOfRounds och sumOfAllRounds) finns på servern skall:
						a. 	Användaren se antalet gånger ni rullat de sex tärningarna, totalsumman av alla rullningar och medelvärdet för alla rullningar. 
						b. 	Länkarna linkExit och linkroll skall också göras användbara. 

					   	Tips!
					   	Fem kontroller!
					   	Variabeln $disabled!
						
					5.	Om användaren klickat på länken med variabeln linkRoll och sessionsvariablerna nbrOfRounds och sumOfAllRounds finns på servern skall:
						a.	Sex tärningar rullas och resultatet visas som bilder på tärningarna. 
						b. 	Därtill skall ni också för användaren presentera antalet gånger ni rullat de sex tärningarna, 
							totalsumman av alla rullningar och medelvärdet för alla rullningar. 
						c.	Länkarna linkExit och linkroll skall också göras användbara.
						d. 	Avslutningsvis skall också innehållet i sessionsvariablerna nbrOfRounds och sumOfAllRounds uppdateras.

						Tips!
						Tre kontroller!
						Variabeln $disabled!
			
				*/
			?>
		</div>
		
		<a href="<?php echo( $_SERVER["PHP_SELF"] ); ?>?linkRoll=true" class="btn btn-primary <?php if($disabled) { echo("disabled"); } ?>">Roll six dices</a> 
		<a href="<?php echo( $_SERVER["PHP_SELF"] ); ?>?linkNewGame=true" class="btn btn-primary">New game</a>
		<a href="<?php echo( $_SERVER["PHP_SELF"] ); ?>?linkExit=true" class="btn btn-primary <?php if($disabled) { echo("disabled"); } ?>">Exit</a>
		
		<script src="script/animation.js"></script>
		
	</body>

</html>