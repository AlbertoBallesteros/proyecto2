<!DOCTYPE html> 
<html> 
   <head>
        <meta charset = "utf-8">
        <title>Mover tarea de pendiente a en progreso</title>
   </head> 
   <body>
        <?php
        $id = $_POST['pendienteaprogreso'];
        $fecha = $_POST['fechadeinicio'];

        $servidor = "localhost"; 
        $user = "root"; 
        $password = null; 
        $database = "tareas"; 

        //conectar 
        $db = new mysqli($servidor,$user, $password,$database); 

        //Comprobamos que la tarea introducida existe y que es una tarea pendiente
        //Preparar: 
        $sentencia = $db->prepare("SELECT `nombre` FROM `tareas` WHERE `id` = $id AND `estado` = 'Pendiente';");

        //Ejecutar 
        $sentencia->execute();

        //Vinculamos las variables a columnas 
        $sentencia->bind_result($nombre);

        //Tratamos el cursor 
        $sentencia->fetch();

        //Cerramos conexiones 
        $sentencia->close();

        //Si no existe se acaba aquí
        if(empty($nombre)){
            echo "Esa tarea no existe o no es una tarea pendiente.";
        }
        else{
            //Si el usuario no ha introducido fecha establezco el día en que pase la tarea de estar pendiente a en progreso como la fecha de inicio
            if(empty($fecha)){
                //Preparar: 
                $sentencia = $db->prepare("UPDATE `tareas` SET `estado` = 'En progreso', `fhinicio` = current_date WHERE `id` = $id;");

                //Ejecutar 
                $sentencia->execute(); 

                //Cerramos conexiones 
                $sentencia->close(); 

                echo "Se ha movido la tarea $nombre con id $id de las tareas pendientes a las tareas en progreso y se ha establecido el día de hoy como la fecha de inicio.";
            }
            else{
                //Preparar: 
                $sentencia = $db->prepare("UPDATE `tareas` SET `estado` = 'En progreso', `fhinicio` = '$fecha' WHERE `id` = $id;");

                //Ejecutar 
                $sentencia->execute(); 

                //Cerramos conexiones 
                $sentencia->close(); 

                echo "Se ha movido la tarea $nombre con id $id de las tareas pendientes a las tareas en progreso.";
            }
        }
        ?>

        <form method="post"
        enctype="application/x-wwww-form-urlencoded"
        action="p4.php">
        <div><button type="submit" class="boton">Volver</button></div>
        </form>
    </body>
</html>