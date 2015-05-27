<?php 
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$db_connect= db_connect();
	$subjectID= $_GET['subject_id'];
	$modoID= $_GET['modo_id'];
	$query_modo= "UPDATE subject SET moderatorID=$modoID WHERE id=$subjectID";
	if (mysqli_query($db_connect, $query_modo)) {
		$query_user= "SELECT * FROM users WHERE id=$modoID";
		if ($result_user= mysqli_query($db_connect, $query_user)) {
			$row_user = mysqli_fetch_array($result_user);
			$email= $row_user['email'];
			$emailfrom=CONTACT_NOTIFY;
			$from="From:";
			$from .= $emailfrom;
			$sujet= "[Modérateur] Sujet à modérer";
			$contenu=
			'Bonjour,
 
 			Vous avez été assigné comme modérateur pour un nouveau sujet par l\'administrateur.
 			---------------
			Ceci est un mail automatique, Merci de ne pas y répondre.';
			$to=$email;
			$sent = mail($to,$sujet,$contenu,$from);
			
			echo "Message envoyé au modérateur.";
		} else {
			echo "Error: " . $query_user . "<br>" . mysqli_error($db_connect);
		}
	}else {
		echo "Error: " . $query_modo . "<br>" . mysqli_error($db_connect);
	}
}else {
	unauthorizedAccess();
}
?>