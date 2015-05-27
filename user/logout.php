<?php
if (!empty($_SESSION)) {
	echo "Déconnexion en cours...";
	$_SESSION = array(); 
	session_destroy(); 
	echo '<meta http-equiv="refresh" content="3" url="index.php"/>';
} else {
	echo "Vous êtes déconnecté!";
}
?>
