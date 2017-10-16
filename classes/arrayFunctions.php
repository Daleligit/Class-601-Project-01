<?php
    class arrayFunctions {
        static public function arrayEnd($array) {
            end($array);
            return $array;
        }
        static public function arrayKey($array) {
            return key($array);
        }
    }
?>