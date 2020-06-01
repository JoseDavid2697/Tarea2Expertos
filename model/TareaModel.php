<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticulosModel
 *
 * @author Jose David
 */

class TareaModel {
    protected $db;

    public function __construct(){
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();//devuelve la instancia de base de datos

    }//constructor

    /*METODOS NECESARIOS PARA MANIPULAR LOS DATOS*/



    public function obtenerDatosEstilo(){
        $consulta = $this->db->prepare('select recinto.ca, recinto.ec, recinto.ea, recinto.or, recinto.estilo from recinto;');
        $consulta->execute();
        $data = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $data;
    }

    public function obtenerDatosRecinto(){
        $consulta = $this->db->prepare('select sexo.sexo, sexo.promedio, sexo.estilo, sexo.recinto from sexo;');
        $consulta->execute();
        $data = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $data;
    }

    public function obtenerDatosSexo(){
        $consulta = $this->db->prepare('select sexo.recinto, sexo.estilo, sexo.promedio, sexo.sexo from sexo;');
        $consulta->execute();
        $data = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $data;
    }

    public function obtenerDatosEstudiante(){
        $consulta = $this->db->prepare('select sexo.recinto, sexo.promedio, sexo.sexo, sexo.estilo from sexo;');
        $consulta->execute();
        $data = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $data;
    }

    public function obtenerDatosRedes(){
        $consulta = $this->db->prepare('select redes.re, redes.li, redes.ca, redes.co, redes.class from redes;');
        $consulta->execute();
        $data = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $data;
    }

    public function obtenerDatosProfesor(){
        $consulta = $this->db->prepare('select profesor.a, profesor.b, profesor.c, profesor.d, profesor.e, profesor.f, profesor.g, profesor.h, profesor.class from profesor;');
        $consulta->execute();
        $data = $consulta->fetchAll();
        $consulta->CloseCursor();
        return $data;
    }

}//fin de clase
