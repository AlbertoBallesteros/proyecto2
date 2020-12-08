<!DOCTYPE html> 
<html> 
   <head>
        <meta charset = "utf-8">
        <link rel="stylesheet" href="css.css">
        <title>Lista de tareas</title>
   </head> 
   <body> 
    <table border=1px>
        <tr>
            <th>Tareas pendientes</th>
        </tr>
        <tr>
            <td>
                <div>
                    <?php 
                    //Abro los ficheros, los leo, ordeno las tareas, las guardo en arrays y reescribo el fichero ordenado.
                    $fichero = fopen("pendientes.txt","rb");
                    $contador = 0;
                    $ordenarfichero = array();

                    /*Recorro todas las líneas del fichero con el while, en la variable $tareas creo una lista dividiendo cada línea con ";", el primer elemento que sería [0] es para el id
                    y el segundo el elemento que sería [1] es para la tarea*/
                    while($a = fgets($fichero)){
                        $tareas = explode(";", $a);
                        $id = $tareas[0];
                    //Con este if voy guardando las tareas en el array por orden de id. He usado el trim() porque si no me daba problemas.
                        if($id == $contador){
                            $ordenarfichero[] = $id . ";" . trim($tareas[1]);
                            $contador++;   
                            fseek($fichero, 0);  
                        }
                    }
                    fclose($fichero);

                    //Aquí reescribo el fichero en orden
                    $fichero = fopen("pendientes.txt","w+");
                    for($i = 0; $i < $contador; $i++){
                        fwrite($fichero, $ordenarfichero[$i]  . "\n");
                    }
                    fclose($fichero); 

                    //Aquí muestro en pantalla el fichero
                    $fichero = fopen("pendientes.txt","rb");
                    while($a = fgets($fichero)){
                        echo $a . "</br>";
                    }
                    fclose($fichero);
                    ?>
                    
                    <!--Creo un form para cada una de las acciones.-->
                    <form method="post"
                    enctype="application/x-wwww-form-urlencoded"
                    action="p3e1scriptnuevatareapendiente.php">
                    <div> <label> Nueva tarea: <input name="nuevatareapendiente" placeholder="Tarea"> </label></div>
                    <div><button type="submit" class="boton">Enviar</button></div>
                    </form>

                    <form method="post"
                    enctype="application/x-wwww-form-urlencoded"
                    action="p3e1scriptborrartareapendiente.php">
                    <div> <label> Borrar tarea: <input name="borrartareapendiente" placeholder="Tarea"> </label></div>
                    <div><button type="submit" class="boton">Enviar</button></div>
                    </form>
                </div>
            </td>
        </tr>
        <tfoot>
        </tfoot>
    </table>

    <table border=1px>
        <tr>
            <th>Tareas en progreso</th>
        </tr>
        <tr>
            <td>
                <div>
                        <?php 
                        //Abro los ficheros, los leo, ordeno las tareas, las guardo en arrays y reescribo el fichero ordenado.
                        $fichero = fopen("enprogreso.txt","rb");
                        $contador = 0;
                        $ordenarfichero = array();

                        /*Recorro todas las líneas del fichero con el while, en la variable $tareas creo una lista dividiendo cada línea con ";", el primer elemento que sería [0] es para el id
                        y el segundo el elemento que sería [1] es para la tarea*/
                        while($a = fgets($fichero)){
                            $tareas = explode(";", $a);
                            $id = $tareas[0];
                        //Con este if voy guardando las tareas en el array por orden de id. He usado el trim() porque si no me daba problemas.
                            if($id == $contador){
                                $ordenarfichero[] = $id . ";" . trim($tareas[1]);
                                $contador++;   
                                fseek($fichero, 0);  
                            }
                        }
                        fclose($fichero);

                        //Aquí reescribo el fichero en orden
                        $fichero = fopen("enprogreso.txt","w+");
                        for($i = 0; $i < $contador; $i++){
                            fwrite($fichero, $ordenarfichero[$i] . "\n");
                        }
                        fclose($fichero);

                        //Aquí muestro en pantalla el fichero
                        $fichero = fopen("enprogreso.txt","rb");
                        while($a = fgets($fichero)){
                            echo $a . "</br>";
                        }
                        fclose($fichero);
                        ?>

                        <form method="post"
                        enctype="application/x-wwww-form-urlencoded"
                        action="p3e1scriptenprogreso.php">
                        <div> <label> Borrar tarea: <input name="borrartareaenprogreso" placeholder="Tarea"> </label></div>
                        <div><button type="submit" class="boton">Enviar</button></div>
                        </form>

                </div>
            </td>
        </tr>
        <tfoot>
        </tfoot>
    </table>

    <table border=1px>
        <tr>
            <th>Tareas finalizadas</th>
        </tr>
        <tr>
            <td>
                <div>
                    <?php 
                        //Abro los ficheros, los leo, ordeno las tareas, las guardo en arrays y reescribo el fichero ordenado.
                        $fichero = fopen("finalizadas.txt","rb");
                        $contador = 0;
                        $ordenarfichero = array();
                        /*Recorro todas las líneas del fichero con el while, en la variable $tareas creo una lista dividiendo cada línea con ";", el primer elemento que sería [0] es para el id
                        y el segundo el elemento que sería [1] es para la tarea*/
                        while($a = fgets($fichero)){
                            $tareas = explode(";", $a);
                            $id = $tareas[0];
                        //Con este if voy guardando las tareas en el array por orden de id. He usado el trim() porque si no me daba problemas.
                            if($id == $contador){
                                $ordenarfichero[] = $id . ";" . trim($tareas[1]);
                                $contador++;   
                                fseek($fichero, 0);  
                            }
                        }
                        fclose($fichero);

                        //Aquí reescribo el fichero en orden
                        $fichero = fopen("finalizadas.txt","w+b");
                        for($i = 0; $i < $contador; $i++){
                            fwrite($fichero, $ordenarfichero[$i] . "\n");
                        }
                        fclose($fichero);
                        
                        //Aquí muestro en pantalla el fichero
                        $fichero = fopen("finalizadas.txt","rb");
                        while($a = fgets($fichero)){
                            echo $a . "</br>";
                        }
                        fclose($fichero);
                        ?>
                </div>
            </td>

        </tr>
        <tfoot>
        </tfoot>
    </table>
   </body> 
</html>