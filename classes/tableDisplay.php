<?php
    class tableDisplay extends page {
        public function get() {
            //Open CSV file and read it into array $lineText
            $csvFile = fopen('./uploads/' . $_GET['filename'], 'r');
            while (!feof($csvFile) ) {
                $lineText[] = fgetcsv($csvFile);
            }
            //The marker for the table title line. Because the first a few lines may be empty.
            $tableTitle = 0;
            //The marker to check if there is an output in the table about the data in CSV file.
            //This is to check if the CSV file is empty.
            $printCheck = 0;
            $this->html .= htmlTags::turnPage('index.php?page=uploadForm','Back');
            $this->html .= htmlTags::tableHead('displayTable');
            foreach ($lineText as $line => $value) {
                //Check the line if it is empty
                $test = 0;
                if (!empty($value)){
                    foreach ($value as $textTest) {
                        if (!empty($textTest) && !empty(stringFunctions::stringTrim($textTest))){
                            $test = 1;
                            break;
                        }
                    }
                }
                //Start to output data
                if ($line == $tableTitle && $test ==0) {
                    //Title line is empty, so make the next line as title line.
                    $tableTitle++;
                } elseif ($test != 0) {
                    $this->html .= htmlTags::tableLineStart();
                    if ($line == $tableTitle ) {
                        foreach ($value as $text) {
                            //Title line output
                            $this->html .= htmlTags::tableTitle($text);
                        }
                    } else {
                        foreach ($value as $text) {
                            //Normal line output
                            $this->html .= htmlTags::tableDetail($text);
                        }
                    }
                    $this->html .= htmlTags::tableLineEnd();
                    //There is an data output, so set the marker.
                    $printCheck = 1;
                }
            }
            $this->html .= htmlTags::tableEnd();
            //Check if the CSV file is empty.
            if ($printCheck == 0) {
                $this->html .= htmlTags::changeRow('This is an empty CSV file');
            }
        }
    }
?>