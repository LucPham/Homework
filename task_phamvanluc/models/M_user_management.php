<?php 
	/*
       - Class M_user_management use to connect database when handle admin user data (not normal user)
       - Inherit from class database
    */
	require_once("models/database.php");

	class M_user_management extends database {

		public function getData()
		{
			$this->stateMent= $this->pdo->prepare("SELECT * FROM user");
			$this->stateMent->execute();
			return $this->stateMent->fetchAll(PDO::FETCH_ASSOC);
		}
		public function add_user($data) 
		{
			$sql = "INSERT INTO `user`(`username`, `email`, `password`,`hintpassword`, `admin`) VALUES (?,?,?,?,?)";
			$this->stateMent = $this->pdo->prepare($sql);
			$this->stateMent->execute(array($data['username'], $data['email'], $data['password'], $data['hintpassword'], $data['admin']));
			return $this->pdo->lastInsertId();
		}
		public function check_email($email) {
			$this->stateMent = $this->pdo->prepare("SELECT email FROM user WHERE email='".$email."'");
			$this->stateMent->execute();
			if ($this->stateMent->rowCount() > 0) 
				return true;
			return false;
		}
		public function check_admin($id) {
			$this->stateMent = $this->pdo->prepare("SELECT id FROM user WHERE id=".$id." and admin = 1");
			$this->stateMent->execute();
			if ($this->stateMent->rowCount() > 0) 
				return true;
			return false;
		}
		public function get_pw($email) {
			$this->stateMent = $this->pdo->prepare("SELECT id,email,password FROM user WHERE email='".$email."'");
			$this->stateMent->execute();
			if ($this->stateMent->rowCount() > 0) 
				return $this->stateMent->fetch();
			return false;
		}
	}
?>