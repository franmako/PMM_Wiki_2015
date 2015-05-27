<?php
if(!empty($_SESSION)){
	user_info_display();
}elseif(isset($_POST['username']) AND isset($_POST['password'])){
	$db_connect= db_connect();
	$username = $_POST['username']; 
    $password = $_POST['password']; 
	$query_user= "SELECT * FROM users WHERE username = '$username';";
	$row_user= getRow($query_user);
	if($row_user){
		$userID= $row_user['id'];
		$hash_db= $row_user['password'];
		
		$query_status= "SELECT * FROM status WHERE users_id=$userID";
		$row_status= getRow($query_status);
		$user_level= $row_status['level'];
		$isReactivation= $row_status['isReactivation'];
		if ($user_level == USER_ACTIVATION OR $isReactivation == 1) {
			echo "Votre compte doit d'abord être activé pour pouvoir vous connecter! ";
		} elseif ($user_level == USER_BANNED) {
			echo "Cet utilisateur est <b>BANNI</b>!";
		} else {
			$query_salt="SELECT * FROM salts WHERE users_id=$userID";
			$row_salt=getRow($query_salt);
			$salt_db= $row_salt['salt'];
			$hash= crypt($password,$salt_db);
			if ($hash == $hash_db){
				session_init($row_user);
				
				//Update lastLogin time
				$query_last_login="UPDATE users SET last_connect=NOW() WHERE username='$username'";
				$db_connect->query($query_last_login);
				
				//Redirection espace membres
				echo "<h1>Bienvenue ".$_SESSION['username']."</h1>";
				echo "<p>Adresse e-mail: ".$_SESSION['email']."</p>";
				echo "<p>Statut: <b>".$_SESSION['userlevel_label']."</b></p>";
        		echo "<p>Redirection vers l'espace membres...</p>";
				echo '<meta http-equiv="refresh" content="4" url="index.php?rq=connection"/>';
			}else {
				echo "Erreur de connexion! Veuillez ré-essayer.";
				echo '<meta http-equiv="refresh" content="4" url="index.php?rq=connection"/>';
			}
		}
	}else {
		echo "Erreur de connexion! Cet utilisateur n'existe pas!";
		echo '<meta http-equiv="refresh" content="3" url="index.php?rq=connection"/>';
	}
}else{
	include 'forms/login_form.php';
} 
?>