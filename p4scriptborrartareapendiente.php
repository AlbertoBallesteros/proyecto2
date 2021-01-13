<!DOCTYPE html> 
<html> 
   <head>
        <meta charset = "utf-8">
        <title>Borrar tarea</title>
   </head> 
   <body>
        <?php
        $id = $_POST['borrartareapendiente'];

        $servidor = "localhost"; 
        $user = "root"; 
        $password = null; 
        $database = "tareas"; 

        //conectar 
        $db = new mysqli($servidor,$user, $password,$database); 

        //Comprobamos que la tarea introducida existe y que es una tarea pendiente
        //Preparar: 
        $sentencia = $db->prepare("SELECT `nombre` FROM `tareas` WHERE `id` = '$id' AND `estado` = 'Pendiente';");

        //Ejecutar 
        $sentencia->execute(); 

        //Vinculamos las variables a columnas 
        $sentencia->bind_result($nombre);

        //Tratamos el cursor 
        $sentencia->fetch();

        //Cerramos conexiones 
        $sentencia->close();

        if(empty($nombre)){
            echo "Esa tarea no existe o no es una tarea pendiente.";
        }else{
            //Preparar: 
            $sentencia = $db->prepare("DELETE FROM `tareas` WHERE `id` = '$id' AND `estado` = 'Pendiente'");

            //Ejecutar 
            $sentencia->execute(); 

            //Cerramos conexiones 
            $sentencia->close(); 
            $db->close();

            echo "Se ha borrado la tarea $nombre con id $id.";
        }
        ?>

        <form method="post"
        enctype="application/x-wwww-form-urlencoded"
        action="p4.php">
        <div><button type="submit" class="boton">Volver</button></div>
        </form>
    </body>
</html>
