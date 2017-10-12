<?php 
	
	/*
		- Class C_main use constructor function to declare and point to class models
	*/

	require_once("models/M_user_management.php");
	require_once("models/M_normal_user.php");
	require_once("phpMailer/class.phpmailer.php");
	require_once('phpMailer/class.smtp.php'); 
	
	class C_main {
		/*
			Declare variales same as models class
		*/
		protected $M_user_management, $M_normal_user; 
		public function __construct() {

			/*
				Point to model class
			*/
			$this->M_user_management = new M_user_management;
			$this->M_normal_user = new M_normal_user;
			
		}
	}

?>