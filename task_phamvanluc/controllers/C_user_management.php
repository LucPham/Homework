<?php

	/*
		- Class C_user_management use to handle admin user action (not normal user action)
		- Inherit class C_main
		- In this class, using to add new user, also delete user, update information user 
	*/
	session_start();
	require_once("C_main.php");
	class C_user_management extends C_main {




		public function add_user() {
			
			/*
				- Check isset session, else load page 404 errors
			*/
			if (isset($_SESSION['userid'])) {
				/*
					- Check whether or not is admin user 
					- Else load page 404 errors 
				*/
				if ($this->M_user_management->check_admin($_SESSION['userid']) == true) {

				$title = 'Add user';
				$path = 'views/V_add_user.php';

				if (isset($_POST['add-btn'])) {
					$username = $_POST['username'];
					$email = $_POST['email'];
					$password = $_POST['password'];
					$hintpassword = $_POST['hint_password'];
					if (isset($_POST['auth']))
						$auth = $_POST['auth'];
					

					//echo $hintpassword;
					if (!empty($username)) {
					if (!empty($email)) {
					if (!empty($password)) {
					if (!empty($hintpassword)) {
					if ($auth != '') {
					if (preg_match("/[^\da-zA-Z]/", $password) == 0) {
					if (strcmp($password, $hintpassword) == 0) {

					/*
						- Check email input is exist or not
					*/
					if ($this->M_user_management->check_email($email) == false) {


						$dataInsert['username'] = $username;
						$dataInsert['email'] = $email;
						$dataInsert['password'] = password_hash($password, PASSWORD_DEFAULT);
						$dataInsert['hintpassword'] = password_hash($hintpassword, PASSWORD_DEFAULT);
						$dataInsert['admin'] = $auth;
						/*
							Add user to database action
						*/
						if ($this->M_user_management->add_user($dataInsert)) {


							
							$message = 'Hello '.$username.', we send your account information to sign website: username: '.$username.', password: '.$password.', email: '.$email;
							$mFrom = 'phamvanluc0595@gmail.com';
							$mPass = 'phamluc99';
							$nTo = $email;
							$title = 'YOUR ACCOUNT INFORMATION';
							if ($this->sendEmail($message,$mFrom,$mPass,$nTo,$title)) {
								$data['success'] = 'Insert success';
							} else $data_err['email_err'] = 'Send email fail';
							//sendEmail($message,$mFrom,$mPass,$nTo,$title)

						} else echo 'Fail';

					} else $data_err['email_err'] = 'This email is exist';
					} else $data_err['strcmp_err'] = 'Password is different hint password!';
					} else $data_err['password_err'] = 'Password only hold word and digit!';
					} else $data_err['auth_err'] = 'Please check authorize';
					} else $data_err['hintpassword_err'] = 'Please enter password again!';
					} else $data_err['password_err'] = 'Please enter a password!';
					} else $data_err['email_err'] = 'Please enter your email!';
					} else $data_err['username_err'] = 'Please enter a username!';

				}

				require_once("template/layout.php");
			} else require_once("template/404_errors/index.php");
			} else require_once("template/404_errors/index.php");

		}



		public function checkLenPW($string) {
			if (strlen($string) < 8) {
				return "Password must least 8 characters!";
			} elseif (strlen($string) > 50) {
				return "Password too long!";
			}
			return true;
		}

		public function index() {

			$title = 'User management - DE - NashTech';
			$path = 'views/V_index.php';

			if (isset($_POST['sign-in-btn'])) { // isset submit

				$email = $_POST['email'];
				$password = $_POST['password'];

				if (!empty($email)) {
				if (!empty($password)) {
				if ($this->M_user_management->check_email($email) == true) { // check email exist

					$hashPW = $this->M_user_management->get_pw($email);	// get pw by email
					if (password_verify($password, $hashPW['password'])) { // check pw & pw hash
							
						$_SESSION['userid'] = $hashPW['id'];
						header('location:user.php?p=welcome');

					} else $data_err['password_err'] = 'Information not exactly';

				} else $data_err['email_err'] = 'Not fount this email';
				} else $data_err['password_err'] = 'Enter a password';
				} else $data_err['email_err'] = 'Please enter your email';

			}

			require_once("template/layout.php");
		}


		public function sendEmail($message,$mFrom,$mPass,$nTo,$title)
		{
			$nFrom = "PL-Part 1";    //mail duoc gui tu dau, thuong de ten cong ty ban
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->CharSet  = "utf-8";
			$mail->SMTPDebug  = 0;
			$mail->SMTPAuth   = true;    // enable SMTP authentication
		    $mail->SMTPSecure = "ssl";   // sets the prefix to the servier
		    $mail->Host       = "smtp.gmail.com";    // sever gui mail.
		    $mail->Port       = 465;         // cong gui mail de nguyen
		    // xong phan cau hinh bat dau phan gui mail
		    $mail->Username   = $mFrom;  // khai bao dia chi email
		    $mail->Password   = $mPass;              // khai bao mat khau
		    $mail->SetFrom($mFrom, $nFrom);
		    //$mail->AddReplyTo('account@123nam.com', '123nam.com'); //khi nguoi dung phan hoi se duoc gui den email nay
		    $mail->Subject    = $title;// tieu de email 
		    $mail->MsgHTML($message);// noi dung chinh cua mail se nam o day.
		    $mail->AddAddress($nTo);
			if(!$mail->Send()) {
		      return 0;
		    } else {
		       return 1;
		    }
		}
	}

?>