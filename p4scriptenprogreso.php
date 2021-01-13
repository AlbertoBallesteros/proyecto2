<!DOCTYPE html> 
<html> 
   <head>
        <meta charset = "utf-8">
        <title>Borrar tarea en progreso</title>
   </head> 
   <body>
        <?php
        $id = $_POST['borrartareaenprogreso'];

        $servidor = "localhost"; 
        $user = "root"; 
        $password = null; 
        $database = "tareas"; 

        //conectar 
        $db = new mysqli($servidor,$user, $password,$database); 

        //Comprobamos que la tarea introducida existe y que es una tarea en progreso
        //Preparar: 
        $sentencia = $db->prepare("SELECT `nombre` FROM `tareas` WHERE `id` = '$id' AND `estado` = 'En progreso';");

        //Ejecutar 
        $sentencia->execute(); 

        //Vinculamos las variables a columnas 
        $sentencia->bind_result($nombre);

        //Cerramos conexiones 
        $sentencia->close();

        //Si no existe se acaba aquí, si existe la borro
        if(empty($nombre)){
            echo "Esa tarea no existe o no es una tarea en progreso.";
        }else{
            //Preparar: 
            $sentencia = $db->prepare("DELETE FROM `tareas` WHERE `id` = '$id'");

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
