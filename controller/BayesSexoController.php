<?php

class BayesSexoController
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
    public function datosEstudianteSexo()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $vector_bd = $tarea->obtenerDatosSexo();

        //Se ordenan los datos correspondientes a cada columna y se guardan en un array para mayor facilidad de iterar
        $index = 0;
        foreach ($vector_bd as $row) {
            $data[$index]["recinto"] = $row["recinto"];
            $data[$index]["estilo"] = $row["estilo"];
            $data[$index]["promedio"] = $row["promedio"];
            $data[$index]["sexo"] = $row["sexo"];

            $index++;
        }

        //Llama al algoritmo de bayes para sexo estudiante y guarda las probabilidades en un archivo

        $this->guardarProbabilidadesSexoEstudiante($data);
    }

    //Saca todas las probabilidades y las guarda en un archivo
    public function guardarProbabilidadesSexoEstudiante($data)
    {
        //Se obtiene el valor de cada caracteristica **** numero de opciones por caracteristica
        $recinto = 2;
        $promedio = 4;
        $estilo = 4;

        //Se obtiene el valor de m al contar el numero de columnas o caracteristicas y restando la que corresponde a estilo
        $m = count($data[0]) - 1;

        //Se saca la probabilidad para cada caracteristica (p)
        $pRecinto = 1 / $recinto;
        $pPromedio = 1 / $promedio;
        $pEstilo = 1 / $estilo;

        //Numero de apariciones de cada sexo en los datos
        $n["masculino"] = 0;
        $n["femenino"] = 0;

        foreach ($data as $item) {
            if ($item["sexo"] == "M") {
                $n["masculino"] = $n["masculino"] + 1;
            } elseif ($item["sexo"] == "F") {
                $n["femenino"] = $n["femenino"] + 1;
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
        donde la primera casilla es el dato (estilo,promedio,recinto) y la segunda
        el sexo asociado a ese dato (maculino,femenino)
        */

        //Cantidades para estilo por cada sexo
        $nc["estiloDivergente"]["M"] = 0;
        $nc["estiloDivergente"]["F"] = 0;

        $nc["estiloConvergente"]["M"] = 0;
        $nc["estiloConvergente"]["F"] = 0;

        $nc["estiloAsimilador"]["M"] = 0;
        $nc["estiloAsimilador"]["F"] = 0;

        $nc["estiloAcomodador"]["M"] = 0;
        $nc["estiloAcomodador"]["F"] = 0;

        //Cantidades para promedio por cada sexo
        $nc["promedio6"]["M"] = 0;
        $nc["promedio6"]["F"] = 0;

        $nc["promedio7"]["M"] = 0;
        $nc["promedio7"]["F"] = 0;

        $nc["promedio8"]["M"] = 0;
        $nc["promedio8"]["F"] = 0;

        $nc["promedio9"]["M"] = 0;
        $nc["promedio9"]["F"] = 0;


        //Cantidades para recinto por cada sexo
        $nc["recintoTurrialba"]["M"] = 0;
        $nc["recintoTurrialba"]["F"] = 0;

        $nc["recintoParaiso"]["M"] = 0;
        $nc["recintoParaiso"]["F"] = 0;

        //Obtiene el numero de apariciones de cada caracteristica para cada sexo de estudiante

        foreach ($data as $item) {

            //Sexo M,F con estilo diver,conver,asim,acom
            if ($item["sexo"] == "M" && $item["estilo"] == "DIVERGENTE") {

                $nc["estiloDivergente"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["estilo"] == "DIVERGENTE") {

                $nc["estiloDivergente"]["F"]++;
            }

            if ($item["sexo"] == "M" && $item["estilo"] == "CONVERGENTE") {

                $nc["estiloConvergente"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["estilo"] == "CONVERGENTE") {

                $nc["estiloConvergente"]["F"]++;
            }

            if ($item["sexo"] == "M" && $item["estilo"] == "ASIMILADOR") {

                $nc["estiloAsimilador"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["estilo"] == "ASIMILADOR") {

                $nc["estiloAsimilador"]["F"]++;
            }

            if ($item["sexo"] == "M" && $item["estilo"] == "ACOMODADOR") {

                $nc["estiloAcomodador"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["estilo"] == "ACOMODADOR") {

                $nc["estiloAcomodador"]["F"]++;
            }

            //Promedio
            if ($item["sexo"] == "M" && $item["promedio"] == 6) {

                $nc["promedio6"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["promedio"] == 6) {

                $nc["promedio6"]["F"]++;
            }
            //7
            if ($item["sexo"] == "M" && $item["promedio"] == 7) {

                $nc["promedio7"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["promedio"] == 7) {

                $nc["promedio7"]["F"]++;
            }
            //8
            if ($item["sexo"] == "M" && $item["promedio"] == 8) {

                $nc["promedio8"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["promedio"] == 8) {

                $nc["promedio8"]["F"]++;
            }
            //9
            if ($item["sexo"] == "M" && $item["promedio"] == 9) {

                $nc["promedio9"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["promedio"] == 9) {

                $nc["promedio9"]["F"]++;
            }

            //Recinto
            if ($item["sexo"] == "M" && $item["recinto"] == "Turrialba") {

                $nc["recintoTurrialba"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["recinto"] == "Turrialba") {

                $nc["recintoTurrialba"]["F"]++;
            }

            //Paraiso
            if ($item["sexo"] == "M" && $item["recinto"] == "Paraiso") {

                $nc["recintoParaiso"]["M"]++;
            } elseif ($item["sexo"] == "F" && $item["recinto"] == "Paraiso") {

                $nc["recintoParaiso"]["F"]++;
            }
        } //fin for

        //Probabilidad de cada recinto por sexo
        //Turrialba:

        //Probabilidades de frecuencia para Masculino ** (nc[recinto][M]+m*p)/(n+m)
        $pfMasculino["recintoTurrialba"] = (($nc["recintoTurrialba"]["M"]) + ($m * $pRecinto)) / ($n["masculino"] + $m);

        //Probabilidades de frecuencia para Femenino
        $pfFemenino["recintoTurrialba"] = (($nc["recintoTurrialba"]["F"]) + ($m * $pRecinto)) / ($n["femenino"] + $m);


        //Paraiso:

        //Probabilidades de frecuencia para Masculino ** (nc[recinto][M]+m*p)/(n+m)
        $pfMasculino["recintoParaiso"] = (($nc["recintoParaiso"]["M"]) + ($m * $pRecinto)) / ($n["masculino"] + $m);

        //Probabilidades de frecuencia para Femenino
        $pfFemenino["recintoParaiso"] = (($nc["recintoParaiso"]["F"]) + ($m * $pRecinto)) / ($n["femenino"] + $m);


        //Probabilidad de cada promedio por sexo
        //6
        $pfMasculino["promedio6"] = (($nc["promedio6"]["M"]) + ($m * $pPromedio)) / ($n["masculino"] + $m);

        $pfFemenino["promedio6"] = (($nc["promedio6"]["F"]) + ($m * $pPromedio)) / ($n["femenino"] + $m);

        //7
        $pfMasculino["promedio7"] = (($nc["promedio7"]["M"]) + ($m * $pPromedio)) / ($n["masculino"] + $m);

        $pfFemenino["promedio7"] = (($nc["promedio7"]["F"]) + ($m * $pPromedio)) / ($n["femenino"] + $m);

        //8
        $pfMasculino["promedio8"] = (($nc["promedio8"]["M"]) + ($m * $pPromedio)) / ($n["masculino"] + $m);

        $pfFemenino["promedio8"] = (($nc["promedio8"]["F"]) + ($m * $pPromedio)) / ($n["femenino"] + $m);

        //9
        $pfMasculino["promedio9"] = (($nc["promedio9"]["M"]) + ($m * $pPromedio)) / ($n["masculino"] + $m);

        $pfFemenino["promedio9"] = (($nc["promedio9"]["F"]) + ($m * $pPromedio)) / ($n["femenino"] + $m);


        //Probabilidad estilo por sexo
        //DIVERGENTE
        $pfMasculino["estiloDivergente"] = (($nc["estiloDivergente"]["M"]) + ($m * $pEstilo)) / ($n["masculino"] + $m);

        $pfFemenino["estiloDivergente"] = (($nc["estiloDivergente"]["F"]) + ($m * $pEstilo)) / ($n["femenino"] + $m);

        //CONVERGENTE
        $pfMasculino["estiloConvergente"] = (($nc["estiloConvergente"]["M"]) + ($m * $pEstilo)) / ($n["masculino"] + $m);

        $pfFemenino["estiloConvergente"] = (($nc["estiloConvergente"]["F"]) + ($m * $pEstilo)) / ($n["femenino"] + $m);

        //ASIMILADOR
        $pfMasculino["estiloAsimilador"] = (($nc["estiloAsimilador"]["M"]) + ($m * $pEstilo)) / ($n["masculino"] + $m);

        $pfFemenino["estiloAsimilador"] = (($nc["estiloAsimilador"]["F"]) + ($m * $pEstilo)) / ($n["femenino"] + $m);

        //ACOMODADOR
        $pfMasculino["estiloAcomodador"] = (($nc["estiloAcomodador"]["M"]) + ($m * $pEstilo)) / ($n["masculino"] + $m);

        $pfFemenino["estiloAcomodador"] = (($nc["estiloAcomodador"]["F"]) + ($m * $pEstilo)) / ($n["femenino"] + $m);


        //NO SEGUIR
        //ESTO ES LO QUE SE GUARDA
        $vSexoEstudiante["M"] = $pfMasculino;

         
        $vSexoEstudiante["F"] = $pfFemenino;

        $arr = json_encode($vSexoEstudiante);
        

        $fp = fopen('resultados_sexo_estudiante.json', 'w');
        fwrite($fp, json_encode($vSexoEstudiante));
        fclose($fp);
    }


    //Recibe los datos del usuario y consulta para adivinar el sexo
    public function adivinarSexo()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $data = $tarea->obtenerDatosSexo();

        //Numero de apariciones de cada sexo en los datos
        $n["masculino"] = 0;
        $n["femenino"] = 0;

        foreach ($data as $item) {
            if ($item["sexo"] == "M") {
                $n["masculino"] = $n["masculino"] + 1;
            } elseif ($item["sexo"] == "F") {
                $n["femenino"] = $n["femenino"] + 1;
            }
        }

        //Datos del usuario que corresponden a cada columna de datos
        $recinto = $_POST['recinto'];
        $promedio = $_POST['promedio'];
        $estilo = $_POST['estilo'];

        //Una vez que se obtienen los datos del usuario se comparan con los datos ya guardados
        //este seria la segunda parte del algoritmo de BAYES

        // Obtiene los datos previos 
        $prob_previas = file_get_contents("resultados_sexo_estudiante.json");

        $arr = json_decode($prob_previas, true);

        //Probabilidades de sexo
        $pMasculino = $n["masculino"] / sizeof($data);
        $pFemenino = $n["femenino"] / sizeof($data);


        //Multiplicacion de todas las caracteristicas para Masculino
        $valorMaculino = $arr['M']['recinto' . $recinto] * $arr['M']['promedio' . $promedio]
            * $arr['M']['estilo' . $estilo];

        //Multiplicacion de ese valor por la prior probability de Masculino
        $valorFinalMasculino = $valorMaculino * $pMasculino;

        //Multiplicacion de todas las caracteristicas para Femenino
        $valorFemenino = $arr['F']['recinto' . $recinto] * $arr['F']['promedio' . $promedio]
            * $arr['F']['estilo' . $estilo];

        //Multiplicacion de ese valor por la prior probability de Femenino
        $valorFinalFemenino = $valorFemenino * $pFemenino;

        //Una vez que se tiene los datos se obtiene el mayor
        $resultados = array($valorFinalMasculino, $valorFinalFemenino);
        $mayor = max($resultados);

        if ($mayor == $valorFinalMasculino) {
            $sexo = "Masculino";
        } elseif ($mayor == $valorFinalFemenino) {
            $sexo = "Femenino";
        }

        $this->view->show("adivinarSexoView.php", $sexo);
    }
}
