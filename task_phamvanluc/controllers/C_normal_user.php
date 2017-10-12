<?php 
	/*
		- Class C_normal_user use to handle normal user action (not admin action)
		- Inherit class C_main
	*/
	require_once("C_main.php");
	class C_normal_user extends C_main{


		public function welcome() {


			/*
				- Check isset session = true -> show page welcome layout 
			*/
			if (isset($_SESSION['userid'])) { 
				$id = $_SESSION['userid'];
				$title = 'Welcome';
				$path = 'views/welcome.php';

				$user_info = $this->M_normal_user->welcome($id);
				

				require_once("template/layout.php");

			}
			
		}

		public function logout()
		{
			/*
				- Destroy session with id = userid
				- Direct to index.php
			*/
			unset($_SESSION['userid']);
			header('location:index.php');
		}	


	}

?>