<?php
$tarea = $_POST['borrartareaenprogreso'];
$ficheroordenado = array();
$contador = 0;
$z = 0;

$fichero = fopen("enprogreso.txt", "r+b");
//Comparamos el nombre de la tarea introducida con los nombres de las tareas existentes, si coinciden le sumamos +1 a la variable z para saber que se ha introducido una tarea existente y le cambio el id
//a -1 para que no lo meta en el array y así no escribirlo luego en el archivo cuando los reordene. Uso el trim() porque no funcionaba sin él, tomaba un espacio.
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


    echo "La tarea " . $tarea . " ha sido borrada de las tareas en progreso.";
}
