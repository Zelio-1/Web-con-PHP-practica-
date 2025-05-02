<?php

// Crear la conexion a la base de datos
$db_host = "localhost";
$db_username = "appUser";
$db_password = "<.OA&qa1=34_\a@#1QL_%kñP()$09894e7t";
$db_database = "app";

$db = new mysqli ($db_host, $db_username, $db_password, $db_database);

mysqli_query($db, "SET NAMES 'utf8'");

if($db -> connect_errno > 0){
    die('No es posible conectarse a la base de datos ['.$db -> connect_error.']');
}