<?php
if (!empty($_SESSION) AND (($_SESSION['userlevel'] == USER_ADMIN) OR ($_SESSION['userlevel'] == USER_MODERATOR) OR ($_SESSION['userlevel'] == USER_NORMAL))) {
	echo "Supprimer page"; 
}else {
	unauthorizedAccess();
}
?>