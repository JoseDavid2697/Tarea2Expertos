<?php

class TareaController
{
    public function __construct()
    {
        $this->view = new View();
    } //constructor

    //metodo para cambiar vista
    public function cambiarVista()
    {
        $vista = $_GET['nombreVista'];
        $this->view->show($vista);
    }


    //Estilo de aprendizaje
    public function obtenerDatosEstiloAprendizaje()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        //Valores capturados en el form
        $c1 = $_POST['c1'];$c2 = $_POST['c2'];$c3 = $_POST['c3'];$c4 = $_POST['c4'];$c5 = $_POST['c5'];$c6 = $_POST['c6'];
        $c7 = $_POST['c7'];$c8 = $_POST['c8'];$c9 = $_POST['c9'];$c10 = $_POST['c10'];$c11 = $_POST['c11'];$c12 = $_POST['c12'];
        $c13 = $_POST['c13'];$c14 = $_POST['c14'];$c15 = $_POST['c15'];$c16 = $_POST['c16'];$c17 = $_POST['c17'];$c18 = $_POST['c18'];
        $c19 = $_POST['c19'];$c20 = $_POST['c20'];$c21 = $_POST['c21'];$c22 = $_POST['c22'];$c23 = $_POST['c23'];$c24 = $_POST['c24'];
        $c25 = $_POST['c25'];$c26 = $_POST['c26'];$c27 = $_POST['c27'];$c28 = $_POST['c28'];$c29 = $_POST['c29'];$c30 = $_POST['c30'];
        $c31 = $_POST['c31'];$c32 = $_POST['c32'];$c33 = $_POST['c33'];$c34 = $_POST['c34'];$c35 = $_POST['c35'];$c36 = $_POST['c36'];

        //Definicion de las 4 variables basado en el algoritmo del sitio http://multi.ucr.ac.cr/estilo.htm
        $ec = (int) $c5 + (int) $c9 + (int) $c13 + (int) $c17 + (int) $c25 + (int) $c29;
        $or = (int) $c2 + (int) $c10 + (int) $c22 + (int) $c26 + (int) $c30 + (int) $c34;
        $ca = (int) $c7 + (int) $c11 + (int) $c15 +  (int) $c19 + (int) $c31 + (int) $c35;
        $ea = (int) $c4 + (int) $c12 + (int) $c24 + (int) $c28 + (int) $c32 + (int) $c36;

        //Definicion de los vectores
        $vector_usuario['ca'] = $ca;
        $vector_usuario['ec'] = $ec;
        $vector_usuario['ea'] = $ea;
        $vector_usuario['or'] = $or;

        //Se obtienen los datos de la base de datos

        $data = $tarea->obtenerDatosEstilo();

        //Se asignan los valores de la base a un vector con las mismas columnas que el vector usuario
        $i = 0;
        foreach ($data as $row) {
            $vector_bd[$i]['ca'] = (int) $data[$i]['ca'];
            $vector_bd[$i]['ec'] = (int) $data[$i]['ec'];
            $vector_bd[$i]['ea'] = (int) $data[$i]['ea'];
            $vector_bd[$i]['or'] = (int) $data[$i]['or'];
            $vector_bd[$i]['estilo'] = $data[$i]['estilo'];
            $i = $i + 1;
        }

        $resultado = $this->distancia($vector_usuario, $vector_bd);
        
        $estilo_aprendizaje = $vector_bd[$resultado[1]]['estilo'];

        $this->view->show("indexview.php",$estilo_aprendizaje);

    }//fin obtenerDatosEstiloAprendizaje


    //Adivinar recinto
    public function obtenerDatosAdivinarRecinto(){
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        //Datos de usuario
        $estilo = $_POST['estilo'];
        $promedio = (float)$_POST['promedio'];
        $sexo = $_POST['sexo'];

        //Mapeado de valores strings
        /*
            "M" = 1, "F" = 2, "DIVERGENTE"=3,"CONVERGENTE=4","ASIMILADOR=5","ACOMODADOR=6"
        */
        //vector del usuario
        (strcmp($sexo,"M") == 0) ?  $vector_usuario['sexo'] = 1 : $vector_usuario['sexo'] = 2;
        if((strcmp($estilo,"DIVERGENTE") == 0)){

            $vector_usuario['estilo'] = 3;

        }elseif((strcmp($estilo,"CONVERGENTE") == 0)){

            $vector_usuario['estilo'] = 4;

        }elseif((strcmp($estilo,"ASIMILADOR") == 0)){

            $vector_usuario['estilo'] = 5;
            
        }else{
            $vector_usuario['estilo'] = 6;
        }  
        $vector_usuario['promedio'] = $promedio;

        //Obtiene los datos de la base de datos
        $data = $tarea->obtenerDatosRecinto();
        //Se asignan enteros a los valores con letras segun el mapeado
        $i = 0;
        foreach ($data as $row) {
            (strcmp($data[$i]['sexo'],"M") == 0) ?  $vector_bd[$i]['sexo'] = 1 : $vector_bd[$i]['sexo'] = 2;

            if((strcmp($data[$i]['estilo'],"DIVERGENTE") == 0)){
                $vector_bd[$i]['estilo'] = 3;
            }elseif((strcmp($data[$i]['estilo'],"CONVERGENTE") == 0)){
                $vector_bd[$i]['estilo'] = 4;
            }elseif((strcmp($data[$i]['estilo'],"ASIMILADOR") == 0)){
                $vector_bd[$i]['estilo'] = 5;
            }else{
                $vector_bd[$i]['estilo'] = 6;
            }  

            $promedio_bd = floatval($data[$i]['promedio']);
            //var_dump($promedio_bd);

            $vector_bd[$i]['promedio'] = $promedio_bd;
            $vector_bd[$i]['recinto'] = $data[$i]['recinto'];

            $i = $i + 1;
        }
        
        $resultado = $this->distancia($vector_usuario,$vector_bd);
        
        $recinto_estudiante = $vector_bd[$resultado[1]]['recinto'];

        $this->view->show("adivinarRecintoView.php",$recinto_estudiante);

    }

    public function obtenerDatosAdivinarSexo(){
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        //Mapeado de valores strings
        /*
            "Turrialba" = 1, "Paraiso" = 2, "DIVERGENTE"=3,"CONVERGENTE=4","ASIMILADOR=5","ACOMODADOR=6"
        */

        //Datos del usuario
        $estilo = $_POST['estilo'];
        $promedio = (float)$_POST['promedio'];
        $recinto = $_POST['recinto'];

        //vector del usuario
        (strcmp($recinto,"Turrialba") == 0) ?  $vector_usuario['recinto'] = 1 : $vector_usuario['recinto'] = 2;
        if((strcmp($estilo,"DIVERGENTE") == 0)){

            $vector_usuario['estilo'] = 3;

        }elseif((strcmp($estilo,"CONVERGENTE") == 0)){

            $vector_usuario['estilo'] = 4;

        }elseif((strcmp($estilo,"ASIMILADOR") == 0)){

            $vector_usuario['estilo'] = 5;
            
        }else{
            $vector_usuario['estilo'] = 6;
        }  
        $vector_usuario['promedio'] = $promedio;

        //Obtiene los datos de la base de datos
        $data = $tarea->obtenerDatosSexo();
        //Se asignan enteros a los valores con letras segun el mapeado  
        $i = 0;
        foreach ($data as $row) {
            (strcmp($data[$i]['recinto'],"Turrialba") == 0) ?  $vector_bd[$i]['recinto'] = 1 : $vector_bd[$i]['recinto'] = 2;

            if((strcmp($data[$i]['estilo'],"DIVERGENTE") == 0)){
                $vector_bd[$i]['estilo'] = 3;
            }elseif((strcmp($data[$i]['estilo'],"CONVERGENTE") == 0)){
                $vector_bd[$i]['estilo'] = 4;
            }elseif((strcmp($data[$i]['estilo'],"ASIMILADOR") == 0)){
                $vector_bd[$i]['estilo'] = 5;
            }else{
                $vector_bd[$i]['estilo'] = 6;
            }  

            $promedio_bd = floatval($data[$i]['promedio']);
            

            $vector_bd[$i]['promedio'] = $promedio_bd;
            $vector_bd[$i]['sexo'] = $data[$i]['sexo'];

            $i = $i + 1;
        }
        
        $resultado = $this->distancia($vector_usuario,$vector_bd);
        
        $sexo_estudiante = $vector_bd[$resultado[1]]['sexo'];

        $this->view->show("adivinarSexoView.php",$sexo_estudiante);
        
    }


    public function obtenerDatosAprendizajeEstudiante(){
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        //Mapeado de valores strings
        /*
            "Turrialba" = 1, "Paraiso" = 2, "M" = 1, "F" = 2
        */

        //Datos del usuario
        $recinto = $_POST['recinto'];
        $promedio = (float)$_POST['promedio'];
        $sexo = $_POST['sexo'];

        //vector del usuario
        (strcmp($recinto,"Turrialba") == 0) ?  $vector_usuario['recinto'] = 1 : $vector_usuario['recinto'] = 2;
        $vector_usuario['promedio'] = $promedio;
        (strcmp($sexo,"M") == 0) ?  $vector_usuario['sexo'] = 1 : $vector_usuario['sexo'] = 2;

        //Obtiene los datos de la base de datos
        $data = $tarea->obtenerDatosEstudiante();
        //Se asignan enteros a los valores con letras segun el mapeado
        $i = 0;
        foreach ($data as $row) {
            (strcmp($data[$i]['recinto'],"Turrialba") == 0) ?  $vector_bd[$i]['recinto'] = 1 : $vector_bd[$i]['recinto'] = 2;
            $promedio_bd = floatval($data[$i]['promedio']);
            $vector_bd[$i]['promedio'] = $promedio_bd;
            (strcmp($data[$i]['sexo'],"M") == 0) ?  $vector_bd[$i]['sexo'] = 1 : $vector_bd[$i]['sexo'] = 2;
            $vector_bd[$i]['estilo'] = $data[$i]['estilo'];
            $i = $i + 1;
        }
        
        $resultado = $this->distancia($vector_usuario,$vector_bd);
        

        $estilo_estudiante = $vector_bd[$resultado[1]]['estilo'];

        $this->view->show("estiloEstudianteView.php",$estilo_estudiante);
        
    }

    public function obtenerDatosTipoProfesor(){
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        //Datos del usuario
        $a = $_POST['A'];
        $b = $_POST['B'];
        $c = $_POST['C'];
        $d = $_POST['D'];
        $e = $_POST['E'];
        $f = $_POST['F'];
        $g = $_POST['G'];
        $h = $_POST['H'];

        //A
        $vector_usuario['a'] = $a;

        //Mapeo de datos
       /*
        B: M=1  F=2  NA=3
        C: B=1  I=2  A=3
        E: DM=1 ND=2 O=3
        F: L=1 A=2   H=3
        G: N=1 S=2  O=3
        H: N=1 S=2  O=3
       */

        //B
        switch ($b) {
            case "M":
                $vector_usuario['b'] = 1;
                break;
            case "F":
                $vector_usuario['b'] = 2;
                break;
            case "NA":
                $vector_usuario['b'] = 3;
                break;
            default:
                echo "Tipo de dato no valido en usuario b";
        }

        //C
        switch ($c) {
            case "B":
                $vector_usuario['c'] = 1;
                break;
            case "I":
                $vector_usuario['c'] = 2;
                break;
            case "A":
                $vector_usuario['c'] = 3;
                break;
            default:
                echo "Tipo de dato no valido";
        }

        //D
        $vector_usuario['d'] = $d;

        //E
        switch ($e) {
            case "DM":
                $vector_usuario['e'] = 1;
                break;
            case "ND":
                $vector_usuario['e'] = 2;
                break;
            case "O":
                $vector_usuario['e'] = 3;
                break;
            default:
                echo "Tipo de dato no valido";
        }

        //F
        switch ($f) {
            case "L":
                $vector_usuario['f'] = 1;
                break;
            case "A":
                $vector_usuario['f'] = 2;
                break;
            case "H":
                $vector_usuario['f'] = 3;
                break;
            default:
                echo "Tipo de dato no valido";
        }

        //G
        switch ($g) {
            case "N":
                $vector_usuario['g'] = 1;
                break;
            case "S":
                $vector_usuario['g'] = 2;
                break;
            case "O":
                $vector_usuario['g'] = 3;
                break;
            default:
                echo "Tipo de dato no valido";
        }

        //H
        switch ($h) {
            case "N":
                $vector_usuario['h'] = 1;
                break;
            case "S":
                $vector_usuario['h'] = 2;
                break;
            case "O":
                $vector_usuario['h'] = 3;
                break;
            default:
                echo "Tipo de dato no valido";
        }

        //Obtiene los datos de la base de datos
        $data = $tarea->obtenerDatosProfesor();

        //Se pasan las letras de la bd a enteros igual que el vector usuario
        $i = 0;
        foreach ($data as $row) {
            //A
            $vector_bd[$i]['a'] = (int) $data[$i]['a'];

            //B
            switch ((string)$data[$i]['b']) {
                case "M":
                    $vector_bd[$i]['b'] = 1;
                    break;
                case "F":
                    $vector_bd[$i]['b'] = 2;
                    break;
                case "NA":
                    $vector_bd[$i]['b'] = 3;
                    break;
                default:
                    echo "";
            }

            //C
            switch ($data[$i]['c']) {
                case "B":
                    $vector_bd[$i]['c'] = 1;
                    break;
                case "I":
                    $vector_bd[$i]['c'] = 2;
                    break;
                case "A":
                    $vector_bd[$i]['c'] = 3;
                    break;
                default:
                    echo "Tipo de dato no valido";
            }
            
            //D
            $vector_bd[$i]['d'] = $data[$i]['d'];

            //E
            switch ($data[$i]['e']) {
                case "DM":
                    $vector_bd[$i]['e'] = 1;
                    break;
                case "ND":
                    $vector_bd[$i]['e'] = 2;
                    break;
                case "O":
                    $vector_bd[$i]['e'] = 3;
                    break;
                default:
                    echo "Tipo de dato no valido";
            }

            //F
            switch ($data[$i]['f']) {
                case "L":
                    $vector_bd[$i]['f'] = 1;
                    break;
                case "A":
                    $vector_bd[$i]['f'] = 2;
                    break;
                case "H":
                    $vector_bd[$i]['f'] = 3;
                    break;
                default:
                    echo "Tipo de dato no valido";
            }

            //G
            switch ($data[$i]['g']) {
                case "N":
                    $vector_bd[$i]['g'] = 1;
                    break;
                case "S":
                    $vector_bd[$i]['g'] = 2;
                    break;
                case "O":
                    $vector_bd[$i]['g'] = 3;
                    break;
                default:
                    echo "Tipo de dato no valido";
            }

            //H
            switch ($data[$i]['h']) {
                case "N":
                    $vector_bd[$i]['h'] = 1;
                    break;
                case "S":
                    $vector_bd[$i]['h'] = 2;
                    break;
                case "O":
                    $vector_bd[$i]['h'] = 3;
                    break;
                default:
                    echo "Tipo de dato no valido";
            }

            $vector_bd[$i]['class'] = $data[$i]['class'];         
            $i = $i + 1;
        }//foreach
        
        //Obtiene los datos de la base de datos
        $resultado = $this->distancia($vector_usuario,$vector_bd);

        $tipo_prof = $vector_bd[$resultado[1]]['class'];

        $this->view->show("tipoProfesorView.php",$tipo_prof);
 
    }



    public function obtenerDatosRedes(){
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        //Datos del usuario
        $re = $_POST['Re'];
        $li = $_POST['Li'];
        $ca = $_POST['Ca'];
        $co = $_POST['Co'];

        //Mapeo de datos
        //Low=1, Medium=2, High=3

        $vector_usuario['re'] = (int)$re;
        $vector_usuario['li'] = (int)$li;

        //Ca
        switch ($ca) {
            case "Low":
                $vector_usuario['ca'] = 1;
                break;
            case "Medium":
                $vector_usuario['ca'] = 2;
                break;
            case "High":
                $vector_usuario['ca'] = 3;
                break;
            default:
                echo "Tipo de dato no valido";
        }

        //Co
        switch ($co) {
            case "Low":
                $vector_usuario['co'] = 1;
                break;
            case "Medium":
                $vector_usuario['co'] = 2;
                break;
            case "High":
                $vector_usuario['co'] = 3;
                break;
            default:
                echo "Tipo de dato no valido";
        }

        //Obtiene los datos de la base de datos
        $data = $tarea->obtenerDatosRedes();

        //Se asignan los valores de las letras como enteros para poder restar
        $i = 0;
        foreach ($data as $row) {
            $vector_bd[$i]['re'] = (int) $data[$i]['re'];
            $vector_bd[$i]['li'] = (int) $data[$i]['li'];
            //Ca
            switch ((string)$data[$i]['ca']) {
                case "Low":
                    $vector_bd[$i]['ca'] = 1;
                    break;
                case "Medium":
                    $vector_bd[$i]['ca'] = 2;
                    break;
                case "High":
                    $vector_bd[$i]['ca'] = 3;
                    break;
                default:
                    echo "Tipo de dato no valido";
            }

            //Co
            switch ((string)$data[$i]['co']) {
                case "Low":
                    $vector_bd[$i]['co'] = 1;
                    break;
                case "Medium":
                    $vector_bd[$i]['co'] = 2;
                    break;
                case "High":
                    $vector_bd[$i]['co'] = 3;
                    break;
                default:
                    echo "Tipo de dato no valido";
            }

            $vector_bd[$i]['class'] = $data[$i]['class'];
            $i = $i + 1;
        }

        //Se saca las distancia de ambos vectores para mostrar el resultado
        $resultado = $this->distancia($vector_usuario,$vector_bd);

        $tipo_red = $vector_bd[$resultado[1]]['class'];

        $this->view->show("tipoRedesView.php",$tipo_red);
        
    }

    /*---------------------------*/   
   /* *ALGORITMO DE DISTANCIA* */
  /*-------------------------*/

    /*  distancia($vector_usuario, $vector_data)
    *   Algoritmo para el cálculo de la distancia euclidiana
    *   input: $vector_usuario=contiene los datos ingresados por el usuario en el website
    *          $vector_data=contiene los registros de la base de datos, con los que se compararán los datos del usuario
    *   output: un arreglo con dos valores, el primero es el valor más cercano a 0 despues de aplicar la formula
    *           el segundo el indice de la base de datos que contiene el dato por calcular, ejemplo estilo,sexo,etc.
    */

    public function distancia($vector_usuario, $vector_data)
    {

        //Define el tuplas obtenidas de la base de datos
        $num_filas = count($vector_data);
        
        //Datos a comparar(por ejemplo: CA,EC,EA,OR en el caso de estilo de aprendizaje)
        $columnas = array_keys($vector_usuario);
        
        
        //Define el numero de columnas que posee la tabla(mismo numero de datos ingresados por el usuario)
        $num_columnas = count($columnas);

        /*La primer sumatoria se define como el resultado menor,
        se aplica la formula de distancia con el vector del usuario
        y la primera tupla*/
        $primer_sumatoria = 0;
        
        for($x=0; $x<$num_columnas;$x++){   
            //Se hace la sumatoria de cada diferencia de columnas elevadas al cuadrado
            //(p1-q1)^2+(p2-q2)^2
            $primer_sumatoria += pow(($vector_data[0][$columnas[($x)]] - $vector_usuario[$columnas[($x)]]),2);
        }
        //Obtiene la raiz cuadrada de la sumatoria resultante de la diferencia de cada columna
        // √(p1-q1)^2+(p2-q2)^2
        $menor = sqrt($primer_sumatoria);
        $index_valor = 0;

        //Se recorren las tuplas restantes y se aplica la formula de distancia con el vector del usuario y cada tupla
        $sumatoria = 0;
        for ($i = 1; $i <= $num_filas-1; $i++) {

            for($j=1; $j<=$num_columnas;$j++){   
                //Se hace la sumatoria de cada diferencia de columnas elevadas al cuadrado
                //(p1-q1)^2+(p2-q2)^2
                $sumatoria += pow(($vector_data[$i][$columnas[$j-1]] - $vector_usuario[$columnas[$j-1]]),2);
                
            }
            //Obtiene la raiz cuadrada de la sumatoria resultante de la diferencia de cada columna
            // √(p1-q1)^2+(p2-q2)^2
            $tmp = sqrt($sumatoria);

            $sumatoria = 0; 

            //Si el nuevo calculo es menor al anterior entonces se establece el nuevo valor para la menor distancia
            //Asimismo se guarda el numero de tupla donde esta el resultado que estamos buscando
            if($tmp < $menor){
                
                $menor = $tmp;
                $index_valor = $i;
            }

        }//for i

        return array($menor,$index_valor);

    }//fin distancia



}//fin de clase
