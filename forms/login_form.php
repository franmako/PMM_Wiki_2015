<?php 
echo 
'
<h3> Connexion </h3>
<form method="post" action="index.php?rq=connection">
	<table border="0" cellpadding="0" cellspacing="5">
		<tr>
			<td align="right">
				<p>Utilisateur</p>
			</td>
			<td>
				<input type="text" name="username" id="username" size="25"/>
			</td>
		</tr>
		<tr>
			<td align="right">
				<p>Mot de passe</p>
			</td>
			<td>
				<input type="password" name="password" id="password" size="25"/>
			</td>
		</tr>
		<tr>
			<td align="right">
				<a href="index.php?rq=passwordReset">Mot de passe oublié?</a>
			</td>
			<td>
				<input type="submit" name="login" id="login" value="Connexion" />
			</td>
		</tr>
	</table>
</form>
';
?>