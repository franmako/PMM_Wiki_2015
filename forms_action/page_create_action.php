<?php 
if (!empty($_SESSION) AND (($_SESSION['userlevel'] == USER_ADMIN) OR ($_SESSION['userlevel'] == USER_MODERATOR) OR ($_SESSION['userlevel'] == USER_NORMAL))) {
	$db_connect= db_connect();
	$pageID= $_GET['page_id'];
	$subjectID= $_GET['subject_id'];
	$keyword= $_POST['keyword'];
	$content= $_POST['content'];
	$wiky= new wiky;
	$content=htmlspecialchars($content);
	$wiky->parse($content);
	$query_subject= "SELECT * FROM subject WHERE id= $subjectID";
	if ($result_subject= mysqli_query($db_connect, $query_subject)) {
		$row_subject = mysqli_fetch_array($result_subject);
		$authorID= $row_subject['authorID'];
		if ($_SESSION['userID'] == $authorID) {
			$query_page="UPDATE page SET keyword='$keyword',content='$content' WHERE id=$pageID";
			if (mysqli_query($db_connect, $query_page)) {
				echo "Page créé!";
			}else {
				echo "Error: " . $query_page . "<br>" . mysqli_error($db_connect);
			}
		} else {
			echo "Vous ne pouvez pas modifier ce sujet!";
		}
	}else {
		echo "Error: " . $query_subject . "<br>" . mysqli_error($db_connect);
	}
}else {
	unauthorizedAccess();
}
?>