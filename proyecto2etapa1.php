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
                /*Recorro todas las líneas del fichero con el while, en la variable $tareas creo una lista dividiendo cada línea por ; el primer elemento que sería [0] es para el id
                y el segundo el elemento que sería [1] es para la tarea*/
                while($a = fgets($fichero)){
                $tareas = explode(";", $a);
                $id = $tareas[0];
                /*En este if estoy comprobando que el id que leo en el documento sea igual que la variable $contador, cuando ambos son 0 muestro en el html el primer elemtno que sería el 0,
                y así consecutivamente par amostrarlos todos ordenados*/
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
                $fichero2 = fopen("enprogreso.txt","rb");
                $contador = 0;
                /*Recorro todas las líneas del fichero con el while, en la variable $tareas creo una lista dividiendo cada línea por ; el primer elemento que sería [0] es para el id
                y el segundo el elemento que sería [1] es para la tarea*/
                while($a2 = fgets($fichero2)){
                    $tareas = explode(";", $a2);
                    $id = $tareas[0];
                    /*En este if estoy comprobando que el id que leo en el documento sea igual que la variable $contador, cuando ambos son 0 muestro en el html el primer elemtno que sería el 0,
                    y así consecutivamente par amostrarlos todos ordenados*/
                        if($id == $contador){
                            echo $id;
                            echo $tareas[1];
                            echo "<br>";
                            $contador++;   
                            fseek($fichero2, 0);  
                        }
    
                    }
                    fclose($fichero2); 
                ?>
            </td>
            <td>
                <?php /*Abro el archivo de texto con el fopen, con el while repito, mientras queden tareas, el mostrar una tarea con el fgets y el echo y hacer un salto de línea con el br , lo cierro con el fclose */
                $fichero3 = fopen("finalizadas.txt","rb");
                $contador = 0;
                /*Recorro todas las líneas del fichero con el while, en la variable $tareas creo una lista dividiendo cada línea por ; el primer elemento que sería [0] es para el id
                y el segundo el elemento que sería [1] es para la tarea*/
                while($a3 = fgets($fichero3)){
                    $tareas = explode(";", $a3);
                    $id = $tareas[0];
                    /*En este if estoy comprobando que el id que leo en el documento sea igual que la variable $contador, cuando ambos son 0 muestro en el html el primer elemtno que sería el 0,
                    y así consecutivamente par amostrarlos todos ordenados*/
                        if($id == $contador){
                            echo $id;
                            echo $tareas[1];
                            echo "<br>";
                            $contador++;   
                            fseek($fichero3, 0);  
                        }
    
                    }
                    fclose($fichero3);
               ?>
            </td>

        </tr>
        <tfoot>
        </tfoot>
    </table>
   </body> 
</html> 