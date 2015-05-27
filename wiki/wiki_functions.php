<?php 
function getVisibilityLabel($visibility){
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
	return $visibility;
}
function getSubjectID($pageID){
	$query_page= "SELECT * FROM page WHERE id=$pageID";
	$row_page= getRow($query_page);
	$subjectID= $row_page['subject_id'];
	return $subjectID;
}
function getSubjectName($subjectID){
	$query= "SELECT * FROM subject WHERE id=$subjectID";
	$row_subject= getRow($query);
	$subject= $row_subject['title'];
	return $subject;
}
function getPageKey($pageID){
	$query= "SELECT * FROM page WHERE id=$pageID";
	$row_page= getRow($query);
	$keyword= $row_page['keyword'];
	if (empty($keyword)) {
		$keyword= "Page Principale";
	}
	return $keyword;
}
function getAuthorName($userID){
	$db_connect= db_connect();
	$query="SELECT * FROM user WHERE id=$userID";
	$row= getRow($query);
	$username= $row['username'];
	return ($username);
}
?>