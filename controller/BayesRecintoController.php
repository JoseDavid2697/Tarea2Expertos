<?php
class BayesRecintoController
{
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } //construct

    /* 
        Se encarga de obtener la data de estudiante(para adivinar sexo) y trabajarla para guardar las probabilidades en un nuevo archivo,
        para luego solo consultar las probabilidades en el mismo, y no volver a calcular
    */

    public function datosEstudianteRecinto()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $vector_bd = $tarea->obtenerDatosRecinto();


        //Se ordenan los datos correspondientes a cada columna y se guardan en un array para mayor facilidad de iterar
        $index = 0;
        foreach ($vector_bd as $row) {
            $data[$index]["estilo"] = $row["estilo"];
            $data[$index]["promedio"] = $row["promedio"];
            $data[$index]["sexo"] = $row["sexo"];
            $data[$index]["recinto"] = $row["recinto"];

            $index++;
        }


        //Llama al algoritmo de bayes para recinto estudiante y guarda las probabilidades en un archivo

        $this->guardarProbabilidadesRecintoEstudiante($data);
    }


    //Se obtiene las probabilidades y se guardan en un archivo
    public function guardarProbabilidadesRecintoEstudiante($data)
    {
        //Se obtiene el valor de cada caracteristica **** numero de opciones por caracteristica
        $sexo = 2;
        $promedio = 4;
        $estilo = 4;

        //Se obtiene el valor de m al contar el numero de columnas o caracteristicas y restando la que corresponde a estilo
        $m = count($data[0]) - 1;

        //Se saca la probabilidad para cada caracteristica (p)
        $pSexo = 1 / $sexo;
        $pPromedio = 1 / $promedio;
        $pEstilo = 1 / $estilo;

        //Numero de apariciones de cada recinto en los datos
        $n["turrialba"] = 0;
        $n["paraiso"] = 0;

        foreach ($data as $item) {
            if ($item["recinto"] == "Turrialba") {
                $n["turrialba"] = $n["turrialba"] + 1;
            } elseif ($item["recinto"] == "Paraiso") {
                $n["paraiso"] = $n["paraiso"] + 1;
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
        donde la primera casilla es el dato (estilo,promedio,sexo) y la segunda
        el recinto asociado a ese dato (turrialba,paraiso)
        */

        //Cantidades para estilo por cada recinto
        $nc["estiloDivergente"]["Turrialba"] = 0;
        $nc["estiloDivergente"]["Paraiso"] = 0;

        $nc["estiloConvergente"]["Turrialba"] = 0;
        $nc["estiloConvergente"]["Paraiso"] = 0;

        $nc["estiloAsimilador"]["Turrialba"] = 0;
        $nc["estiloAsimilador"]["Paraiso"] = 0;

        $nc["estiloAcomodador"]["Turrialba"] = 0;
        $nc["estiloAcomodador"]["Paraiso"] = 0;

        //Cantidades para promedio por cada recinto
        $nc["promedio6"]["Turrialba"] = 0;
        $nc["promedio6"]["Paraiso"] = 0;

        $nc["promedio7"]["Turrialba"] = 0;
        $nc["promedio7"]["Paraiso"] = 0;

        $nc["promedio8"]["Turrialba"] = 0;
        $nc["promedio8"]["Paraiso"] = 0;

        $nc["promedio9"]["Turrialba"] = 0;
        $nc["promedio9"]["Paraiso"] = 0;

        //Cantidades para sexo por cada recinto
        $nc["sexoM"]["Turrialba"] = 0;
        $nc["sexoM"]["Paraiso"] = 0;

        $nc["sexoF"]["Turrialba"] = 0;
        $nc["sexoF"]["Paraiso"] = 0;

        //Obtiene el numero de apariciones de cada caracteristica para cada recinto de estudiante

        foreach ($data as $item) {

            //recinto Turrialba o Paraiso
            if ($item["recinto"] == "Turrialba" && $item["estilo"] == "DIVERGENTE") {

                $nc["estiloDivergente"]["Turrialba"]++;
            } elseif ($item["recinto"] == "Paraiso" && $item["estilo"] == "DIVERGENTE") {

                $nc["estiloDivergente"]["Paraiso"]++;
            }

            if ($item["recinto"] == "Turrialba" && $item["estilo"] == "CONVERGENTE") {

                $nc["estiloConvergente"]["Turrialba"]++;
            } elseif ($item["recinto"] == "Paraiso" && $item["estilo"] == "CONVERGENTE") {

                $nc["estiloConvergente"]["Paraiso"]++;
            }

            if ($item["recinto"] == "Turrialba" && $item["estilo"] == "ASIMILADOR") {

                $nc["estiloAsimilador"]["Turrialba"]++;
            } elseif ($item["recinto"] == "Paraiso" && $item["estilo"] == "ASIMILADOR") {

                $nc["estiloAsimilador"]["Paraiso"]++;
            }

            if ($item["recinto"] == "Turrialba" && $item["estilo"] == "ACOMODADOR") {

                $nc["estiloAcomodador"]["Turrialba"]++;
            } elseif ($item["recinto"] == "Paraiso" && $item["estilo"] == "ACOMODADOR") {

                $nc["estiloAcomodador"]["Paraiso"]++;
            }

            //Promedio
            if ($item["recinto"] == "Turrialba" && $item["promedio"] == 6) {

                $nc["promedio6"]["Turrialba"]++;
            } elseif ($item["recinto"] == "Paraiso" && $item["promedio"] == 6) {

                $nc["promedio6"]["Paraiso"]++;
            }
            //7
            if ($item["recinto"] == "Turrialba" && $item["promedio"] == 7) {

                $nc["promedio7"]["Turrialba"]++;
            } elseif ($item["recinto"] == "Paraiso" && $item["promedio"] == 7) {

                $nc["promedio7"]["Paraiso"]++;
            }
            //8
            if ($item["recinto"] == "Turrilba" && $item["promedio"] == 8) {

                $nc["promedio8"]["Turrialba"]++;
            } elseif ($item["recinto"] == "Paraiso" && $item["promedio"] == 8) {

                $nc["promedio8"]["Paraiso"]++;
            }
            //9
            if ($item["recinto"] == "Turrialba" && $item["promedio"] == 9) {

                $nc["promedio9"]["Turrialba"]++;
            } elseif ($item["recinto"] == "Paraiso" && $item["promedio"] == 9) {

                $nc["promedio9"]["Paraiso"]++;
            }

            //Sexo
            if ($item["sexo"] == "M" && $item["recinto"] == "Turrialba") {

                $nc["sexoM"]["Turrialba"]++;
            } elseif ($item["sexo"] == "F" && $item["recinto"] == "Turrialba") {

                $nc["sexoF"]["Turrialba"]++;
            }

            //Paraiso
            if ($item["sexo"] == "M" && $item["recinto"] == "Paraiso") {

                $nc["sexoM"]["Paraiso"]++;
            } elseif ($item["sexo"] == "F" && $item["recinto"] == "Paraiso") {

                $nc["sexoF"]["Paraiso"]++;
            }
        } //fin for

        
            //Probabilidad de cada sexo por recinto
            //Turrialba:


            $pfTurrialba["sexoM"] = (($nc["sexoM"]["Turrialba"]) + ($m * $pSexo)) / ($n["turrialba"] + $m);


            $pfParaiso["sexoM"] = (($nc["sexoM"]["Paraiso"]) + ($m * $pSexo)) / ($n["paraiso"] + $m);


            //Paraiso:

            $pfTurrialba["sexoF"] = (($nc["sexoF"]["Turrialba"]) + ($m * $pSexo)) / ($n["turrialba"] + $m);


            $pfParaiso["sexoF"] = (($nc["sexoF"]["Paraiso"]) + ($m * $pSexo)) / ($n["paraiso"] + $m);

            //Probabilidades de cada promedio por recinto

            //6
            $pfTurrialba["promedio6"] = (($nc["promedio6"]["Turrialba"]) + ($m * $pPromedio)) / ($n["turrialba"] + $m);

            $pfParaiso["promedio6"] = (($nc["promedio6"]["Paraiso"]) + ($m * $pPromedio)) / ($n["paraiso"] + $m);

            //7
            $pfTurrialba["promedio7"] = (($nc["promedio7"]["Turrialba"]) + ($m * $pPromedio)) / ($n["turrialba"] + $m);

            $pfParaiso["promedio7"] = (($nc["promedio7"]["Paraiso"]) + ($m * $pPromedio)) / ($n["paraiso"] + $m);

            //8
            $pfTurrialba["promedio8"] = (($nc["promedio8"]["Turrialba"]) + ($m * $pPromedio)) / ($n["turrialba"] + $m);

            $pfParaiso["promedio8"] = (($nc["promedio8"]["Paraiso"]) + ($m * $pPromedio)) / ($n["paraiso"] + $m);

            //9
            $pfTurrialba["promedio9"] = (($nc["promedio9"]["Turrialba"]) + ($m * $pPromedio)) / ($n["turrialba"] + $m);

            $pfParaiso["promedio9"] = (($nc["promedio9"]["Paraiso"]) + ($m * $pPromedio)) / ($n["paraiso"] + $m);


            //Probabilidad estilo por recinto
            //DIVERGENTE
            $pfTurrialba["estiloDivergente"] = (($nc["estiloDivergente"]["Turrialba"]) + ($m * $pEstilo)) / ($n["turrialba"] + $m);

            $pfParaiso["estiloDivergente"] = (($nc["estiloDivergente"]["Paraiso"]) + ($m * $pEstilo)) / ($n["paraiso"] + $m);

            //CONVERGENTE
            $pfTurrialba["estiloConvergente"] = (($nc["estiloConvergente"]["Turrialba"]) + ($m * $pEstilo)) / ($n["turrialba"] + $m);

            $pfParaiso["estiloConvergente"] = (($nc["estiloConvergente"]["Paraiso"]) + ($m * $pEstilo)) / ($n["paraiso"] + $m);

            //ASIMILADOR
            $pfTurrialba["estiloAsimilador"] = (($nc["estiloAsimilador"]["Turrialba"]) + ($m * $pEstilo)) / ($n["turrialba"] + $m);

            $pfParaiso["estiloAsimilador"] = (($nc["estiloAsimilador"]["Paraiso"]) + ($m * $pEstilo)) / ($n["paraiso"] + $m);

            //ACOMODADOR
            $pfTurrialba["estiloAcomodador"] = (($nc["estiloAcomodador"]["Turrialba"]) + ($m * $pEstilo)) / ($n["turrialba"] + $m);

            $pfParaiso["estiloAcomodador"] = (($nc["estiloAcomodador"]["Paraiso"]) + ($m * $pEstilo)) / ($n["paraiso"] + $m);




        //ESTO ES LO QUE SE GUARDA
        $vRecintoEstudiante["Turrialba"] = $pfTurrialba;

        
        $vRecintoEstudiante["Paraiso"] = $pfParaiso;

        $arr = json_encode($vRecintoEstudiante);
        

        $fp = fopen('resultados_recinto_estudiante.json', 'w');
        fwrite($fp, json_encode($vRecintoEstudiante));
        fclose($fp);

    }


    //Recibe los datos del usuario y consulta para adivinar el recinto
    public function adivinarRecinto()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $data = $tarea->obtenerDatosRecinto();

        //Numero de apariciones de cada recinto en los datos
        $n["turrialba"] = 0;
        $n["paraiso"] = 0;

        foreach ($data as $item) {
            if ($item["recinto"] == "Turrialba") {
                $n["turrialba"] = $n["turrialba"] + 1;
            } elseif ($item["recinto"] == "Paraiso") {
                $n["paraiso"] = $n["paraiso"] + 1;
            }
        }

        //Datos del usuario que corresponden a cada columna de datos
        $sexo = $_POST['sexo'];
        $promedio = $_POST['promedio'];
        $estilo = $_POST['estilo'];

        //Una vez que se obtienen los datos del usuario se comparan con los datos ya guardados
        //este seria la segunda parte del algoritmo de BAYES

        // Obtiene los datos previos 
        $prob_previas = file_get_contents("resultados_recinto_estudiante.json");

        $arr = json_decode($prob_previas, true);

        //Probabilidades de recinto
        $pTurrialba = $n["turrialba"] / sizeof($data);
        $pParaiso = $n["paraiso"] / sizeof($data);


        //Multiplicacion de todas las caracteristicas para Turrialba
        $valorTurrialba = $arr['Turrialba']['sexo' . $sexo] * $arr['Turrialba']['promedio' . $promedio]
            * $arr['Turrialba']['estilo' . $estilo];

        //Multiplicacion de ese valor por la prior probability de Turrialba
        $valorFinalTurrialba = $valorTurrialba * $pTurrialba;

        //Multiplicacion de todas las caracteristicas para Paraiso
        $valorParaiso = $arr['Paraiso']['sexo' . $sexo] * $arr['Paraiso']['promedio' . $promedio]
            * $arr['Paraiso']['estilo' . $estilo];

        //Multiplicacion de ese valor por la prior probability de Paraiso
        $valorFinalParaiso = $valorParaiso * $pParaiso;

        //Una vez que se tiene los datos se obtiene el mayor
        $resultados = array($valorFinalTurrialba, $valorFinalParaiso);
        $mayor = max($resultados);

        if ($mayor == $valorFinalTurrialba) {
            $recinto = "Turrialba";
        } elseif ($mayor == $valorFinalParaiso) {
            $recinto = "Paraiso";
        }

        $this->view->show("adivinarRecintoView.php", $recinto);
    }
}
