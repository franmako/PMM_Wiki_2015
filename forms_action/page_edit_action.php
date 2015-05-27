<?php 
if (!empty($_SESSION) AND (($_SESSION['userlevel'] == USER_ADMIN) OR ($_SESSION['userlevel'] == USER_MODERATOR) OR ($_SESSION['userlevel'] == USER_NORMAL))) {
	$pageID= $_GET['page_id'];
	if (!empty($_POST['keyword'])) {
		$keyword= $_POST['keyword'];
	}else {
		$keyword= null;
	}
	$content= $_POST['content'];
	$wiky= new wiky;
	$content=htmlspecialchars($content);
	$wiky->parse($content);
	if (isset($_POST['keyword'])) {
		$query_page= "UPDATE page SET keyword='$keyword',content='$content',last_modif=NOW() WHERE id= $pageID ";
	} else {
		$query_page= "UPDATE page SET content='$content',last_modif=NOW() WHERE id= $pageID ";
	}
	$db_connect= db_connect();
	$subjectID= $_GET['subject_id'];
	$query_subject= "SELECT * FROM subject WHERE id=$subjectID";
	if ($result_subject= mysqli_query($db_connect, $query_subject)) {
		$row_subject = mysqli_fetch_array($result_subject);
		$visibility_rank_db= $row_subject['visibility_user_rank'];
	} else {
		echo "Error: " . $query_subject . "<br>" . mysqli_error($db_connect);
	}
	$title= $_POST['title'];
	$description= $_POST['description'];
	$visibility= $_POST['visibility'];
	$user_rank= $_SESSION['userlevel'];
	if ($user_rank <= $visibility_rank_db) {
		$query_update= "UPDATE subject SET title='$title',description='$description',visibility=$visibility,visibility_user_rank=$user_rank WHERE id=$subjectID";
	} else {
		$query_update= "UPDATE subject SET title='$title',description='$description' WHERE id=$subjectID";
	}
	
	if (mysqli_query($db_connect, $query_page) AND mysqli_query($db_connect, $query_update)) {
		echo "Les modifications ont été ajoutées à la page.";
	} elseif (!mysqli_query($db_connect, $query_page)) {
		echo "Error: " . $query_page . "<br>" . mysqli_error($db_connect);
	}elseif (!mysqli_query($db_connect, $query_update)) {
		echo "Error: " . $query_update . "<br>" . mysqli_error($db_connect);
	}
}else {
	unauthorizedAccess();
}
?>