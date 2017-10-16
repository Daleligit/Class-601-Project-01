<?php
    class htmlTags {
        static public function horizontalRule() {
            return '<hr>';
        }
        static public function headingOne($input) {
            return '<h1>' . $input . '</h1>';
        }
        static public function changeRow($input) {
            return $input . '</br>';
        }
        static public function htmlHead() {
            return '<html>';
        }
        static public function htmlBody() {
            return '<body>';
        }
        static public function htmlEnd() {
            return '</html>';
        }
        static public function bodyEnd() {
            return '</body>';
        }
    }
?>