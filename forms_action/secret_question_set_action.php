<?php 
$type= $_GET['type'];
if(!empty($_SESSION) AND $_SESSION['userlevel'] != USER_BANNED AND isset($_POST['question']) AND isset($_POST['answer']) AND $type== "new"){
	$question= $_POST['question'];
	$answer= $_POST['answer'];
	$userID= $_SESSION['userID'];
	$db_connect= db_connect();
	$query_salt= "SELECT * FROM salts WHERE users_id= $userID";
	$row_salt= getRow($query_salt);
	if ($row_salt) {
		$salt= $row_salt['salt'];
		$hash_answer= getHash($answer, $salt);
		$query_secret= "INSERT INTO secret_q_a (id,users_id,question,answer) VALUES(NULL,$userID,'$question','$hash_answer');";
		if (mysqli_query($db_connect, $query_secret)) {
			$query_update= "UPDATE users SET hasSecretQuestion=1 WHERE id=$userID";
			if (mysqli_query($db_connect, $query_update)) {
				echo "Question et réponse ajoutés avec succès!";
			}else {
				echo "Error: " . $query_update . "<br>" . mysqli_error($db_connect);
			}
		} else {
			echo "Error: " . $query_secret . "<br>" . mysqli_error($db_connect);
		}	
	} else {
		echo "Erreur! Veuillez recommencer la procédure.";
	}
}elseif (!empty($_SESSION) AND $_SESSION['userlevel'] != USER_BANNED AND isset($_POST['question']) AND isset($_POST['answer']) AND $type== "change") {
	$question= $_POST['question'];
	$answer= $_POST['answer'];
	$userID= $_SESSION['userID'];
	$db_connect= db_connect();
	$query_salt= "SELECT * FROM salts WHERE users_id= $userID";
	$row_salt= getRow($query_salt);
	if ($row_salt) {
		$salt= $row_salt['salt'];
		$hash_answer= getHash($answer, $salt);
		$query_secret= "UPDATE secret_q_a SET question='$question',answer='$hash_answer' WHERE users_id=$userID";
		if (mysqli_query($db_connect, $query_secret)) {
			echo "Question et réponse changés.";
		}else {
			echo "Error: " . $query_secret . "<br>" . mysqli_error($db_connect);
		}	
	}
}elseif (empty($_POST['question'])) {
	echo "Question non valide!";	
}elseif (empty($_POST['answer'])) {
	echo "Réponse non valide!";
}elseif (empty($_SESSION['connected'])) {
	unauthorizedAccess();
}
?>