<?php

include_once 'AlmacenPalabras.php';

class Partida {
    protected $word;
    protected $avance;
    protected $letters = [];
    protected $numIntentos;
    
    
    
    
    function __construct($word=null, $avance=null, $letters=null, $numIntentos=null) {
        $almacen = AlmacenPalabras::getInstance();
                
        $this->word = $almacen->getPalabraAleatoria();
        $this->avance = str_pad("_",  strlen($this->word), "_");
        $this->numIntentos=0;
        $this->letters = [];
    }

    
    function checkLetter($letter) {
        
        if(in_array($letter, $this->letters)){
            return 0;
        }
        
        $arr_word = str_split($this->word);
        $arr_avance = str_split($this->avance);
        
        foreach ($arr_word as $key => $let) {
            if($letter === $let){
                $arr_avance[$key] = $letter;
            }
        }
        
        $this->numIntentos++;
        $this->avance = implode("", $arr_avance);
        array_push($this->letters, $letter);
    }
    
    function checkWin(){
        return $this->word == $this->avance;
    }

    function getWord() {
        return $this->word;
    }

    function getAvance() {
        return $this->avance;
    }

    function getLetters() {
        return $this->letters;
    }

    function setWord($word) {
        $this->word = $word;
    }

    function setAvance($avance) {
        $this->avance = $avance;
    }

    function setLetters($letters) {
        $this->letters = $letters;
    }
    
    function getNumIntentos() {
        return $this->numIntentos;
    }

    function setNumIntentos($numIntentos) {
        $this->numIntentos = $numIntentos;
    }



}
