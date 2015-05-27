<?php 
if(!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN){
	echo "<h2> Configuration du site </h2>";
	echo 
	'
<form method="post" action="index.php?rq=config_modify">
	<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<th><h4>En tête</h4></th>
			</tr>
			<tr>
			<td align="right">
				<p>Titre</p>
			</td>
			<td>
				<input type="text" name="title" value="'.TITLE.'" maxlength="65" size="25" />
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Titre - Bannière</p>
			</td>
			<td>
				<input type="text" name="title_banner" value="'.TITLE_BANNER.'" maxlength="65" size="25" />
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Filename logo (ex. logo.png)</p>
			</td>
			<td>
				<input type="text" name="logo_path" value="'.LOGO_PATH.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Largeur min. du logo</p>
			</td>
			<td>
				<input type="number" name="logo_min_width" value="'.LOGO_MIN_WIDTH.'" />
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Largeur du logo</p>
			</td>
			<td>
				<input type="number" name="logo_width" value="'.LOGO_WIDTH.'" />
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Largeur max. du logo</p>
			</td>
			<td>
				<input type="number" name="logo_max_width" value="'.LOGO_MAX_WIDTH.'" />
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Hauteur min. du logo</p>
			</td>
			<td>
				<input type="number" name="logo_min_height" value="'.LOGO_MIN_HEIGHT.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Hauteur du logo</p>
			</td>
			<td>
				<input type="number" name="logo_height" value="'.LOGO_HEIGHT.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Hauteur max. du logo</p>
			</td>
			<td>
				<input type="number" name="logo_max_height" value="'.LOGO_MAX_HEIGHT.'"/>
			</td>
			</tr>
			<tr>
			<td align="right"">
			<p><a href="index.php?rq=avatar_logo">[Uploader un logo]</a><p>
			</td>
			</tr>
			
			<tr>
				<th><h4>Contact</h4></th>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Email de notification</p>
			</td>
			<td>
				<input type="email" name="notify" value="'.CONTACT_NOTIFY.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Email d\'inscription</p>
			</td>
			<td>
				<input type="email" name="register" value="'.CONTACT_REGISTER.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Email de confirmation</p>
			</td>
			<td>
				<input type="email" name="confirm" value="'.CONTACT_CONFIRM.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Email du gestionnaire </p>
			</td>
			<td>
				<input type="email" name="admin" value="'.CONTACT_ADMIN.'"/>
			</td>
			</tr>
			
			<tr>
				<th><h4>Inscription</h4></th>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Taille min. du mot de passe </p>
			</td>
			<td>
				<input type="number" name="min_password" value="'.PASSWORD_MIN_SIZE.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Taille max. du mot de passe</p>
			</td>
			<td>
				<input type="number" name="max_password" value="'.PASSWORD_MAX_SIZE.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Taille min. du nom d\'utilisateur</p>
			</td>
			<td>
				<input type="number" name="min_username" value="'.USERNAME_MIN_SIZE.'"/>
			</td>
			</tr>

			<tr>
				<th><h4>Avatar</h4></th>
			</tr>	
			<tr>
			<td align="right">
				<p class="signup">Chemin des avatars</p>
			</td>
			<td>
				<input type="text" name="avatar_path" value="'.AVATAR_PATH.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Largeur Min.</p>
			</td>
			<td>
				<input type="number" name="avatar_min_width" value="'.AVATAR_MIN_WIDTH.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Largeur</p>
			</td>
			<td>
				<input type="number" name="avatar_width" value="'.AVATAR_WIDTH.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Largeur Max.</p>
			</td>
			<td>
				<input type="number" name="avatar_max_width" value="'.AVATAR_MAX_WIDTH.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Hauteur Min.</p>
			</td>
			<td>
				<input type="number" name="avatar_min_height" value="'.AVATAR_MIN_HEIGHT.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Hauteur</p>
			</td>
			<td>
				<input type="number" name="avatar_height" value="'.AVATAR_HEIGHT.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Hauteur Max.</p>
			</td>
			<td>
				<input type="number" name="avatar_max_height" value="'.AVATAR_MAX_HEIGHT.'"/>
			</td>
			</tr>

			<tr>
				<th><h4> Pied de page </h4></th>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Nom du gestionnaire</p>
			</td>
			<td>
				<input type="text" name="author" value="'.AUTHOR_NAME.'"/>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Copyright</p>
			</td>
			<td>
				<input type="text" name="copyright" value="'.COPYRIGHT.'"/>
			</td>
			</tr>
			
			<tr>
				<th><h4>Base de données</h4></th>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Hôte local</p>
			</td>
			<td>
				<input type="text" name="host_local" value="'.HOST_LOCAL.'" readonly/>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Hôte externe</p>
			</td>
			<td>
				<input type="text" name="host_external" value="'.HOST_EXTERNAL.'" readonly/>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Nom de la base de données</p>
			</td>
			<td>
				<input type="text" name="database" value="'.DATABASE.'" readonly/>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Utilisateur</p>
			</td>
			<td>
				<input type="text" name="user" value="'.USER.'" readonly/>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
			</tr>
			<tr>
			<td align="right">
				<p class="signup">Mot de passe</p>
			</td>
			<td>
				<input type="password" name="db_password" value="'.PASSWORD.'" readonly/>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
			</tr>
			<font color="orangered" size="+1"><tt><b>* Ces champs ne peuvent pas être modifiés sur cette page.</b></tt></font>
	</table>
	<hr>
	<h4>Entrez vôtre mot de passe pour sauvegarder les modifications:</h4> <input type="password" name="password">
	<input type="submit" name="submit" value="Sauvegarder les modifications" />
</form>
'; 
}else{
	unauthorizedAccess();
} 

?>