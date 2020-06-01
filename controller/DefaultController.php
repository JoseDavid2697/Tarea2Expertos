<?php
//Carga la pagina por default
class DefaultController
{
    private $view;
    public function __construct()
    {
        $this->view = new View();
    } //construct

    public function acciondefault()
    {
        //llamar al modelo para traer datos
        $this->view->show("indexview.php", null);
    } //acciondefault

}//fin de clase
