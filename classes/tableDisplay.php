<?php
    class tableDisplay extends page {
        public function get() {
            $csvFile = fopen('./uploads/' . $_GET['filename'], 'r');
            while (!feof($csvFile) ) {
                $lineText[] = fgetcsv($csvFile);
            }
            $lineText_check = arrayFunctions::arrayEnd($lineText);
            $key = arrayFunctions::arrayKey($lineText_check);
            if ($key != 0 || $lineText[$key] != NULL) {
                $this->html .= htmlTags::backButton('Back');
                $this->html .= htmlTags::tableHead('displayTable');
                foreach ($lineText as $line => $value) {
                    $this->html .= htmlTags::tableLineStart();
                    if ($line == 0 ) {
                        foreach ($value as $text) {
                            $this->html .= htmlTags::tableTitle($text);
                        }
                    } else {
                        if ($line != $key || $value != NULL) {
                            foreach ($value as $text) {
                                $this->html .= htmlTags::tableDetail($text);
                            }
                        }
                    }
                    $this->html .= htmlTags::tableLineEnd();
                }
                $this->html .= htmlTags::tableEnd();
            } else {
                $this->html .= htmlTags::backButton('Back');
                $this->html .= htmlTags::changeRow('This is an empty CSV file');
            }
        }
    }
?>