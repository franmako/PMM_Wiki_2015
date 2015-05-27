<?php 
echo 
'
<h3> Mot de passe oublié </h3>
<form method="post" action="index.php?rq=passwordReset_action">
	<table border="0" cellpadding="0" cellspacing="5">
		<tr>
			<td align="right">
				<p> E-Mail </p>
			</td>
			<td>
				<input type="email" name="email"/>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="reset_password" value="Envoyer la demande" />
			</td>
		</tr>
	</table>
</form>
';
?>