<?php
echo 
'
<h3>Modifier le mot de passe</h3>
<form method="post" action="index.php?rq=password_modify">
	<table border="0" cellpadding="0" cellspacing="5">
	
		<tr>
			<td align="right">
				<p >Nouveau mot de passe</p>
			</td>
			<td>
				<input name="password_new" type="password" maxlength="100" size="25" />
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
		<tr align="right">
			<td align="right">
				<p>Mot de passe admin</p>
			</td>
			<td>
				<input name="password" type="password" maxlength="100" size="25" />
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
?>