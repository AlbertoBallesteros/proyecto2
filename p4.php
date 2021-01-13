<!DOCTYPE html> 
<html> 
   <head>
        <meta charset = "utf-8">
        <link rel="stylesheet" href="css.css">
        <title>Lista de tareas</title>
   </head> 
   <body> 
        <table border=1px class="tablatareaspendientes">
            <thead>
                <tr class="cabecera">
                    <th colspan="6" class="titulo">Lista de tareas pendientes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Id</td>
                    <td>Nombre</td>
                    <td>Prioridad</td>
                    <td>Descripción</td>
                    <td>Fecha de inicio prevista</td>
                    <td>Fecha de finalización prevista</td>
                </tr>
                <tr>
                    <td>
                        <div class="div">
                            <?php 
                            $servidor = "localhost"; 
                            $user = "root"; 
                            $password = null; 
                            $database = "tareas"; 
                            
                            //Uso una sentencia para mostrar las tareas 
                            //Conectar 
                            $db = new mysqli($servidor,$user, $password,$database); 

                            //Hago un select de las columnas que muestro en las tareas pendientes, todas menos la fecha de inicio y de finalización que no 
                            //tendría sentido. Lo hago con order by por el requisito
                            //Preparar: 
                            $sentencia = $db->prepare("SELECT `nombre`, `prioridad`, `descripcion`, `fhinicioprevista`, `fhfinalizacionprevista`,`id` 
                            FROM `tareas` WHERE `estado` = 'Pendiente' ORDER BY `prioridad`"); 

                            //Ejecutar 
                            $sentencia->execute(); 

                            //Vinculamos las variables a columnas 
                            $sentencia->bind_result($nombre, $prioridad, $descripcion, $fhinicioprevista, $fhfinalizacionprevista, $id); 

                            $listanombre = array();
                            $listaprioridad = array();
                            $listadescripcion = array();
                            $listafhinicioprevista = array();
                            $listafhfinalizacionprevista = array();
                            $listaid = array();

                            //Guardo los valores en arrays, uso un while con un contador para que no se mezclen los valores de unas tareas con
                            //los de otras: en el índice 0 de todos los arrays están todos los valores de la misma tarea
                            //Tratamos el cursor 
                            $i = 0;
                            while ($sentencia->fetch()){ 
                                $listanombre[$i] = $nombre;
                                $listaprioridad[$i] = $prioridad;
                                $listadescripcion[$i] = $descripcion;
                                $listafhinicioprevista[$i] = $fhinicioprevista;
                                $listafhfinalizacionprevista[$i] = $fhfinalizacionprevista;
                                $listaid[$i] = $id;
                                $i++;
                            }

                            //Cerramos conexiones 
                            $sentencia->close(); 
                            $db->close();

                            //Muestro el id de la primera tarea, cierro php para cambiar de columna de la tabla en html, muestro el nombre de la primera tarea, etc
                            foreach($listaid as $id){
                                echo $id . "</br>";
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <?php
                            foreach($listanombre as $nombre){
                                echo $nombre . "</br>";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            //Hago una function con un switch para que la prioridad tenga una palabra que defina a cada número y muestre la palabra y el número
                            function prioridad($prioridad){
                                switch ($prioridad) {
                                    case 0:
                                        echo "Aplazable($prioridad)</br>";
                                        break;
                                    case 1:
                                        echo "Prorrogable($prioridad)</br>";
                                        break;
                                    case 2:
                                        echo "Postergable($prioridad)</br>";
                                        break;
                                    case 3:
                                        echo "Procrastinable($prioridad)</br>";
                                        break;
                                    case 4:
                                        echo "Acuciante($prioridad)</br>";
                                        break;
                                    case 5:
                                        echo "Apremiante($prioridad)</br>";
                                        break;
                                    case 6:
                                        echo "Importante($prioridad)</br>";
                                        break;
                                    case 7:
                                        echo "Imperioso($prioridad)</br>";
                                        break;
                                    case 8:
                                        echo "Ineludible($prioridad)</br>";
                                        break;
                                    case 9:
                                        echo "Inexcusable($prioridad)</br>";
                                        break;
                                    case 10:
                                        echo "Inminente($prioridad)</br>";
                                        break;
                                }
                            }
                            foreach($listaprioridad as $prioridad){
                                prioridad($prioridad);
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            //Hago un if para que no se quede un vacío en la tabla si una tarea no tiene descripción
                            foreach($listadescripcion as $descripcion){
                                if($descripcion == ""){
                                    echo "No se introdujo descripción.</br>";
                                }
                                else{
                                    echo $descripcion . "</br>";
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            //Hago un if para que no se vea el 0000-00-00 si una tarea no tiene fecha
                            foreach($listafhinicioprevista as $fhinicioprevista){
                                if($fhinicioprevista == "0000-00-00"){
                                    echo "No se introdujo fecha.</br>";
                                }
                                else{
                                    echo $fhinicioprevista . "</br>";
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($listafhfinalizacionprevista as $fhfinalizacionprevista){
                                if($fhfinalizacionprevista == "0000-00-00"){
                                    echo "No se introdujo fecha.</br>";
                                }
                                else{
                                    echo $fhfinalizacionprevista . "</br>";
                                }
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <!-- Hago un form para cada acción -->
                <tr class="cabecera">
                    <th colspan="6" class="titulo">Introducir nueva tarea pendiente</th>
                </tr>
                <tr>
                    <td colspan="6">
                        <form method="post"
                        enctype="application/x-wwww-form-urlencoded"
                        action="p4scriptnuevatareapendiente.php">
                        <div> <label> Nombre: <input name="nombre" placeholder="Nombre" required> </label></div>
                        <div> <label> Prioridad: <input name="prioridad" placeholder="Prioridad"> </label></div>
                        <div> <label> Descripción: <input name="descripcion" placeholder="Descripción"> </label></div>
                        <div> <label> Fecha de inicio prevista: <input type="date" name="fhinicioprevista"> </label></div>
                        <div> <label> Fecha de finalización prevista: <input type="date" name="fhfinalizacionprevista"> </label></div>
                        <div><button type="submit" class="boton">Enviar</button></div>
                        </form>
                    </td>
                </tr>

                <tr class="cabecera">
                    <th colspan="6" class="titulo">Borrar tarea pendiente</th>
                </tr>
                <tr>
                    <!-- Hago que la tarea se borre con el id porque es más exacto, puede haber varias tareas con el mismo nombre por ejemplo -->
                    <td colspan="6">
                        <form method="post"
                        enctype="application/x-wwww-form-urlencoded"
                        action="p4scriptborrartareapendiente.php">
                        <div> <label> ID de la tarea: <input name="borrartareapendiente" placeholder="ID de la tarea que desea borrar" required> </label></div>
                        <div><button type="submit" class="boton">Enviar</button></div>
                        </form>
                    </td>
                </tr>

                <tr class="cabecera">
                    <th colspan="6" class="titulo">Pasar tarea de pendiente a en progreso</th>
                </tr>
                <tr>
                    <td colspan="6">
                        <!-- Dejo que el usuario elija la fecha de inicio, si lo deja vacío pongo la fecha del día en que pase la tarea de las pendientes a las en progreso -->
                        <form method="post"
                        enctype="application/x-wwww-form-urlencoded"
                        action="p4scriptpendienteaprogreso.php">
                        <div> <label> ID de la tarea: <input name="pendienteaprogreso" placeholder="ID de la tarea que desea mover" required> </label></div>
                        <div> <label> Fecha de inicio: <input type="date" name="fechadeinicio"> </label></div>
                        <div><button type="submit" class="boton">Enviar</button></div>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>

        <table border=1px class="tablatareasenprogreso">
            <thead>
                <tr class="cabecera">
                    <th colspan="6" class="titulo">Tareas en progreso</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Id</td>
                    <td>Nombre</td>
                    <td>Prioridad</td>
                    <td>Descripción</td>
                    <td>Fecha de inicio</td>
                    <td>Fecha de finalización prevista</td>
                </tr>
                <tr>
                    <td>
                        <div class="div">
                            <?php 
                            $servidor = "localhost"; 
                            $user = "root"; 
                            $password = null; 
                            $database = "tareas"; 

                            //conectar 
                            $db = new mysqli($servidor,$user, $password,$database); 

                            //Preparar: 
                            $sentencia = $db->prepare("SELECT `nombre`, `prioridad`, `descripcion`, `fhinicio`, `fhfinalizacionprevista`,`id` 
                            FROM `tareas` WHERE `estado` = 'En progreso' ORDER BY `prioridad`"); 

                            //Ejecutar 
                            $sentencia->execute(); 

                            //Vinculamos las variables a columnas 
                            $sentencia->bind_result($nombre, $prioridad, $descripcion, $fhinicio, $fhfinalizacionprevista, $id); 

                            $listanombre = array();
                            $listaprioridad = array();
                            $listadescripcion = array();
                            $listafhinicio = array();
                            $listafhfinalizacionprevista = array();
                            $listaid = array();

                            //Tratamos el cursor 
                            $i = 0;
                            while ($sentencia->fetch()){ 
                                $listanombre[$i] = $nombre;
                                $listaprioridad[$i] = $prioridad;
                                $listadescripcion[$i] = $descripcion;
                                $listafhfinalizacionprevista[$i] = $fhfinalizacionprevista;
                                $listaid[$i] = $id;
                                $listafhinicio[$i] = $fhinicio;
                                $i++;
                            }

                            //Cerramos conexiones 
                            $sentencia->close(); 
                            $db->close();

                            foreach($listaid as $id){
                                echo $id . "</br>";
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <?php
                            foreach($listanombre as $nombre){
                                echo $nombre . "</br>";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($listaprioridad as $prioridad){
                                prioridad($prioridad);
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($listadescripcion as $descripcion){
                                if($descripcion == ""){
                                    echo "No se introdujo descripción.</br>";
                                }
                                else{
                                    echo $descripcion . "</br>";
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($listafhinicio as $fhinicio){
                                if($fhinicio == "0000-00-00"){
                                    echo "No se introdujo fecha.</br>";
                                }
                                else{
                                    echo $fhinicio . "</br>";
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($listafhfinalizacionprevista as $fhfinalizacionprevista){
                                if($fhfinalizacionprevista == "0000-00-00"){
                                    echo "No se introdujo fecha.</br>";
                                }
                                else{
                                    echo $fhfinalizacionprevista . "</br>";
                                }
                            }
                        ?>
                    </td>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr class="cabecera">
                    <th colspan="6" class="titulo">Borrar tarea en progreso</th>
                </tr>
                <tr>
                    <td colspan="6">
                        <form method="post"
                        enctype="application/x-wwww-form-urlencoded"
                        action="p4scriptenprogreso.php">
                        <div> <label> ID de la tarea: <input name="borrartareaenprogreso" placeholder="Tarea" required> </label></div>
                        <div><button type="submit" class="boton">Enviar</button></div>
                        </form>
                    </td>
                </tr>

                <tr class="cabecera">
                    <th colspan="6" class="titulo">Pasar tarea de en progreso a finalizada</th>
                </tr>
                <tr>
                    <td colspan="6">
                        <form method="post"
                        enctype="application/x-wwww-form-urlencoded"
                        action="p4scriptenprogresoafinalizadas.php">
                        <div> <label> ID de la tarea: <input name="enprogresoafinalizadas" placeholder="ID de la tarea finalizada" required> </label></div>
                        <div> <label> Fecha de finalización: <input type="date" name="fechadefinalizacion"> </label></div>
                        <div><button type="submit" class="boton">Enviar</button></div>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>

        <table border=1px class="tablatareasfinalizadas">
            <thead>
                <tr class="cabecera">
                    <th colspan="6" class="titulo">Tareas finalizadas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Id</td>
                    <td>Nombre</td>
                    <td>Descripción</td>
                    <td>Fecha de inicio</td>
                    <td>Fecha de finalización</td>
                </tr>
                <tr>
                    <td>
                        <div class="div">
                            <?php 
                            $servidor = "localhost"; 
                            $user = "root"; 
                            $password = null; 
                            $database = "tareas"; 
                            
                            //conectar 
                            $db = new mysqli($servidor,$user, $password,$database); 
                            
        
                            //Preparar: 
                            $sentencia = $db->prepare("SELECT `nombre`, `descripcion`, `fhinicio`, `fhfinalizacion`,`id` 
                            FROM `tareas` WHERE `estado` = 'Finalizada' ORDER BY `nombre`"); 

                            //Ejecutar 
                            $sentencia->execute(); 

                            //Vinculamos las variables a columnas 
                            $sentencia->bind_result($nombre, $descripcion, $$fhinicio, $fhfinalizacion, $id); 

                            $listanombre = array();
                            $listadescripcion = array();
                            $listafhinicio = array();
                            $listafhfinalizacion = array();
                            $listaid = array();

                            //Tratamos el cursor 
                            $i = 0;
                            while ($sentencia->fetch()){ 
                                $listanombre[$i] = $nombre;
                                $listadescripcion[$i] = $descripcion;
                                $listafhinicio[$i] = $fhinicio;
                                $listafhfinalizacion[$i] = $fhfinalizacion;
                                $listaid[$i] = $id;
                                $i++;
                            }

                            //Cerramos conexiones 
                            $sentencia->close(); 
                            $db->close();

                            foreach($listaid as $id){
                                echo $id . "</br>";
                            }
                            ?>
                        </div>
                    </td>
                    <td>
                        <?php
                            foreach($listanombre as $nombre){
                                echo $nombre . "</br>";
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($listadescripcion as $descripcion){
                                if($descripcion == ""){
                                    echo "No se introdujo descripción.</br>";
                                }
                                else{
                                    echo $descripcion . "</br>";
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($listafhinicio as $fhinicio){
                                if($fhinicio == "0000-00-00"){
                                    echo "No se introdujo fecha.</br>";
                                }
                                else{
                                    echo $fhinicio . "</br>";
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            foreach($listafhfinalizacion as $fhfinalizacion){
                                if($fhfinalizacion == "0000-00-00"){
                                    echo "No se introdujo fecha.</br>";
                                }
                                else{
                                    echo $fhfinalizacion . "</br>";
                                }
                            }
                        ?>
                    </td>
                </tr>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
   </body> 
</html>