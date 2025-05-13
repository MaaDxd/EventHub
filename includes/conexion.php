<?php
// Conexión
$servidor = 'localhost';
$usuario = 'root';
$password = '';
$basededatos = 'blog';
$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db, "SET NAMES 'utf8'");//saca se esta haciendo una query y set names es setear los resultados de la base de datos a un utf8 asi q las Ñ van a entrar sin problemas

// Iniciar la sesión
if(!isset($_SESSION)){
	session_start();
}