<?php
$password = $_POST['password'];
$password_verif= $_POST['password_verif']; 
$key= $_GET['cle'];
$userID= $_GET['id'];
if($password_verif != $password){
	echo 'La vérification du mot de passe et le mot de passe sont différents! <a href=index.php?rq=password_reset_form&id='.$userID.'&cle='.$key.'>Cliquez-ici</a> pour recommencer.';
}elseif (!preg_match("#.*^(?=.{".PASSWORD_MIN_SIZE.",".PASSWORD_MAX_SIZE."})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)) {//Vérification de la sécurité du mot de passe 
		echo "Le mot de passe est trop court ou ne contient pas tous les caractère requis ! <a href=index.php?rq=password_reset_form&id='.$userID.'&cle='.$key.'>Cliquez-ici</a> pour recommencer.";
}else {
	$query_users= "SELECT * users WHERE id=$userID";
	$row_users= getRow($query_users);
	if ($row_users) {
		$email= $row_users['email'];
	} else {
		echo "Erreur!";
	}
	
	$query_salt= "SELECT * FROM salts WHERE users_id=$userID";
	$row_salts= getRow($query_salt);
	$salt= $row_salts['salt'];
	$hash = getHash($password, $salt);
	
	$query_users= "UPDATE users SET password='$hash' WHERE id=$userID";
	$result_users= $db_connect->query($query_users);
	if ($result_users) {
		$db_connect= db_connect();
		$query_status= "UPDATE status SET isPwdForgotten=0 WHERE users_id=$userID";
		$result_status= $db_connect->query($query_status);
		if ($result_status) {
			$emailfrom=CONTACT_NOTIFY;
			$from="From:";
			$from .= $emailfrom;
			$sujet= "[Notifixation]Mot de passe changé!";
			$contenu=
			'Bonjour,
 
			Le mot de passe associé à cet adresse e-mail vient d\'être changé!
 			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre. Veuillez contacter l\'admin si ce changement ne vient pas de vous.';
			$to=$email;
			$sent = mail($to,$sujet,$contenu,$from);
			echo "Mot de passe changé! Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.";
		} else {
			echo "Erreur!";
		}			
	} else {
		echo "Erreur!";
	}
	
}
?>