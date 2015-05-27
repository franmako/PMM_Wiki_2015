<?php
function db_connect(){
	$db_connect=mysqli_connect(HOST,USER,PASSWORD,DATABASE);
	return ($db_connect);
}
function getRow($query){
	$db_connect= db_connect();
	$result= $db_connect->query($query);
	if($result){
		$row = mysqli_fetch_array($result);
	}else {
		$row= FALSE;
	}
	return($row);
}
?>