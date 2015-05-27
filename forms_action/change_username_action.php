<?php 
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	if (isset($_POST['username_new']) AND isset($_POST['password'])) {
		$username_new= $_POST['username_new'];
		$password= $_POST['password'];
		$db_connect= db_connect();
		$userID_admin= $_SESSION['userID'];
		$userID_user= $_GET['id'];
		
		$query_salt="SELECT * FROM salts WHERE users_id=$userID_admin";
		$row_salt=getRow($query_salt);
		$salt_db= $row_salt['salt'];
		$hash= crypt($password,$salt_db);
		
		$query_user= "SELECT * FROM users WHERE id = '$userID_admin';";
		$row_user= getRow($query_user);
		if($row_user != FALSE){
			$hash_db= $row_user['password'];
		}
		
		if (hash_equals($hash_db, $hash)){
			$query_getuser= "SELECT * FROM users WHERE id=$userID_user";
			$row_user= getRow($query_getuser);
			$email= $row_user['email'];
			
			$query="SELECT * FROM users WHERE username = '$username_new';";
			$checkUserName= $db_connect->query($query);
			if (mysqli_num_rows($checkUserName) == 1) {
				echo 'Le nom d\'utilisateur est indisponible! Veuillez en choisir un autre. <a href="index.php?rq=change_username">Cliquez-ici</a> pour ré-essayer.';
			}elseif (strlen($username_new) < USERNAME_MIN_SIZE) {
				echo 'Le nom d\utilisateur n\'est pas assez long! <a href="index.php?rq=change_username">Cliquez-ici</a> pour ré-essayer.'; 
			}else {
				$query_update_db= "UPDATE users SET username='$username_new' WHERE id=$userID_user";
				$update_username= $db_connect->query($query_update_db);
				
				if($update_username){
					$emailfrom=CONTACT_NOTIFY;
					$from="From:";
					$from .= $emailfrom;
					$sujet= "Nom d'utilisateur changé!";
					$contenu=
					'Bonjour,
 	
					Le nom d\'utilisateur associé à cet adresse e-mail vient d\'être changé par l\'administrateur!
 					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre. ';
					$to=$email;
					$sent = mail($to,$sujet,$contenu,$from);
			
					echo '<p> Le nom d\'utilisateur a été changé avec succès. </p>';
				}
			}
		}else {
			echo "Le mot de passe est incorrect!";
		}
	}else {
		echo "Les champs requis ne sont pas valides! Veuillez recommencer.";
	}
} elseif (!empty($_SESSION)) {
	if (isset($_POST['username_new']) AND isset($_POST['password'])) {
		$username_new= $_POST['username_new'];
		$password= $_POST['password'];
		$db_connect= db_connect();
		$userID= $_SESSION['userID'];
		$email= $_SESSION['email'];
		
		$query_salt="SELECT * FROM salts WHERE users_id=$userID";
		$row_salt=getRow($query_salt);
		$salt_db= $row_salt['salt'];
		$hash= crypt($password,$salt_db);
		
		$query_user= "SELECT * FROM users WHERE id = '$userID';";
		$row_user= getRow($query_user);
		if($row_user != FALSE){
			$hash_db= $row_user['password'];
		}else {
			echo "Erreur!";
		}
		
		if (hash_equals($hash_db, $hash)){
			$query_getuser= "SELECT * FROM users WHERE id=$userID";
			$row_user= getRow($query_getuser);
			$email= $row_user['email'];
			
			$query="SELECT * FROM users WHERE username = '$username_new';";
			$checkUserName= $db_connect->query($query);
			if (mysqli_num_rows($checkUserName) == 1) {
				echo "Le nom d'utilisateur est indisponible! Veuillez en choisir un autre.";
			}else {
				$query_update_db= "UPDATE users SET username='$username_new' WHERE id=$userID";
				$update_username= $db_connect->query($query_update_db);
				if($update_username){
					$emailfrom=CONTACT_NOTIFY;
					$from="From:";
					$from .= $emailfrom;
					$sujet= "Nom d'utilisateur changé!";
					$contenu=
					'Bonjour,
 
					Le nom d\'utilisateur associé à cet adresse e-mail vient d\'être changé!
 					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre. Veuillez contacter l\'admin si ce changement ne vient pas de vous.';
					$to=$email;
					$sent = mail($to,$sujet,$contenu,$from);
			
					echo '<p> Le nom d\'utilisateur a été changé avec succès. Vous allez être déconnecté... </p>';
					include 'user/logout.php';
				}
			}
		}else {
			echo "Le mot de passe est incorrect!";
		}
	}else {
		echo "Les champs requis ne sont pas valides! Veuillez recommencer.";
	}
}else {
	unauthorizedAccess();
}

?>