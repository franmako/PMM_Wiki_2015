<?php
if(!empty($_SESSION)){
	$db_connect=db_connect();
	$userID= $_SESSION['userID'];
	if (!empty($_GET['sort'])) {
		switch ($_GET['sort']) {
			case 'recent':
				$query= "SELECT * FROM messages WHERE destID=$userID ORDER BY date_time";
				break;
			case 'no_reply':
				$query= "SELECT * FROM messages WHERE destID=$userID AND parentID IS NULL";
				break;
			case 'anonyme':
				$query= "SELECT * FROM messages WHERE destID=$userID AND authorID= 0";
				break;
			case 'user':
				$query= "SELECT * FROM messages WHERE destID=$userID AND authorID <> 0";
				break;
			case 'non_read':
				$query= "SELECT * FROM messages WHERE destID=$userID AND message_read= 0";
		}
	} else {
		$query= "SELECT * FROM messages WHERE destID=$userID";
	}
			
	echo '&nbsp;<a href="index.php?rq=messages&sort=recent">[Messages Récents]</a>&nbsp;';
	echo '&nbsp;<a href="index.php?rq=messages&sort=no_reply">[Non-Répondus]</a>&nbsp;';
	echo '&nbsp;<a href="index.php?rq=messages&sort=anonyme">[Envoyé Par Anonyme]</a>&nbsp;';
	echo '&nbsp;<a href="index.php?rq=messages&sort=user">[Envoyé Par Utilisateur]</a>&nbsp;';
	echo '&nbsp;<a href="index.php?rq=messages&sort=non_read">[Non-Lus]</a>&nbsp;';
	echo '<table border="1" class="tftable" id="tfhover">';
	echo'
	<tr>
		<th> Sujet </th>
		<th> Reçu le </th>
		<th> Marquer "Lu" </th>
	</tr>';
	if (mysqli_query($db_connect, $query)) {
		$result= mysqli_query($db_connect, $query);
    	while($row = mysqli_fetch_array($result)){
		$messageID= $row['id'];
		$time= new DateTime($row['date_time']);
		echo'
		<tr>
			<td> <a href="index.php?rq=message_detail&id='.$messageID.'&read=1">'.$row['subject'].'<a/> </td>
			<td> '.date_format($time, 'd-m-Y H:i:s').' </td>
			<td> <a href="index.php?rq=messages&read=1&id='.$messageID.'">[Lu]</a>&nbsp; <a href="index.php?rq=messages&read=0&id='.$messageID.'">[Non-Lu]</a></td>
		</tr>'; 
		}
	} else {
   		echo "Error: " . $query . "<br>" . mysqli_error($db_connect);
	}
	
	echo "</table>";
	
	if (!empty($_GET['read'])) {
		if ($_GET['read'] == 1 AND !empty($_GET['id'])) {
		$messageID= $_GET['id'];
		$query_update= "UPDATE messages SET message_read = 1 WHERE id=$messageID";
		$result= $db_connect->query($query_update);
			if ($result) {
				echo "Message marqué comme lu.";
			} else {
				echo "Erreur!";
			}		
		}elseif ($_GET['read'] == 0 AND !empty($_GET['id'])) {
			$messageID= $_GET['id'];
			$query_update= "UPDATE messages SET message_read = 0 WHERE id=$messageID";
			$result= $db_connect->query($query_update);
			if ($result) {
				echo "Message marqué comme non-lu.";
			} else {
			echo "Erreur!";
			}	
		}
	}
	
}else{
	unauthorizedAccess();
}  
?>