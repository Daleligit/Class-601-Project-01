<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    class Manage {
        static public function autoload($class) {
            include 'class/' . $class . '.php';
        }
    }

    spl_autoload_register(array('Manage', 'autoload'));

    $obj = new main();

    class main {
        public function __construct() {
            $pageRequest = 'uploadForm';
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
    }

    class uploadForm extends page {
        public function get() {
            $form =  '<form action="index.php?page=uploadForm" method="post"
	enctype="multipart/form-data">';
            $form .= '<input type="file" name="uploadCSVFiles" id="uploadCSVFiles">';
            $form .= '<input type="submit" value="Upload CSV Files" name="submit">';
            $form .= '</form>';
            $this->html .= htmlTags::headingOne('Upload Form');
            $this->html .= $form;
        }
        public function post() {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["uploadCSVFiles"]["name"]);
            $uploadOk = 1;
            $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if(isset($_POST["submit"])) {
                $check = stringFunctions::stringCompare(strtolower($fileType),'csv');
                if($check != 0) {
                    echo "File is a CSV file";
                    $uploadOk = 1;
                } else {
                    echo "File is not a CSV file.";
                    $uploadOk = 0;
                }
            }
        }
    }

?>