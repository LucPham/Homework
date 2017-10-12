<?php 
	/*
		- Run as sub page
		- Get request and redirect another pages
	*/
	require_once("controllers/C_user_management.php");
	require_once("controllers/C_normal_user.php");
	$manage = new C_user_management;
	$user = new C_normal_user;

	if (isset($_REQUEST['p'])) {
		switch ($_REQUEST['p']) {
			case 'add_user':
				$manage->add_user();
				break;
			case 'mail_test':
				$manage->emailTest();
				break;
			case 'welcome':
				$user->welcome();
				break;
			case 'logout':
				$user->logout();
				break;
			default:
				# code...
				break;
		}
	}
?>