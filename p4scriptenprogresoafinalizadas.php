<!DOCTYPE html> 
<html> 
   <head>
        <meta charset = "utf-8">
        <title>Mover tarea de pendiente a en progreso</title>
   </head> 
   <body>
        <?php
        $id = $_POST['enprogresoafinalizadas'];
        $fecha = $_POST['fechadefinalizacion'];

        $servidor = "localhost"; 
        $user = "root"; 
        $password = null; 
        $database = "tareas"; 

        //conectar 
        $db = new mysqli($servidor,$user, $password,$database); 

        //Comprobamos que la tarea introducida existe
        //Preparar: 
        $sentencia = $db->prepare("SELECT `nombre` FROM `tareas` WHERE `id` = '$id'  AND `estado` = 'En progreso';");

        //Ejecutar 
        $sentencia->execute(); 

        //Vinculamos las variables a columnas 
        $sentencia->bind_result($nombre);

        //Tratamos el cursor 
        $sentencia->fetch();

        //Cerramos conexiones 
        $sentencia->close();


        if(empty($nombre)){
            echo "Esa tarea no existe.";
        }else{
            //Preparar: 
            $sentencia = $db->prepare("UPDATE `tareas` SET `estado` = 'Finalizada' WHERE `id` = $id");

            //Ejecutar 
            $sentencia->execute(); 

            //Cerramos conexiones 
            $sentencia->close(); 

            echo "Se ha pasado la tarea $nombre con id $id de las tareas en proceso a las tareas finalizadas.";
        }
        ?>
        <form method="post"
        enctype="application/x-wwww-form-urlencoded"
        action="p4.php">
        <div><button type="submit" class="boton">Volver</button></div>
        </form>
    </body>
</html>



