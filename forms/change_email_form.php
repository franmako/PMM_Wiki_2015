<?php 
if (!empty($_SESSION) AND ($_SESSION['userlevel'] != USER_BANNED OR $_SESSION['userlevel'] != USER_ACTIVATION)) {
	if(isset($_GET['id'])){
		$userID_user= $_GET['id'];
		echo 
		'
		<h3> Modifier l\'adresse e-mail </h3>
		<form method="post" action="index.php?rq=email_modify&id='.$userID_user.'">
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td align="right">
						<p class="signup">Nouvelle Adresse E-Mail</p>
					</td>
					<td>
						<input type="email" name="email_new" id="email"/>
					</td>
				</tr>
				<tr>
					<td align="right">
						<p class="signup">Mot de passe admin</p>	
					</td>
					<td>
						<input name="password" type="password" maxlength="32" size="25"/>
					</td>
				</tr>
				<tr>
					<td align="right" colspan="2">
						<input type="submit" name="submitok" value="Changer le mot de passe" />
					</td>
    			</tr>
			</table>
		</form>
		';
	}else {
		echo 
		'
		<h3> Modifier votre adresse e-mail</h3>
		<form method="post" action="index.php?rq=email_modify">
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td align="right">
						<p class="signup">Nouvelle Adresse E-Mail</p>
					</td>
					<td>
						<input type="email" name="email_new" id="email" />
					</td>
				</tr>
				<tr>
					<td align="right">
						<p class="signup">Mot de passe</p>	
					</td>
					<td>
						<input name="password" type="password" maxlength="32" size="25"/>
					</td>
				</tr>
				<tr>
					<td align="right" colspan="2">
						<input type="submit" name="submitok" value="Changer le mot de passe" />
					</td>
    			</tr>
			</table>
		</form>
		';
	}
} else {
	unauthorizedAccess();
}
