<?php 
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$db_connect= db_connect();
	$subjectID= $_GET['subject_id'];
	$query_modo= "UPDATE subject SET moderatorID= NULL WHERE id=$subjectID";
	if (mysqli_query($db_connect, $query_modo)) {
		echo "Le modérateur a été enlevé du sujet";
	}else {
		echo "Error: " . $query_modo . "<br>" . mysqli_error($db_connect);
	}
}else {
	unauthorizedAccess();
}
?>