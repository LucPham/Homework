<?php 
	/***
	
	 * Class User implements from UserInfo
	 * With namespace Controller\Users
	
	 * This class use to define method function of users
	 * Use as a argument in some cases
		
	**/
	namespace Controller\Users;
	
	require("UserInfo.php");
	require("UserAction.php");

	use Controller\Users\UserAction;
	use Controller\Users\UserInfo;
	
	class User implements UserInfo
	{
		protected $data = array();
		public function __construct(&$data = array())
		{
			if (isset($data)) {
				$this->data = $data;
			}
		}

		// Set info of user
		public function setInfo(&$data = array())
		{
			$this->data = $data;
		}

		// Return user info as array
		public function getInfo()
		{
			return $this->data;
		}

		// Login
		public function logIn()
		{
			header('location:index.php');
		}
		// Log out and redirect
		public function logOut()
		{
			unset($_SESSION['userid']);
			header('location:index.php');
		}
	}

