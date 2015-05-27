<?php
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	echo 
	'
	<form method="post" action="index.php?rq=subject_create_action">
		<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td align="right">
					<p class="signup">Titre du Sujet</p>
				</td>
				<td>
					<input name="title" type="text" maxlength="100" size="25" />
					<font color="orangered" size="+1"><tt><b>*</b></tt></font>
				</td>
			</tr>
			<tr>
				<td align="right">
					<p class="signup">Description</p>
				</td>
				<td>
					<input name="description" type="text" maxlength="100" size="25" />
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
				<td>
					<input type="submit" name="submit" value="Créer le sujet" />
				</td>
    		</tr>
		</table>
	</form>
	';
}elseif (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_MODERATOR) {
	echo 
	'
	<form method="post" action="index.php?rq=subject_create_action">
		<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td align="right">
					<p class="signup">Titre du Sujet</p>
				</td>
				<td>
					<input name="title" type="text" maxlength="100" size="25" />
					<font color="orangered" size="+1"><tt><b>*</b></tt></font>
				</td>
			</tr>
			<tr>
				<td align="right">
					<p class="signup">Description</p>
				</td>
				<td>
					<input name="description" type="text" maxlength="100" size="25" />
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
						<font color="orangered" size="+1"><tt><b>*</b></tt></font>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="submit" value="Créer le sujet" />
				</td>
    		</tr>
		</table>
	</form>
	';
}elseif (!empty($_SESSION)) {
	$user_level= $_SESSION['userlevel'];
	echo 
	'
	<form method="post" action="index.php?rq=subject_create_action">
		<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td align="right">
					<p class="signup">Titre du Sujet</p>
				</td>
				<td>
					<input name="title" type="text" maxlength="100" size="25" />
					<font color="orangered" size="+1"><tt><b>*</b></tt></font>
				</td>
			</tr>
			<tr>
				<td align="right">
					<p class="signup">Description</p>
				</td>
				<td>
					<input name="description" type="text" maxlength="100" size="25" />
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
					</select>
					<font color="orangered" size="+1"><tt><b>*</b></tt></font>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="submit" value="Créer le sujet" />
				</td>
    		</tr>
		</table>
	</form>
	'; 
} else {
	unauthorizedAccess();
}
?>