<?php
	//untuk kebutuhan reset password
	//define('DIR','http://ppdb.smk4.mahadhika.sch.id/');
	//define('SITEEMAIL','noreply@mahadhika.sch.id');
	//include('phpmailer/mail.php');
	
	//local
	/*
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password="root"; // Mysql password 
	$db_name="ppdbm3"; // Database name
	*/

	//online 
	$host="localhost"; // Host name 
	$username="mmc-mhd"; // Mysql username 
	$password="Karehol*7$$"; // Mysql password 
	$db_name="binadharma_raport"; // Database name
	// Connect to server and select databse.
	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$db = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset=utf8', $username, $password);
	}
	catch(Exception $e)
	{
		die('Error : ' . $e->getMessage());
	}
	$db->exec('SET FOREIGN_KEY_CHECKS = 0');
	
	date_default_timezone_set('Asia/Jakarta');
	
?>
