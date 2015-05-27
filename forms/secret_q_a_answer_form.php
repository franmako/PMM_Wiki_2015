<?php 
echo
	'
	<h3>'.$question.'</h3>
	<form method="post" action="index.php?rq=secret_answer_action&id='.$userID.'&email='.$email.'">
		Réponse: <input type="text" name="answer" size="100"/><br/>
	<input type="submit" name="submit" value="Répondre"/>
	</form>
	';
?>