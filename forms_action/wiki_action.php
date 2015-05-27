<?php
if (!empty($_SESSION)) {
	$wiki_text= $_POST['content'];
	$str_size= strlen($wiki_text);
	for($i=0;$i<$str_size;$i++){
		switch ($wiki_text[$i]) {
			case '\\':
				$char_spe=substr($wiki_text,$i,1);
				switch ($char_spe){
					case '\\':
						echo "\\";
						$i++;
						break;
					case '[':
						echo "[";
						//$i= $i+2;
						$i++;
						break;
					case ']':
						echo "]";
						//$i= $i+2;
						$i++;
						break;
					case '|':
						echo "|";
						//$i= $i+2;
						$i++;
						break;
					case '^':
						echo "^";
						//$i= $i+2;
						$i++;
						break;
				}
				$i= $i+2;
				//echo "$char_spe";
				break;
		}
	}
	//echo "$wiki_text";
}else {
	unauthorizedAccess();
}
?>