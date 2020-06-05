<?php

class BayesEstiloAprendizajeController
{
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } //construct

    /* 
        Se encarga de obtener la data de estilo(para adivinar estilo aprendizaje) y trabajarla para guardar las probabilidades en un nuevo archivo,
        para luego solo consultar las probabilidades en el mismo, y no volver a calcular
    */


    public function datosAprendizaje()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $vector_bd = $tarea->obtenerDatosEstilo();

        //Se ordenan los datos correspondientes a cada columna y se guardan en un array para mayor facilidad de iterar
        $index = 0;
        foreach ($vector_bd as $row) {
            $data[$index]["ca"] = $row["ca"];
            $data[$index]["ec"] = $row["ec"];
            $data[$index]["ea"] = $row["ea"];
            $data[$index]["or"] = $row["or"];
            $data[$index]["estilo"] = $row["estilo"];

            $index++;
        }

        //Llama al algoritmo de bayes para redes y guarda las probabilidades en un archivo

        $this->guardarProbabilidadesAprendizaje($data);
    }

    //Guarda las probabilidades en un archivo 
    public function guardarProbabilidadesAprendizaje($data)
    {

        //valor de cada caracteristica **** numero de opciones por caracteristica
        //6-24
        $ca = 19;
        $ec = 19;
        $ea = 19;
        $or = 19;


        //Se obtiene el valor de m al contar el numero de columnas o caracteristicas y restando la que corresponde a estilo
        $m = count($data[0]) - 1;

        //Se saca la probabilidad para cada caracteristica (p)
        $pCA = 1 / $ca;
        $pEC = 1 / $ec;
        $pEA = 1 / $ea;
        $pOR = 1 / $or;

        //Numero de apariciones de cada clase de estilo en los datos
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



        /*
        Se obtiene el numero de instancias [nc] donde nc sera una matriz,
        donde la primera casilla es el dato (ca,ec,ea,or) y la segunda
        el estilo asociado a ese dato (asimilador,convergente,divergente,acomodador)
        */

        //Cantidades para CA por cada estilo de aprendizaje
        //6
        $nc["CA6"]["DIVERGENTE"] = 0;$nc["CA6"]["CONVERGENTE"] = 0;$nc["CA6"]["ASIMILADOR"] = 0;$nc["CA6"]["ACOMODADOR"] = 0;

        //7
        $nc["CA7"]["DIVERGENTE"] = 0;$nc["CA7"]["CONVERGENTE"] = 0;$nc["CA7"]["ASIMILADOR"] = 0;$nc["CA7"]["ACOMODADOR"] = 0;

        //8
        $nc["CA8"]["DIVERGENTE"] = 0;$nc["CA8"]["CONVERGENTE"] = 0;$nc["CA8"]["ASIMILADOR"] = 0;$nc["CA8"]["ACOMODADOR"] = 0;

        //9
        $nc["CA9"]["DIVERGENTE"] = 0;$nc["CA9"]["CONVERGENTE"] = 0;$nc["CA9"]["ASIMILADOR"] = 0;$nc["CA9"]["ACOMODADOR"] = 0;

        //10
        $nc["CA10"]["DIVERGENTE"] = 0;$nc["CA10"]["CONVERGENTE"] = 0;$nc["CA10"]["ASIMILADOR"] = 0;$nc["CA10"]["ACOMODADOR"] = 0;

        //11
        $nc["CA11"]["DIVERGENTE"] = 0;$nc["CA11"]["CONVERGENTE"] = 0;$nc["CA11"]["ASIMILADOR"] = 0;$nc["CA11"]["ACOMODADOR"] = 0;

        //12
        $nc["CA12"]["DIVERGENTE"] = 0;$nc["CA12"]["CONVERGENTE"] = 0;$nc["CA12"]["ASIMILADOR"] = 0;$nc["CA12"]["ACOMODADOR"] = 0;

        //13
        $nc["CA13"]["DIVERGENTE"] = 0;$nc["CA13"]["CONVERGENTE"] = 0;$nc["CA13"]["ASIMILADOR"] = 0;$nc["CA13"]["ACOMODADOR"] = 0;

        //14
        $nc["CA14"]["DIVERGENTE"] = 0;$nc["CA14"]["CONVERGENTE"] = 0;$nc["CA14"]["ASIMILADOR"] = 0;$nc["CA14"]["ACOMODADOR"] = 0;

        //15
        $nc["CA15"]["DIVERGENTE"] = 0;$nc["CA15"]["CONVERGENTE"] = 0;$nc["CA15"]["ASIMILADOR"] = 0;$nc["CA15"]["ACOMODADOR"] = 0;

        //16
        $nc["CA16"]["DIVERGENTE"] = 0;$nc["CA16"]["CONVERGENTE"] = 0;$nc["CA16"]["ASIMILADOR"] = 0;$nc["CA16"]["ACOMODADOR"] = 0;

        //17
        $nc["CA17"]["DIVERGENTE"] = 0;$nc["CA17"]["CONVERGENTE"] = 0;$nc["CA17"]["ASIMILADOR"] = 0;$nc["CA17"]["ACOMODADOR"] = 0;


        //18
        $nc["CA18"]["DIVERGENTE"] = 0;$nc["CA18"]["CONVERGENTE"] = 0;$nc["CA18"]["ASIMILADOR"] = 0;$nc["CA18"]["ACOMODADOR"] = 0;

        //19
        $nc["CA19"]["DIVERGENTE"] = 0;$nc["CA19"]["CONVERGENTE"] = 0;$nc["CA19"]["ASIMILADOR"] = 0;$nc["CA19"]["ACOMODADOR"] = 0;

        //20
        $nc["CA20"]["DIVERGENTE"] = 0;$nc["CA20"]["CONVERGENTE"] = 0;$nc["CA20"]["ASIMILADOR"] = 0;$nc["CA20"]["ACOMODADOR"] = 0;
        
        //21
        $nc["CA21"]["DIVERGENTE"] = 0;$nc["CA21"]["CONVERGENTE"] = 0;$nc["CA21"]["ASIMILADOR"] = 0;$nc["CA21"]["ACOMODADOR"] = 0;

        //22
        $nc["CA22"]["DIVERGENTE"] = 0;$nc["CA22"]["CONVERGENTE"] = 0;$nc["CA22"]["ASIMILADOR"] = 0;$nc["CA22"]["ACOMODADOR"] = 0;

        //23
        $nc["CA23"]["DIVERGENTE"] = 0;$nc["CA23"]["CONVERGENTE"] = 0;$nc["CA23"]["ASIMILADOR"] = 0;$nc["CA23"]["ACOMODADOR"] = 0;

        //24
        $nc["CA24"]["DIVERGENTE"] = 0;$nc["CA24"]["CONVERGENTE"] = 0;$nc["CA24"]["ASIMILADOR"] = 0;$nc["CA24"]["ACOMODADOR"] = 0;

        //Cantidades para EC por cada estilo de aprendizaje
        //6
        $nc["EC6"]["DIVERGENTE"] = 0;$nc["EC6"]["CONVERGENTE"] = 0;$nc["EC6"]["ASIMILADOR"] = 0;$nc["EC6"]["ACOMODADOR"] = 0;

        //7
        $nc["EC7"]["DIVERGENTE"] = 0;$nc["EC7"]["CONVERGENTE"] = 0;$nc["EC7"]["ASIMILADOR"] = 0;$nc["EC7"]["ACOMODADOR"] = 0;

        //8
        $nc["EC8"]["DIVERGENTE"] = 0;$nc["EC8"]["CONVERGENTE"] = 0;$nc["EC8"]["ASIMILADOR"] = 0;$nc["EC8"]["ACOMODADOR"] = 0;

        //9
        $nc["EC9"]["DIVERGENTE"] = 0;$nc["EC9"]["CONVERGENTE"] = 0;$nc["EC9"]["ASIMILADOR"] = 0;$nc["EC9"]["ACOMODADOR"] = 0;

        //10
        $nc["EC10"]["DIVERGENTE"] = 0;$nc["EC10"]["CONVERGENTE"] = 0;$nc["EC10"]["ASIMILADOR"] = 0;$nc["EC10"]["ACOMODADOR"] = 0;

        //11
        $nc["EC11"]["DIVERGENTE"] = 0;$nc["EC11"]["CONVERGENTE"] = 0;$nc["EC11"]["ASIMILADOR"] = 0;$nc["EC11"]["ACOMODADOR"] = 0;

        //12
        $nc["EC12"]["DIVERGENTE"] = 0;$nc["EC12"]["CONVERGENTE"] = 0;$nc["EC12"]["ASIMILADOR"] = 0;$nc["EC12"]["ACOMODADOR"] = 0;

        //13
        $nc["EC13"]["DIVERGENTE"] = 0;$nc["EC13"]["CONVERGENTE"] = 0;$nc["EC13"]["ASIMILADOR"] = 0;$nc["EC13"]["ACOMODADOR"] = 0;

        //14
        $nc["EC14"]["DIVERGENTE"] = 0;$nc["EC14"]["CONVERGENTE"] = 0;$nc["EC14"]["ASIMILADOR"] = 0;$nc["EC14"]["ACOMODADOR"] = 0;

        //15
        $nc["EC15"]["DIVERGENTE"] = 0;$nc["EC15"]["CONVERGENTE"] = 0;$nc["EC15"]["ASIMILADOR"] = 0;$nc["EC15"]["ACOMODADOR"] = 0;

        //16
        $nc["EC16"]["DIVERGENTE"] = 0;$nc["EC16"]["CONVERGENTE"] = 0;$nc["EC16"]["ASIMILADOR"] = 0;$nc["EC16"]["ACOMODADOR"] = 0;

        //17
        $nc["EC17"]["DIVERGENTE"] = 0;$nc["EC17"]["CONVERGENTE"] = 0;$nc["EC17"]["ASIMILADOR"] = 0;$nc["EC17"]["ACOMODADOR"] = 0;


        //18
        $nc["EC18"]["DIVERGENTE"] = 0;$nc["EC18"]["CONVERGENTE"] = 0;$nc["EC18"]["ASIMILADOR"] = 0;$nc["EC18"]["ACOMODADOR"] = 0;

        //19
        $nc["EC19"]["DIVERGENTE"] = 0;$nc["EC19"]["CONVERGENTE"] = 0;$nc["EC19"]["ASIMILADOR"] = 0;$nc["EC19"]["ACOMODADOR"] = 0;

        //20
        $nc["EC20"]["DIVERGENTE"] = 0;$nc["EC20"]["CONVERGENTE"] = 0;$nc["EC20"]["ASIMILADOR"] = 0;$nc["EC20"]["ACOMODADOR"] = 0;
        
        //21
        $nc["EC21"]["DIVERGENTE"] = 0;$nc["EC21"]["CONVERGENTE"] = 0;$nc["EC21"]["ASIMILADOR"] = 0;$nc["EC21"]["ACOMODADOR"] = 0;

        //22
        $nc["EC22"]["DIVERGENTE"] = 0;$nc["EC22"]["CONVERGENTE"] = 0;$nc["EC22"]["ASIMILADOR"] = 0;$nc["EC22"]["ACOMODADOR"] = 0;

        //23
        $nc["EC23"]["DIVERGENTE"] = 0;$nc["EC23"]["CONVERGENTE"] = 0;$nc["EC23"]["ASIMILADOR"] = 0;$nc["EC23"]["ACOMODADOR"] = 0;

        //24
        $nc["EC24"]["DIVERGENTE"] = 0;$nc["EC24"]["CONVERGENTE"] = 0;$nc["EC24"]["ASIMILADOR"] = 0;$nc["EC24"]["ACOMODADOR"] = 0;

        //Cantidades para EA por cada estilo de aprendizaje
        //6
        $nc["EA6"]["DIVERGENTE"] = 0;$nc["EA6"]["CONVERGENTE"] = 0;$nc["EA6"]["ASIMILADOR"] = 0;$nc["EA6"]["ACOMODADOR"] = 0;

        //7
        $nc["EA7"]["DIVERGENTE"] = 0;$nc["EA7"]["CONVERGENTE"] = 0;$nc["EA7"]["ASIMILADOR"] = 0;$nc["EA7"]["ACOMODADOR"] = 0;

        //8
        $nc["EA8"]["DIVERGENTE"] = 0;$nc["EA8"]["CONVERGENTE"] = 0;$nc["EA8"]["ASIMILADOR"] = 0;$nc["EA8"]["ACOMODADOR"] = 0;

        //9
        $nc["EA9"]["DIVERGENTE"] = 0;$nc["EA9"]["CONVERGENTE"] = 0;$nc["EA9"]["ASIMILADOR"] = 0;$nc["EA9"]["ACOMODADOR"] = 0;

        //10
        $nc["EA10"]["DIVERGENTE"] = 0;$nc["EA10"]["CONVERGENTE"] = 0;$nc["EA10"]["ASIMILADOR"] = 0;$nc["EA10"]["ACOMODADOR"] = 0;

        //11
        $nc["EA11"]["DIVERGENTE"] = 0;$nc["EA11"]["CONVERGENTE"] = 0;$nc["EA11"]["ASIMILADOR"] = 0;$nc["EA11"]["ACOMODADOR"] = 0;

        //12
        $nc["EA12"]["DIVERGENTE"] = 0;$nc["EA12"]["CONVERGENTE"] = 0;$nc["EA12"]["ASIMILADOR"] = 0;$nc["EA12"]["ACOMODADOR"] = 0;

        //13
        $nc["EA13"]["DIVERGENTE"] = 0;$nc["EA13"]["CONVERGENTE"] = 0;$nc["EA13"]["ASIMILADOR"] = 0;$nc["EA13"]["ACOMODADOR"] = 0;

        //14
        $nc["EA14"]["DIVERGENTE"] = 0;$nc["EA14"]["CONVERGENTE"] = 0;$nc["EA14"]["ASIMILADOR"] = 0;$nc["EA14"]["ACOMODADOR"] = 0;

        //15
        $nc["EA15"]["DIVERGENTE"] = 0;$nc["EA15"]["CONVERGENTE"] = 0;$nc["EA15"]["ASIMILADOR"] = 0;$nc["EA15"]["ACOMODADOR"] = 0;

        //16
        $nc["EA16"]["DIVERGENTE"] = 0;$nc["EA16"]["CONVERGENTE"] = 0;$nc["EA16"]["ASIMILADOR"] = 0;$nc["EA16"]["ACOMODADOR"] = 0;

        //17
        $nc["EA17"]["DIVERGENTE"] = 0;$nc["EA17"]["CONVERGENTE"] = 0;$nc["EA17"]["ASIMILADOR"] = 0;$nc["EA17"]["ACOMODADOR"] = 0;


        //18
        $nc["EA18"]["DIVERGENTE"] = 0;$nc["EA18"]["CONVERGENTE"] = 0;$nc["EA18"]["ASIMILADOR"] = 0;$nc["EA18"]["ACOMODADOR"] = 0;

        //19
        $nc["EA19"]["DIVERGENTE"] = 0;$nc["EA19"]["CONVERGENTE"] = 0;$nc["EA19"]["ASIMILADOR"] = 0;$nc["EA19"]["ACOMODADOR"] = 0;

        //20
        $nc["EA20"]["DIVERGENTE"] = 0;$nc["EA20"]["CONVERGENTE"] = 0;$nc["EA20"]["ASIMILADOR"] = 0;$nc["EA20"]["ACOMODADOR"] = 0;
        
        //21
        $nc["EA21"]["DIVERGENTE"] = 0;$nc["EA21"]["CONVERGENTE"] = 0;$nc["EA21"]["ASIMILADOR"] = 0;$nc["EA21"]["ACOMODADOR"] = 0;

        //22
        $nc["EA22"]["DIVERGENTE"] = 0;$nc["EA22"]["CONVERGENTE"] = 0;$nc["EA22"]["ASIMILADOR"] = 0;$nc["EA22"]["ACOMODADOR"] = 0;

        //23
        $nc["EA23"]["DIVERGENTE"] = 0;$nc["EA23"]["CONVERGENTE"] = 0;$nc["EA23"]["ASIMILADOR"] = 0;$nc["EA23"]["ACOMODADOR"] = 0;

        //24
        $nc["EA24"]["DIVERGENTE"] = 0;$nc["EA24"]["CONVERGENTE"] = 0;$nc["EA24"]["ASIMILADOR"] = 0;$nc["EA24"]["ACOMODADOR"] = 0; 
        
        //Cantidades para OR por cada estilo de aprendizaje
        //6
        $nc["OR6"]["DIVERGENTE"] = 0;$nc["OR6"]["CONVERGENTE"] = 0;$nc["OR6"]["ASIMILADOR"] = 0;$nc["OR6"]["ACOMODADOR"] = 0;

        //7
        $nc["OR7"]["DIVERGENTE"] = 0;$nc["OR7"]["CONVERGENTE"] = 0;$nc["OR7"]["ASIMILADOR"] = 0;$nc["OR7"]["ACOMODADOR"] = 0;

        //8
        $nc["OR8"]["DIVERGENTE"] = 0;$nc["OR8"]["CONVERGENTE"] = 0;$nc["OR8"]["ASIMILADOR"] = 0;$nc["OR8"]["ACOMODADOR"] = 0;

        //9
        $nc["OR9"]["DIVERGENTE"] = 0;$nc["OR9"]["CONVERGENTE"] = 0;$nc["OR9"]["ASIMILADOR"] = 0;$nc["OR9"]["ACOMODADOR"] = 0;

        //10
        $nc["OR10"]["DIVERGENTE"] = 0;$nc["OR10"]["CONVERGENTE"] = 0;$nc["OR10"]["ASIMILADOR"] = 0;$nc["OR10"]["ACOMODADOR"] = 0;

        //11
        $nc["OR11"]["DIVERGENTE"] = 0;$nc["OR11"]["CONVERGENTE"] = 0;$nc["OR11"]["ASIMILADOR"] = 0;$nc["OR11"]["ACOMODADOR"] = 0;

        //12
        $nc["OR12"]["DIVERGENTE"] = 0;$nc["OR12"]["CONVERGENTE"] = 0;$nc["OR12"]["ASIMILADOR"] = 0;$nc["OR12"]["ACOMODADOR"] = 0;

        //13
        $nc["OR13"]["DIVERGENTE"] = 0;$nc["OR13"]["CONVERGENTE"] = 0;$nc["OR13"]["ASIMILADOR"] = 0;$nc["OR13"]["ACOMODADOR"] = 0;

        //14
        $nc["OR14"]["DIVERGENTE"] = 0;$nc["OR14"]["CONVERGENTE"] = 0;$nc["OR14"]["ASIMILADOR"] = 0;$nc["OR14"]["ACOMODADOR"] = 0;

        //15
        $nc["OR15"]["DIVERGENTE"] = 0;$nc["OR15"]["CONVERGENTE"] = 0;$nc["OR15"]["ASIMILADOR"] = 0;$nc["OR15"]["ACOMODADOR"] = 0;

        //16
        $nc["OR16"]["DIVERGENTE"] = 0;$nc["OR16"]["CONVERGENTE"] = 0;$nc["OR16"]["ASIMILADOR"] = 0;$nc["OR16"]["ACOMODADOR"] = 0;

        //17
        $nc["OR17"]["DIVERGENTE"] = 0;$nc["OR17"]["CONVERGENTE"] = 0;$nc["OR17"]["ASIMILADOR"] = 0;$nc["OR17"]["ACOMODADOR"] = 0;


        //18
        $nc["OR18"]["DIVERGENTE"] = 0;$nc["OR18"]["CONVERGENTE"] = 0;$nc["OR18"]["ASIMILADOR"] = 0;$nc["OR18"]["ACOMODADOR"] = 0;

        //19
        $nc["OR19"]["DIVERGENTE"] = 0;$nc["OR19"]["CONVERGENTE"] = 0;$nc["OR19"]["ASIMILADOR"] = 0;$nc["OR19"]["ACOMODADOR"] = 0;

        //20
        $nc["OR20"]["DIVERGENTE"] = 0;$nc["OR20"]["CONVERGENTE"] = 0;$nc["OR20"]["ASIMILADOR"] = 0;$nc["OR20"]["ACOMODADOR"] = 0;
        
        //21
        $nc["OR21"]["DIVERGENTE"] = 0;$nc["OR21"]["CONVERGENTE"] = 0;$nc["OR21"]["ASIMILADOR"] = 0;$nc["OR21"]["ACOMODADOR"] = 0;

        //22
        $nc["OR22"]["DIVERGENTE"] = 0;$nc["OR22"]["CONVERGENTE"] = 0;$nc["OR22"]["ASIMILADOR"] = 0;$nc["OR22"]["ACOMODADOR"] = 0;

        //23
        $nc["OR23"]["DIVERGENTE"] = 0;$nc["OR23"]["CONVERGENTE"] = 0;$nc["OR23"]["ASIMILADOR"] = 0;$nc["OR23"]["ACOMODADOR"] = 0;

        //24
        $nc["OR24"]["DIVERGENTE"] = 0; $nc["OR24"]["CONVERGENTE"] = 0;$nc["OR24"]["ASIMILADOR"] = 0;$nc["OR24"]["ACOMODADOR"] = 0;


        //Obtiene el numero de apariciones de cada caracteristica para cada estilo de estudiante
        //CA
        foreach ($data as $item) {
            $c = 6;
            while($c <=24){
                
                if ($item["estilo"] == "DIVERGENTE" && $item["ca"] == $c) {

                    $nc["CA".$c]["DIVERGENTE"]++;
                } elseif ($item["estilo"] == "CONVERGENTE" && $item["ca"] == $c) {

                    $nc["CA".$c]["CONVERGENTE"]++;
                } elseif ($item["estilo"] == "ASIMILADOR" && $item["ca"] == $c) {

                    $nc["CA".$c]["ASIMILADOR"]++;
                } elseif ($item["estilo"] == "ACOMODADOR" && $item["ca"] == $c) {

                    $nc["CA".$c]["ACOMODADOR"]++;
                }

                $c++;
            }   
        }//FIN FOR

        //EA
        foreach ($data as $item) {
            $c = 6;
            while($c <=24){
                
                if ($item["estilo"] == "DIVERGENTE" && $item["ea"] == $c) {

                    $nc["EA".$c]["DIVERGENTE"]++;
                } elseif ($item["estilo"] == "CONVERGENTE" && $item["ea"] == $c) {

                    $nc["EA".$c]["CONVERGENTE"]++;
                } elseif ($item["estilo"] == "ASIMILADOR" && $item["ea"] == $c) {

                    $nc["EA".$c]["ASIMILADOR"]++;
                } elseif ($item["estilo"] == "ACOMODADOR" && $item["ea"] == $c) {

                    $nc["EA".$c]["ACOMODADOR"]++;
                }

                $c++;
            }   
        }//FIN FOR


        //EC
        foreach ($data as $item) {
            $c = 6;
            while($c <=24){
                
                if ($item["estilo"] == "DIVERGENTE" && $item["ec"] == $c) {

                    $nc["EC".$c]["DIVERGENTE"]++;
                } elseif ($item["estilo"] == "CONVERGENTE" && $item["ec"] == $c) {

                    $nc["EC".$c]["CONVERGENTE"]++;
                } elseif ($item["estilo"] == "ASIMILADOR" && $item["ec"] == $c) {

                    $nc["EC".$c]["ASIMILADOR"]++;
                } elseif ($item["estilo"] == "ACOMODADOR" && $item["ec"] == $c) {

                    $nc["EC".$c]["ACOMODADOR"]++;
                }

                $c++;
            }   
        }//FIN FOR

        //OR

        foreach ($data as $item) {
            $c = 6;
            while($c <=24){
                
                if ($item["estilo"] == "DIVERGENTE" && $item["or"] == $c) {

                    $nc["OR".$c]["DIVERGENTE"]++;
                } elseif ($item["estilo"] == "CONVERGENTE" && $item["or"] == $c) {

                    $nc["OR".$c]["CONVERGENTE"]++;
                } elseif ($item["estilo"] == "ASIMILADOR" && $item["or"] == $c) {

                    $nc["OR".$c]["ASIMILADOR"]++;
                } elseif ($item["estilo"] == "ACOMODADOR" && $item["or"] == $c) {

                    $nc["OR".$c]["ACOMODADOR"]++;
                }

                $c++;
            }   
        }//FIN FOR




        //MULTIPLICACION DE CARACTERISTICAS POR ESTILO
        //CA
        $cont = 6;
        while($cont <= 24){
            //Probabilidades de frecuencia para divergente
            $pfDivergente["CA".$cont] = (($nc["CA".$cont]["DIVERGENTE"]) + ($m * $pCA)) / ($n["divergente"] + $m);

            //Probabilidades de frecuencia para convergente 
            $pfConvergente["CA".$cont] = (($nc["CA".$cont]["CONVERGENTE"]) + ($m * $pCA)) / ($n["convergente"] + $m);

            //Probabilidades de frecuencia para asimilador 
            $pfAsimilador["CA".$cont] = (($nc["CA".$cont]["ASIMILADOR"]) + ($m * $pCA)) / ($n["asimilador"] + $m);

            //Probabilidades de frecuencia para acomodador 
            $pfAcomodador["CA".$cont] = (($nc["CA".$cont]["ACOMODADOR"]) + ($m * $pCA)) / ($n["acomodador"] + $m);
        
            $cont++;
        }

        //EC
        $cont = 6;
        while($cont <= 24){
            //Probabilidades de frecuencia para divergente
            $pfDivergente["EC".$cont] = (($nc["EC".$cont]["DIVERGENTE"]) + ($m * $pEC)) / ($n["divergente"] + $m);

            //Probabilidades de frecuencia para convergente 
            $pfConvergente["EC".$cont] = (($nc["EC".$cont]["CONVERGENTE"]) + ($m * $pEC)) / ($n["convergente"] + $m);

            //Probabilidades de frecuencia para asimilador 
            $pfAsimilador["EC".$cont] = (($nc["EC".$cont]["ASIMILADOR"]) + ($m * $pEC)) / ($n["asimilador"] + $m);

            //Probabilidades de frecuencia para acomodador 
            $pfAcomodador["EC".$cont] = (($nc["EC".$cont]["ACOMODADOR"]) + ($m * $pEC)) / ($n["acomodador"] + $m);
        
            $cont++;
        }

        //EA
        $cont = 6;
        while($cont <= 24){
            //Probabilidades de frecuencia para divergente
            $pfDivergente["EA".$cont] = (($nc["EA".$cont]["DIVERGENTE"]) + ($m * $pEA)) / ($n["divergente"] + $m);

            //Probabilidades de frecuencia para convergente 
            $pfConvergente["EA".$cont] = (($nc["EA".$cont]["CONVERGENTE"]) + ($m * $pEA)) / ($n["convergente"] + $m);

            //Probabilidades de frecuencia para asimilador 
            $pfAsimilador["EA".$cont] = (($nc["EA".$cont]["ASIMILADOR"]) + ($m * $pEA)) / ($n["asimilador"] + $m);

            //Probabilidades de frecuencia para acomodador 
            $pfAcomodador["EA".$cont] = (($nc["EA".$cont]["ACOMODADOR"]) + ($m * $pEA)) / ($n["acomodador"] + $m);
        
            $cont++;
        }

        //OR
        $cont = 6;
        while($cont <= 24){
            //Probabilidades de frecuencia para divergente
            $pfDivergente["OR".$cont] = (($nc["OR".$cont]["DIVERGENTE"]) + ($m * $pOR)) / ($n["divergente"] + $m);

            //Probabilidades de frecuencia para convergente 
            $pfConvergente["OR".$cont] = (($nc["OR".$cont]["CONVERGENTE"]) + ($m * $pOR)) / ($n["convergente"] + $m);

            //Probabilidades de frecuencia para asimilador 
            $pfAsimilador["OR".$cont] = (($nc["OR".$cont]["ASIMILADOR"]) + ($m * $pOR)) / ($n["asimilador"] + $m);

            //Probabilidades de frecuencia para acomodador 
            $pfAcomodador["OR".$cont] = (($nc["OR".$cont]["ACOMODADOR"]) + ($m * $pOR)) / ($n["acomodador"] + $m);
        
            $cont++;
        }
        

        //NO SEGUIR
        //ESTO ES LO QUE SE GUARDA
        $vEstiloAprendizaje["Divergente"] = $pfDivergente;

        //Probabilidades de frecuencia para intermediate 
        $vEstiloAprendizaje["Convergente"] = $pfConvergente;

        //Probabilidades de frecuencia para advanced 
        $vEstiloAprendizaje["Asimilador"] = $pfAsimilador;

        //Probabilidades de frecuencia para advanced 
        $vEstiloAprendizaje["Acomodador"] = $pfAcomodador;

        $arr = json_encode($vEstiloAprendizaje);

        $fp = fopen('resultados_estilo_aprendizaje.json', 'w');
        fwrite($fp, json_encode($vEstiloAprendizaje));
        fclose($fp);

    }


    public function adivinarEstilo(){
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $data = $tarea->obtenerDatosEstilo();
        //Numero de apariciones de cada clase de estilo en los datos
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


        //Una vez que se obtienen los datos del usuario se comparan con los datos ya guardados
        //este seria la segunda parte del algoritmo de BAYES

        // Obtiene los datos previos 
        $prob_previas = file_get_contents("resultados_estilo_aprendizaje.json");

        $arr = json_decode($prob_previas, true);

        //Probabilidades de clase
        $pDiver = $n["divergente"] / sizeof($data);
        $pConver = $n["convergente"] / sizeof($data);
        $pAsim = $n["asimilador"] / sizeof($data);
        $pAcom = $n["acomodador"] / sizeof($data);

        //Multiplicacion de todas las caracteristicas para divergente
        $valorDivergente = $arr['Divergente']['CA' . $ca] * $arr['Divergente']['EC' . $ec]
        * $arr['Divergente']['EA' . $ea] * $arr['Divergente']['OR' . $or];
    
        //Multiplicacion de ese valor por la prior probability de divergente
        $valorFinalDivergente = $valorDivergente * $pDiver;

        //Multiplicacion de todas las caracteristicas para convergente
        $valorConvergente = $arr['Convergente']['CA' . $ca] * $arr['Convergente']['EC' . $ec]
            * $arr['Convergente']['EA' . $ea] * $arr['Convergente']['OR' . $or];

        //Multiplicacion de ese valor por la prior probability de convergente
        $valorFinalConvergente = $valorConvergente * $pConver;

        //Multiplicacion de todas las caracteristicas para asimilador
        $valorAsimilador = $arr['Asimilador']['CA' . $ca] * $arr['Asimilador']['EC' . $ec]
        * $arr['Asimilador']['EA' . $ea] * $arr['Asimilador']['OR' . $or];

        //Multiplicacion de ese valor por la prior probability de asimilador
        $valorFinalAsimilador = $valorAsimilador * $pAsim;

        //Multiplicacion de todas las caracteristicas para acomodador
        $valorAcomodador = $arr['Acomodador']['CA' . $ca] * $arr['Acomodador']['EC' . $ec]
        * $arr['Acomodador']['EA' . $ea] * $arr['Acomodador']['OR' . $or];

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

        $this->view->show("indexView.php", $estilo);


    }



}//fin clase