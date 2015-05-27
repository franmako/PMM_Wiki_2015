<?php 
if(!empty($_SESSION) AND ($_SESSION['userlevel'] != USER_ACTIVATION OR $_SESSION['userlevel'] != USER_BANNED OR $_SESSION['userlevel'] != USER_FROZEN)){
	$target_dir = "images/avatars/";
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	$uploadOk = false;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check if image file is an actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["photo"]["tmp_name"]);
		if($check != false) {
			echo "<p>Image uploadé " . $check["mime"] . ".</p>";
			$uploadOk = true;
		}else {
			echo "<p>Le fichier n'est pas une image!</p>";
			$uploadOk = false;
		}	
	}

	// Check file size
	if ($_FILES["photo"]["size"] > 1024000) {
		echo "<p>Le fichier est trop gros! Il doit être de 1MB max.</p>";
		$uploadOk = false;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
		echo "<p>Le format de l'image n'est pas supporté par le site</p>";
		$uploadOk = false;
	}	
	// Check if $uploadOk is set to 0 by an error
	if (!$uploadOk) {
		echo "<p>Le fichier n'as pas été uploadé</p>";
		// if everything is ok, try to upload file
	}else {
		if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
			$avatar_filename= basename($_FILES["photo"]["name"]);		
			$userID= $_SESSION['userID'];
			$db_connect= db_connect();
			$query="UPDATE avatars SET filename='$avatar_filename' WHERE users_id=$userID";
			$result= $db_connect->query($query);
			$query= "UPDATE users SET hasAvatar=1 WHERE id=$userID";
			$result= $db_connect->query($query);
      		$redimOK = redimImage(AVATAR_MAX_WIDTH,AVATAR_MAX_HEIGHT,'','',AVATAR_PATH,$avatar_filename);
			
			if($result AND $redimOK){
				echo "<p>Le fichier ". basename( $_FILES["photo"]["name"]). " a été uploadé.</p>";
				echo '<img src="images/avatars/'.$avatar_filename.'" alt="Profile Image">';
			}
		} else {
			echo "<p>Erreur sur l'upload du fichier.</p>";
		}
	}
}else {
	unauthorizedAccess();
}

?>