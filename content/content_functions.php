<?php
function getContent(){
	switch (isset($_GET['rq']) ? $_GET['rq'] : '') {
	//Register
	case 'newAccount':
		include'forms/register_form.php';
		break;
	case 'account_activate':
		include 'user/account_activation.php';
		break;
	//Admin options
	case 'user_manage_detail':
		include 'admin/user_manage_profile.php';
		break;
	case 'config':
		include 'forms/config_admin_form.php';
		break;
	case 'config_modify':
		include 'forms_action/config_admin_action.php';
		break;
	case 'user_manage':
		include 'admin/user_manage.php';
		break;
	case 'change_status':
		include 'forms_action/change_status_action.php';
		break;
	case 'avatar_logo':
		include 'forms/upload_logo_form.php';
		break;
	case 'user_messages':
		include 'admin/user_messages.php';
		break;
	case 'admin_contact_action':
		include 'forms_action/admin_contact_action.php';
		break;
	//Moderator
	case 'assign_modo':
		include 'moderator/assign_modo.php';
		break;
	case 'modo_choose':
		include 'moderator/modo_choose.php';
		break;
	case 'notify_modo':
		include 'moderator/assign_modo_notify.php';
		break;
	case 'moderate_subject':
		include 'moderator/moderate_subject.php';
		break;
	case 'remove_modo':
		include 'moderator/remove_modo.php';
		break;
	case 'delete_modo':
		include 'moderator/delete_modo.php';
		break;
	//Wiki
	case 'wiki_form':
		include 'forms/wiki_form.php';
		break;
	case 'wiki_action':
		include 'forms_action/wiki_action.php';
		break;
	case 'wiki_home':
		include 'wiki/wiki_main.php';
		break;
	case 'subject_create':
		include 'wiki/subject_create.php';
		break;
	case 'write_page':
		include 'wiki/page_create.php';
		break;
	case 'edit_page':
		include 'wiki/page_edit.php';
		break;
	case 'edit_page_action':
		include 'forms_action/page_edit_action.php';
		break;
	case 'delete_page':
		include 'wiki/page_delete.php';
		break;
	case 'subject_create_action':
		include 'forms_action/subject_create_action.php';
		break;
	case 'subjects_show':
		include 'wiki/subjects_show.php';
		break;
	case 'subject_page':
		include 'wiki/subject_pages.php';
		break;	
	case 'wiki_search':
		include 'forms_action/search_wiki_action.php';
		break;
	case 'subject_user':
		include 'wiki/subject_user.php';
		break;
	case 'signal_page':
		include 'wiki/signal_page.php';
		break;
	case 'signal_subject':
		include 'wiki/signal_subject.php';
		break;
	case 'write_page_action':
		include 'forms_action/page_create_action.php';
		break;
	//Profile mgmt
	case 'username_modify':
		include 'forms_action/change_username_action.php';
		break;
	case 'change_username':
		include'forms/change_username_form.php';
		break;
	case 'email_modify':
		include 'forms_action/change_email_action.php';
		break;
	case 'change_email':
		include 'forms/change_email_form.php';
		break;
	case 'change_password':
		include 'forms/change_password_form.php';
		break;
	case 'password_modify':
		include 'forms_action/change_password_action.php';
		break;
	case 'avatar_upload':
		include 'forms/upload_avatar_form.php';
		break;
	case 'avatar_upload_action':
		include 'forms_action/upload_avatar_action.php';
		break;
	case 'secretQuestion_set':
		include 'forms/secret_question_set_form.php';
		break;
	case 'secretQuestion_set_action':
		include 'forms_action/secret_question_set_action.php';
		break;
	//Contact
	case 'contact_action':
		include 'forms_action/contact_action.php';
		break;
	case 'account_create':
		include 'forms_action/register_action.php';
		break;
	case 'contact':
		include'forms/contact_form.php';
		break;
	case 'message_detail':
		include 'user/message_detail.php';
		break;
	case 'messages':
		include 'user/messages.php';
		break;
	//Login&logout
	case 'connection':
		include'forms_action/login_action.php';
		break;
	case 'logout':
		include 'user/logout.php';
		break;
	//Forgotten password
	case 'passwordReset':
		include 'forms/password_forgotten_form.php';
		break;
	case 'passwordReset_action':
		include 'forms_action/password_forgotten_action.php';
		break;
	case 'secret_answer_action':
		include 'forms_action/secret_answer_q_a_action.php';
		break;
	case 'password_reset_form':
		include 'forms/password_reset_form.php';
		break;
	case 'password_reset_action':
		include 'forms_action/password_reset_action.php';
		break;
	//Acceuil
	default:
		include 'content/home.php';
	}	
}
?>