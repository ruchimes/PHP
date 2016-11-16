<?php

class Game {
    var $number;
    var $attemps;
    
    function __construct() {
        $this->number = rand(1, 10);
        $this->attemps = 0;
    }
    
    function checkNumber($num){
        $flag;
        
        if($this->number<$num){
            $flag = -1;
        }
        else if($this->number>$num){
            $flag = 1;
        }
        else{
            $flag = 0;
        }
        return $flag;
    }
    
    function increaseAttemps() {
        $this->attemps++;
    }

    function getNumber() {
        return $this->number;
    }

    function getAttemps() {
        return $this->attemps;
    }

    function setNumber($number) {
        $this->number = $number;
    }

    function setAttemps($attemps) {
        $this->attemps = $attemps;
    }


}
