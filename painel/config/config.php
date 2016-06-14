<?php

define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DBNAME','novajornada');

$dsn = 'mysql:host='.HOST.';dbname='.DBNAME;

try {
	$conn = new PDO($dsn,USER,PASS);
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	return htmlentities("Não foi possível estabelecer conexão com o banco de dados, tente novamente mais tarde! ".$e->getMessage());
}