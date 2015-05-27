<?php 
if (!empty($_SESSION) AND (($_SESSION['userlevel'] == USER_ADMIN) OR ($_SESSION['userlevel'] == USER_MODERATOR) OR ($_SESSION['userlevel'] == USER_NORMAL))) {
	$title= $_POST['title'];
	$description= $_POST['description'];
	$visibility= $_POST['visibility'];
	$authorID= $_SESSION['userID'];
	$userlevel= $_SESSION['userlevel'];
	$db_connect= db_connect();
	$query_subject= "INSERT INTO subject(id,authorID,title,description,creation_date,last_modif,moderatorID,visibility,visibility_user_rank) VALUES (NULL,$authorID,'$title','$description',NOW(),NOW(),NULL,$visibility,$userlevel)";
	if (mysqli_query($db_connect, $query_subject)) {
    	$subjectID = mysqli_insert_id($db_connect);
		echo "<p>Nouveau sujet créé: ".$title."<br/></p>";
		$query_page= "INSERT INTO page (id,subject_id,keyword,content,creation_date,last_modif) VALUES (NULL,$subjectID,NULL,NULL,NOW(),NOW())";
		$result_page= $db_connect->query($query_page);
		$pageID= mysqli_insert_id($db_connect);
		if (mysqli_query($db_connect, $query_page)) {
			echo '<p>Page d\'entrée créée. <a href="index.php?rq=edit_page&page_id='.$pageID.'">Cliquez-ici</a> pour y ajouter du contenu</p>';
		} else {
			echo "Error: " . $query_page . "<br>" . mysqli_error($db_connect);
		}
	} else {
   		echo "Error: " . $query_subject . "<br>" . mysqli_error($db_connect);
	}
} else {
	unauthorizedAccess();
}



?>