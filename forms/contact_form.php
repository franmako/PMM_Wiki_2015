<?php
if(empty($_SESSION)){
echo 
'
<h3> Contact</h3>
<form method="post" action="index.php?rq=contact_action&type=contact">
	<table border="0" cellpadding="0" cellspacing="5">
		<tr>
			<td align="right">
				<p class="signup">E-Mail</p>
			</td>
			<td>
				<input name="email" type="text" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		
		<tr>
			<td align="right">
				<p class="signup">Sujet</p>
			</td>
			<td>
				<input name="subject" type="text" maxlength="100" size="25" />
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>
		<tr align="right">
			<td align="right">
				<p class="signup">Message</p>
			</td>
			<td>
				<textarea name="content" cols="40" rows="5" ></textarea>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>	
		<tr>
			<td>
				<input type="submit" name="send" value="Soumettre le message" />
			</td>
    	</tr>
	</table>
</form>
<font color="orangered" size="+1"><tt><b>*Ces champs ne peuvent pas être vides!</b></tt></font>
'; 
}elseif (!empty($_SESSION) AND $_SESSION['userlevel'] == USER_ADMIN) {
	$messageID= $_GET['id'];
	$query_message= "SELECT * FROM contact_messages WHERE id=$messageID";
	$row_message= getRow($query_message);
	$subject= $row_message['subject'];
	echo 
'
<h3> Contact</h3>
<form method="post" action="index.php?rq=admin_contact_action&id='.$messageID.'">
	<table border="0" cellpadding="0" cellspacing="5">
		<tr>
			<td align="right">
				<p class="signup">Sujet</p>
			</td>
			<td>
				<input name="subject" type="text" maxlength="100" size="25" value="[RE] '.$subject.'"/>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font> 
			</td>
		</tr>
		<tr align="right">
			<td align="right">
				<p class="signup">Message</p>
			</td>
			<td>
				<textarea name="content" cols="40" rows="5" ></textarea>
				<font color="orangered" size="+1"><tt><b>*</b></tt></font>
			</td>
		</tr>	
		<tr>
			<td>
				<input type="submit" name="send" value="Soumettre le message" />
			</td>
    	</tr>
	</table>
</form>
<font color="orangered" size="+1"><tt><b>*Ces champs ne peuvent pas être vides!</b></tt></font>
';	
}elseif (!empty($_SESSION) AND $_SESSION['userlevel'] != USER_BANNED) {
echo 
'
	<h3> Contact</h3>
	<form method="post" action="index.php?rq=contact_action">
		<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td align="right">
					<p class="signup">Sujet</p>
				</td>
				<td>
					<input name="subject" type="text" maxlength="100" size="25" readonly/>
					<font color="orangered" size="+1"><tt><b>*</b></tt></font>
				</td>
			</tr>
			<tr align="right">
				<td align="right">
					<p class="signup">Message</p>
				</td>
				<td>
					<textarea name="content" cols="40" rows="5" ></textarea>
					<font color="orangered" size="+1"><tt><b>*</b></tt></font>
				</td>
			</tr>	
			<tr>
				<td>
					<input type="submit" name="send" value="Soumettre le message" />
				</td>
    		</tr>
		</table>
	</form>
	<font color="orangered" size="+1"><tt><b>*Ces champs ne peuvent pas être vides!</b></tt></font>
'; 
}
?>