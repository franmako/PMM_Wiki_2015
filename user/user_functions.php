<?php
function convertWikiMarkup($wiki_text){
	$wiki_text= preg_replace('/\[1\|(.*?)\]/','<h1>$1</h1>', $wiki_text);
	$wiki_text= preg_replace('/\[2\|(.*?)\]/','<h2>$1</h2>', $wiki_text);
	$wiki_text= preg_replace('/\[!\|(.*?)\]/','<!‐‐$1‐‐>', $wiki_text);
	$wiki_text= preg_replace('/\[3\|(.*?)\]/','<h3>$1</h3>', $wiki_text);
	$wiki_text= preg_replace('/\[d\|(.*?)\]/','<div>$1</div>', $wiki_text);
	$wiki_text= preg_replace('/\[p\|(.*?)\]/','<p>$1</p>', $wiki_text);
	$wiki_text= preg_replace('/\[n\]/','<br/>', $wiki_text);
	$wiki_text= preg_replace('/\[h\]/','<hr/>', $wiki_text);
	$wiki_text= preg_replace('/\[b\|(.*?)\]/','<b>$1</b>', $wiki_text);
	$wiki_text= preg_replace('/\[i\|(.*?)\]/','<i>$1</i>', $wiki_text);
	$wiki_text= preg_replace('/\[u\|(.*?)\]/','<u>$1</u>', $wiki_text);
	$wiki_text= preg_replace('/\[a\|(.*?)\|(.*?)\]/','<a href="$1">$2</a>', $wiki_text);
	$wiki_text= preg_replace('/\[img\|(.*?)\|(.*?)\]/','<img href="$1" alt="$2">', $wiki_text);
	$wiki_text= preg_replace('/\[\#(.*?)\|(.*?)\]/','<span style="color:#$1;">$2</span>', $wiki_text);
	$wiki_text= preg_replace('/\[bg\|\#(.*?)\|(.*?)\]/','<span style="background:#$1;">$2</span>', $wiki_text);
	$wiki_text= preg_replace('/\[div\|\#(.*?)\|(.*?)\]/','<div style="background:#$1;">$2</div>', $wiki_text);
	return($wiki_text);
}
function getSalt(){
	$cost = 10;// A higher "cost" is more secure but consumes more processing power
	$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.'); // Create a random salt
	// Prefix information about the hash so PHP knows how to verify it later.
	// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
	$salt = sprintf("$2a$%02d$", $cost) . $salt;
	
	return $salt;
}
function getHash($password,$salt){
	$hash = crypt($password, $salt); // Hash the password with the salt
	
	return $hash;
}

function getUserType($userID){
	$db_connect= db_connect();
	$query="SELECT * FROM status WHERE users_id=$userID";
	$result= $db_connect->query($query);
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_array($result);
		$usertype= $row['level'];
	}
	return ($usertype);
}
function getUserType_label($userID){
	$db_connect= db_connect();
	$query="SELECT * FROM status WHERE users_id=$userID";
	$row= getRow($query);
	$usertype_label= $row['label_level'];
	return ($usertype_label);
}
function session_init($row){
	$userID= $row['id'];	
	$_SESSION['userID']= $userID;	
	$_SESSION['username'] = $row['username'];
	$_SESSION['email']= $row['email'];
	$_SESSION['userlevel']= getUserType($userID);
	$_SESSION['userlevel_label']= getUserType_label($userID);
	$_SESSION['register_date']= new DateTime($row['register_date']);
	$_SESSION['secretquestion']= $row['hasSecretQuestion'];
	$_SESSION['hasAvatar']= $row['hasAvatar'];
}


// © Jérome Réaux : http://j-reaux.developpez.com - http://www.jerome-reaux-creations.fr
// ---------------------------------------------------
// Fonction de REDIMENSIONNEMENT physique "PROPORTIONNEL" et Enregistrement
// ---------------------------------------------------
// retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
// ---------------------
// La FONCTION : fctredimimage ($W_max, $H_max, $rep_Dst, $img_Dst, $rep_Src, $img_Src)
// Les paramètres :
// - $W_max : LARGEUR maxi finale --> ou 0
// - $H_max : HAUTEUR maxi finale --> ou 0
// - $rep_Dst : repertoire de l'image de Destination (déprotégé) --> ou '' (même répertoire)
// - $img_Dst : NOM de l'image de Destination --> ou '' (même nom que l'image Source)
// - $rep_Src : repertoire de l'image Source (déprotégé)
// - $img_Src : NOM de l'image Source
// ---------------------
// 3 options :
// A- si $W_max!=0 et $H_max!=0 : a LARGEUR maxi ET HAUTEUR maxi fixes
// B- si $H_max!=0 et $W_max==0 : image finale a HAUTEUR maxi fixe (largeur auto)
// C- si $W_max==0 et $H_max!=0 : image finale a LARGEUR maxi fixe (hauteur auto)
// Si l'image Source est plus petite que les dimensions indiquées : PAS de redimensionnement.
// ---------------------
// $rep_Dst : il faut s'assurer que les droits en écriture ont été donnés au dossier (chmod)
// - si $rep_Dst = ''   : $rep_Dst = $rep_Src (même répertoire que l'image Source)
// - si $img_Dst = '' : $img_Dst = $img_Src (même nom que l'image Source)
// - si $rep_Dst='' ET $img_Dst='' : on ecrase (remplace) l'image source !
// ---------------------
// NB : $img_Dst et $img_Src doivent avoir la meme extension (meme type mime) !
// Extensions acceptées (traitees ici) : .jpg , .jpeg , .png
// Pour Ajouter d autres extensions : voir la bibliotheque GD ou ImageMagick
// (GD) NE fonctionne PAS avec les GIF ANIMES ou a fond transparent !
// ---------------------
// UTILISATION (exemple) :
// $redimOK = fctredimimage(120,80,'reppicto/','monpicto.jpg','repimage/','monimage.jpg');
// if ($redimOK==true) { echo 'Redimensionnement OK !';  }
// ---------------------------------------------------
function redimImage($W_max, $H_max, $rep_Dst, $img_Dst, $rep_Src, $img_Src) {
 $condition = 0;
 // Si certains paramètres ont pour valeur '' :
 if ($rep_Dst=='') { $rep_Dst = $rep_Src; } // (même répertoire)
 if ($img_Dst=='') { $img_Dst = $img_Src; } // (même nom)
 // ---------------------
 // si le fichier existe dans le répertoire, on continue...
 if (file_exists($rep_Src.$img_Src) && ($W_max!=0 || $H_max!=0)) { 
   // ----------------------
   // extensions acceptées : 
	$extension_Allowed = 'jpg,jpeg,png';	// (sans espaces)
   // extension fichier Source
	$extension_Src = strtolower(pathinfo($img_Src,PATHINFO_EXTENSION));
   // ----------------------
   // extension OK ? on continue ...
   if(in_array($extension_Src, explode(',', $extension_Allowed))) {
     // ------------------------
      // récupération des dimensions de l'image Src
      $img_size = getimagesize($rep_Src.$img_Src);
      $W_Src = $img_size[0]; // largeur
      $H_Src = $img_size[1]; // hauteur
      // ------------------------
      // condition de redimensionnement et dimensions de l'image finale
      // ------------------------
      // A- LARGEUR ET HAUTEUR maxi fixes
      if ($W_max!=0 && $H_max!=0) {
         $ratiox = $W_Src / $W_max; // ratio en largeur
         $ratioy = $H_Src / $H_max; // ratio en hauteur
         $ratio = max($ratiox,$ratioy); // le plus grand
         $W = $W_Src/$ratio;
         $H = $H_Src/$ratio;   
         $condition = ($W_Src>$W) || ($W_Src>$H); // 1 si vrai (true)
      }
      // ------------------------
      // B- HAUTEUR maxi fixe
      if ($W_max==0 && $H_max!=0) {
         $H = $H_max;
         $W = $H * ($W_Src / $H_Src);
         $condition = ($H_Src > $H_max); // 1 si vrai (true)
      }
      // ------------------------
      // C- LARGEUR maxi fixe
      if ($W_max!=0 && $H_max==0) {
         $W = $W_max;
         $H = $W * ($H_Src / $W_Src);         
         $condition = ($W_Src > $W_max); // 1 si vrai (true)
      }
      // ---------------------------------------------
      // REDIMENSIONNEMENT si la condition est vraie
      // ---------------------------------------------
      // - Si l'image Source est plus petite que les dimensions indiquées :
      // Par defaut : PAS de redimensionnement.
      // - Mais on peut "forcer" le redimensionnement en ajoutant ici :
      // $condition = 1; (risque de perte de qualité)
      if ($condition==1) {
         // ---------------------
         // creation de la ressource-image "Src" en fonction de l extension
         switch($extension_Src) {
         case 'jpg':
         case 'jpeg':
           $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
           break;
         case 'png':
           $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
           break;
         }
         // ---------------------
         // creation d une ressource-image "Dst" aux dimensions finales
         // fond noir (par defaut)
         switch($extension_Src) {
         case 'jpg':
         case 'jpeg':
           $Ress_Dst = imagecreatetruecolor($W,$H);
           break;
         case 'png':
           $Ress_Dst = imagecreatetruecolor($W,$H);
           // fond transparent (pour les png avec transparence)
           imagesavealpha($Ress_Dst, true);
           $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
           imagefill($Ress_Dst, 0, 0, $trans_color);
           break;
         }
         // ---------------------
         // REDIMENSIONNEMENT (copie, redimensionne, re-echantillonne)
         imagecopyresampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src); 
         // ---------------------
         // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
         switch ($extension_Src) { 
         case 'jpg':
         case 'jpeg':
           imagejpeg ($Ress_Dst, $rep_Dst.$img_Dst);
           break;
         case 'png':
           imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
           break;
         }
         // ------------------------
         // liberation des ressources-image
         imagedestroy ($Ress_Src);
         imagedestroy ($Ress_Dst);
      }
      // ------------------------
   }
 }
 // ---------------------------------------------------
 // retourne : true si le redimensionnement et l'enregistrement ont bien eu lieu, sinon false
 if ($condition==1 && file_exists($rep_Dst.$img_Dst)) { return true; }
 else { return false; }
 // ---------------------------------------------------
};

function user_info_display(){
	echo'<h3>Profil</h3>';
	$userID=$_SESSION['userID'];
	$query="SELECT * FROM avatars WHERE users_id=$userID";
	$row=getRow($query);
	$avatar_filename= $row['filename'];
	echo '<img src="'.AVATAR_PATH.$avatar_filename.'" alt="Profile Image" style="width:'.AVATAR_WIDTH.'px;height:'.AVATAR_HEIGHT.'px"> <br/>';
	if ($_SESSION['hasAvatar'] == 0) {	
		echo '<a href="index.php?rq=avatar_upload">[Ajouter un avatar]</a>';
	}else {
		echo '<a href="index.php?rq=avatar_upload">[Modifier]</a>';
	}
    echo '<p>Utilisateur: <b>'.$_SESSION['username'].'</b><a href="index.php?rq=change_username">[Modifier]</a></p>';
	echo "<p>Date d'inscription: ".date_format($_SESSION['register_date'], 'd-m-Y H:i:s')."<p>";
	echo '<p>Votre email est: '.$_SESSION['email'].'<a href="index.php?rq=change_email">[Modifier]</a></p> ';
	echo "<p>Statut : <b>".$_SESSION['userlevel_label']."</b></p>";
	echo '<a href="index.php?rq=change_password">[Modifier - Mot De Passe]</a>';
	
	$query_secret="SELECT * FROM users WHERE id=$userID";
	$row_secret = getRow($query_secret);
	if ($row_secret) {
		$secretquestion= $row_secret['hasSecretQuestion'];
	} else {
		echo "Erreur!";
	}

	if($secretquestion == 0){
		echo '<p><a href="index.php?rq=secretQuestion_set&type=new">[Cliquez ici pour ajouter une question secrète.]</a></p>';
	}else {
		echo '<p><a href="index.php?rq=secretQuestion_set&type=change">[Modifier - Q&R Secrets]</a></p>';
	}
} 
?>