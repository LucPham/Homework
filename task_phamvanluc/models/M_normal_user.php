<?php 
	/*
       - Class M_normal_user use to connect database when handle normal user data (not administrator)
       - Inherit from class database
    */
	require_once("models/database.php");

	class M_normal_user extends database {


		public function welcome($id) {
			$sql = "SELECT * FROM user where id=".$id;
			$this->stateMent = $this->pdo->prepare($sql);
			$this->stateMent->execute();
			if ($this->stateMent->rowCount() > 0)
				return $this->stateMent->fetch();
			return false;
		} 

	}

?>