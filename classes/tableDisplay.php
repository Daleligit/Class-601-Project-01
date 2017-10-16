<?php
    class tableDisplay extends page {
        public function get() {
            $csvFile = fopen('./uploads/' . $_GET['filename'], 'r');
            while (!feof($csvFile) ) {
                $lineText[] = fgetcsv($csvFile);
            }
            $tableTitle = 0;
            $printCheck = 0;
            $this->html .= htmlTags::backButton('Back');
            $this->html .= htmlTags::tableHead('displayTable');
            foreach ($lineText as $line => $value) {
                $test = 0;
                if (!empty($value)){
                    foreach ($value as $textTest) {
                        if (!empty($textTest) && !empty(stringFunctions::stringTrim($textTest))){
                            $test = 1;
                            break;
                        }
                    }
                }
                if ($line == $tableTitle && $test ==0) {
                    $tableTitle++;
                } elseif ($test != 0) {
                    $this->html .= htmlTags::tableLineStart();
                    if ($line == $tableTitle ) {
                        foreach ($value as $text) {
                            $this->html .= htmlTags::tableTitle($text);
                        }
                    } else {
                        foreach ($value as $text) {
                            $this->html .= htmlTags::tableDetail($text);
                        }
                    }
                    $this->html .= htmlTags::tableLineEnd();
                    $printCheck = 1;
                }
            }
            $this->html .= htmlTags::tableEnd();
            if ($printCheck == 0) {
                $this->html .= htmlTags::changeRow('This is an empty CSV file');
            }
        }
    }
?>