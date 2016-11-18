<?php

$basedatos = 'contabilidad';
$usuario = 'root';
$contrasenya = '';
$equipo = 'localhost';

class BD {

    protected static $bd = null;

    private function __construct() {
        try {
            self::$bd = new PDO('mysql:host=localhost;dbname=contabilidad', 'root', '');
            self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
    
    public static function getConexion() {
        if (!self::$bd) {
            new BD();
        }
        return self::$bd;
    }

}

    