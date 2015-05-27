<?php 
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	echo "<h2>Supprimer des modérateurs</h2>";
	$query_subject= "SELECT * FROM subject WHERE moderatorID IS NOT NULL AND visibility >= 1";
	$db_connect= db_connect();
	if ($result_subject= mysqli_query($db_connect, $query_subject)) {
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Sujet </th>
			<th> Description </th>
			<th> Créé le </th>
		</tr>';
		while($row_subject = mysqli_fetch_array($result_subject)){
			$subjectID= $row_subject['id'];
			$time= new DateTime($row_subject['creation_date']);
			$time_format= date_format($time, 'd-m-Y H:i:s');
			$visibility= $row_subject['visibility'];
			$visibility= getVisibilityLabel($visibility);
			echo'
			<tr>
				<td> <a href="index.php?rq=delete_modo&subject_id='.$subjectID.'">'.$row_subject['title'].'</a> </td>
				<td> '.$row_subject['description'].' </td>
				<td> '.$time_format.' </td>
			</tr>'; 					
		}
	echo "</table>";
	}
} else {
	unauthorizedAccess();
}

?>