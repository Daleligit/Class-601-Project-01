<?php
    class uploadForm extends page {
        public function get() {
            //The upload form
            $form =  '<form action="index.php?page=uploadForm" method="post" enctype="multipart/form-data">';
            $form .= '<input type="file" name="uploadCSVFiles" id="uploadCSVFiles">';
            $form .= '<input type="submit" value="Upload CSV Files" name="submit">';
            $form .= '</form>';
            $this->html .= htmlTags::headingOne('Upload Form');
            $this->html .= htmlTags::changeRow('Please upload your CSV file here:');
            $this->html .= $form;
            $this->html .= htmlTags::backButton('Back');
    }
        public function post() {
            //Set upload directory
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["uploadCSVFiles"]["name"]);
            //Upload state marker: 1 success, 0 failed
            $uploadOk = 1;
            //Get the upload file type
            $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if ($_FILES["uploadCSVFiles"]["name"] != NULL) {
                if(isset($_POST["submit"])) {
                    //Check if the upload file is a CSV file
                    $check = stringFunctions::stringCompare(strtolower($fileType),'csv');
                    if($check == 0) {
                        $uploadOk = 1;
                    } else {
                        $this->html .= htmlTags::changeRow('Sorry, file is not a CSV file');;
                        $uploadOk = 0;
                    }
                }
                //Check if there is already a same file
                if (file_exists($target_file)) {
                    $this->html .= htmlTags::changeRow('Sorry, file already exists.');
                    $uploadOk = 0;
                }
                //Use the upload state marker to make decision if the web page needs to do the upload.
                if ($uploadOk == 0) {
                    $this->html .= htmlTags::changeRow('Your file was not uploaded.');
                    $this->html .= htmlTags::backButton('Back');
                } else {
                    //upload file
                    if (move_uploaded_file($_FILES["uploadCSVFiles"]["tmp_name"], $target_file)) {
                        //Transfer the user to the tableDisplay page
                        header('Location: index.php?page=tableDisplay&filename=' . $_FILES["uploadCSVFiles"]["name"]);
                    } else {
                        //Uploaded failed with some problem
                        $this->html .= htmlTags::changeRow('Sorry, there was an error uploading your file.');
                        $this->html .= htmlTags::backButton('Back');
                    }
                }
            } else {
                //Check if the use choose a file to upload.
                $this->html .= htmlTags::changeRow('Please choose a file to upload');
                $this->html .= htmlTags::backButton('Back');
            }
        }
    }
?>