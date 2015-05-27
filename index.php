<?php
include_once 'config/global_config_variables.php';
include_once 'database/db_init.php';
include_once 'init.php';
?>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo "".TITLE.""; ?></title>
		<link rel="stylesheet" type="text/css" href="css/default.css">
	</head>
	
	<body id="top">
		<div>
			<!-- Header -->
			<?php include 'content/header.php'?>
			<!-- Menu -->
			<div class="wrapper col2">
				<div id="topbar">
					<?php 
					include 'menu/default.php'; 
					include 'forms/search_wiki_form.php';
					?>
					<br class="clear"/>
				</div>
			</div>
			<!-- Contenu principal -->
			<div class="wrapper col5">
				<div id="container">
					<?php include'content/main.php';?>	
				</div>
			</div>
			<!-- Pied de page -->
			<?php include'content/footer.php';?>		
		</div>
	</body>
</html>