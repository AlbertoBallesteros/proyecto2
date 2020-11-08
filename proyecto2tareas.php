<?php
$tareas = $_POST['nuevatarea'];
$a = fopen("pendientes.txt","a+b");
$tareas = explode(";", $tareas);
$c = 0;
$j = 0;

if($tareas[0] == false){
    $maximo = $contador = 0;
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
    if(($maximo == 0) && ($contador == 0)){
        $nuevatarea = $maximo . ";" . $tareas[1];
        $c = 1;
        // fwrite ($a, PHP_EOL);
        fwrite($a, $nuevatarea . "\n");
        fclose($a);
    }else{
        $nuevatarea = $maximo+1 . ";" . $tareas[1];
        // fwrite ($a, PHP_EOL);
        fwrite($a, $nuevatarea . "\n");
        fclose($a);
    }
  
}else{
    
    $contador = $maximo = 0;
    
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
    if($tarea[0] == $tareas[0] && $j == 0){
        echo "Cuidado que este id ya existe.";
        $j = 1;
    }
    if($tareas[0] > $maximo+1 && $c == 0 && $j == 0){
        echo "Hay un hueco entre las ids";
        $c = 1;
    }

    if($j == 0 && $c == 0){
        $nuevatarea = $tareas[0] . ";" . $tareas[1];
        fwrite($a, $nuevatarea . "\n");
    }
    fclose($a);  
}
