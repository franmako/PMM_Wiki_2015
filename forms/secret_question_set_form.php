<?php
$type= $_GET['type'];
if (!empty($_SESSION) AND $_SESSION['userlevel'] != USER_BANNED) {
	echo 
	'
	<h3 align="center">Question Secrète</h3>
	<form method="post" action="index.php?rq=secretQuestion_set_action&type='.$type.'" name="loginform" >
		<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td align="right">
					<p class="signup">Question secrète</p>
				</td>
				<td>
					<input name="question" type="text" size="100" maxlength="100" />
				</td>
			</tr>
			<tr>
				<td align="right">
					<p class="signup">Réponse </p>				
				</td>
				<td>
					<input name="answer" type="text" size="100" maxlength="100" />
				</td>
			</tr>
			<tr>
				<td align="right" colspan="2">
					<input type="reset" value="Réinitialiser" />
					<input type="submit" name="submitok" value="Soumettre" />
				</td>
    		</tr>
		</table>
	</form>';	
} else {
	unauthorizedAccess();
}
 
?>

