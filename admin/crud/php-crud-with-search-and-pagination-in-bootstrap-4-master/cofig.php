<?php

define('DB_NAME', 'linkemac_database');
define('DB_USER', 'linkemac_mohammadreza');
define('DB_PASSWORD', 'pyax}nO-[nYW');
define('DB_HOST', 'localhost');

$dsn	= 	"mysql:dbname=".DB_NAME.";host=".DB_HOST."";
$pdo	=	"";
try {
	$pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
}catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
$db 	=	new Database($pdo);
$pages	=	new Paginator();
?>