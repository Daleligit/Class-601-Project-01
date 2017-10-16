<?php
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    class Manage {
        static public function autoload($class) {
            include './classes/' . $class . '.php';
        }
    }

    spl_autoload_register(array('Manage', 'autoload'));

    $obj = new main();
?>