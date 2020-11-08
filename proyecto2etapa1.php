<!DOCTYPE html> 
<html> 
   <head>
        <meta charset = "utf-8">
        <title>Lista de tareas</title>
   </head> 
   <body> 
    <table border=1px>
        <tr>
            <th>Tareas pendientes</th>
            <th>Tareas en progreso</th>
            <th>Tareas finalizadas</th>
        </tr>
        <tr>
            <td>
                <?php /*Abro el archivo de texto con el fopen, con el while repito, mientras queden tareas, el mostrar una tarea con el fgets y el echo y hacer un salto de línea con el br , lo cierro con el fclose */
                $fichero = fopen("pendientes.txt","rb");
                $contador = 0;
                while($a = fgets($fichero)){
                $tareas = explode(";", $a);
                $id = $tareas[0];
                
                    if($id == $contador){
                        echo $id;
                        echo $tareas[1];
                        echo "<br>";
                        $contador++;   
                        fseek($fichero, 0);  
                    }

                }
                fclose($fichero); 
                ?>
            </td>
            <td>
                <?php /*Abro el archivo de texto con el fopen, con el while repito, mientras queden tareas, el mostrar una tarea con el fgets y el echo y hacer un salto de línea con el br , lo cierro con el fclose */
                $fichero = fopen("enprogreso.txt","rb");
                while($tarea = fgets($fichero)){
                echo $tarea;
                echo "<br>";
                }
                fclose($fichero); 
                ?>
            </td>
            <td>
                <?php /*Abro el archivo de texto con el fopen, con el while repito, mientras queden tareas, el mostrar una tarea con el fgets y el echo y hacer un salto de línea con el br , lo cierro con el fclose */
                $fichero = fopen("finalizadas.txt","rb");
                while($tarea = fgets($fichero)){
                echo $tarea;
                echo "<br>";
                }
                fclose($fichero); 
               ?>
            </td>

        </tr>
        <tfoot>
        </tfoot>
    </table>
   </body> 
</html> 