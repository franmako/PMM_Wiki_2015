<h3> Créer un compte</h3>
<p>
	<ul>
		<li>
			Le nom d'utilisateur doit avoir un minimum de <?php echo "".USERNAME_MIN_SIZE.""; ?> caractères.
		</li>
		<li>
			Le mot de passe doit avoir un minimum de <?php echo "".PASSWORD_MIN_SIZE.""; ?> caractères et contenir au moins un chiffre, une lettre minuscule, une lettre majuscule et un caractère spécial.
		</li>
	</ul>
</p>
<form method="post" action="index.php?rq=account_create">
	<table border="0" cellpadding="0" cellspacing="5">
		<tr>
			<td align="right">
				<p class="signup">Nom d'utilisateur</p>
			</td>
			<td>
				<input name="username" type="text" value="<?php if(!empty($_GET['user'])){echo $_GET['user'];}else{echo'';} ?>" maxlength="65" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		<tr>
			<td align="right">
				<p class="signup">Mot de passe</p>				
			</td>
			<td>
				<input name="password" type="password" maxlength="32" size="25"/>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		<tr>
			<td align="right">
				<p class="signup">Répéter mot de passe</p>				
			</td>
			<td>
				<input name="password_verif" type="password" maxlength="32" size="25"/>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		<tr align="right">
			<td align="right">
				<p class="signup">Adresse e-mail</p>
			</td>
			<td>
				<input name="email" type="email" value="<?php if(!empty($_GET['email'])){echo $_GET['email'];}else{echo'';} ?>" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>	
		<tr align="right">
			<td align="right">
				<p class="signup">Répeter adresse e-mail</p>
			</td>
			<td>
				<input name="email_verif" type="email" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<input type="reset" value="Réinitialiser" />
				<input type="submit" name="submitok" value="Créer Compte" />
			</td>
    	</tr>
	</table>
</form>
<font color="orangered" size="+1"><tt><b>*Ces champs ne peuvent pas être vides!</b></tt></font>