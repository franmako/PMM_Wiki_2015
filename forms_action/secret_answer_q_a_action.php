<?php
if (empty($_SESSION) AND !empty($_GET['id'])) {
	$userID= $_GET['id'];
	$email= $_GET['email'];
	$db_connect= db_connect();
	$query= "SELECT * FROM status WHERE users_id=$userID";
	$status_row= getRow($query);
	if ($status_row) {
		$isPwdForgotten= $status_row['isPwdForgotten'];
		if ($isPwdForgotten == 1) {
			$answer= $_POST['answer'];
			$query_q_a= "SELECT * FROM secret_q_a WHERE users_id=$userID";
			$row_secret= getRow($query_q_a);
			if ($row_secret) {
				$answer_db= $row_secret['answer'];
				$query_salt="SELECT * FROM salts WHERE users_id=$userID";
			    $row_salt=getRow($query_salt);
				$salt_db= $row_salt['salt'];
				$hash= crypt($answer,$salt_db);
				if (hash_equals($answer_db, $hash)){
					$activation_key = md5(microtime(TRUE)*100000);//Generate activation key
					$query_activation= "UPDATE activation SET email_key='$activation_key' WHERE users_id=$userID";
        			$result= $db_connect->query($query_activation);
					
					if ($result) {
						$emailfrom=CONTACT_NOTIFY;
						$from="From:";
						$from .= $emailfrom;
						$sujet= "[Activation] Changement de mot de passe";
						$contenu=
						'Bonjour,
 
						Pour changer votre mot de passe, veuillez cliquer sur le lien ci dessous
						ou copier/coller dans votre navigateur internet.
						http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'.'index.php?rq=password_reset_form&id='.urlencode($userID).'&cle='.urlencode($activation_key).'
 						---------------
						Ceci est un mail automatique, Merci de ne pas y répondre.';
						$to=$email;
						$sent = mail($to,$sujet,$contenu,$from);
			
						echo '<p> Un email pour changer votre mot de passe vient d\'être envoyé. Veuillez changer votre mot de passe à l\'aide de celui-ci. </p>';
					} else {
						echo "Erreur!";
					}
				}else {
					echo "La réponse est incorrecte!";
				}
			} else {
				echo "Erreur!";
				//print_r(1);
			}
		} else {
			echo "Erreur!";
			//print_r(2);
		}
	} else {
		echo "Erreur!";
		//print_r(3);
	}
	
} else {
	unauthorizedAccess();
}
 
?>
