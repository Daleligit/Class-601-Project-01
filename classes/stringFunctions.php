<?php
    class stringFunctions {
        static public function printThis($input) {
            print($input);
        }
        static public function stringCompare ($string1, $string2) {
            return strcmp($string1,$string2);
        }
    }
?>