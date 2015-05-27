<?php
if (!empty($_SESSION) AND (($_SESSION['userlevel'] == USER_ADMIN) OR ($_SESSION['userlevel'] == USER_MODERATOR) OR ($_SESSION['userlevel'] == USER_NORMAL))) {
	$db_connect= db_connect();
	$subjectID= $_GET['subject_id'];
	$query_subject= "SELECT * FROM subject WHERE id= $subjectID";
	if ($result_subject= mysqli_query($db_connect, $query_subject)) {
		$row_subject = mysqli_fetch_array($result_subject);
		$authorID= $row_subject['authorID'];
		$modoID= $row_subject['moderatorID'];
		$query_page= "INSERT INTO page (id,subject_id,keyword,content,creation_date,last_modif) VALUES (NULL,$subjectID,NULL,NULL,NOW(),NOW())";
		if (mysqli_query($db_connect, $query_page)) {
			$pageID= mysqli_insert_id($db_connect);
			if ($_SESSION['userID'] == $authorID) {
				echo 
				'
				<form method="post" action="index.php?rq=write_page_action&page_id='.$pageID.'&subject_id='.$subjectID.'">
					<table border="0" cellpadding="0" cellspacing="5">
						<tr>
							<td align="right">
								<p class="signup">Mot-Clé</p>
							</td>
							<td>
								<input name="keyword" type="text" "maxlength="100" size="25" />
							</td>
						</tr>
						<tr align="right">
							<td align="right">
								<p class="signup">Contenu</p>
							</td>
							<td>
								<textarea name="content" cols="40" rows="5" ></textarea>
								<font color="orangered" size="+1"><tt><b>*</b></tt></font>
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" name="send" value="Créer la page" />
							</td>
    					</tr>	
					</table>
				</form>';
		} else {
			echo "Vous ne pouvez pas modifier ce sujet!";
		}
	}else {
		echo "Error: " . $query_page . "<br>" . mysqli_error($db_connect);
	}
	} else {
		echo "Error: " . $query_subject . "<br>" . mysqli_error($db_connect);
	}
} else {
	unauthorizedAccess();
}



?>