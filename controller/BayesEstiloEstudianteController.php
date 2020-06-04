<?php

class BayesEstiloEstudianteController
{
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } //construct


    /* 
        Se encarga de obtener la data de estudiante y trabajarla para guardar las probabilidades en un nuevo archivo,
        para luego solo consultar las probabilidades en el mismo, y no volver a calcular
    */
    public function datosEstudiante()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $vector_bd = $tarea->obtenerDatosEstudiante();

        //Se ordenan los datos correspondientes a cada columna y se guardan en un array para mayor facilidad de iterar
        $index = 0;
        foreach ($vector_bd as $row) {
            $data[$index]["recinto"] = $row["recinto"];
            $data[$index]["promedio"] = $row["promedio"];
            $data[$index]["sexo"] = $row["sexo"];
            $data[$index]["estilo"] = $row["estilo"];

            $index++;
        }

        //Llama al algoritmo de bayes para estilo estudiante y guarda las probabilidades en un archivo

        $this->guardarProbabilidadesEstiloEstudiante($data);
    }

    public function guardarProbabilidadesEstiloEstudiante($data)
    {
        //Se obtiene el valor de cada caracteristica **** numero de opciones por caracteristica
        $recinto = 2;
        $promedio = 4;
        $sexo = 2;

        //Se obtiene el valor de m al contar el numero de columnas o caracteristicas y restando la que corresponde a estilo
        $m = count($data[0]) - 1;

        //Se saca la probabilidad para cada caracteristica (p)
        $pRecinto = 1 / $recinto;
        $pSexo = 1 / $sexo;
        $pPromedio = 1 / $promedio;


        //Numero de apariciones de cada estilo en los datos
        $n["acomodador"] = 0;
        $n["divergente"] = 0;
        $n["asimilador"] = 0;
        $n["convergente"] = 0;

        foreach ($data as $item) {
            if ($item["estilo"] == "ACOMODADOR") {
                $n["acomodador"] = $n["acomodador"] + 1;
            } elseif ($item["estilo"] == "DIVERGENTE") {
                $n["divergente"] = $n["divergente"] + 1;
            } elseif ($item["estilo"] == "ASIMILADOR") {
                $n["asimilador"] = $n["asimilador"] + 1;
            } else {
                $n["convergente"] = $n["convergente"] + 1;
            }
        }

        //Redondeo de los promedios a cantidades enteras para no trabajar con decimales
        $i = 0;
        foreach ($data as $item) {
            $data[$i]["promedio"] = round($item["promedio"]);
            $i++;
        }

        /*
        Se obtiene el numero de instancias [nc] donde nc sera una matriz,
        donde la primera casilla es el dato (sexo,promedio,recinto) y la segunda
        el estilo asociado a ese dato (asimilador,convergente,divergente,acomodador)
        */

        //Cantidades para recinto por cada estilo de aprendizaje
        $nc["recintoTurrialba"]["DIVERGENTE"] = 0;
        $nc["recintoTurrialba"]["CONVERGENTE"] = 0;
        $nc["recintoTurrialba"]["ASIMILADOR"] = 0;
        $nc["recintoTurrialba"]["ACOMODADOR"] = 0;

        $nc["recintoParaiso"]["DIVERGENTE"] = 0;
        $nc["recintoParaiso"]["CONVERGENTE"] = 0;
        $nc["recintoParaiso"]["ASIMILADOR"] = 0;
        $nc["recintoParaiso"]["ACOMODADOR"] = 0;

        //Cantidades para promedio por cada estilo de aprendizaje
        $nc["promedio6"]["DIVERGENTE"] = 0;
        $nc["promedio6"]["CONVERGENTE"] = 0;
        $nc["promedio6"]["ASIMILADOR"] = 0;
        $nc["promedio6"]["ACOMODADOR"] = 0;

        $nc["promedio7"]["DIVERGENTE"] = 0;
        $nc["promedio7"]["CONVERGENTE"] = 0;
        $nc["promedio7"]["ASIMILADOR"] = 0;
        $nc["promedio7"]["ACOMODADOR"] = 0;

        $nc["promedio8"]["DIVERGENTE"] = 0;
        $nc["promedio8"]["CONVERGENTE"] = 0;
        $nc["promedio8"]["ASIMILADOR"] = 0;
        $nc["promedio8"]["ACOMODADOR"] = 0;

        $nc["promedio9"]["DIVERGENTE"] = 0;
        $nc["promedio9"]["CONVERGENTE"] = 0;
        $nc["promedio9"]["ASIMILADOR"] = 0;
        $nc["promedio9"]["ACOMODADOR"] = 0;

        //Cantidades para sexo por cada estilo 
        $nc["sexoM"]["DIVERGENTE"] = 0;
        $nc["sexoM"]["CONVERGENTE"] = 0;
        $nc["sexoM"]["ASIMILADOR"] = 0;
        $nc["sexoM"]["ACOMODADOR"] = 0;

        $nc["sexoF"]["DIVERGENTE"] = 0;
        $nc["sexoF"]["CONVERGENTE"] = 0;
        $nc["sexoF"]["ASIMILADOR"] = 0;
        $nc["sexoF"]["ACOMODADOR"] = 0;



        //Obtiene el numero de apariciones de cada caracteristica para cada estilo de estudiante

        foreach ($data as $item) {

            //Estilo diver,asim,acom,conver con recinto turrialba o paraiso
            if ($item["estilo"] == "DIVERGENTE" && $item["recinto"] == "Turrialba") {

                $nc["recintoTurrialba"]["DIVERGENTE"]++;
            } elseif ($item["estilo"] == "CONVERGENTE" && $item["recinto"] == "Turrialba") {

                $nc["recintoTurrialba"]["CONVERGENTE"]++;
            } elseif ($item["estilo"] == "ASIMILADOR" && $item["recinto"] == "Turrialba") {

                $nc["recintoTurrialba"]["ASIMILADOR"]++;
            } elseif ($item["estilo"] == "ACOMODADOR" && $item["recinto"] == "Turrialba") {

                $nc["recintoTurrialba"]["ACOMODADOR"]++;
            }

            if ($item["estilo"] == "DIVERGENTE" && $item["recinto"] == "Paraiso") {

                $nc["recintoParaiso"]["DIVERGENTE"]++;
            } elseif ($item["estilo"] == "CONVERGENTE" && $item["recinto"] == "Paraiso") {

                $nc["recintoParaiso"]["CONVERGENTE"]++;
            } elseif ($item["estilo"] == "ASIMILADOR" && $item["recinto"] == "Paraiso") {

                $nc["recintoParaiso"]["ASIMILADOR"]++;
            } elseif ($item["estilo"] == "ACOMODADOR" && $item["recinto"] == "Paraiso") {

                $nc["recintoParaiso"]["ACOMODADOR"]++;
            }

            //Estilo diver,asim,acom,conver con promedio 6,7,8,9
            if ($item["estilo"] == "DIVERGENTE" && $item["promedio"] == 6) {

                $nc["promedio6"]["DIVERGENTE"]++;
            } elseif ($item["estilo"] == "CONVERGENTE" && $item["promedio"] == 6) {

                $nc["promedio6"]["CONVERGENTE"]++;
            } elseif ($item["estilo"] == "ASIMILADOR" && $item["promedio"] == 6) {

                $nc["promedio6"]["ASIMILADOR"]++;
            } elseif ($item["estilo"] == "ACOMODADOR" && $item["promedio"] == 6) {

                $nc["promedio6"]["ACOMODADOR"]++;
            }

            //7
            if ($item["estilo"] == "DIVERGENTE" && $item["promedio"] == 7) {

                $nc["promedio7"]["DIVERGENTE"]++;
            } elseif ($item["estilo"] == "CONVERGENTE" && $item["promedio"] == 7) {

                $nc["promedio7"]["CONVERGENTE"]++;
            } elseif ($item["estilo"] == "ASIMILADOR" && $item["promedio"] == 7) {

                $nc["promedio7"]["ASIMILADOR"]++;
            } elseif ($item["estilo"] == "ACOMODADOR" && $item["promedio"] == 7) {

                $nc["promedio7"]["ACOMODADOR"]++;
            }

            //8
            if ($item["estilo"] == "DIVERGENTE" && $item["promedio"] == 8) {

                $nc["promedio8"]["DIVERGENTE"]++;
            } elseif ($item["estilo"] == "CONVERGENTE" && $item["promedio"] == 8) {

                $nc["promedio8"]["CONVERGENTE"]++;
            } elseif ($item["estilo"] == "ASIMILADOR" && $item["promedio"] == 8) {

                $nc["promedio8"]["ASIMILADOR"]++;
            } elseif ($item["estilo"] == "ACOMODADOR" && $item["promedio"] == 8) {

                $nc["promedio8"]["ACOMODADOR"]++;
            }

            //9
            if ($item["estilo"] == "DIVERGENTE" && $item["promedio"] == 9) {

                $nc["promedio9"]["DIVERGENTE"]++;
            } elseif ($item["estilo"] == "CONVERGENTE" && $item["promedio"] == 9) {

                $nc["promedio9"]["CONVERGENTE"]++;
            } elseif ($item["estilo"] == "ASIMILADOR" && $item["promedio"] == 9) {

                $nc["promedio9"]["ASIMILADOR"]++;
            } elseif ($item["estilo"] == "ACOMODADOR" && $item["promedio"] == 9) {

                $nc["promedio9"]["ACOMODADOR"]++;
            }

            //Cantidades para cada estilo con sexo F o M
            //M
            if ($item["estilo"] == "DIVERGENTE" && $item["sexo"] == "M") {

                $nc["sexoM"]["DIVERGENTE"]++;
            } elseif ($item["estilo"] == "CONVERGENTE" && $item["sexo"] == "M") {

                $nc["sexoM"]["CONVERGENTE"]++;
            } elseif ($item["estilo"] == "ASIMILADOR" && $item["sexo"] == "M") {

                $nc["sexoM"]["ASIMILADOR"]++;
            } elseif ($item["estilo"] == "ACOMODADOR" && $item["sexo"] == "M") {

                $nc["sexoM"]["ACOMODADOR"]++;
            }

            //F
            if ($item["estilo"] == "DIVERGENTE" && $item["sexo"] == "F") {

                $nc["sexoF"]["DIVERGENTE"]++;
            } elseif ($item["estilo"] == "CONVERGENTE" && $item["sexo"] == "F") {

                $nc["sexoF"]["CONVERGENTE"]++;
            } elseif ($item["estilo"] == "ASIMILADOR" && $item["sexo"] == "F") {

                $nc["sexoF"]["ASIMILADOR"]++;
            } elseif ($item["estilo"] == "ACOMODADOR" && $item["sexo"] == "F") {

                $nc["sexoF"]["ACOMODADOR"]++;
            }
        } //fin for


        //Probabilidad de cada recinto por estilo
        //Turrialba:

        //Probabilidades de frecuencia para divergente ** (nc[recinto][divergente]+m*p)/(n+m)
        $pfDivergente["recintoTurrialba"] = (($nc["recintoTurrialba"]["DIVERGENTE"]) + ($m * $pRecinto)) / ($n["divergente"] + $m);

        //Probabilidades de frecuencia para convergente 
        $pfConvergente["recintoTurrialba"] = (($nc["recintoTurrialba"]["CONVERGENTE"]) + ($m * $pRecinto)) / ($n["convergente"] + $m);

        //Probabilidades de frecuencia para asimilador 
        $pfAsimilador["recintoTurrialba"] = (($nc["recintoTurrialba"]["ASIMILADOR"]) + ($m * $pRecinto)) / ($n["asimilador"] + $m);

        //Probabilidades de frecuencia para acomodador 
        $pfAcomodador["recintoTurrialba"] = (($nc["recintoTurrialba"]["ACOMODADOR"]) + ($m * $pRecinto)) / ($n["acomodador"] + $m);

        //Paraiso
        $pfDivergente["recintoParaiso"] = (($nc["recintoParaiso"]["DIVERGENTE"]) + ($m * $pRecinto)) / ($n["divergente"] + $m);

        //Probabilidades de frecuencia para convergente 
        $pfConvergente["recintoParaiso"] = (($nc["recintoParaiso"]["CONVERGENTE"]) + ($m * $pRecinto)) / ($n["convergente"] + $m);

        //Probabilidades de frecuencia para asimilador 
        $pfAsimilador["recintoParaiso"] = (($nc["recintoParaiso"]["ASIMILADOR"]) + ($m * $pRecinto)) / ($n["asimilador"] + $m);

        //Probabilidades de frecuencia para acomodador 
        $pfAcomodador["recintoParaiso"] = (($nc["recintoParaiso"]["ACOMODADOR"]) + ($m * $pRecinto)) / ($n["acomodador"] + $m);

        /***************************************************************************************************************/

        //Probabilidad por cada promedio por estilo
        //6
        $pfDivergente["promedio6"] = (($nc["promedio6"]["DIVERGENTE"]) + ($m * $pPromedio)) / ($n["divergente"] + $m);

        //Probabilidades de frecuencia para convergente 
        $pfConvergente["promedio6"] = (($nc["promedio6"]["CONVERGENTE"]) + ($m * $pPromedio)) / ($n["convergente"] + $m);

        //Probabilidades de frecuencia para asimilador 
        $pfAsimilador["promedio6"] = (($nc["promedio6"]["ASIMILADOR"]) + ($m * $pPromedio)) / ($n["asimilador"] + $m);

        //Probabilidades de frecuencia para acomodador 
        $pfAcomodador["promedio6"] = (($nc["promedio6"]["ACOMODADOR"]) + ($m * $pPromedio)) / ($n["acomodador"] + $m);

        //7
        $pfDivergente["promedio7"] = (($nc["promedio7"]["DIVERGENTE"]) + ($m * $pPromedio)) / ($n["divergente"] + $m);

        //Probabilidades de frecuencia para convergente 
        $pfConvergente["promedio7"] = (($nc["promedio7"]["CONVERGENTE"]) + ($m * $pPromedio)) / ($n["convergente"] + $m);

        //Probabilidades de frecuencia para asimilador 
        $pfAsimilador["promedio7"] = (($nc["promedio7"]["ASIMILADOR"]) + ($m * $pPromedio)) / ($n["asimilador"] + $m);

        //Probabilidades de frecuencia para acomodador 
        $pfAcomodador["promedio7"] = (($nc["promedio7"]["ACOMODADOR"]) + ($m * $pPromedio)) / ($n["acomodador"] + $m);

        //8
        $pfDivergente["promedio8"] = (($nc["promedio8"]["DIVERGENTE"]) + ($m * $pPromedio)) / ($n["divergente"] + $m);

        //Probabilidades de frecuencia para convergente 
        $pfConvergente["promedio8"] = (($nc["promedio8"]["CONVERGENTE"]) + ($m * $pPromedio)) / ($n["convergente"] + $m);

        //Probabilidades de frecuencia para asimilador 
        $pfAsimilador["promedio8"] = (($nc["promedio8"]["ASIMILADOR"]) + ($m * $pPromedio)) / ($n["asimilador"] + $m);

        //Probabilidades de frecuencia para acomodador 
        $pfAcomodador["promedio8"] = (($nc["promedio8"]["ACOMODADOR"]) + ($m * $pPromedio)) / ($n["acomodador"] + $m);

        //9
        $pfDivergente["promedio9"] = (($nc["promedio9"]["DIVERGENTE"]) + ($m * $pPromedio)) / ($n["divergente"] + $m);

        //Probabilidades de frecuencia para convergente 
        $pfConvergente["promedio9"] = (($nc["promedio9"]["CONVERGENTE"]) + ($m * $pPromedio)) / ($n["convergente"] + $m);

        //Probabilidades de frecuencia para asimilador 
        $pfAsimilador["promedio9"] = (($nc["promedio9"]["ASIMILADOR"]) + ($m * $pPromedio)) / ($n["asimilador"] + $m);

        //Probabilidades de frecuencia para acomodador 
        $pfAcomodador["promedio9"] = (($nc["promedio9"]["ACOMODADOR"]) + ($m * $pPromedio)) / ($n["acomodador"] + $m);


        /*********************************************************************************************/

        //Probabilidad de cada sexo por estilo 
        //M
        $pfDivergente["sexoM"] = (($nc["sexoM"]["DIVERGENTE"]) + ($m * $pSexo)) / ($n["divergente"] + $m);

        //Probabilidades de frecuencia para convergente 
        $pfConvergente["sexoM"] = (($nc["sexoM"]["CONVERGENTE"]) + ($m * $pSexo)) / ($n["convergente"] + $m);

        //Probabilidades de frecuencia para asimilador 
        $pfAsimilador["sexoM"] = (($nc["sexoM"]["ASIMILADOR"]) + ($m * $pSexo)) / ($n["asimilador"] + $m);

        //Probabilidades de frecuencia para acomodador 
        $pfAcomodador["sexoM"] = (($nc["sexoM"]["ACOMODADOR"]) + ($m * $pSexo)) / ($n["acomodador"] + $m);

        //F
        $pfDivergente["sexoF"] = (($nc["sexoF"]["DIVERGENTE"]) + ($m * $pSexo)) / ($n["divergente"] + $m);

        //Probabilidades de frecuencia para convergente 
        $pfConvergente["sexoF"] = (($nc["sexoF"]["CONVERGENTE"]) + ($m * $pSexo)) / ($n["convergente"] + $m);

        //Probabilidades de frecuencia para asimilador 
        $pfAsimilador["sexoF"] = (($nc["sexoF"]["ASIMILADOR"]) + ($m * $pSexo)) / ($n["asimilador"] + $m);

        //Probabilidades de frecuencia para acomodador 
        $pfAcomodador["sexoF"] = (($nc["sexoF"]["ACOMODADOR"]) + ($m * $pSexo)) / ($n["acomodador"] + $m);


        //NO SEGUIR
        //ESTO ES LO QUE SE GUARDA
        $vEstiloEst["Divergente"] = $pfDivergente;

        //Probabilidades de frecuencia para intermediate 
        $vEstiloEst["Convergente"] = $pfConvergente;

        //Probabilidades de frecuencia para advanced 
        $vEstiloEst["Asimilador"] = $pfAsimilador;

        //Probabilidades de frecuencia para advanced 
        $vEstiloEst["Acomodador"] = $pfAcomodador;

        $arr = json_encode($vEstiloEst);
        

        $fp = fopen('resultados_estilo_estudiante.json', 'w');
        fwrite($fp, json_encode($vEstiloEst));
        fclose($fp);

        //Se guardan las probabilidades para no calcular, si no mas bien consultar

    }

    //Recibe los datos del usuario y los consulta en el archivo de probabilidades para dar un resultado del estilo de aprendizaje

    public function adivinarEstiloAprendizaje()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $data = $tarea->obtenerDatosEstudiante();

        //Numero de apariciones de cada estilo en los datos
        $n["acomodador"] = 0;
        $n["divergente"] = 0;
        $n["asimilador"] = 0;
        $n["convergente"] = 0;

        foreach ($data as $item) {
            if ($item["estilo"] == "ACOMODADOR") {
                $n["acomodador"] = $n["acomodador"] + 1;
            } elseif ($item["estilo"] == "DIVERGENTE") {
                $n["divergente"] = $n["divergente"] + 1;
            } elseif ($item["estilo"] == "ASIMILADOR") {
                $n["asimilador"] = $n["asimilador"] + 1;
            } else {
                $n["convergente"] = $n["convergente"] + 1;
            }
        }

        //Datos del usuario que corresponden a cada columna de datos
        $recinto = $_POST['recinto'];
        $promedio = $_POST['promedio'];
        $sexo = $_POST['sexo'];


        //Una vez que se obtienen los datos del usuario se comparan con los datos ya guardados
        //este seria la segunda parte del algoritmo de BAYES

        // Obtiene los datos previos 
        $prob_previas = file_get_contents("resultados_estilo_estudiante.json");

        $arr = json_decode($prob_previas, true);

        //Probabilidades de clase
        $pDiver = $n["divergente"] / sizeof($data);
        $pConver = $n["convergente"] / sizeof($data);
        $pAsim = $n["asimilador"] / sizeof($data);
        $pAcom = $n["acomodador"] / sizeof($data);

        //Multiplicacion de todas las caracteristicas para divergente
        $valorDivergente = $arr['Divergente']['recinto' . $recinto] * $arr['Divergente']['promedio' . $promedio]
            * $arr['Divergente']['sexo' . $sexo];

        //Multiplicacion de ese valor por la prior probability de divergente
        $valorFinalDivergente = $valorDivergente * $pDiver;

        //Multiplicacion de todas las caracteristicas para convergente
        $valorConvergente = $arr['Convergente']['recinto' . $recinto] * $arr['Convergente']['promedio' . $promedio]
            * $arr['Convergente']['sexo' . $sexo];

        //Multiplicacion de ese valor por la prior probability de convergente
        $valorFinalConvergente = $valorConvergente * $pConver;

        //Multiplicacion de todas las caracteristicas para asimilador
        $valorAsimilador = $arr['Asimilador']['recinto' . $recinto] * $arr['Asimilador']['promedio' . $promedio]
            * $arr['Asimilador']['sexo' . $sexo];

        //Multiplicacion de ese valor por la prior probability de asimilador
        $valorFinalAsimilador = $valorAsimilador * $pAsim;

        //Multiplicacion de todas las caracteristicas para acomodador
        $valorAcomodador = $arr['Acomodador']['recinto' . $recinto] * $arr['Acomodador']['promedio' . $promedio]
            * $arr['Acomodador']['sexo' . $sexo];

        //Multiplicacion de ese valor por la prior probability de acomodador
        $valorFinalAcomodador = $valorAcomodador * $pAcom;



        //Una vez que se tiene los datos se obtiene el mayor
        $resultados = array($valorFinalDivergente, $valorFinalConvergente, $valorFinalAsimilador,$valorFinalAcomodador);
        $mayor = max($resultados);

        if ($mayor == $valorFinalDivergente) {
            $estilo = "DIVERGENTE";
        } elseif ($mayor == $valorFinalConvergente) {
            $estilo = "CONVERGENTE";
        } elseif ($mayor == $valorFinalAsimilador) {
            $estilo = "ASIMILADOR";
        }elseif($mayor == $valorFinalAcomodador){
            $estilo = "ACOMODADOR";
        }

        $this->view->show("estiloEstudianteView.php", $estilo);
    }
}//Fin de clase
