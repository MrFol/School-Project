<?php
	include_once "../utilities.php";

	function verarbeiteEmailaenderung($nrt, $emailUnencoded, $pw, $neueEmailUnencoded) {
		$db = oeffneBenutzerDB($nrt);
	
		$email = $db->real_escape_string(strtolower($emailUnencoded));
		$neueemail = $db->real_escape_string(strtolower($neueEmailUnencoded));
		
		if (userExestiertBereits($db, $email)) {
			$passwortTest = benutzerPwTest($db, $email, $pw);
			if ($passwortTest == PASSWORD_PASS)  {
				return $db->query("UPDATE `Benutzer` SET Email='$neueemail' WHERE Email='$email'")->fold(
					function($ergebnis) use (&$nrt) {
						$nrt->okay("Email erfolgreich geändert");
						//Bestätigungs Email, dass das Pw geändert wurde
						return true;
					}, function($fehlerNachricht) use (&$nrt) {
						$nrt->fehler("Es gab einen Fehler beim Datenbankzugriff: $fehlerNachricht");
						return false;
					}
				);
			} else {
				$nrt->fehler("Email-Passwort Kombination passt nicht.");
				return false;
			}	
		}
		return true;
	}
?>