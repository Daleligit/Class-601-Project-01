<?php
    class uploadForm extends page {
        public function get() {
            $form =  '<form action="index.php?page=uploadForm" method="post" enctype="multipart/form-data">';
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
?>