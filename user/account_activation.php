<?php 
$username_url= $_GET['log'];
$key_url= $_GET['cle'];

$user_verif= "SELECT * FROM users WHERE username='$username_url'";
$row= getRow($user_verif);
$userID= $row['id'];
$username_db= $row['username'];

$cle_verif= "SELECT * FROM activation WHERE users_id=$userID";
$row2= getRow($cle_verif);
$key_db= $row2['email_key'];

$userstatus_verif= "SELECT * FROM status WHERE users_id=$userID";
$row3=getRow($userstatus_verif);
$user_status= $row3['level'];
$isReactivation= $row3['isReactivation'];

if(($username_url == $username_db) AND ($key_url == $key_db) AND ($user_status == USER_ACTIVATION OR $isReactivation == 1)){
	$update_users_db= "UPDATE users SET activation_date=NOW() WHERE username= '$username_db'";
	$db_connect= db_connect();
	$db_connect->query($update_users_db);
	
	$update_status_db= "UPDATE status SET level=2,label_level='Normal' WHERE users_id= $userID";
	$db_connect= db_connect();
	$db_connect->query($update_status_db);
	
	echo "Votre compte est activé! Vous pouvez vous connecter.";
}else{
	echo "Ce compte ne doit pas être activé!";
}
?>