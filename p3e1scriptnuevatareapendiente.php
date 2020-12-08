<?php
//Tenía problemas haciendo que escribiese la nueva tarea en una nueva línea, lo solucioné escribiendo todo el fichero de nuevo.
$nuevatarea = $_POST['nuevatareapendiente'];
$fichero = fopen("pendientes.txt","rb");
$ficheroordenado = array();

//Las tareas ya están ordenadas así que sólo las guardo en un array
while($a = fgets($fichero)){
    $tareas = explode(";", $a);
        $ficheroordenado[] = $tareas[0] . ";" . $tareas[1];
}
fclose($fichero);

//Añado la nueva tarea y el id que le corresponde al array
$ficheroordenado[] = $tareas[0]+1 . ";" . $nuevatarea;

//Escribo todas las tareas en el fichero
$a = fopen("pendientes.txt", "w+");
for($i = 0; $i < count($ficheroordenado); $i++){
    fwrite($a, $ficheroordenado[$i] . "\n");
}
fclose($a);

echo "La tarea " . $nuevatarea . " ha sido añadida a las tareas pendientes.";


