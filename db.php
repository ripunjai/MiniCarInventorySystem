<?php
	//database credentials
	define('DBHOST','localhost');
	define('DBUSER','root');
	define('DBPASS','');
	define('DBNAME','car-inventory-system');


	//application address
	define('DIR','http://localhost/MiniCarInventorySystem/');
	// define('DIR', 'http://winkk.in/');

	try {
		$conn = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

	include_once 'connect.php';
	$connection = new Connect($conn);
?>