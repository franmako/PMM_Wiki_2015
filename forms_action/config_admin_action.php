<?php
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$password= $_POST['password'];
	$db_connect= db_connect();
	$userID= $_SESSION['userID'];
	
	$query_salt="SELECT * FROM salts WHERE users_id=$userID";
	$row_salt=getRow($query_salt);
	if ($row_salt) {
		$salt_db= $row_salt['salt'];
	} else {
		echo "Erreur de connexion! ";
	}
	
	
	$hash= crypt($password,$salt_db);
	$query= "SELECT * FROM users WHERE id = $userID;";
	$row= getRow($query);
	if($row != FALSE){
		$hash_db= $row['password'];
	}
		
	if (hash_equals($hash_db, $hash)){
		$fichier = fopen('config/config.ini.php', 'w');
               
		$ini['Header']['title'] = $_POST['title'];
		$ini['Header']['banner_title'] = $_POST['title_banner'];
		$ini['Header']['logo'] = $_POST['logo_path'];
		$ini['Header']['logo_min_height'] = $_POST['logo_min_height'];
		$ini['Header']['logo_height'] = $_POST['logo_height'];
		$ini['Header']['logo_max_height'] = $_POST['logo_max_height'];
		$ini['Header']['logo_min_width'] = $_POST['logo_min_width'];
		$ini['Header']['logo_width'] = $_POST['logo_width'];
		$ini['Header']['logo_max_width'] = $_POST['logo_max_width'];

		$ini['Contact']['notify']= $_POST['notify'];
		$ini['Contact']['confirm']= $_POST['confirm'];
		$ini['Contact']['register']= $_POST['register'];
		$ini['Contact']['admin']= $_POST['admin'];

		$ini['Register']['username_min_size']= $_POST['min_username'];
		$ini['Register']['password_min_size']= $_POST['min_password'];
		$ini['Register']['password_max_size']= $_POST['max_password'];

		$ini['Avatar']['path'] = $_POST['avatar_path'];
		$ini['Avatar']['avatar_min_height'] = $_POST['avatar_min_height'];
		$ini['Avatar']['avatar_min_width'] = $_POST['avatar_min_width'];
		$ini['Avatar']['avatar_height'] = $_POST['avatar_height'];
		$ini['Avatar']['avatar_width'] = $_POST['avatar_width'];
		$ini['Avatar']['avatar_max_height'] = $_POST['avatar_max_height'];
		$ini['Avatar']['avatar_max_width'] = $_POST['avatar_max_width'];
	
		$ini['Database']['hostname_local']=$_POST['host_local'];
		$ini['Database']['hostname_external']= $_POST['host_external'];
		$ini['Database']['db_name']= $_POST['database'];
		$ini['Database']['db_user']= $_POST['user'];
		$ini['Database']['db_password']= $_POST['db_password'];

		$ini['Footer']['author_name']= $_POST['author'];
		$ini['Footer']['copyright_date']= $_POST['copyright'];
               
		$newConfig = ';<?php echo "vous n\'êtes pas autorisé à voir ce contenu"; exit;?>'."\n";
		foreach($ini as $key => $value){
			$newConfig .= '['.$key.']'."\n";
    		foreach($value as $nom =>$valeur){
    			$newConfig .= "$nom = $valeur"."\n";
    		}
		}
		fputs($fichier, $newConfig);
		fclose($fichier);
		echo "Fichier de configuration mis à jour! ";
	}else {
		echo "Mot de passe incorrect!";
	}
} else {
	unauthorizedAccess();
}
?>