<?php
	include_once dirname(__FILE__)."/../frontend/frontendUtilities.php";
	include_once dirname(__FILE__)."/../utilities.php";
	function verarbeiteAnmeldung($nrt, $emailUnescaped, $merken, $passwort) {
		$db = oeffneBenutzerDB($nrt);
		
		$email = $db->real_escape_string(strtolower($emailUnescaped));
		$pwTest = benutzerPwTest($db, $email, $passwort);
		
		if ($pwTest == WRONG_EMAIL) {
			$nrt->fehler("Falsche Email");
			return false;
		} elseif ($pwTest == WRONG_COMBINATION) {
			$nrt->fehler("Falsches Passwort");
			return false;
		} elseif ($pwTest == PASSWORD_PASS) {
			$nrt->okay("Anmeldung erfolgreich");
			$_SESSION["semail"] = $email;
			$_SESSION["seid"] = EmailZuNutzerID($email,$nrt);
			if ($merken) {
				setcookie("email",$email,time()+1*60*60*24*7,"/");//email cookie wird gesetzt (1 Woche)
			}
			else{
				setcookie("email",null,-1,"/");
			}
			session_regenerate_id(true);//Session wird neu gestartet
			return true;
		}
	}
?>