<?php
$db_connect= db_connect();
if (isset($_GET['keyword'])) {
	$keyword= $_GET['keyword'];
}
$subjectID= $_GET['subject_id'];
$query_subject= "SELECT * FROM subject WHERE id=$subjectID";
$row_subject= getRow($query_subject);
$visibility= $row_subject['visibility'];
//if ($result_subject= mysqli_query($db_connect, $query_subject)) {
if (empty($keyword)) {
	$title= $row_subject['title'];
	$query_page="SELECT * FROM page WHERE subject_id=$subjectID AND keyword IS NULL";
	echo "<h2>$title</h2>";
}else {
	echo "<h2>$keyword</h2>";
	$query_page="SELECT * FROM page WHERE subject_id=$subjectID AND keyword='$keyword'";
}
if (!empty($_SESSION) AND $_SESSION['userlevel'] <= $visibility ) {
	$authorID= $row_subject['authorID'];
	$modoID= $row_subject['moderatorID'];
	$row_page= getRow($query_page);
	$pageID= $row_page['id'];
	$content= $row_page['content'];
	if ($_SESSION['userID'] == $authorID) {
		echo '<p><a href="index.php?rq=edit_page&page_id='.$pageID.'&subject_id='.$subjectID.'">[Modifier La Page]</a> &nbsp; <a href="index.php?rq=delete_page&page_id='.$pageID.'&subject_id='.$subjectID.'">[Supprimer La Page]</a> &nbsp; <a href="index.php?rq=write_page&page_id='.$pageID.'&subject_id='.$subjectID.'">[Créer Une Nouvelle Page]</a> <br/></p>';
	}elseif ($_SESSION['userID'] == $modoID) {
		echo '<p><a href="index.php?rq=edit_page&page_id='.$pageID.'&subject_id='.$subjectID.'">[Modifier La Page]</a>';
	}
	echo ''.$content.'';
	echo '<p><a href="index.php?rq=signal_subject&subject_id='.$subjectID.'">[Signaler Sujet]</a> &nbsp; <a href="index.php?rq=signal_page&page_id='.$pageID.'">[Signaler Page]</a></p>';
}elseif (empty($_SESSION) AND $visibility >= 3) {
	$row_page= getRow($query_page);
	$pageID= $row_page['id'];
	$content= $row_page['content'];
	echo ''.$content.'';
}else {
	echo "<h3> Vous devez être inscrit pour voir cette page. Vous pouvez vous inscrire ci-dessous.</h3>";
	include 'forms/register_form.php';
}


?>