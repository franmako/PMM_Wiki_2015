<?php
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	if (isset($_POST['email_new']) AND isset($_POST['password'])) {
		$email_new= $_POST['email_new'];
		$password= $_POST['password'];
		$db_connect= db_connect();
		$userID_admin= $_SESSION['userID'];
		$userID_user= $_GET['id'];
		
		$query_username= "SELECT * FROM users WHERE id=$userID_user";
		$row_user= getRow($query_username);
		if ($row_user) {
			$username= $row_user['username'];
		} else {
			echo "Erreur!";
		}
	
		$query_salt="SELECT * FROM salts WHERE users_id=$userID_admin";
		$row_salt=getRow($query_salt);
		$salt_db= $row_salt['salt'];
		if ($salt_db) {
			$hash= crypt($password,$salt_db);
		} else {
			echo "Erreur!";
		}
		
		
		$query= "SELECT * FROM users WHERE id = '$userID_admin';";
		$row= getRow($query);
		if($row){
			$hash_db= $row['password'];
		}else {
			echo "Erreur";
			print_r(1);
		}
		
		if (hash_equals($hash_db, $hash)){
			$query="SELECT * FROM users WHERE email = '$email_new';";
			$checkUserName= $db_connect->query($query);
			if (mysqli_num_rows($checkUserName) == 1) {
				echo "Un compte est déjà associé à cette adresse e-mail.";
			}else {
				//print_r($userID_user);
				$query_messages= "UPDATE messages SET email_author='$email_new' WHERE authorID=$userID_user";
				$update_messages= $db_connect->query($query_messages);
				$query_update_db= "UPDATE users SET email='$email_new' WHERE id=$userID_user";
				$update_email= $db_connect->query($query_update_db);
				if($update_email){
					$activation_key = md5(microtime(TRUE)*100000);//Generate activation key
										
					$query_status_update= "UPDATE status SET isReactivation=1 WHERE users_id=$userID_user;";
        			$db_connect->query($query_status_update);
				
					$query_actication_update= "UPDATE activation SET email_key='$activation_key' WHERE users_id=$userID_user;";
        			$db_connect->query($query_actication_update);
        		
					$emailfrom=CONTACT_NOTIFY;
					$from="From:";
					$from .= $emailfrom;
					$sujet= "[Activation] Ré-activer votre compte";
					$contenu=
					'Bonjour,
 
					Pour activer votre compte avec cet adresse e-mail, veuillez cliquer sur le lien ci dessous
					ou copier/coller dans votre navigateur internet.
					
 					http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'.'index.php?rq=account_activate&log='.urlencode($username).'&cle='.urlencode($activation_key).'
 					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
					$to=$email_new;
					$sent = mail($to,$sujet,$contenu,$from);
				
					$emailfrom=CONTACT_NOTIFY;
					$from="From:";
					$from .= $emailfrom;
					$sujet= "Adresse e-mail changé!";
					$contenu=
					'Bonjour,
 
					L\'adresse e-mail associée à cet utilisateur vient d\'être changé par l\'administrateur!
 					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre. ';
					$to=$email_current;
					$sent = mail($to,$sujet,$contenu,$from);
				
				
			
					echo '<p> L\'adresse e-mail a été changée avec succès. </p>';
				}else {
					echo "Erreur!";
					print_r(2);
				}
			}
		}else {
			echo 'Mot de passe incorrect! <a href="index.php?rq=change_email">Cliquez-ici</a> pour ré-essayer.';
		}
	}else {
		echo "Les champs requis ne sont pas valides! Veuillez recommencer.";
	}
}elseif (!empty($_SESSION)){
	if (isset($_POST['email_new']) AND isset($_POST['password'])) {
		$email_new= $_POST['email_new'];
		$password= $_POST['password'];
		$db_connect= db_connect();
		$userID= $_SESSION['userID'];
		
		$query_salt="SELECT * FROM salts WHERE users_id=$userID";
		$row_salt=getRow($query_salt);
		$salt_db= $row_salt['salt'];
		$hash= crypt($password,$salt_db);
		$query= "SELECT * FROM users WHERE id = '$userID';";
		$row= getRow($query);
		if($row){
			$hash_db= $row['password'];
		}
		
		if (hash_equals($hash_db, $hash)){
			$query_user= "SELECT * FROM users WHERE id = '$userID';";
			$row_user= getRow($query_user);
			if ($row_user) {
				$username= $row_user['username'];
				$email_current= $row_user['email'];
			}
					
			$query="SELECT * FROM users WHERE email = '$email_new';";
			$checkUserName= $db_connect->query($query);
			if (mysqli_num_rows($checkUserName) == 1) {
				echo "Un compte est déjà associé à cette adresse e-mail.";
			}else {			
				$query_update_db= "UPDATE users SET email='$email_new' WHERE id=$userID";
				$update_email= $db_connect->query($query_update_db);
				if($update_email){
					$activation_key = md5(microtime(TRUE)*100000);//Generate activation key
										
					$query_status_update= "UPDATE status SET isReactivation=1 WHERE users_id=$userID_user;";
        			$db_connect->query($query_status_update);
				
					$query_actication_update= "UPDATE activation SET email_key='$activation_key' WHERE users_id=$userID;";
        			$db_connect->query($query_actication_update);
        		
					$emailfrom=CONTACT_NOTIFY;
					$from="From:";
					$from .= $emailfrom;
					$sujet= "[Activation] Ré-activer votre compte";
					$contenu=
					'Bonjour,
 
					Pour activer votre compte avec cet adresse e-mail, veuillez cliquer sur le lien ci dessous
					ou copier/coller dans votre navigateur internet.
					
 					http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'.'index.php?rq=account_activate&log='.urlencode($username).'&cle='.urlencode($activation_key).'
 					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';
					$to=$email_new;
					$sent = mail($to,$sujet,$contenu,$from);
				
					$emailfrom=CONTACT_NOTIFY;
					$from="From:";
					$from .= $emailfrom;
					$sujet= "Adresse e-mail changé!";
					$contenu=
					'Bonjour,
 
					L\'adresse e-mail associée à cet utilisateur vient d\'être changé!
 					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre. Veuillez contacter l\'admin si ce changement ne vient pas de vous.';
					$to=$email_current;
					$sent = mail($to,$sujet,$contenu,$from);
				
				
			
					echo '<p> L\'adresse e-mail a été changée avec succès. Celui-ci doit être activé. </p>';
				}else {
					echo "Erreur !";
					print_r(3);
				}
			}
		}else {
			echo "Mot de passe incorrect!";
		}
	}else {
		echo "Les champs requis ne sont pas valides! Veuillez recommencer.";
	}
}else {
	unauthorizedAccess();
}
?>