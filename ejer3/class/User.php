<?php


class User {
    private $id;
    private $name;
    private $pass;
    private $partidas;
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPass() {
        return $this->pass;
    }

    function getPartidas() {
        return $this->partidas;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    function setPartidas($partidas) {
        $this->partidas = $partidas;
    }


}
