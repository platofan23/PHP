<?php
//Funktion definieren
function unsetSession()
{	//Crsf-Token leeren
	unset($_SESSION['_crsf_token']);
	unset($_SESSION['hash']);
}
//Funktion definieren
function regenerateSession()
{
	//Crsf-Token erneuern
	unsetSession();
	setSession();
}
//Funktion definieren
function setSession()
{	//Neues Crsf-Token generieren und in Session speichern
	$_SESSION['_csrf_token'] = base64_encode(random_bytes(16));
	$token = bin2hex(random_bytes(32));
	$_SESSION['token'] = $token;
	$hash = password_hash($token, PASSWORD_DEFAULT);
	$_SESSION['hash'] = $hash;
}
?>