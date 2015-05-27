<?php
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$userID_user= $_GET['id'];
	$userID_admin= $_SESSION['userID'];
	$status_new= $_POST['status'];
	$password= $_POST['password'];
	$db_connect= db_connect();
	
	$query_salt="SELECT * FROM salts WHERE users_id=$userID_admin";
	$row_salt=getRow($query_salt);
	$salt_db= $row_salt['salt'];
	$hash= crypt($password,$salt_db);
	$query= "SELECT * FROM users WHERE id = '$userID_admin';";
	$row= getRow($query);
	if($row != FALSE){
		$hash_db= $row['password'];
	}
		
	if (hash_equals($hash_db, $hash)){
		$query_status= "SELECT * FROM status WHERE users_id = $userID_user;";
		$row_status= getRow($query_status);
			if ($row_status) {
				$status_id= $row_status['id'];
			}	
		switch ($status_new) {
			case 1:
				$query_update_db= "UPDATE status SET level=$status_new,label_level='Modérateur' WHERE id=$status_id";
				$update_status= $db_connect->query($query_update_db);
				break;
			case 2:
				$query_update_db= "UPDATE status SET level=$status_new,label_level='Normal' WHERE id=$status_id";
				$update_status= $db_connect->query($query_update_db);
				break;
			case 7:
				$query_update_db= "UPDATE status SET level=$status_new,label_level='Dèsinscrit' WHERE id=$status_id";
				$update_status= $db_connect->query($query_update_db);
				break;
			case 8:
				$query_update_db= "UPDATE status SET level=$status_new,label_level='Banni' WHERE id=$status_id";
				$update_status= $db_connect->query($query_update_db);
				break;
		}
		
		if($update_status){
			$query_user= "SELECT * FROM users WHERE id = $userID_user;";
			$row_user= getRow($query_user);
			if ($row_user) {
				$email= $row_user['email'];
			}
			
			$emailfrom=CONTACT_NOTIFY;
			$from="From:";
			$from .= $emailfrom;
			$sujet= "Statut changé!";
			$contenu=
			'Bonjour,
 
			Le statut associé à cet utilisateur vient d\'être changé par l\'administrateur!
 			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre. ';
			$to=$email;
			$sent = mail($to,$sujet,$contenu,$from);
			if ($sent) {
				echo '<p> Le statut a été changé avec succès. </p>';
			}else {
				echo "Erreur du changement de statut!";
			}	
			
		}
	}else {
		echo "Mot de passe incorrect!";
	}
} else {
	unauthorizedAccess();
}
 
?>