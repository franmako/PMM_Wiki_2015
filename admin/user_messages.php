<?php 
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$userID= $_GET['id'];
	$db_connect= db_connect();
	$query_messages= 'SELECT * FROM messages WHERE authorID=$userID;';
	$result= mysqli_query($db_connect,$query_messages);
	//$row_messages= getRow($query_messages);
	switch ($_GET['sort']) {
		case 'recent':
			$query_messages= "SELECT * FROM messages WHERE authorID=$userID ORDER BY time_sent";
			break;
		case 'no_reply':
			$query_messages= "SELECT * FROM messages WHERE parentID=NULL AND authorID=$userID";
			break;
		default:
			$query_messages= "SELECT * FROM messages WHERE authorID=$userID";
			break;
	}
	echo '<p>&nbsp;<a href="index.php?rq=user_messages&sort=recent">[Messages Récents]</a>&nbsp;';
	echo '&nbsp;<a href="index.php?rq=user_messages&sort=no_reply">[Non-Répondus]</a>&nbsp;</p>';
	$result_message= $db_connect->query($query_messages);
	echo '<table border="1" class="tftable" id="tfhover">';
	echo'
	<tr>
		<th> Sujet </th>
		<th> Reçu le </th>
		<th> Marquer Lu </th>
	</tr>';
	while($row_message = mysqli_fetch_array($result_message)){
		//if ($row_message != FALSE) {
			$messageID= $row_message['id'];
			$time= new DateTime($row_message['date_time']);
			echo'
			<tr>
				<td> <a href="index.php?rq=message_detail&id='.$messageID.'">'.$row_message['subject'].'<a/> </td>
				<td> '.date_format($time, 'd-m-Y H:i:s').' </td>
				<td> <a href="index.php?rq=read&id='.$messageID.'">[Lu]</a></td>
			</tr>'; 
	} 
	echo "</table>";
}else {
	unauthorizedAccess();
}
?>