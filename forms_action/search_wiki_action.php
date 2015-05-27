<?php 
echo "<h3> Résultats de la recherche </h3>";
if(!empty($_POST['search'])){
	if (empty($_SESSION)) { // User anonyme
		$search= $_POST['search'];
		echo '<table border="1" class="tftable" id="tfhover">';
		$query_subject= "SELECT * FROM subject WHERE title LIKE '%$search%' OR description LIKE '%$search%' AND visibility >= 2 ";
		$db_connect= db_connect();
				
		//Results subjects
		echo "<p> Résultats dans les sujets </p>";
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Titre </th>
			<th> Description </th>
			<th> Créé le </th>
			<th> Visibilité </th>
		</tr>';
		$result_subject= $db_connect->query($query_subject);
		while($row_subject = mysqli_fetch_array($result_subject)){
			$subjectID= $row_subject['id'];
			$time= new DateTime($row_subject['creation_date']);
			$time_format= date_format($time, 'd-m-Y H:i:s');
			$visibility= $row_subject['visibility'];
			$visibility= getVisibilityLabel($visibility);
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&subject_id='.$subjectID.'">'.$row_subject['title'].'</a> </td>
				<td> '.$row_subject['description'].' </td>
				<td> '.$time_format.' </td>
				<td> '.$visibility.' </td>
			</tr>'; 
		}
		echo "</table>";
	
		//Results pages
		echo "<p>Résultats dans les pages</p>";
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Mot-clé </th>
			<th> Créé le </th>
		</tr>';	
		$query_page= "SELECT * FROM page,subject WHERE subject.id=subject_id AND keyword LIKE '%$search%' AND visibility >= 2";
		$result_page= $db_connect->query($query_page);
		while($row_page = mysqli_fetch_array($result_page)){
			$subjectID= $row_page['subject_id'];
			$subject_name= getSubjectName($subjectID);
			$create_date= new DateTime($row_page['creation_date']);
			$create_date_format= date_format($create_date, 'd-m-Y H:i:s');
			$keyword= $row_page['keyword'];
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&keyword='.$keyword.'">'.$keyword.'</a> </td>
				<td> '.$create_date_format.' </td>
			</tr>'; 					
		}
		echo "</table>";
	}elseif (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) { // User admin
		$search= $_POST['search'];
		echo '<table border="1" class="tftable" id="tfhover">';
		$query_subject= "SELECT * FROM subject WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
		$db_connect= db_connect();
		
		//Results subjects
		echo "<p> Résultats dans les sujets </p>";
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Titre </th>
			<th> Description </th>
			<th> Créé le </th>
			<th> Visibilité </th>
		</tr>';
		$result_subject= $db_connect->query($query_subject);
		while($row_subject = mysqli_fetch_array($result_subject)){
			$subjectID= $row_subject['id'];
			$time= new DateTime($row_subject['creation_date']);
			$time_format= date_format($time, 'd-m-Y H:i:s');
			$visibility= $row_subject['visibility'];
			$visibility= getVisibilityLabel($visibility);
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&subject_id='.$subjectID.'">'.$row_subject['title'].'</a> </td>
				<td> '.$row_subject['description'].' </td>
				<td> '.$time_format.' </td>
				<td> '.$visibility.' </td>
			</tr>'; 
		}
		echo "</table>";
	
		//Results pages
		echo "<p>Résultats dans les pages</p>";
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Mot-clé </th>
			<th> Créé le </th>
		</tr>';	
		$query_page= "SELECT * FROM page,subject WHERE subject.id=subject_id AND keyword LIKE '%$search%'";
		$result_page= $db_connect->query($query_page);
		while($row_page = mysqli_fetch_array($result_page)){
			$subjectID= $row_page['subject_id'];
			$subject_name= getSubjectName($subjectID);
			$create_date= new DateTime($row_page['creation_date']);
			$create_date_format= date_format($create_date, 'd-m-Y H:i:s');
			$keyword= $row_page['keyword'];
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&keyword='.$keyword.'">'.$keyword.'</a> </td>
				<td> '.$create_date_format.' </td>
			</tr>'; 					
		}
		echo "</table>";
	}elseif (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_MODERATOR) {// User Modo
		$search= $_POST['search'];
		echo '<table border="1" class="tftable" id="tfhover">';
		$query_subject= "SELECT * FROM subject WHERE title LIKE '%$search%' OR description LIKE '%$search%' AND visibility >= 1";
		$db_connect= db_connect();
		
		//Results subjects
		echo "<p> Résultats dans les sujets </p>";
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Titre </th>
			<th> Description </th>
			<th> Créé le </th>
			<th> Visibilité </th>
		</tr>';
		$result_subject= $db_connect->query($query_subject);
		while($row_subject = mysqli_fetch_array($result_subject)){
			$subjectID= $row_subject['id'];
			$time= new DateTime($row_subject['creation_date']);
			$time_format= date_format($time, 'd-m-Y H:i:s');
			$visibility= $row_subject['visibility'];
			$visibility= getVisibilityLabel($visibility);
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&subject_id='.$subjectID.'">'.$row_subject['title'].'</a> </td>
				<td> '.$row_subject['description'].' </td>
				<td> '.$time_format.' </td>
				<td> '.$visibility.' </td>
			</tr>'; 
		}
		echo "</table>";
	
		//Results pages
		echo "<p>Résultats dans les pages</p>";
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Mot-clé </th>
			<th> Créé le </th>
		</tr>';	
		$query_page= "SELECT * FROM page,subject WHERE subject.id=subject_id AND keyword LIKE '%$search%' AND visibility >= 1";
		$result_page= $db_connect->query($query_page);
		while($row_page = mysqli_fetch_array($result_page)){
			$subjectID= $row_page['subject_id'];
			$subject_name= getSubjectName($subjectID);
			$create_date= new DateTime($row_page['creation_date']);
			$create_date_format= date_format($create_date, 'd-m-Y H:i:s');
			$keyword= $row_page['keyword'];
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&keyword='.$keyword.'">'.$keyword.'</a> </td>
				<td> '.$create_date_format.' </td>
			</tr>'; 					
		}
		echo "</table>";
	}elseif (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_NORMAL) {//User normal
		$search= $_POST['search'];
		echo '<table border="1" class="tftable" id="tfhover">';
		$query_subject= "SELECT * FROM subject WHERE title LIKE '%$search%' OR description LIKE '%$search%' AND visibility >= 2 ";
		$db_connect= db_connect();
		
		
		//Results subjects
		echo "<p> Résultats dans les sujets </p>";
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Titre </th>
			<th> Description </th>
			<th> Créé le </th>
			<th> Visibilité </th>
		</tr>';
		$result_subject= $db_connect->query($query_subject);
		while($row_subject = mysqli_fetch_array($result_subject)){
			$subjectID= $row_subject['id'];
			$time= new DateTime($row_subject['creation_date']);
			$time_format= date_format($time, 'd-m-Y H:i:s');
			$visibility= $row_subject['visibility'];
			$visibility= getVisibilityLabel($visibility);
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&subject_id='.$subjectID.'">'.$row_subject['title'].'</a> </td>
				<td> '.$row_subject['description'].' </td>
				<td> '.$time_format.' </td>
				<td> '.$visibility.' </td>
			</tr>'; 
		}
		echo "</table>";
	
		//Results pages
		echo "<p>Résultats dans les pages</p>";
		echo '<table border="1" class="tftable" id="tfhover">';
		echo'
		<tr>
			<th> Mot-clé </th>
			<th> Créé le </th>
		</tr>';	
		$query_page= "SELECT * FROM page,subject WHERE subject.id=subject_id AND keyword LIKE '%$search%' AND visibility >= 2";
		$result_page= $db_connect->query($query_page);
		while($row_page = mysqli_fetch_array($result_page)){
			$subjectID= $row_page['subject_id'];
			$subject_name= getSubjectName($subjectID);
			$create_date= new DateTime($row_page['creation_date']);
			$create_date_format= date_format($create_date, 'd-m-Y H:i:s');
			$keyword= $row_page['keyword'];
			echo'
			<tr>
				<td> <a href="index.php?rq=subject_page&keyword='.$keyword.'">'.$keyword.'</a> </td>
				<td> '.$create_date_format.' </td>
			</tr>'; 					
		}
		echo "</table>";
	}		
}else {
	echo "Veuillez entrer du texte pour effectuer une recherche.";
}
?>