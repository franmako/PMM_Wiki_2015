<?php 
if (!empty($_SESSION)) {
	$messageID= $_GET['id'];
	$query= "SELECT * FROM messages WHERE id=$messageID";
	$row= getRow($query);
	if ($row) {
		$time= new DateTime($row['date_time']);
		$sujet= $row['subject'];
		$message= $row['content'];
		$email= $row['email_author'];
		$userID= $row['authorID'];
		$parent_id= $row['parentID'];
	}

	echo '<a href="index.php?rq=message_detail&id='.$messageID.'&read=1">[Marquer Lu]</a>';
	echo '<a href="index.php?rq=message_detail&id='.$messageID.'&read=0">[Marquer Non-lu]</a><br/>';

	$message_read= $_GET['read'];
	if ($message_read == 1) {
		$query_read= "UPDATE messages SET message_read=1 WHERE id= $messageID";
		$db_connect= db_connect();
		$result= $db_connect->query($query_read);
		if ($result) {
			echo "<p>Le message est marqué comme étant lu.</p>";
		} else {
			echo "Erreur";
		}	
	} elseif ($message_read == 0) {
		$query_unread= "UPDATE messages SET message_read=0 WHERE id= $messageID";
		$db_connect= db_connect();
		$result= $db_connect->query($query_unread);
		if ($result) {
			echo "<p>Le message est marqué comme étant non-lu.</p>";
		} else {
			echo "Erreur";
		}
	} 
	if($parent_id != NULL){
		$query_parent= "SELECT * FROM messages WHERE id=$parent_id";
	}

	if ($userID != 0) {
		$query_user= "SELECT * FROM users WHERE id=$userID";
		$row_user= getRow($query_user);
		if ($row_user) {
			echo 
			'
			<p>
				<b>Envoyé par:</b>
				<a href="index.php?rq=user_manage_detail&id='.$userID.'">'.$row_user['username'].'</a>
			</p>';
		}
	}else {
		echo 
		'
		<p>
	 		<b>Envoyé par:</b> <br/>
	 		Anonyme
		</p>
		';
	}

	echo 
	'
	<p>
		<b>Reçu le: </b><br/>
		'.date_format($time, 'd-m-Y H:i:s').'
	</p>

	<p>
		<b>Sujet: </b><br/>
	'.$sujet.'
	</p>

	<p>
		<b>Message: </b><br/>
	'.$message.'
	</p>
	'; 
	include 'forms/contact_form.php';
} else {
	unauthorizedAccess();
}

?>