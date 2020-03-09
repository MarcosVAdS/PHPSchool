<?php
# seta o PHP.INI
ini_set("default_charset", "UTF-8");
ini_set("date.timezone", "America/Belem");
ini_set("display_errors", true);

# define os parametros de conexão com o banco de dados
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "p@\$\$w0rd");
define("DB_DB", "argosbd");

# define a chave privada para Json Web Token - JWT
define("PRIVATE_KEY", "chavePrivadaParaJsonWebTokenDisqueDenuncia");

# carrega classe MYSQLi
require_once "class/database.php";

# carrega Json Web Token
require_once "class/jwt.php";

# carrega Json Web Token
require_once "class/utf8_convert.php";


function sanitize($string, $replace="") {
	$string = iconv( "UTF-8" , "ASCII//TRANSLIT//IGNORE" , $string );
	$string = preg_replace( "/[^A-Za-z0-9\-\.\ ]/" , $replace, $string );
	return $string;
}

?>