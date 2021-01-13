<?php
$servidor = "localhost"; 
$user = "root"; 
$password = null; 
$database = "tareas"; 

//conectar 
$db = new mysqli($servidor,$user, $password,$database); 

//comprobamos la conexion 
if($db->connect_error){ 
die("La conexión con la bd ha fallado, error: " . $db->connect_errno . ": ". $db->connect_error); 
} 
else { 
echo("Conexión a la bd realizada con éxito"); 
} 

//Preparar: 
$sentencia = $db->prepare("INSERT INTO `tareas` (`nombre`,`id`,`descripcion`,`estado`,`prioridad`,`fhinicio`,`fhinicioprevista`,`fhfinalizacion`,`fhfinalizacionprevista`) VALUES ('Tarea A','','AAAAAAAAAA','Pendiente','7','','','',''), 
('Tarea B','','BBBBBBBBBB','Pendiente','2','','','','2021-10-20'), ('Tarea C','','CCCCCCCCCCCC','Pendiente','8','','2021-10-20','','2021-10-23'), 
('Tarea D','','DDDDDDDDDD','Pendiente','5','','2021-10-21','',''), ('Tarea E','','EEEEEEEEEE','Pendiente','1','','2021-10-22','','2021-10-25'), 
('Tarea F','','FFFFFFFFFFF','Pendiente','10','','2020-12-20','','2020-12-31'), ('Tarea G','','GGGGGGGGGGGGGGGG','En progreso','1','2000-12-13','','',''), 
('Tarea H','','HHHHHHHHHHHHH','En progreso','7','2021-10-20','2021-10-20','',''), ('Tarea I','','IIIIIIIIIII','En progreso','4','2021-10-20','2021-10-20','','2021-10-25'), 
('Tarea J','','JJJJJJJJJJJJ','En progreso','2','2021-10-20','','','2021-10-25'), ('Tarea K','','KKKKKKKKKK','En progreso','10','2021-10-20','2021-10-20','','2021-10-25'), 
('Tarea L','','LLLLLLLLLLL','Finalizada','10','2021-10-20','2021-10-20','2021-10-25','2021-10-25'), ('Tarea M','','MMMMMMMMMMM','Finalizada','1','2021-10-20','2021-10-20','2021-10-25',''), 
('Tarea N','','NNNNNNNNNN','Finalizada','4','2021-10-20','','2021-10-25','2021-10-25'), ('Tarea O','','OOOOOOOOOO','Finalizada','3','2021-10-20','','2021-10-25',''), 
('Tarea P','','PPPPPPPPPPP','Finalizada','2','2021-10-20','2021-10-20','2021-10-25','2021-10-25');");

//Ejecutar 
$sentencia->execute(); 

//Cerramos conexiones 
$sentencia->close();
$db->close();