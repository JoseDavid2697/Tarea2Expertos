<?php

/**
 * Description of View
 *
 * @author Jose David
 */
class View {

    public function __construct() {
        ;
    }

//constructor

    public function show($nombreVista, $vars = array()) {
        $config = Config::singleton();
        $path = $config->get('viewFolder').$nombreVista;
        /*valida que la ruta sea valida*/
        if (is_file($path) == FALSE) {
            trigger_error('Pagina '.$path.' no existe', E_USER_NOTICE);
            return FALSE;
        }//if
        if(is_array($vars)){
            foreach ($vars as $key=>$value){
                $key=$value;
            }//foreach
        }// if is_array($vars)
        
        include $path;
    }//show
}

//fin clase
