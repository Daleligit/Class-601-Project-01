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
                if($check == 0) {
                    $uploadOk = 1;
                } else {
                    $this->html .= htmlTags::changeRow('Sorry, file is not a CSV file');;
                    $uploadOk = 0;
                }
            }
            if (file_exists($target_file)) {
                $this->html .= htmlTags::changeRow('Sorry, file already exists.');
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $this->html .= htmlTags::changeRow('Your file was not uploaded.');
            } else {
                if (move_uploaded_file($_FILES["uploadCSVFiles"]["tmp_name"], $target_file)) {
                    header('Location: index.php?page=tableDisplay&filename=' . $_FILES["uploadCSVFiles"]["name"]);
                } else {
                    $this->html .= htmlTags::changeRow('Sorry, there was an error uploading your file.');
                }
            }
        }
    }

    class tableDisplay extends page {
        public function get() {
            $csvFile = fopen('./uploads/' . $_GET['filename'], 'r');
            while (!feof($csvFile) ) {
                $lineText[] = fgetcsv($csvFile);
            }
            if (!empty($lineText)) {
                $this->html .= htmlTags::tableHead('displayTable');
                foreach ($lineText as $line => $value) {
                    $this->html .= htmlTags::tableLineStart();
                    if ($line == 0 ) {
                        foreach ($value as $text) {
                            $this->html .= htmlTags::tableTitle($text);
                        }
                    } else {
                        foreach ($value as $text) {
                            $this->html .= htmlTags::tableDetail($text);
                        }
                    }
                    $this->html .= htmlTags::tableLineEnd();
                }
                $this->html .= htmlTags::tableEnd();
            } else {
                $this->html .= htmlTags::changeRow('This is an empyt CSV file');
            }
        }
    }
?>