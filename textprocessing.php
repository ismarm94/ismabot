<?php

//Función que resuelve las posibles formas de escribir un mensaje cualquiera, véase changelog.txt

function limpiaTexto($input, $tolower=TRUE){
 if($tolower){$input = strtolower($input);}
 $vocals = [
     "á" => "a" , "é" => "e" , "í" => "i" , "ó" => "o" , "ú" => 'u',
     "Á" => "A" , "É" =>"E" , "Í" => "I" , "Ó" => "O" , "Ú" => "U"
     ];
     
    $input = str_replace(array_keys($vocals), array_values($vocals), $input);
    $input = str_replace("%20", " ", $input);
    if($tolower){$input = strtolower($input);}
    return $input;
 }
 
 
 
 ?>