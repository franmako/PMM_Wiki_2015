<?php
if (!empty($_SESSION) AND (($_SESSION['userlevel'] == USER_ADMIN) OR ($_SESSION['userlevel'] == USER_MODERATOR) OR ($_SESSION['userlevel'] == USER_NORMAL))) {
	$pageID= $_GET['page_id'];
	$query_page="SELECT * FROM page WHERE id=$pageID";
	$row_page= getRow($query_page);
	$keyword= getPageKey($pageID);
	$subjectID= getSubjectID($pageID);
	$subject_name= getSubjectName($subjectID);
	echo 
	'
	<h3> Signaler Sujet/Page</h3>
	<form method="post" action="index.php?rq=contact_action&type=signal_page&page_id='.$pageID.'">
		<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td align="right">
					<p class="signup">Sujet</p>
				</td>
				<td>
					<input name="subject" type="text" value="[Signal Page]: '.$keyword.' (Sujet: '.$subject_name.')" maxlength="100" size="25" readonly/>
				</td>
			</tr>
			<tr>
				<td align="right">
					<p class="signup">Destinataire</p>
				</td>
				<td>
					<select name="dest">
						<option value="2">Auteur</option>
						<option value="1">Modérateur</option>
						<option value="0">Admin</option>
					</select>
					<font color="orangered" size="+1"><tt><b>*</b></tt></font>
				</td>
			</tr>
			<tr align="right">
				<td align="right">
					<p class="signup">Message</p>
				</td>
				<td>
					<textarea name="content" cols="40" rows="5" ></textarea>
					<font color="orangered" size="+1"><tt><b>*</b></tt></font>
				</td>
			</tr>	
			<tr>
				<td>
					<input type="submit" name="send" value="Soumettre le message" />
				</td>
    		</tr>
		</table>
	</form>
	<font color="orangered" size="+1"><tt><b>*Ces champs ne peuvent pas être vides!</b></tt></font>
	';
}else {
	unauthorizedAccess();
} 
?>