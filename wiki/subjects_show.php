<?php 
if (!empty($_SESSION)) {
	$level= $_SESSION['userlevel'];
}else {
	$level= 99;
}
switch ($level) {
	case USER_ADMIN:
		$query_subject= "SELECT * FROM subject WHERE visibility >= 0";
		break;
	case USER_MODERATOR:
		$query_subject= "SELECT * FROM subject WHERE visibility >= 1 ";
		break;
	case USER_NORMAL:
		$query_subject= "SELECT * FROM subject WHERE visibility >= 2 ";
		break;
	default:
		$query_subject= "SELECT * FROM subject WHERE visibility >= 2 ";
		break;
}
$db_connect= db_connect();
if ($result_subject= mysqli_query($db_connect, $query_subject)) {
	echo '<table border="1" class="tftable" id="tfhover">';
	echo'
	<tr>
		<th> Sujet </th>
		<th> Description </th>
		<th> Créé le </th>
		<th> Visibilité </th>
	</tr>';
	while($row_subject = mysqli_fetch_array($result_subject)){
		$subjectID= $row_subject['id'];
		$time= new DateTime($row_subject['creation_date']);
		$time_format= date_format($time, 'd-m-Y H:i:s');
		$visibility= $row_subject['visibility'];
		$visibility= getVisibilityLabel($visibility);
		echo'
		<tr>
			<td> <a href="index.php?rq=subject_page&subject_id='.$subjectID.'&keyword=">'.$row_subject['title'].'</a> </td>
			<td> '.$row_subject['description'].' </td>
			<td> '.$time_format.' </td>
			<td> '.$visibility.' </td>
		</tr>'; 					
	}
	echo "</table>";
}else {
	echo "Error: " . $query_subject . "<br>" . mysqli_error($db_connect);
}

?>