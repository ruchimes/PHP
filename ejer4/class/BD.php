<?php

class BD {

    private $basedatos = 'sports';
    private $usuario = 'root';
    private $contrasenya = '';
    private $equipo = 'localhost';
    
    protected static $bd = null;
    private function __construct() {
        try {
            self::$bd = new PDO("mysql:host=$this->equipo;dbname=$this->basedatos", $this->usuario, $this->contrasenya);
            self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
            die();
        }
    }

    public static function getConexion() {
        if (!self::$bd) {
            new BD();
        }
        return self::$bd;
    }

}
