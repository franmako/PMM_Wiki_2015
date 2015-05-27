<?php
$userID= $_GET['id'];
$key= $_GET['cle'];
$query_user= "SELECT * FROM status WHERE users_id=$userID";
$row_status= getRow($query_user);
$isPwdForgotten= $row_status['isPwdForgotten'];

$query_activation= "SELECT * FROM activation WHERE users_id=$userID";
$row_activation= getRow($query_activation);
$key_db= $row_activation['email_key'];
if ($isPwdForgotten == 1 AND $key == $key_db) {
echo 
'
<h3>Modifier le mot de passe</h3>
<p>
	<ul>
		<li>
			Le nom d\'utilisateur doit avoir un minimum de <?php echo "'.USERNAME_MIN_SIZE.'"; ?> caractères.
		</li>
		<li>
			Le mot de passe doit avoir un minimum de <?php echo "'.PASSWORD_MIN_SIZE.'"; ?> caractères et contenir au moins un chiffre, une lettre minuscule, une lettre majuscule et un caractère spécial.
		</li>
	</ul>
</p>
<form method="post" action="index.php?rq=password_reset_action&id='.$userID.'&cle='.$key.'">
	<table border="0" cellpadding="0" cellspacing="5">
	
		<tr>
			<td align="right">
				<p >Nouveau mot de passe</p>
			</td>
			<td>
				<input name="password" type="password" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<p>Répéter le nouveau mot de passe</p>
			</td>
			<td>
				<input name="password_verif" type="password" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="send" value="Changer le mot de passe" />
			</td>
    	</tr>
	</table>
</form>
<font color="orangered" size="+1"><tt><b>*Ces champs ne peuvent pas être vides!</b></tt></font>
';  
} else {
	unauthorizedAccess();
}
?>