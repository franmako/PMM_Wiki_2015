<?php 
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$userid_manage= $_GET['id'];
	$query_avatar="SELECT * FROM avatars WHERE users_id=$userid_manage";
	$row_avatar=getRow($query_avatar);
	$avatar_filename= $row_avatar['filename'];
	
	$query_users= "SELECT * FROM users WHERE id=$userid_manage";
	$row_users= getRow($query_users);
	$username= $row_users['username'];
	$register_date= $row_users['register_date'];
	$last_connect= $row_users['last_connect'];
	$email= $row_users['email'];

	
	$query_status= "SELECT * FROM status WHERE users_id=$userid_manage";
	$row_status= getRow($query_status);
	$status= $row_status['label_level'];
	
	echo '<img src="'.AVATAR_PATH.$avatar_filename.'" alt="Profile Image" style="width:'.AVATAR_WIDTH.'px;height:'.AVATAR_HEIGHT.'px"><br/>';
	//echo ' <a href="index.php?rq=avatar_upload">[Modifier - Avatar]</a>';
    echo ' <p>Utilisateur: <b>'.$username.'</b><a href="index.php?rq=change_username&id='.$userid_manage.'">[Modifier - Nom utilisateur]</a></p>';
	echo "<p>Date d'inscription: ".$register_date."<p>";
	echo '<p>Dernière connexion: '.$last_connect.'</p>';
	echo ' <p>Votre email est: '.$email.'<a href="index.php?rq=change_email&id='.$userid_manage.'">[Modifier - Email]</a></p> ';
	echo '<p>Statut : <b>'.$status.'</b></p>'; 
	if ($userid_manage != $_SESSION['userID']) {
		echo 
		'
		Nouveau statut: <form method="post" action="index.php?rq=change_status&id='.$userid_manage.'">
    						<select name="status"> 
       						    <option value="1"> Modérateur</option>
        						<option value="2"> Normal</option>
        						<option value="6"> Dèsinscrit </option>
        						<option value="7"> Banni </option>   
    						</select>
    						Mot de passe: <input type="password" name="password"/>
    						<INPUT TYPE="submit" name="submit" value="Changer statut"/>
						</form></p>';
		echo '<p><a href="index.php?rq=user_messages&id='.$userid_manage.'&sort=">[Voir ses messages]</a></p>';
	}
	
	echo '<a href="index.php?rq=change_password">[Modifier - Mot de passe]</a>';
} else {
	unauthorizedAccess();
}

	
?>