<?php

    // Funcion que retorna la condicional de busqueda
    function SearchConditional($a,$b,$c,$d,$e,$f) {
        $conditional = " ";

        if($a != "") {
            $conditional .= "dato24 LIKE '{$a}' AND ";
        }
        if($b != "-") {
            $conditional .= "dato11 LIKE '{$b}' AND ";
        }
        if($c != "-") {
            $conditional .= "dato10 LIKE '{$c}' AND ";
        }
        if($d != "") {
            $conditional .= "dato5 >= {$d} AND ";
        }
        if($e != "") {
            $conditional .= "dato5 <= {$e} AND ";
        }
        if($f != "-") {
            $conditional .= "dato5 = '{$f}' AND ";
        }
        $conditional .= "dato6 = 'A'";

        return $conditional;
    }