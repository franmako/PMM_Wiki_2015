<?php
$type= $_GET['type'];
if (!empty($_POST['subject']) AND !empty($_POST['content']) AND $type == 'signal_page') {
	$pageID= $_GET['page_id'];
	$subjectID= getSubjectID($pageID);
	$query_subject= "SELECT * FROM subject WHERE id=$subjectID";
	$row_subject= getRow($query_subject);
	$subject_contact= $_POST['subject'];
	$dest= $_POST['dest'];
	$query_admin= "SELECT * FROM status WHERE level=0";
	$row_admin= getRow($query_admin);
	$adminID= $row_admin['users_id'];
	switch ($dest) {
		case 2://dest= auteur
			$destID= $row_subject['authorID'];
			break;
		case 1://dest= modo
			$destID= $row_subject['moderatorID'];
			if (empty($destID)) {
				$destID= $adminID;
			}
			break;
		case 0://dest= admin
			$destID= $adminID;
			break;
	}
	$content= $_POST['content'];
	$email= $_SESSION['email'];
	$userID= $_SESSION['userID'];
	$db_connect=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
   	
   	$query_message= "INSERT INTO messages (id,authorID,destID,subject,content,date_time,parentID,email_author,message_read) VALUES(NULL,$userID,$destID,'$subject_contact','$content',NOW(),NULL,'$email',0)";
	if (mysqli_query($db_connect, $query_message)) {
    	$message_id = mysqli_insert_id($db_connect);
	} else {
   		echo "Error: " . $query_message . "<br>" . mysqli_error($db_connect);
	}
	
	if (!empty($message_id)) {
		$query_msg_signal= "INSERT INTO msg_signal_page (id,message_id,page_id) VALUES (NULL,$message_id,$pageID)";
		if (mysqli_query($db_connect, $query_msg_signal)) {
    		//Envoi e-mail de notification à l'utilisateur
			$emailfrom=CONTACT_NOTIFY;
			$from="From:";
			$from .= $emailfrom;
			$subject=$subject_contact;
			$contenu="
			La page a bien été signalé.
			Sujet: $subject 
	
			Message:
			$content .";
			$to=$email;
			$sent = mail($to,$subject,$contenu,$from);
    	
    		echo "Le message a été envoyé.";
		} else {
   		echo "Error: " . $query_msg_signal . "<br>" . mysqli_error($db_connect);
		}
	} else {
		echo "Erreur!";
	}	
}elseif (!empty($_POST['subject']) AND !empty($_POST['content']) AND $type == 'signal_subject') {
	$subjectID= $_GET['subject_id'];
	$query_subject= "SELECT * FROM subject WHERE id=$subjectID";
	$row_subject= getRow($query_subject);
	$subject_contact= $_POST['subject'];
	$dest= $_POST['dest'];
	$query_admin= "SELECT * FROM status WHERE level=0";
	$row_admin= getRow($query_admin);
	$adminID= $row_admin['users_id'];
	switch ($dest) {
		case 2://dest= auteur
			$destID= $row_subject['authorID'];
			break;
		case 1://dest= modo
			$destID= $row_subject['moderatorID'];
			if (empty($destID)) {
				$destID= $adminID;
			}
			break;
		case 0://dest= admin
			$destID= $adminID;
			break;
	}
	$content= $_POST['content'];
	$email= $_SESSION['email'];
	$userID= $_SESSION['userID'];
	$db_connect=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
   	
   	$query_message= "INSERT INTO messages (id,authorID,destID,subject,content,date_time,parentID,email_author,message_read) VALUES(NULL,$userID,$destID,'$subject_contact','$content',NOW(),NULL,'$email',0)";
	if (mysqli_query($db_connect, $query_message)) {
    	$message_id = mysqli_insert_id($db_connect);
	} else {
   		echo "Error: " . $query_message . "<br>" . mysqli_error($db_connect);
	}
	
	if (!empty($message_id)) {
		$query_msg_signal= "INSERT INTO msg_signal_subject (id,message_id,subject_id) VALUES (NULL,$message_id,$subjectID)";
		if (mysqli_query($db_connect, $query_msg_signal)) {
    		//Envoi e-mail de notification à l'utilisateur
			$emailfrom=CONTACT_NOTIFY;
			$from="From:";
			$from .= $emailfrom;
			$subject=$subject_contact;
			$contenu="
			La sujet a bien été signalé.
			Sujet: $subject 
	
			Message:
			$content .";
			$to=$email;
			$sent = mail($to,$subject,$contenu,$from);
    	
    		echo "Le message a été envoyé.";
		} else {
   		echo "Error: " . $query_msg_signal . "<br>" . mysqli_error($db_connect);
		}
	} else {
		echo "Erreur!";
	}
}elseif(!empty($_POST['subject']) AND !empty($_POST['content']) AND $type == 'contact'){
	$subject = $_POST['subject'];
	$content= $_POST['content']; 	
	
	$query_id_admin= "SELECT * FROM status WHERE level=0";
	$row_admin_status= getRow($query_id_admin);
	$adminID= $row_admin_status['users_id'];
	if (isset($_POST['email'])) {
		$email= $_POST['email'];
		$userID= 0; //Utilisateur anonyme
	}else {
		$email= $_SESSION['email'];
		$userID= $_SESSION['userID'];
	}	
	
	$db_connect=db_connect();
   	$query_message= "INSERT INTO messages (id,authorID,destID,subject,content,date_time,parentID,email_author,message_read) VALUES(NULL,$userID,$adminID,'$subject','$content',NOW(),NULL,'$email',0)";
    $result_message= $db_connect->query($query_message);
	    
    if($result_message){
    	//Envoi e-mail de notification à l'utilisateur
		$emailfrom=CONTACT_NOTIFY;
		$from="From:";
		$from .= $emailfrom;
		$sujet=$subject;
		$contenu="
		Le message suivant a été envoyé à l'administrateur:
		Sujet: $sujet 
		
		Message:
		$content .";
		$to=$email;
		$sent = mail($to,$sujet,$contenu,$from);
    	
    	echo "Le message a été envoyé à l'admin.";
    }else {
        echo "Erreur de l'envoi! Veuillez recommencer.";
    }
}else{
	echo "Erreur! Les champs requis sont incomplets!";
}
?>