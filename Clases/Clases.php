<?php

class Post {
    private $titulo;
    private $username;
    private $carrera;
    private $nrc_materia;
    private $texto;
    private $ruta_archivo;
    private $fecha;


    //METODOS SET
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setUsername($username) {
        $this->username = $username;
    }
 
    public function setCarrera($carrera) {
        $this->carrera = $carrera;
    }

    public function setNrcMateria($nrc_materia) {
        $this->nrc_materia = $nrc_materia;
    }

    public function setTexto($texto) {
        $this->texto = $texto;
    }

    public function setRutaArchivo($ruta_archivo) {
        $this->ruta_archivo = $ruta_archivo;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    //METODOS GET
    public function getTitulo() {
        return $this->titulo;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getCarrera() {
        return $this->carrera;
    }

    public function getNrcMateria() {
        return $this->nrc_materia;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getRutaArchivo() {
        return $this->ruta_archivo;
    }

    public function getFecha() {
        return $this->fecha;
    }
}

?>