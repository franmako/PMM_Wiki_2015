<?php
if (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	echo '<h2> Créer un sujet </h2>'; 
	echo 
	'
	<ul>
		<li><font color="orangered"><b>* Ces champs ne peuvent PAS être VIDES!</b></tt></font></li>
		<li>
			Visiblité
			<ul>
				<li>Anonyme: Visible à tout le monde.</li>
				<li>Membre: Visible aux memebres inscrits du site.</li>
				<li>Modérateur: Visible seulement aux modérateurs et à l\'admin.</li>
				<li>Admin: Visible seulement à l\'admin.</li>
			</ul>
		</li>
	</ul>
	';
	include 'forms/subject_create_form.php';
} elseif (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_MODERATOR) {
	echo '<h2> Créer un sujet </h2>'; 
	echo 
	'
	<ul>
		<li><font color="orangered"><b>* Ces champs ne peuvent PAS être VIDES!</b></tt></font></li>
		<li>
			Visiblité
			<ul>
				<li>Anonyme: Visible à tout le monde.</li>
				<li>Membre: Visible aux memebres inscrits du site.</li>
				<li>Modérateur: Visible seulement aux modérateurs et à l\'admin.</li>
			</ul>
		</li>
	</ul>
	';
	include 'forms/subject_create_form.php';
}elseif (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_NORMAL) {
	echo '<h2> Créer un sujet </h2>'; 
	echo 
	'
	<ul>
		<li><font color="orangered"><b>* Ces champs ne peuvent PAS être VIDES!</b></tt></font></li>
		<li>
			Visiblité
			<ul>
				<li>Anonyme: Visible à tout le monde.</li>
				<li>Membre: Visible aux memebres inscrits du site.</li>
			</ul>
		</li>
	</ul>
	';
	include 'forms/subject_create_form.php';
}else {
	unauthorizedAccess();
}

?>