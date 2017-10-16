<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    class Manage {
        static public function autoload($class) {
            include './class' . $class . '.php';
        }
    }

    spl_autoload_register(array('Manage', 'autoload'));

    $obj = new main();

    class main {
        public function __construct() {
            $pageRequest = 'homepage';
            if (isset($_REQUEST['page'])) {
                $pageRequest = $_REQUEST['page'];
            }
            $page = new $pageRequest;

            if($_SERVER['REQUEST_METHOD'] == 'GET') {
                $page->get();
            } else {
                $page->post();
            }
        }
    }

    abstract class page {
        protected $html;

        public function __construct() {
            $this->html .= htmlTags::htmlHead();
            $this->html .= '<link rel="stylesheet" href="styles.css">';
            $this->html .= htmlTags::htmlBody();
        }
        public function __destruct()
        {
            $this->html .= htmlTags::bodyEnd();
            $this->html .= htmlTags::htmlEnd();
            stringFunctions::printThis($this->html);
        }
        public function get() {

        }
        public function post() {

        }
    }

?>