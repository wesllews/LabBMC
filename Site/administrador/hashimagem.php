<?php

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   $string = str_replace("-", "", $string);
   return $string;
}

function retornaHash(){
    $now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
    $local = $now->setTimeZone(new DateTimeZone('America/Sao_Paulo'));
    $local=clean($local->format("m-d-Y H:i:s.u"));
    return $local;
}
//echo retornaHash();

?>