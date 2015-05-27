<?php 
if (!empty($_SESSION)) {
	echo 
	'
	<h3>Uploader un avatar</h3>
	<form action="index.php?rq=avatar_upload_action" method="post" enctype="multipart/form-data">
		Choisir une image à uploader (Taille max. de 1 Mo):
		<input type="file" name="photo" size="25"/>
		<input type="submit" value="Uploader Image" name="submit">
	</form>
	';
} else {
	unauthorizedAccess();
}


?>
