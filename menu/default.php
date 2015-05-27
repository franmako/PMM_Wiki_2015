<?php
if (!empty($_SESSION)) {
	$unread_messages= getNbNotif();
}
if(empty($_SESSION)){//User not connected or en demande de mot de passe
echo '
<div id="topnav">
	<ul >
		<li>
			<a href="index.php?rq=home" name="rq">Accueil</a>
		</li>
		<li>
			<a href="index.php?rq=contact" name="rq">Contact</a>
		</li>
		<li>
			<a href="index.php?rq=wiki_home" name="rq">Wiki</a>
		</li>
		<li>
			<a href="index.php?rq=newAccount" name="rq">Créer un compte</a>
		</li>
		<li>
			<a href="index.php?rq=connection" name="rq">Connexion</a>
		</li>
	</ul>
</div>
';
}elseif(!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN){
echo '
<div id="topnav">
	<ul >
		<li>
			<a href="index.php?rq=home" name="rq">Accueil</a>
		</li>
		<li>
			<a href="index.php?rq=connection" name="rq">Profil ('.$unread_messages.')</a>
			<ul>
				<li>
					<a href="index.php?rq=connection" name="rq">Profil</a>
				</li>
				<li>
					<a href="index.php?rq=messages&read=&id=" name="rq">Messages (Non-Lus: '.$unread_messages.')</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="index.php?rq=wiki_home" name="rq">Wikis</a>
			<ul>
				<li>
					<a href="index.php?rq=subject_create" name="rq">Créer Sujet</a>
				</li>
				<li>
					<a href="index.php?rq=subject_user" name="rq">Mes Sujets</a>
				</li>
			</ul>
		</li>
		<li><a href="#">Administrateur</a>
			<ul>
				<li>
					<a href="index.php?rq=user_manage" name="rq">Gestion des utilisateurs</a>
				</li>
				<li>
					<a href="index.php?rq=assign_modo"> Assigner Modérateurs</a>
				</li>
				<li>
					<a href="index.php?rq=config" name="rq">Configuration du site</a>
				</li>
				<li>
					<a href="index.php?rq=remove_modo"> Supprimer Modérateur </a>
				</li>
			</ul>
		</li>
		<li>
			<a href="index.php?rq=modo" name="rq">Modérateur </a>
			<ul>
				<li>
					<a href="index.php?rq=moderate_subject">Mes Sujets</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="index.php?rq=logout" name="rq">Déconnexion</a>
		</li>
	</ul>
</div>';
}elseif(!empty($_SESSION) AND $_SESSION['userlevel'] == USER_MODERATOR){
$unread_messages= getNbNotif();
echo '
<div id="topnav">
	<ul >
		<li>
			<a href="index.php?rq=home" name="rq">Accueil</a>
		</li>
		<li>
			<a href="index.php?rq=connection" name="rq">Profil ('.$unread_messages.')</a>
			<ul>
				<li>
					<a href="index.php?rq=connection" name="rq">Profil</a>
				</li>
				<li>
					<a href="index.php?rq=messages&read=&id=" name="rq">Messages (Non-Lus: '.$unread_messages.')</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="index.php?rq=wiki_home" name="rq">Wikis</a>
			<ul>
				<li>
					<a href="index.php?rq=subject_create" name="rq">Créer Sujet</a>
				</li>
				<li>
					<a href="index.php?rq=subject_user" name="rq">Mes Sujets</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="index.php?rq=modo" name="rq">Modérateur </a>
			<ul>
				<li>
					<a href="index.php?rq=moderate_subject">Mes Sujets</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="index.php?rq=logout" name="rq">Déconnexion</a>
		</li>
	</ul>
</div>';
}elseif(!empty($_SESSION) AND $_SESSION['userlevel'] == USER_NORMAL){//Normal user
echo '
<div id="topnav">
	<ul >
		<li>
			<a href="index.php?rq=home" name="rq">Accueil</a>
		</li>
		<li>
			<a href="index.php?rq=contact" name="rq">Contact</a>
		</li>
		<li>
			<a href="index.php?rq=connection" name="rq">Profil ('.$unread_messages.')</a>
			<ul>
				<li>
					<a href="index.php?rq=connection" name="rq">Profil</a>
				</li>
				<li>
					<a href="index.php?rq=messages&read=&id=" name="rq">Messages (Non-Lus: '.$unread_messages.')</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="index.php?rq=wiki_home" name="rq">Wikis</a>
			<ul>
				<li>
					<a href="index.php?rq=subject_create" name="rq">Créer Sujet</a>
				</li>
				<li>
					<a href="index.php?rq=subject_user" name="rq">Mes Sujets</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="index.php?rq=logout" name="rq">Déconnexion</a>
		</li>
	</ul>
</div>';
}elseif(!empty($_SESSION) AND $_SESSION['userlevel'] == USER_REACTIVATION){
echo '
<div id="topnav">
	<ul >
		<li>
			<a href="index.php?rq=home" name="rq">Accueil</a>
		</li>
		<li>
			<a href="index.php?rq=contact" name="rq">Contact</a>
		</li>
		<li>
			<a href="index.php?rq=connection" name="rq">Profil</a>
		</li>
		<li>
			<a href="index.php?rq=logout" name="rq">Déconnexion</a>
		</li>
	</ul>
</div>';	
}elseif(!empty($_SESSION) AND $_SESSION['userlevel'] == USER_DEMANDEMDP){
echo '
<div id="topnav">
	<ul >
		<li>
			<a href="index.php?rq=home" name="rq">Accueil</a>
		</li>
		<li>
			<a href="index.php?rq=contact" name="rq">Contact</a>
		</li>
		<li>
			<a href="index.php?rq=connection" name="rq">Profil</a>
		</li>
		<li>
			<a href="index.php?rq=logout" name="rq">Déconnexion</a>
		</li>
	</ul>
</div>';
}
?>

