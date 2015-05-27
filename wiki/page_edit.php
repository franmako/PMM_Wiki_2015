<?php
if (!empty($_SESSION) AND (($_SESSION['userlevel'] == USER_ADMIN) OR ($_SESSION['userlevel'] == USER_MODERATOR) OR ($_SESSION['userlevel'] == USER_NORMAL))) {
	$db_connect= db_connect();
	$pageID= $_GET['page_id'];
	$query_page= "SELECT * FROM page WHERE id=$pageID";
	$row_page= getRow($query_page);
	$subjectID= $_GET['subject_id'];
	$query_subject= "SELECT * FROM subject WHERE id= $subjectID";
	if ($result_subject= mysqli_query($db_connect, $query_subject)) {
		$row_subject = mysqli_fetch_array($result_subject);
		$authorID= $row_subject['authorID'];
		$modoID= $row_subject['moderatorID'];
		$title= $row_subject['title'];
		$description= $row_subject['description'];
		if ($_SESSION['userID'] == $authorID) {
			echo 
			'
			<form method="post" action="index.php?rq=edit_page_action&page_id='.$pageID.'&subject_id='.$subjectID.'">
				<table border="0" cellpadding="0" cellspacing="5">
					<tr>
						<td align="right">
							<p class="signup">Titre du Sujet</p>
						</td>
						<td>
							<input name="title" value="'.$title.'"type="text" maxlength="100" size="25" />
							<font color="orangered" size="+1"><tt><b>*</b></tt></font>
						</td>
					</tr>
					<tr>
						<td align="right">
							<p class="signup">Description</p>
						</td>
						<td>
							<input name="description" value="'.$description.'"type="text" maxlength="100" size="25" />
							<font color="orangered" size="+1"><tt><b>*</b></tt></font>
						</td>
					</tr>
					<tr>
						<td align="right">
							<p class="signup">Visibilté</p>
						</td>
						<td>
							<select name="visibility">
								<option value="4">Pas de Choix</option>
								<option value="3">Anonyme</option>
								<option value="2">Membre</option>
								<option value="1">Modérateur</option>
								<option value="0">Admin</option>
							</select>
							<font color="orangered" size="+1"><tt><b>*</b></tt></font>
						</td>
					</tr>
					<tr>
						<td align="right">
							<p class="signup">Mot-Clé</p>
						</td>
						<td>
							<input name="keyword" type="text" value="'.$row_page['keyword'].'"maxlength="100" size="25" />
						</td>
					</tr>
					<tr align="right">
						<td align="right">
							<p class="signup">Contenu</p>
						</td>
						<td>
							<textarea name="content" value="'.$row_page['content'].'" cols="40" rows="5" ></textarea>
							<font color="orangered" size="+1"><tt><b>*</b></tt></font>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="send" value="Sauvegarder la page" />
						</td>
    				</tr>	
				</table>
			</form>
			';
		} elseif ($_SESSION['userID'] == $modoID) {
			echo 
			'
			<form method="post" action="index.php?rq=edit_page_action&page_id='.$pageID.'&subject_id='.$subjectID.'">
				<table border="0" cellpadding="0" cellspacing="5">
					<tr>
						<td align="right">
							<p class="signup">Titre du Sujet</p>
						</td>
						<td>
							<input name="title" value="'.$title.'"type="text" maxlength="100" size="25" readonly/>
							<font color="orangered" size="+1"><tt><b>*</b></tt></font>
						</td>
					</tr>
					<tr>
						<td align="right">
							<p class="signup">Description</p>
						</td>
						<td>
							<input name="description" value="'.$description.'"type="text" maxlength="100" size="25" readonly/>
							<font color="orangered" size="+1"><tt><b>*</b></tt></font>
						</td>
					</tr>
					<tr>
						<td align="right">
							<p class="signup">Visibilté</p>
						</td>
						<td>
							<select name="visibility">
								<option value="4">Pas de Choix</option>
								<option value="3">Anonyme</option>
								<option value="2">Membre</option>
								<option value="1">Modérateur</option>
								<option value="0">Admin</option>
							</select>
							<font color="orangered" size="+1"><tt><b>*</b></tt></font>
						</td>
					</tr>
					<tr>
						<td align="right">
							<p class="signup">Mot-Clé</p>
						</td>
						<td>
							<input name="keyword" type="text" value="'.$row_page['keyword'].'"maxlength="100" size="25" readonly/>
						</td>
					</tr>
					<tr align="right">
						<td align="right">
							<p class="signup">Contenu</p>
						</td>
						<td>
							<textarea name="content" cols="40" rows="5" readonly> '.$row_page['content'].'</textarea>
							<font color="orangered" size="+1"><tt><b>*</b></tt></font>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="send" value="Sauvegarder la page" />
						</td>
    				</tr>	
				</table>
			</form>
			';
		}else {
			echo "Vous ne pouvez pas modifier cette page!!!";
		}
	} else {
		echo "Error: " . $query_subject . "<br>" . mysqli_error($db_connect);
	}
} else {
	unauthorizedAccess();
}



?>