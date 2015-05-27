<?php
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$messageID= $_GET['id'];
	$query_message= "SELECT * FROM contact_messages WHERE id=$messageID";
	$row_message= getRow($query_message);
	$email= $row_message['email'];
	$subject = $_POST['subject'];
	$content= $_POST['content']; 
	$userID= $_SESSION['userID'];

	$db_connect=db_connect();
	$query= "INSERT INTO contact_messages (id,subject,message,email,users_id,reply_parent_id,time_sent,message_read) VALUES(null,'$subject','$content','$email',$userID,$messageID,NOW(),0);";
	$messagequery= $db_connect->query($query);

	if($messagequery){
    	//Envoi e-mail de notification à l'utilisateur
		$emailfrom=CONTACT_NOTIFY;
		$from="From:";
		$from .= $emailfrom;
		$sujet=$subject;
		$contenu="
		L'administrateur a répondu à votre message:
		$sujet :
		$content .";
		$to=$email;
		$sent = mail($to,$sujet,$contenu,$from);
    	
    	echo "Le message a été envoyé à l'utilisateur.";
		//echo '<meta http-equiv="refresh" content="4" url="index.php"/>';
	}
} else {
	unauthorizedAccess();
}
?>