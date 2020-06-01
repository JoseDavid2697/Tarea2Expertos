<?php

class BayesController
{
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } //construct


    /* 
        Se encarga de obtener la data de profesor y trabajarla para guardar las probabilidades en un nuevo archivo,
        para luego solo consultar las probabilidades en el mismo, y no volver a calcular
    */
    public function datosProfesor()
    {
        require 'model/TareaModel.php';
        $tarea = new TareaModel();

        $vector_bd = $tarea->obtenerDatosProfesor();

        //Se ordenan los datos correspondientes a cada columna y se guardan en un array para mayor facilidad de iterar
        $index = 0;
        foreach ($vector_bd as $row) {
            $data[$index]["a"] = $row["a"];
            $data[$index]["b"] = $row["b"];
            $data[$index]["c"] = $row["c"];
            $data[$index]["d"] = $row["d"];
            $data[$index]["e"] = $row["e"];
            $data[$index]["f"] = $row["f"];
            $data[$index]["g"] = $row["g"];
            $data[$index]["h"] = $row["h"];
            $data[$index]["class"] = $row["class"];

            $index++;
        }

        $this->guardarProbabilidadesProfesor($data);
    }

    public function calcularTipoProfesor()
    {

        //Datos del usuario que corresponden a cada columna de datos
        $a = $_POST['A'];
        $b = $_POST['B'];
        $c = $_POST['C'];
        $d = $_POST['D'];
        $e = $_POST['E'];
        $f = $_POST['F'];
        $g = $_POST['G'];
        $h = $_POST['H'];

        //A - EDAD
        $vector_usuario['a'] = $a;
        //B
        $vector_usuario['b'] = $b;
        //C
        $vector_usuario['c'] = $c;
        //D
        $vector_usuario['d'] = $d;
        //E
        $vector_usuario['e'] = $e;
        //F
        $vector_usuario['f'] = $f;
        //G
        $vector_usuario['g'] = $g;
        //H
        $vector_usuario['h'] = $h;

        $this->datosProfesor();

        //LLAMAR A CONSULTAR EL ARCHIVO PASANDO EL VECTOR USUARIO COMO PARAMETRO

        //$resultado = obtenerProbabilidad($vector_usuario);
    }



    //Algoritmo de BAYES que guarda las probabilidades para el caso de profesor
    public function guardarProbabilidadesProfesor($data)
    {
        //Se obtiene el valor de cada caracteristica **** numero de opciones por caracteristica
        $a = 3;
        $b = 3;
        $c = 3;
        $d = 3;
        $e = 3;
        $f = 3;
        $g = 3;
        $h = 3;

        //Se obtiene el valor de m al contar el numero de columnas o caracteristicas y restando la que corresponde a la clase [class]
        $m = count($data[0]) - 1;

        //Se saca la probabilidad para cada caracteristica 
        $pA = 1 / $a;
        $pB = 1 / $b;
        $pC = 1 / $c;
        $pD = 1 / $d;
        $pE = 1 / $e;
        $pF = 1 / $f;
        $pG = 1 / $g;
        $pH = 1 / $h;

        //Probabilidades de clase
        $pBegin = 3 / sizeof($data);
        $pInterm = 3 / sizeof($data);
        $pAdvan = 3 / sizeof($data);

        //Numero de apariciones de cada clase en los datos
        $n["b"] = 0;
        $n["i"] = 0;
        $n["a"] = 0;

        foreach ($data as $item) {
            if ($item["class"] == "Beginner") {
                $n["b"] = $n["b"] + 1;
            } elseif ($item["class"] == "Intermediate") {
                $n["i"] = $n["i"] + 1;
            } else {
                $n["a"] = $n["a"] + 1;
            }
        }


        /*
        Se obtiene el numero de instancias [nc] donde nc sera una matriz,
        donde la primera casilla es el dato (edad,sexo, etc) y la segunda
        la clase asociada a ese dato (Beginner, Intermediate, Advanced)

        ACLARACION: Si la casilla es A3 entonces se refiere al dato "3" en la columna A
         de la data para trabajar en este caso la base de datos
        */

        //Cantidades pra rango de edad
        $nc["A3"]["Beginner"] = 0;
        $nc["A3"]["Intermediate"] = 0;
        $nc["A3"]["Advanced"] = 0;

        $nc["A2"]["Beginner"] = 0;
        $nc["A2"]["Intermediate"] = 0;
        $nc["A2"]["Advanced"] = 0;

        $nc["A1"]["Beginner"] = 0;
        $nc["A1"]["Intermediate"] = 0;
        $nc["A1"]["Advanced"] = 0;

        //Genero
        $nc["BF"]["Beginner"] = 0;
        $nc["BF"]["Intermediate"] = 0;
        $nc["BF"]["Advanced"] = 0;

        $nc["BM"]["Beginner"] = 0;
        $nc["BM"]["Intermediate"] = 0;
        $nc["BM"]["Advanced"] = 0;

        $nc["BNA"]["Beginner"] = 0;
        $nc["BNA"]["Intermediate"] = 0;
        $nc["BNA"]["Advanced"] = 0;

        //Evaluacion propia
        $nc["CB"]["Beginner"] = 0;
        $nc["CB"]["Intermediate"] = 0;
        $nc["CB"]["Advanced"] = 0;

        $nc["CI"]["Beginner"] = 0;
        $nc["CI"]["Intermediate"] = 0;
        $nc["CI"]["Advanced"] = 0;

        $nc["CA"]["Beginner"] = 0;
        $nc["CA"]["Intermediate"] = 0;
        $nc["CA"]["Advanced"] = 0;

        //Numero de veces que ha ensenado un curso
        $nc["D1"]["Beginner"] = 0;
        $nc["D1"]["Intermediate"] = 0;
        $nc["D1"]["Advanced"] = 0;

        $nc["D2"]["Beginner"] = 0;
        $nc["D2"]["Intermediate"] = 0;
        $nc["D2"]["Advanced"] = 0;

        $nc["D3"]["Beginner"] = 0;
        $nc["D3"]["Intermediate"] = 0;
        $nc["D3"]["Advanced"] = 0;

        //Aprendizaje previo en la disciplina
        $nc["EDM"]["Beginner"] = 0;
        $nc["EDM"]["Intermediate"] = 0;
        $nc["EDM"]["Advanced"] = 0;

        $nc["END"]["Beginner"] = 0;
        $nc["END"]["Intermediate"] = 0;
        $nc["END"]["Advanced"] = 0;

        $nc["EO"]["Beginner"] = 0;
        $nc["EO"]["Intermediate"] = 0;
        $nc["EO"]["Advanced"] = 0;

        //habilidad usando computadoras
        $nc["FL"]["Beginner"] = 0;
        $nc["FL"]["Intermediate"] = 0;
        $nc["FL"]["Advanced"] = 0;

        $nc["FA"]["Beginner"] = 0;
        $nc["FA"]["Intermediate"] = 0;
        $nc["FA"]["Advanced"] = 0;

        $nc["FH"]["Beginner"] = 0;
        $nc["FH"]["Intermediate"] = 0;
        $nc["FH"]["Advanced"] = 0;

        //exp usando tecnologia web
        $nc["GN"]["Beginner"] = 0;
        $nc["GN"]["Intermediate"] = 0;
        $nc["GN"]["Advanced"] = 0;

        $nc["GS"]["Beginner"] = 0;
        $nc["GS"]["Intermediate"] = 0;
        $nc["GS"]["Advanced"] = 0;

        $nc["GO"]["Beginner"] = 0;
        $nc["GO"]["Intermediate"] = 0;
        $nc["GO"]["Advanced"] = 0;

        //exp usando sitios web
        $nc["HN"]["Beginner"] = 0;
        $nc["HN"]["Intermediate"] = 0;
        $nc["HN"]["Advanced"] = 0;

        $nc["HS"]["Beginner"] = 0;
        $nc["HS"]["Intermediate"] = 0;
        $nc["HS"]["Advanced"] = 0;

        $nc["HO"]["Beginner"] = 0;
        $nc["HO"]["Intermediate"] = 0;
        $nc["HO"]["Advanced"] = 0;


        //Obtiene el numero de apariciones de cada caracteristica para cada clase de profesor

        foreach ($data as $item) {
            //Clase Beginner,Intermediate o Advanced con rango de edad 3, 2 o 1
            if ($item["class"] == "Beginner" && $item["a"] == 3) {
                $nc["A3"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["a"] == 3) {
                $nc["A3"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["a"] == 3) {
                $nc["A3"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["a"] == 2) {
                $nc["A2"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["a"] == 2) {
                $nc["A2"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["a"] == 2) {
                $nc["A2"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["a"] == 1) {
                $nc["A1"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["a"] == 1) {
                $nc["A1"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["a"] == 1) {
                $nc["A1"]["Advanced"]++;
            }

            //Clase Beginner,Intermediate o Advanced con genero M,F o NA
            if ($item["class"] == "Beginner" && $item["b"] == "F") {
                $nc["BF"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["b"] == "F") {
                $nc["BF"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["b"] == "F") {
                $nc["BF"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["b"] == "M") {
                $nc["BM"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["b"] == "M") {
                $nc["BM"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["b"] == "M") {
                $nc["BM"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["b"] == "NA") {
                $nc["BNA"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["b"] == "NA") {
                $nc["BNA"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["b"] == "NA") {
                $nc["BNA"]["Advanced"]++;
            }

            //Clase Beginner,Intermediate o Advanced con evaluacion B,I o A
            if ($item["class"] == "Beginner" && $item["c"] == "B") {
                $nc["CB"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["c"] == "B") {
                $nc["CB"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["c"] == "B") {
                $nc["CB"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["c"] == "I") {
                $nc["CI"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["c"] == "I") {
                $nc["CI"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["c"] == "I") {
                $nc["CI"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["c"] == "A") {
                $nc["CA"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["c"] == "A") {
                $nc["CA"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["c"] == "A") {
                $nc["CA"]["Advanced"]++;
            }


            //Clase Beginner,Intermediate o Advanced con veces de dar un curso como 1,2 o 3
            if ($item["class"] == "Beginner" && $item["d"] == 1) {
                $nc["D1"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["d"] == 1) {
                $nc["D1"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["d"] == 1) {
                $nc["D1"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["d"] == 2) {
                $nc["D2"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["d"] == 2) {
                $nc["D2"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["d"] == 2) {
                $nc["D2"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["d"] == 3) {
                $nc["D3"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["d"] == 3) {
                $nc["D3"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["d"] == 3) {
                $nc["D3"]["Advanced"]++;
            }

            //Clase Beginner,Intermediate o Advanced con aprendizaje previo dm,nd,O
            if ($item["class"] == "Beginner" && $item["e"] == "DM") {
                $nc["EDM"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["e"] == "DM") {
                $nc["EDM"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["e"] == "DM") {
                $nc["EDM"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["e"] == "ND") {
                $nc["END"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["e"] == "ND") {
                $nc["END"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["e"] == "ND") {
                $nc["END"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["e"] == "O") {
                $nc["EO"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["e"] == "O") {
                $nc["EO"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["e"] == "O") {
                $nc["EO"]["Advanced"]++;
            }

            //Clase Beginner,Intermediate o Advanced con habi. usando compus L,A,H
            if ($item["class"] == "Beginner" && $item["f"] == "L") {
                $nc["FL"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["f"] == "L") {
                $nc["FL"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["f"] == "L") {
                $nc["FL"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["f"] == "A") {
                $nc["FA"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["f"] == "A") {
                $nc["FA"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["f"] == "A") {
                $nc["FA"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["f"] == "H") {
                $nc["FH"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["f"] == "H") {
                $nc["FH"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["f"] == "H") {
                $nc["FH"]["Advanced"]++;
            }

            //Clase Beginner,Intermediate o Advanced con exp usando tecno. web N,S,O
            if ($item["class"] == "Beginner" && $item["g"] == "N") {
                $nc["GN"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["g"] == "N") {
                $nc["GN"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["g"] == "N") {
                $nc["GN"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["g"] == "S") {
                $nc["GS"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["g"] == "S") {
                $nc["GS"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["g"] == "S") {
                $nc["GS"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["g"] == "O") {
                $nc["GO"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["g"] == "O") {
                $nc["GO"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["g"] == "O") {
                $nc["GO"]["Advanced"]++;
            }


            //Clase Beginner,Intermediate o Advanced con exp usando tecno. web N,S,O
            if ($item["class"] == "Beginner" && $item["h"] == "N") {
                $nc["HN"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["h"] == "N") {
                $nc["HN"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["h"] == "N") {
                $nc["HN"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["h"] == "S") {
                $nc["HS"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["h"] == "S") {
                $nc["HS"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["h"] == "S") {
                $nc["HS"]["Advanced"]++;
            }

            if ($item["class"] == "Beginner" && $item["h"] == "O") {
                $nc["HO"]["Beginner"]++;
            } elseif ($item["class"] == "Intermediate" && $item["h"] == "O") {
                $nc["HO"]["Intermediate"]++;
            } elseif ($item["class"] == "Advanced" && $item["h"] == "O") {
                $nc["HO"]["Advanced"]++;
            }
        }

       // $x = json_encode($nc);
        //echo $x;

        //Probabilidad de cada rango de edad por clase
        //3:

        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["A3"] = (($nc["A3"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["A3"] = (($nc["A3"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["A3"] = (($nc["A3"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);

        //2:
        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["A2"] = (($nc["A2"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["A2"] = (($nc["A2"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["A2"] = (($nc["A2"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);

        //1:
        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["A1"] = (($nc["A1"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["A1"] = (($nc["A1"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["A1"] = (($nc["A1"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);

        /*******************************************************************************************************/
        //Probabilidad de cada genero por clase


        //Probabilidades de frecuencia para beginner
        $pfBeginner["BF"] = (($nc["BF"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["BF"] = (($nc["BF"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["BF"] = (($nc["BF"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner
        $pfBeginner["BM"] = (($nc["BM"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["BM"] = (($nc["BM"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["BM"] = (($nc["BM"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner 
        $pfBeginner["BNA"] = (($nc["BNA"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["BNA"] = (($nc["BNA"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["BNA"] = (($nc["BNA"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);

        /*******************************************************************************************************/
        //Probabilidad de cada self education por clase


        //Probabilidades de frecuencia para beginner 
        $pfBeginner["CB"] = (($nc["CB"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["CB"] = (($nc["CB"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["CB"] = (($nc["CB"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["CI"] = (($nc["CI"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["CI"] = (($nc["CI"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["CI"] = (($nc["CI"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["CA"] = (($nc["CA"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["CA"] = (($nc["CA"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["CA"] = (($nc["CA"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);

        /*******************************************************************************************************/
        //Probabilidad de cada vez impartido curso por clase


        //Probabilidades de frecuencia para beginner 
        $pfBeginner["D1"] = (($nc["D1"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["D1"] = (($nc["D1"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["D1"] = (($nc["D1"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["D2"] = (($nc["D2"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["D2"] = (($nc["D2"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["D2"] = (($nc["D2"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["D3"] = (($nc["D3"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["D3"] = (($nc["D3"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["D3"] = (($nc["D3"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);

        /*******************************************************************************************************/
        //Probabilidad de cada aprendizaje previo por clase


        //Probabilidades de frecuencia para beginner 
        $pfBeginner["EDM"] = (($nc["EDM"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["EDM"] = (($nc["EDM"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["EDM"] = (($nc["EDM"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["END"] = (($nc["END"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["END"] = (($nc["END"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["END"] = (($nc["END"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["EO"] = (($nc["EO"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["EO"] = (($nc["EO"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["EO"] = (($nc["EO"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);

        /*******************************************************************************************************/
        //Probabilidad de cada habi. usando compus por clase


        //Probabilidades de frecuencia para beginner 
        $pfBeginner["FL"] = (($nc["FL"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["FL"] = (($nc["FL"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["FL"] = (($nc["FL"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["FA"] = (($nc["FA"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["FA"] = (($nc["FA"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["FA"] = (($nc["FA"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["FH"] = (($nc["FH"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["FH"] = (($nc["FH"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["FH"] = (($nc["FH"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        /*******************************************************************************************************/
        //Probabilidad de cada EXP. usando tecnologia web por clase


        //Probabilidades de frecuencia para beginner 
        $pfBeginner["GN"] = (($nc["GN"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["GN"] = (($nc["GN"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["GN"] = (($nc["GN"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["GS"] = (($nc["GS"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["GS"] = (($nc["GS"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["GS"] = (($nc["GS"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["GO"] = (($nc["GO"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["GO"] = (($nc["GO"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["GO"] = (($nc["GO"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        /*******************************************************************************************************/
        //Probabilidad de cada EXP. USANDO SITIOS web por clase


        //Probabilidades de frecuencia para beginner 
        $pfBeginner["HN"] = (($nc["HN"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["HN"] = (($nc["HN"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["HN"] = (($nc["HN"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["HS"] = (($nc["HS"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["HS"] = (($nc["HS"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["HS"] = (($nc["HS"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);


        //Probabilidades de frecuencia para beginner ** (nc[edad][beginner]+m*p)/(n+m)
        $pfBeginner["HO"] = (($nc["HO"]["Beginner"]) + ($m * $pBegin)) / ($n["b"] + $m);

        //Probabilidades de frecuencia para intermediate 
        $pfIntermediate["HO"] = (($nc["HO"]["Intermediate"]) + ($m * $pInterm)) / ($n["i"] + $m);

        //Probabilidades de frecuencia para advanced 
        $pfAdvanced["HO"] = (($nc["HO"]["Advanced"]) + ($m * $pAdvan)) / ($n["a"] + $m);



        //NO SEGUIR
        //ESTO ES LO QUE SE GUARDA
        $vProf["Beginner"] = $pfBeginner;

        //Probabilidades de frecuencia para intermediate 
        $vProf["Intermediate"] = $pfIntermediate;

        //Probabilidades de frecuencia para advanced 
        $vProf["Advanced"] = $pfAdvanced;

        $arr = json_encode($vProf);
        echo $arr;

        $fp = fopen('resultados_prof.json', 'w');
        fwrite($fp, json_encode($vProf));
        fclose($fp);

        //Se guardan las probabilidades para no calcular, si no mas bien consultar

    }





    public function adivinarTipoProfesor(){
                /* 

        ///////////////////////////////////

        //SE PROCEDE A MULTIPLICAR CADA PROBABILIDAD

        //Primera combinacion de 3

        //Beginner 
        $productoFrecuenciaB[0] = $pfBeginner["A1"] * $pfBeginner["BF"] * $pfBeginner["CB"] * $pfBeginner["D1"] * $pfBeginner["EDM"] * $pfBeginner["FL"] * $pfBeginner["GN"] * $pfBeginner["HN"];
        //Intermediate
        $productoFrecuenciaI[0] = $pfIntermediate["A1"] * $pfIntermediate["BF"] * $pfIntermediate["CB"] * $pfIntermediate["D1"] * $pfIntermediate["EDM"] * $pfIntermediate["FL"] * $pfIntermediate["GN"] * $pfIntermediate["HN"];
        //Advanced 
        $productoFrecuenciaA[0] = $pfAdvanced["A1"] * $pfAdvanced["BF"] * $pfAdvanced["CB"] * $pfAdvanced["D1"] * $pfAdvanced["EDM"] * $pfAdvanced["FL"] * $pfAdvanced["GN"] * $pfAdvanced["HN"];

        //Segunda combinacion de 3

        //Beginner 
        $productoFrecuenciaB[1] = $pfBeginner["A2"] * $pfBeginner["BM"] * $pfBeginner["CI"] * $pfBeginner["D2"] * $pfBeginner["END"] * $pfBeginner["FA"] * $pfBeginner["GS"] * $pfBeginner["HS"];
        //Intermediate
        $productoFrecuenciaI[1] = $pfIntermediate["A2"] * $pfIntermediate["BM"] * $pfIntermediate["CI"] * $pfIntermediate["D2"] * $pfIntermediate["END"] * $pfIntermediate["FA"] * $pfIntermediate["GS"] * $pfIntermediate["HS"];
        //Advanced 
        $productoFrecuenciaA[1] = $pfAdvanced["A2"] * $pfAdvanced["BM"] * $pfAdvanced["CI"] * $pfAdvanced["D2"] * $pfAdvanced["END"] * $pfAdvanced["FA"] * $pfAdvanced["GS"] * $pfAdvanced["HS"];


        //Tercera de 3

        //Beginner 
        $productoFrecuenciaB[2] = $pfBeginner["A3"] * $pfBeginner["BNA"] * $pfBeginner["CA"] * $pfBeginner["D3"] * $pfBeginner["EO"] * $pfBeginner["FH"] * $pfBeginner["GO"] * $pfBeginner["HO"];
        //Intermediate
        $productoFrecuenciaI[2] = $pfIntermediate["A3"] * $pfIntermediate["BNA"] * $pfIntermediate["CA"] * $pfIntermediate["D3"] * $pfIntermediate["EO"] * $pfIntermediate["FH"] * $pfIntermediate["GO"] * $pfIntermediate["HO"];
        //Advanced 
        $productoFrecuenciaA[2] = $pfAdvanced["A3"] * $pfAdvanced["BNA"] * $pfAdvanced["CA"] * $pfAdvanced["D3"] * $pfAdvanced["EO"] * $pfAdvanced["FH"] * $pfAdvanced["GO"] * $pfAdvanced["HO"];

        //Por ultimo se multiplica cada producto de frecuencia * la probabilidad de clase inicial (3/20)
        $productoTotalB[0] = $productoFrecuenciaB[0] * $pBegin;
        $productoTotalI[0] = $productoFrecuenciaI[0] * $pInterm;
        $productoTotalA[0] = $productoFrecuenciaA[0] * $pAdvan;

        $productoTotalB[1] = $productoFrecuenciaB[1] * $pBegin;
        $productoTotalI[1] = $productoFrecuenciaI[1] * $pInterm;
        $productoTotalA[1] = $productoFrecuenciaA[1] * $pAdvan;

        $productoTotalB[2] = $productoFrecuenciaB[2] * $pBegin;
        $productoTotalI[2] = $productoFrecuenciaI[2] * $pInterm;
        $productoTotalA[2] = $productoFrecuenciaA[2] * $pAdvan;

        $vector_probabilidades_profesor[0]["B"] = $productoTotalB[0];
        $vector_probabilidades_profesor[0]["I"] = $productoTotalI[0];
        $vector_probabilidades_profesor[0]["A"] = $productoTotalA[0];

        $vector_probabilidades_profesor[1]["B"] = $productoTotalB[1];
        $vector_probabilidades_profesor[1]["I"] = $productoTotalI[1];
        $vector_probabilidades_profesor[1]["A"] = $productoTotalA[1];

        $vector_probabilidades_profesor[2]["B"] = $productoTotalB[2];
        $vector_probabilidades_profesor[2]["I"] = $productoTotalI[2];
        $vector_probabilidades_profesor[2]["A"] = $productoTotalA[2];

        */
    }
}//fin de clase