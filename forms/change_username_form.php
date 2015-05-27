<?php 
if (!empty($_SESSION) AND ($_SESSION['userlevel'] != USER_BANNED OR $_SESSION['userlevel'] != USER_ACTIVATION)) {
	if(isset($_GET['id'])){
		$userID_user= $_GET['id'];
		echo 
		'
		<h3> Modifier le nom de l\'utilisateur </h3>
		<form method="post" action="index.php?rq=username_modify&id='.$userID_user.'">
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td align="right">
						<p>Nouveau nom d\'utilisateur</p>
					</td>
					<td>
						<input type="text" name="username_new" id="username" />
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
						<input type="submit" name="login" id="login" value="Modifier le nom de l\'utilisateur" />
					</td>
    			</tr>
			</table>
		</form>
		';
	}else {
		echo 
		'
		<h3> Modifier votre nom d\'utilisateur</h3>
		<form method="post" action="index.php?rq=username_modify">
			<table border="0" cellpadding="0" cellspacing="5">
				<tr>
					<td align="right">
						<p>Nouveau nom d\'utilisateur</p>
					</td>
					<td>
						<input type="text" name="username_new" id="username" />
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
						<input type="submit" name="login" id="login" value="Modifier le nom de l\'utilisateur" />
					</td>
    			</tr>
			</table>
		</form>
		';
	}
} else {
	unauthorizedAccess();
}
