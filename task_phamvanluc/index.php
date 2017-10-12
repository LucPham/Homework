<?php 
	/*
		- Run as home page, locahost://task_phamvanluc/index.php
	*/
	require_once("controllers/C_user_management.php");

	$user = new C_user_management;

	$user->index();
	
?>