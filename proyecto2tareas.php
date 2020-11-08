<?php
// Abro el fichero y con un explode la variable $tareas creo una lista dividiendo cada línea por ; el primer elemento que sería [0] es para el id
// y el segundo el elemento que sería [1] es para la tarea
$tareas = $_POST['nuevatarea'];
$a = fopen("pendientes.txt","a+b");
$tareas = explode(";", $tareas);
// Creo 2 variables auxiliares
$c = 0;
$j = 0;
// Este if sirve para si viene el id vacío(tareas[0])
if($tareas[0] == false){
    $maximo = $contador = 0;
    // En este while compruebo cual es el id más alto.
    while($b = fgets($a)){
        $tarea = explode(";", $b);
        if($contador == 0){
            $maximo = $tarea[0];
        }
        if($tarea[0] > $maximo){
            $maximo = $tarea[0];
        }
        $contador++;
    }
    // Aquí compruebo que si estoy en la primera vuelta del while y tanto máximo como $contador son igual a 0 significa que el archivo está vacío
    if(($maximo == 0) && ($contador == 0)){
        $nuevatarea = $maximo . ";" . $tareas[1];
        $c = 1;
        // Escribo en el fichero la tarea con el id 0
        fwrite($a, $nuevatarea . "\n");
        fclose($a);
    }else{
        $nuevatarea = $maximo+1 . ";" . $tareas[1];
        // Escribo en el fichero la tarea con el id maximo que hemos obtenido del id más alto +1
        fwrite($a, $nuevatarea . "\n");
        fclose($a);
    }
//En caso de que el usuario haya ingresado un id entramos en este else
}else{
    
    $contador = $maximo = 0;
    // En este while compruebo cual es el id más alto.
    while($b = fgets($a)){  
        $tarea = explode(";", $b);
        if($contador == 0){
            $maximo = $tarea[0];
        }
        if($tarea[0] > $maximo){
            $maximo = $tarea[0];
        }
        $contador++;       
    }
    // Aquí compruebo que el id que ha ingresado el usuario (tareas[0]) es igual al id de alguna tarea que hayamos encontrado en el fichero
    if($tarea[0] == $tareas[0] && $j == 0){
        echo "Cuidado que este id ya existe.";
        $j = 1;
    }
    // Aquí compruebo que el id que ha ingresado el usuario no sea superior a un número en el que pueda haber un hueco entre el id máximo del fichero y el que ha ingresado en usuario, por ejemplo usuario ingresa 13
    // y en el fichero existe 11, como hay un hyeco que es el 12 pues saltaría este if
    if($tareas[0] > $maximo+1 && $c == 0 && $j == 0){
        echo "Hay un hueco entre las ids";
        $c = 1;
    }
// En el caso de que no haya slatado ninguno de los 2 anteriores ifs escribo dentro del fichero la nueva tarea que ha ingresado el usuario
    if($j == 0 && $c == 0){
        $nuevatarea = $tareas[0] . ";" . $tareas[1];
        fwrite($a, $nuevatarea . "\n");
    }
    fclose($a);  
}
