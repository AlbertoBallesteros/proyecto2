<?php
$tarea = $_POST['enprogresoafinalizadas'];
$ficheroordenado = array();
$contador = 0;
$z = 0;
$pos = strpos($tarea, ";");
//Si el cliente ha introducido el id, el ";" y la tarea entramos en el if, si sólo ha introducido la tarea entramos en el else
if($pos){
    //Como ha introducido el id y la tarea hacemos explode para separarlos
    $tareaamover = explode(";", $tarea);
    $fichero = fopen("enprogreso.txt", "r+b");
    //Comparamos el nombre de la tarea introducida con los nombres de las tareas existentes, si coinciden le sumamos +1 a la variable z para saber que se ha introducido una tarea existente y le cambio el id
    //a -1 para que no lo meta en el array y así no escribirlo luego en el archivo cuando los reordene. Uso el trim() porque no funcionaba sin él, tomaba un espacio.
    while($a = fgets($fichero)){
            $tareas = explode(";", $a);
            if(trim($tareas[1]) == $tareaamover[1]){
                $tareas[0] = -1;
                $z++;
                $contador++;
            }
            if(($tareas[0] == $contador) && ($z == 0)){
                $ficheroordenado[] = $tareas[0] . ";" . $tareas[1];
                $contador++;
            }elseif($tareas[0] == $contador){
                $tareas[0] = $contador-1;
                $ficheroordenado[] = $tareas[0] . ";" . $tareas[1];
                $contador++;
            }
    }
    fclose($fichero);

    //Si no le hemos sumado 1 a z es porque la tarea no existe y aquí termina el script.
    if($z == 0){
        echo "Esa tarea no existe.";
    //Si la tarea existe abrimos el archivo, escribimos las tareas ordenadas con el array
    }else{
        $a = fopen("enprogreso.txt", "w+");
        for($i = 0; $i < count($ficheroordenado); $i++){
            fwrite($a, $ficheroordenado[$i]);
        }
        fclose($a);

        //Aquí escribimos la tarea que hay que pasar a las tareas en progreso en el fichero
        $fichero = fopen("finalizadas.txt","a+b");
        while($a = fgets($fichero)){
            $tareas = explode(";", $a);
            $id = $tareas[0];
        }
        fwrite($fichero, $id+1 . ";" . $tareaamover[1] . "\n");
        fclose($fichero);

        echo "La tarea " . $tareaamover[1] . " ha pasado de las tareas en progreso a las tareas finalizadas.";
    }
}else{
    $fichero = fopen("enprogreso.txt", "r+b");
        while($a = fgets($fichero)){
            $tareas = explode(";", $a);
            if(trim($tareas[1]) == $tarea){
                $tareas[0] = -1;
                $z++;
                $contador++;
            }
            if(($tareas[0] == $contador) && ($z == 0)){
                $ficheroordenado[] = $tareas[0] . ";" . $tareas[1];
                $contador++;
            }elseif($tareas[0] == $contador){
                $tareas[0] = $contador-1;
                $ficheroordenado[] = $tareas[0] . ";" . $tareas[1];
                $contador++;
            }
        }
    fclose($fichero);

    if($z == 0){
        echo "Esa tarea no existe.";
        //Si la tarea existe abrimos el archivo, escribimos las tareas ordenadas con el array
    }else{
        $a = fopen("enprogreso.txt", "w+");
        for($i = 0; $i < count($ficheroordenado); $i++){
            fwrite($a, $ficheroordenado[$i]);
        }
        fclose($a);

        //Aquí escribimos la tarea que hay que pasar a las tareas finalizadas en el fichero
        $fichero = fopen("finalizadas.txt","a+b");
        while($a = fgets($fichero)){
            $tareas = explode(";", $a);
            $id = $tareas[0];
        }
        fwrite($fichero, $id+1 . ";" . $tarea . "\n");
        fclose($fichero);

        echo "La tarea " . $tarea . " ha pasado de las tareas en progreso a las tareas finalizadas.";
    }
}
