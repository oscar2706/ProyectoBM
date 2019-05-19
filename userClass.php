<?php 

class User {
    private $idUsuario;
    private $nombre;
    private $contraseña;
    private $edad;
    private $idGenero;
    private $idEstadoCivil;

    public function __construct($_idUsuario, $_nombre, $_contraseña, $_edad, $_idGenero, $_idEstadoCivil) {
        $this->idUsuario = $_idUsuario;
        $this->nombre = $_nombre;
        $this->contraseña = $_contraseña;
        $this->edad = $_edad;
        $this->idGenero = $_idGenero;
        $this->idEstadoCivil = $_idEstadoCivil;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getContraseña() {
        return $this->contraseña;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getIdGenero() {
        return $this->idGenero;
    }

    public function getIdEstadoCivil() {
        return $this->idEstadoCivil;
    }
}

?>