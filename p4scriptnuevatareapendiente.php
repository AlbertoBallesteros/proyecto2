<!DOCTYPE html> 
<html> 
   <head>
        <meta charset = "utf-8">
        <title>Nueva tarea pendiente</title>
   </head> 
   <body>
        <?php
        $nombre = $_POST['nombre'];
        $prioridad = $_POST['prioridad'];
        $fhinicioprevista = $_POST['fhinicioprevista'];
        $fhfinalizacionprevista = $_POST['fhfinalizacionprevista'];
        $descripcion = $_POST['descripcion'];


        $servidor = "localhost"; 
        $user = "root"; 
        $password = null; 
        $database = "tareas"; 

        //conectar 
        $db = new mysqli($servidor,$user, $password,$database); 

        //Preparar: 
        $sentencia = $db->prepare("INSERT INTO `tareas` (`nombre`,`id`,`descripcion`,`estado`,`prioridad`,`fhinicio`,`fhinicioprevista`,
        `fhfinalizacion`,`fhfinalizacionprevista`) VALUES(?,?,?,?,?,?,?,?,?)"); 
        $sentencia->bind_param('sisssssss',$nombre, $id, $descripcion, $estado, $prioridad, $fhinicio, $fhinicioprevista, 
        $fhfinalizacion, $fhfinalizacionprevista); 

        //Establecer parámtros 
        $estado = "Pendiente";

        //Si no introduce prioridad le asigno 0 para pdoer ordenarlas
        if(empty($prioridad)){
            $prioridad = "0";
        }

        //Ejecutar 
        $sentencia->execute(); 

        //Cerramos conexiones 
        $sentencia->close(); 
        $db->close();

        echo "La tarea " . $nombre . " ha sido añadida a las tareas pendientes.";
        ?>

        <form method="post"
        enctype="application/x-wwww-form-urlencoded"
        action="p4.php">
        <div><button type="submit" class="boton">Volver</button></div>
        </form>
    </body>
</html>