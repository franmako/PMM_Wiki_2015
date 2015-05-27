<?php
function unauthorizedAccess(){
	echo "!!! Vous n'avez pas le statut requis pour accéder à cette page !!!";
}
function getNbUnreadMessages(){
	$db_connect=db_connect();
	$userID= $_SESSION['userID'];
	$query= "SELECT * FROM messages WHERE message_read= 0 AND destID=$userID";
	$result= $db_connect->query($query);
	$nb_unread_messages= mysqli_num_rows($result);
	return($nb_unread_messages);
}
function getNbNotif(){
	$nb_notifs= getNbUnreadMessages();
	
	return ($nb_notifs);
}
function usersearch_form(){
	echo'
	<form method="post" action="index.php?rq=user_manage">
		<h3>Recherche:</h3>
		<p>Utilisateur: <input type="text" name="user_search">
		E-Mail: <input type="text" name="email_search">
		Statut: <input type="text" name="status_search">
		</p>
		<input type="submit" value="Rechercher">
	</form>';
}
function showUserTable($row){
	while ($row) {
		echo
		'
		<tr>
			<td> '.$row['id'].' </td>
			<td> '.$row['username'].' </td>
			<td>' .$row['email']. '</td>
			<td> '.getUserType_label($row['id']).' </td>
		</tr>';
		echo '</table>';
	} 
}
function showUserTable_header(){
	echo '<table border="1" class="tftable" id="tfhover">';
	echo'
	<tr>
		<th> UserID </th>
		<th> Utilisateur </th>
		<th> Adresse e-mail </th>
		<th> Statut </th>
	</tr>';
}
?>