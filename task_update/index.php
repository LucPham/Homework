<?php 
	require_once("controllers/Management.php");
	require_once("controllers/User.php");

	use Controller\Manage\Management;
	use Controller\Users\User;

	

	$manage = new Management;

	if (isset($_REQUEST['p'])) {
		switch ($_REQUEST['p']) {
			case 'add':
				$manage->addUser();
				break;
			case 'logout':
				$manage->logOut(new User());
				break;
			default:
				$manage->logInWeb(new User());
				break;
		}
	} else {$manage->logInWeb(new User());}

?>