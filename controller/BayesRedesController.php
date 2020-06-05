 <?php

    class BayesRedesController
    {
        private $view;
        public function __construct()
        {
            $this->view = new View();
        } //construct

        /* 
        Se encarga de obtener la data de red(para adivinar clase) y trabajarla para guardar las probabilidades en un nuevo archivo,
        para luego solo consultar las probabilidades en el mismo, y no volver a calcular
    */

        public function datosRedes()
        {
            require 'model/TareaModel.php';
            $tarea = new TareaModel();

            $vector_bd = $tarea->obtenerDatosRedes();


            //Se ordenan los datos correspondientes a cada columna y se guardan en un array para mayor facilidad de iterar
            $index = 0;
            foreach ($vector_bd as $row) {
                $data[$index]["re"] = $row["re"];
                $data[$index]["li"] = $row["li"];
                $data[$index]["ca"] = $row["ca"];
                $data[$index]["co"] = $row["co"];
                $data[$index]["class"] = $row["class"];

                $index++;
            }


            //Llama al algoritmo de bayes para redes y guarda las probabilidades en un archivo

            $this->guardarProbabilidadesRedes($data);
        }

        //Se obtiene las probabilidades y se guardan en un archivo
        public function guardarProbabilidadesRedes($data)
        {
            //Se obtiene el valor de cada caracteristica **** numero de opciones por caracteristica
            $re = 4;
            $li = 14;
            $ca = 3;
            $co = 3;

            //Se obtiene el valor de m al contar el numero de columnas o caracteristicas y restando la que corresponde a estilo
            $m = count($data[0]) - 1;

            //Se saca la probabilidad para cada caracteristica (p)
            $pRe = 1 / $re;
            $pLi = 1 / $li;
            $pCa = 1 / $ca;
            $pCo = 1 / $co;

            //Numero de apariciones de cada clase de red     en los datos
            $n["a"] = 0;
            $n["b"] = 0;

            foreach ($data as $item) {
                if ($item["class"] == "A") {
                    $n["a"] = $n["a"] + 1;
                } elseif ($item["class"] == "B") {
                    $n["b"] = $n["b"] + 1;
                }
            }

            /*
        Se obtiene el numero de instancias [nc] donde nc sera una matriz,
        donde la primera casilla es el dato (estilo,promedio,sexo) y la segunda
        el recinto asociado a ese dato (turrialba,paraiso)
        */

            //Cantidades de RE(fiabilidad) por cada clase de red
            //2
            $nc["re2"]["A"] = 0;
            $nc["re2"]["B"] = 0;
            //3
            $nc["re3"]["A"] = 0;
            $nc["re3"]["B"] = 0;
            //4
            $nc["re4"]["A"] = 0;
            $nc["re4"]["B"] = 0;
            //5
            $nc["re5"]["A"] = 0;
            $nc["re5"]["B"] = 0;

            //Cantidades para LI(enlaces) por clase de red
            $nc["li7"]["A"] = 0;
            $nc["li7"]["B"] = 0;

            $nc["li8"]["A"] = 0;
            $nc["li8"]["B"] = 0;

            $nc["li9"]["A"] = 0;
            $nc["li9"]["B"] = 0;

            $nc["li10"]["A"] = 0;
            $nc["li10"]["B"] = 0;

            $nc["li11"]["A"] = 0;
            $nc["li11"]["B"] = 0;

            $nc["li12"]["A"] = 0;
            $nc["li12"]["B"] = 0;

            $nc["li13"]["A"] = 0;
            $nc["li13"]["B"] = 0;

            $nc["li14"]["A"] = 0;
            $nc["li14"]["B"] = 0;

            $nc["li15"]["A"] = 0;
            $nc["li15"]["B"] = 0;

            $nc["li16"]["A"] = 0;
            $nc["li16"]["B"] = 0;

            $nc["li17"]["A"] = 0;
            $nc["li17"]["B"] = 0;

            $nc["li18"]["A"] = 0;
            $nc["li18"]["B"] = 0;

            $nc["li19"]["A"] = 0;
            $nc["li19"]["B"] = 0;

            $nc["li20"]["A"] = 0;
            $nc["li20"]["B"] = 0;

            //Cantidades para CA(Capacidad) por clase
            $nc["caLow"]["A"] = 0;
            $nc["caLow"]["B"] = 0;

            $nc["caMedium"]["A"] = 0;
            $nc["caMedium"]["B"] = 0;

            $nc["caHigh"]["A"] = 0;
            $nc["caHigh"]["B"] = 0;

            //Cantidades para CO(Costo) por clase
            $nc["coLow"]["A"] = 0;
            $nc["coLow"]["B"] = 0;

            $nc["coMedium"]["A"] = 0;
            $nc["coMedium"]["B"] = 0;

            $nc["coHigh"]["A"] = 0;
            $nc["coHigh"]["B"] = 0;

            //Obtiene el numero de apariciones de cada caracteristica para cada clase de red
            foreach ($data as $item) {

                //RE 2,3,4,5
                if ($item["class"] == "A" && $item["re"] == 2) {

                    $nc["re2"]["A"]++;
                } elseif ($item["class"] == "B" && $item["re"] == 2) {

                    $nc["re2"]["B"]++;
                }

                //3
                if ($item["class"] == "A" && $item["re"] == 3) {

                    $nc["re3"]["A"]++;
                } elseif ($item["class"] == "B" && $item["re"] == 3) {

                    $nc["re3"]["B"]++;
                }

                //4
                if ($item["class"] == "A" && $item["re"] == 4) {

                    $nc["re4"]["A"]++;
                } elseif ($item["class"] == "B" && $item["re"] == 4) {

                    $nc["re4"]["B"]++;
                }

                //5
                if ($item["class"] == "A" && $item["re"] == 5) {

                    $nc["re5"]["A"]++;
                } elseif ($item["class"] == "B" && $item["re"] == 5) {

                    $nc["re5"]["B"]++;
                }


                //LI 7-20
                if ($item["class"] == "A" && $item["li"] == 7) {

                    $nc["li7"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 7) {

                    $nc["li7"]["B"]++;
                }

                //8
                if ($item["class"] == "A" && $item["li"] == 8) {

                    $nc["li8"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 8) {

                    $nc["li8"]["B"]++;
                }

                //9
                if ($item["class"] == "A" && $item["li"] == 9) {

                    $nc["li9"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 9) {

                    $nc["li9"]["B"]++;
                }

                //10
                if ($item["class"] == "A" && $item["li"] == 10) {

                    $nc["li10"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 10) {

                    $nc["li10"]["B"]++;
                }

                //11
                if ($item["class"] == "A" && $item["li"] == 11) {

                    $nc["li11"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 11) {

                    $nc["li11"]["B"]++;
                }

                //12
                if ($item["class"] == "A" && $item["li"] == 12) {

                    $nc["li12"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 12) {

                    $nc["li12"]["B"]++;
                }

                //13
                if ($item["class"] == "A" && $item["li"] == 13) {

                    $nc["li13"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 13) {

                    $nc["li13"]["B"]++;
                }

                //14
                if ($item["class"] == "A" && $item["li"] == 14) {

                    $nc["li14"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 14) {

                    $nc["li14"]["B"]++;
                }

                //15
                if ($item["class"] == "A" && $item["li"] == 15) {

                    $nc["li15"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 15) {

                    $nc["li15"]["B"]++;
                }

                //16
                if ($item["class"] == "A" && $item["li"] == 16) {

                    $nc["li16"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 16) {

                    $nc["li16"]["B"]++;
                }

                //17
                if ($item["class"] == "A" && $item["li"] == 17) {

                    $nc["li17"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 17) {

                    $nc["li17"]["B"]++;
                }

                //18
                if ($item["class"] == "A" && $item["li"] == 18) {

                    $nc["li18"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 18) {

                    $nc["li18"]["B"]++;
                }

                //19
                if ($item["class"] == "A" && $item["li"] == 19) {

                    $nc["li19"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 19) {

                    $nc["li19"]["B"]++;
                }

                //20
                if ($item["class"] == "A" && $item["li"] == 20) {

                    $nc["li20"]["A"]++;
                } elseif ($item["class"] == "B" && $item["li"] == 20) {

                    $nc["li20"]["B"]++;
                }


                //Cantidad para CA(Capacidad)
                if ($item["class"] == "A" && $item["ca"] == "Low") {

                    $nc["caLow"]["A"]++;
                } elseif ($item["class"] == "B" && $item["ca"] == "Low") {

                    $nc["caLow"]["B"]++;
                }

                //Medium
                if ($item["class"] == "A" && $item["ca"] == "Medium") {

                    $nc["caMedium"]["A"]++;
                } elseif ($item["class"] == "B" && $item["ca"] == "Medium") {

                    $nc["caMedium"]["B"]++;
                }

                //High
                if ($item["class"] == "A" && $item["ca"] == "High") {

                    $nc["caHigh"]["A"]++;
                } elseif ($item["class"] == "B" && $item["ca"] == "High") {

                    $nc["caHigh"]["B"]++;
                }


                //Cantidad para CO (Costo)
                if ($item["class"] == "A" && $item["co"] == "Low") {

                    $nc["coLow"]["A"]++;
                } elseif ($item["class"] == "B" && $item["co"] == "Low") {

                    $nc["coLow"]["B"]++;
                }

                //Medium
                if ($item["class"] == "A" && $item["co"] == "Medium") {

                    $nc["coMedium"]["A"]++;
                } elseif ($item["class"] == "B" && $item["co"] == "Medium") {

                    $nc["coMedium"]["B"]++;
                }

                //High
                if ($item["class"] == "A" && $item["co"] == "High") {

                    $nc["coHigh"]["A"]++;
                } elseif ($item["class"] == "B" && $item["co"] == "High") {

                    $nc["coHigh"]["B"]++;
                }
            } //fin for


            //Probabilidad de cada re por clase
            //2:
            $pfA["re2"] = (($nc["re2"]["A"]) + ($m * $pRe)) / ($n["a"] + $m);

            $pfB["re2"] = (($nc["re2"]["B"]) + ($m * $pRe)) / ($n["b"] + $m);

            //3
            $pfA["re3"] = (($nc["re3"]["A"]) + ($m * $pRe)) / ($n["a"] + $m);

            $pfB["re3"] = (($nc["re3"]["B"]) + ($m * $pRe)) / ($n["b"] + $m);

            //4
            $pfA["re4"] = (($nc["re4"]["A"]) + ($m * $pRe)) / ($n["a"] + $m);

            $pfB["re4"] = (($nc["re4"]["B"]) + ($m * $pRe)) / ($n["b"] + $m);

            //5
            $pfA["re5"] = (($nc["re5"]["A"]) + ($m * $pRe)) / ($n["a"] + $m);

            $pfB["re5"] = (($nc["re5"]["B"]) + ($m * $pRe)) / ($n["b"] + $m);


            //Probabilidad para LI por clase
            //7
            $pfA["li7"] = (($nc["li7"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li7"] = (($nc["li7"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);

            //8
            $pfA["li8"] = (($nc["li8"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li8"] = (($nc["li8"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);

            //9
            $pfA["li9"] = (($nc["li9"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li9"] = (($nc["li9"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);

            //10
            $pfA["li10"] = (($nc["li10"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li10"] = (($nc["li10"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);

            //11
            $pfA["li11"] = (($nc["li11"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li11"] = (($nc["li11"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);

            //12
            $pfA["li12"] = (($nc["li12"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li12"] = (($nc["li12"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);

            //13
            $pfA["li13"] = (($nc["li13"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li13"] = (($nc["li13"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);


            //14
            $pfA["li14"] = (($nc["li14"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li14"] = (($nc["li14"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);


            //15
            $pfA["li15"] = (($nc["li15"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li15"] = (($nc["li15"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);


            //16
            $pfA["li16"] = (($nc["li16"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li16"] = (($nc["li16"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);


            //17
            $pfA["li17"] = (($nc["li17"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li17"] = (($nc["li17"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);



            //18
            $pfA["li18"] = (($nc["li18"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li18"] = (($nc["li18"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);


            //19
            $pfA["li19"] = (($nc["li19"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li19"] = (($nc["li19"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);



            //20
            $pfA["li20"] = (($nc["li20"]["A"]) + ($m * $pLi)) / ($n["a"] + $m);

            $pfB["li20"] = (($nc["li20"]["B"]) + ($m * $pLi)) / ($n["b"] + $m);

            //Probabilidad de CA (Capacidad)
            //Low
            $pfA["caLow"] = (($nc["caLow"]["A"]) + ($m * $pCa)) / ($n["a"] + $m);

            $pfB["caLow"] = (($nc["caLow"]["B"]) + ($m * $pCa)) / ($n["b"] + $m);

            //Medium
            $pfA["caMedium"] = (($nc["caMedium"]["A"]) + ($m * $pCa)) / ($n["a"] + $m);

            $pfB["caMedium"] = (($nc["caMedium"]["B"]) + ($m * $pCa)) / ($n["b"] + $m);

            //High

            $pfA["caHigh"] = (($nc["caHigh"]["A"]) + ($m * $pCa)) / ($n["a"] + $m);

            $pfB["caHigh"] = (($nc["caHigh"]["B"]) + ($m * $pCa)) / ($n["b"] + $m);


            //Probabilidad de CO (Costo)
            //Low
            $pfA["coLow"] = (($nc["coLow"]["A"]) + ($m * $pCo)) / ($n["a"] + $m);

            $pfB["coLow"] = (($nc["coLow"]["B"]) + ($m * $pCo)) / ($n["b"] + $m);

            //Medium
            $pfA["coMedium"] = (($nc["coMedium"]["A"]) + ($m * $pCo)) / ($n["a"] + $m);

            $pfB["coMedium"] = (($nc["coMedium"]["B"]) + ($m * $pCo)) / ($n["b"] + $m);

            //High

            $pfA["coHigh"] = (($nc["coHigh"]["A"]) + ($m * $pCo)) / ($n["a"] + $m);

            $pfB["coHigh"] = (($nc["coHigh"]["B"]) + ($m * $pCo)) / ($n["b"] + $m);


            //ESTO ES LO QUE SE GUARDA
            $vClaseRed["A"] = $pfA;


            $vClaseRed["B"] = $pfB;

            $arr = json_encode($vClaseRed);


            $fp = fopen('resultados_clase_red.json', 'w');
            fwrite($fp, json_encode($vClaseRed));
            fclose($fp);
        }


        //Recibe los datos del usuario para compararlos
        public function adivinarClaseRed()
        {

            require 'model/TareaModel.php';
            $tarea = new TareaModel();

            $data = $tarea->obtenerDatosRedes();

            //Numero de apariciones de cada clase en los datos
            $n["a"] = 0;
            $n["b"] = 0;

            foreach ($data as $item) {
                if ($item["class"] == "A") {
                    $n["a"] = $n["a"] + 1;
                } elseif ($item["class"] == "B") {
                    $n["b"] = $n["b"] + 1;
                }
            } //for


            //Datos del usuario que corresponden a cada columna de datos
            $re = $_POST['Re'];
            $li = $_POST['Li'];
            $ca = $_POST['Ca'];
            $co = $_POST['Co'];

            //Una vez que se obtienen los datos del usuario se comparan con los datos ya guardados
            //este seria la segunda parte del algoritmo de BAYES

            // Obtiene los datos previos 
            $prob_previas = file_get_contents("resultados_clase_red.json");

            $arr = json_decode($prob_previas, true);

            //Probabilidades de clase
            $pA = $n["a"] / sizeof($data);
            $pB = $n["b"] / sizeof($data);

            //Multiplicacion de todas las caracteristicas para A
            $valorA = $arr['A']['re' . $re] * $arr['A']['li' . $li]
                * $arr['A']['ca' . $ca] *  $arr['A']['co' . $co];

            //Multiplicacion de ese valor por la prior probability de A
            $valorFinalA = $valorA * $pA;

            //Multiplicacion de todas las caracteristicas para B
            $valorB = $arr['B']['re' . $re] * $arr['B']['li' . $li]
                * $arr['B']['ca' . $ca] *  $arr['B']['co' . $co];

            //Multiplicacion de ese valor por la prior probability de B
            $valorFinalB = $valorB * $pB;


            //Una vez que se tiene los datos se obtiene el mayor
            $resultados = array($valorFinalA, $valorFinalB);
            $mayor = max($resultados);

            if ($mayor == $valorFinalA) {
                $clase = "A";
            } elseif ($mayor == $valorFinalB) {
                $clase = "B";
            }

            $this->view->show("tipoRedesView.php", $clase);
        }
    }//fin clase
