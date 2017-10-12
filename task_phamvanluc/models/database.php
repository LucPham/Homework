<?php  

    /*
        - Class database model, use pdo statement
        - Host = localhost
        - Dbname = nashtech (option)
        - User = 'root'
        - Pass = ''
    */
	class database {
		protected $pdo='';
    	protected $sql='';
    	protected $stateMent='';

    	public function database() {
    		try {
    			$this->pdo = new PDO('mysql:host=localhost; dbname=nashtech', 'root','');
    			$this->pdo->query('set names utf8');
    			$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    		} catch (PDOException $e) {
    			print "Error!: " . $e->getMessage() . "<br/>";
            	die();
    		}
    	}
    	


	}

?>