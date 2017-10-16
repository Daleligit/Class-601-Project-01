<?php
    class arrayFunctions {
        /*These two functions I used for previous commits in order to
         *check if the csv file is empty, but later I just found a better
         * way to do that. So they are useless now, just leave here in care
         * that I may use them in the future commits.
         */
        static public function arrayEnd($array) {
            end($array);
            return $array;
        }
        static public function arrayKey($array) {
            return key($array);
        }
    }
?>