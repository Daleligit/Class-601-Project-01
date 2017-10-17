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
        static public function tableHead($name) {
            return '<table id=' . $name . '>';
        }
        static public function tableLineStart() {
            return '<tr>';
        }
        static public function tableLineEnd() {
            return '</tr>';
        }
        static public function tableTitle($input) {
            return '<th>' . $input . '</th>';
        }
        static public function tableDetail($input) {
            return '<td>' . $input . '</td>';
        }
        static public function tableEnd() {
            return '</table>';
        }
        //Set two buttons here, they can be used in different pages in different ways
        /* CHANGE HERE: I just replace all backButton with the turnPage buttons in order
         * to make sure the button can bring the user to the right page not based on their
         * view history.
        */
        static public function backButton($input) {
            return '<input type="button" onclick="javascript:history.back(-1);" value="' . $input . '">';
        }
        static public function turnPage($pageName, $input) {
            return '<input type="button" onclick="location.href=\'' .$pageName . '\'" value="' . $input . '">';
       }
    }
?>