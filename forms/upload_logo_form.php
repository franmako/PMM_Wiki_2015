<?php 
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	echo 
	'
	<h3>Uploader un nouveau logo</h3>
	<form action="index.php?rq=logo_upload_action" method="post" enctype="multipart/form-data">
		Choisir une image à uploader (Taille max. de 1 Mo):
		<input type="file" name="photo" size="25"/>
		<input type="submit" value="Uploader Image" name="submit">
	</form>
	';
} else {
	unauthorizedAccess();
}


?>
