<?php 
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$subjectID= $_GET['subject_id'];
	$query_modo= "SELECT DISTINCT * FROM status,users WHERE users_id= users.id AND status.level <= 1 ";
	$db_connect= db_connect();
	if ($result_modo= mysqli_query($db_connect, $query_modo)) {
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Modérateur </th>
			<th> Dernière Connex. </th>
			<th> Statut </th>
		</tr>';
		while($row_modo = mysqli_fetch_array($result_modo)){
			$modoID= $row_modo['users_id'];
			$time= new DateTime($row_modo['last_connect']);
			$time_format= date_format($time, 'd-m-Y H:i:s');
			$user_level= getUserType_label($modoID);
			echo'
			<tr>
				<td> <a href="index.php?rq=notify_modo&subject_id='.$subjectID.'&modo_id='.$modoID.'">'.$row_modo['username'].'</a> </td>
				<td> '.$time_format.' </td>
				<td> '.$user_level.' </td>
			</tr>'; 					
		}
	}
	echo "</table>";
}else {
	unauthorizedAccess();
}
?>