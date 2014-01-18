<!DOCTYPE HTML>
<?php
include "../utilities.php";

session_start();
debugModus();
if((!isset($_SESSION["semail"]))||($_SESSION["semail"]=="")){//Nicht angemeldet
	session_destroy();
	header("Location: http://".host.dirname(dirname($_SERVER["REQUEST_URI"]))."/Anmeldung.php");//Umleitung zur Anmeldung
}

include "Menu.php";
$menu = new Menu();
$menu->add(new Menupunkt("dashboard","Dashboard","dashboard.php",true));
$menu->add(new Menupunkt("download","Download","download.php"));
$menu->add(new Menupunkt("upload","Upload","upload.php"));
$menu->add(new Menupunkt("gruppen","Gruppen","gruppen.php"));
$menu->add(new Menupunkt("konto","Benutzerkonto","benutzerkonto.php"));
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
	<link type="text/css" rel="stylesheet" href="/github/fileshare/css/style.css">
	<link type="text/css" rel="stylesheet" href="/github/fileshare/css/frontendStyle.css">
	<script src="/github/fileshare/js/frontend.js"></script>
</head>
<body>
<div id='header'>
	<i><h1 id='banner'>Secureshare</h1></i>
	<a href="../abmelden.php" id="abmelden">abmelden</a>
</div>
<div id="contentWrapper">
	<div id="menu">
		<?=$menu->toHTML()?>
	</div>
	<div id="panel">
		<h1>Dashboard</h1>
	</div>
</div>
</body>
</html>