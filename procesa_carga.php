<?php
/* Database Configuration */
require_once "config/config-sample.php";
/* Functions */
require_once "util/funciones.php";
//print_r($_POST);

$tra= new Trabajo();
$tra->cargar_img(); 
?>
