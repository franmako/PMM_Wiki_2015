<?php 
if (!empty($_SESSION)) {
	$db_connect= db_connect();
	$userID= $_SESSION['userID'];
	$query_subject= "SELECT * FROM subject WHERE authorID=$userID";
	$result_subject= $db_connect->query($query_subject);
	if ($result_subject) {
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Sujet </th>
			<th> Description </th>
			<th> Création </th>
			<th> Visibilité </th>
		</tr>';
		while($row_subject = mysqli_fetch_array($result_subject)){
			$subjectID= $row_subject['id'];
			$time= new DateTime($row_subject['creation_date']);
			$time_format= date_format($time, 'd-m-Y H:i:s');
			$visibility= $row_subject['visibility'];
		
			switch ($visibility) {
				case USER_ADMIN:
					$visibility= 'Administrateur';
					break;
				case USER_MODERATOR:
					$visibility= 'Moderator';
					break;
				case USER_NORMAL:
					$visibility= 'Membres';
					break;
				default:
					$visibility= 'Anonyme';
					break;
			}
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&subject_id='.$subjectID.'">'.$row_subject['title'].'</a> </td>
				<td> '.$row_subject['description'].' </td>
				<td> '.$time_format.' </td>
				<td> '.$visibility.' </td>
			</tr>'; 					
		}
		echo "</table>";
	} else {
		echo "Erreur!";
	}
	
} else {
	unauthorizedAccess();
}
?>