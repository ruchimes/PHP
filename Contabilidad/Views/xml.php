<?php

$clas = <<<XML
<?xml version='1.0' standalone='yes'?>
<resumen>
</resumen>
XML;

$xml = new SimpleXMLElement($clas);

while($apu = $user->getApuntes()->iterate()){
    $tipo = $apu->getTipo() ? "Ingreso" : "Gasto";
    
    $apunte = $xml->addChild("apunte");
    $apunte->addChild("tipo", $tipo);
    $apunte->addChild("concepto", $apu->getConcepto());
    $apunte->addChild("cantidad", $apu->getCantidad());
    $apunte->addChild("fecha", $apu->getFecha());
}

$archivo = $xml->asXML();

$fichero = fopen("xml/resumen.xml", "w+");

fwrite($fichero, $archivo);