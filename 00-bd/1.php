<?php
$servidor = "localhost"; 
$user = "root"; 
$password = null; 
// $database = "dawpruebas"; 

//conectar 
$db = new mysqli($servidor,$user, $password); 

//comprobamos la conexion 
if($db->connect_error){ 
die("La conexión con la bd ha fallado, error: " . $db->connect_errno . ": ". $db->connect_error); 
} 
else { 
echo("Conexión a la bd realizada con éxito"); 
} 

//Preparar: 
$sentencia = $db->prepare("Create database `tareas`");

//Ejecutar 
$sentencia->execute(); 

//Cerramos conexiones 
$sentencia->close();

//Ahora creamos la tabla
//Preparar: 
$sentencia = $db->prepare("CREATE TABLE `tareas`.`tareas`(
    `nombre` VARCHAR(40)
    ,`id` TINYINT(4) PRIMARY KEY AUTO_INCREMENT
    ,`descripcion` VARCHAR(300)
    ,`estado` VARCHAR(11)
    ,`prioridad` TINYINT(2)
    ,`fhinicio` DATE
    ,`fhinicioprevista` DATE 
    ,`fhfinalizacion` DATE 
    ,`fhfinalizacionprevista` DATE
    );
    ");

//Ejecutar 
$sentencia->execute(); 

//Cerramos conexiones 
$sentencia->close();
$db->close();




