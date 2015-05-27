<?php 
//echo "En attente...";
if (isset($_POST['password_new']) AND isset($_POST['password']) AND isset($_POST['password_verif']) AND (($_SESSION['userlevel'])== USER_ADMIN) OR (($_SESSION['userlevel'])== USER_MODERATOR) OR (($_SESSION['userlevel'])== USER_NORMAL)) {
	$password_new= $_POST['password_new'];
	$password_verif= $_POST['password_verif'];
	$password= $_POST['password'];
	$userID= $_SESSION['userID'];
	$email= $_SESSION['email'];
	
	//print_r($userID);
	if($password_new == $password_verif){
	$query_password_check= "SELECT * FROM users_noyau WHERE id=$userID AND password='$password'";
	$db_connect= db_connect();
	$password_check= $db_connect->query($query_password_check);

	if (mysqli_num_rows($password_check) == 1) {
		$query_update_db= "UPDATE users_noyau SET password='$password_new' WHERE id=$userID";
		$update_username= $db_connect->query($query_update_db);
			if($update_username){
				//echo "success4";
				$emailfrom=CONTACT_NOTIFY;
				$from="From:";
				$from .= $emailfrom;
				$sujet= "Mot de passe changé!";
				$contenu=
				'Bonjour,
 
				Le mot de passe de l\'utilisateur associé à cet adresse e-mail vient d\'être changé!
 				---------------
				Ceci est un mail automatique, Merci de ne pas y répondre. Veuillez contacter l\'admin si ce changement ne vient pas de vous.';
				$to=$email;
				$sent = mail($to,$sujet,$contenu,$from);
			
				echo '<p> Le mot de passe a été changé avec succès. Reconnectez vous pour voir le changement. </p>';
				}
	}else {
		echo "Les champs requis ne sont pas valides!";
	}
	}
}else {
	unauthorizedAccess();
}
?>