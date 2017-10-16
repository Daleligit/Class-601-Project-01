<?php
    class tableDisplay extends page {
        public function get() {
            $csvFile = fopen('./uploads/' . $_GET['filename'], 'r');
            while (!feof($csvFile) ) {
                $lineText[] = fgetcsv($csvFile);
            }
            print_r($lineText);
            if (!empty($lineText)) {
                $this->html .= htmlTags::backButton('Back');
                $this->html .= htmlTags::tableHead('displayTable');
                $lineText_check = arrayFunctions::arrayEnd($lineText);
                $key = arrayFunctions::arrayKey($lineText_check);
                foreach ($lineText as $line => $value) {
                    $this->html .= htmlTags::tableLineStart();
                    if ($line != $key || $value != NULL) {
                        if ($line == 0 ) {
                            foreach ($value as $text) {
                                $this->html .= htmlTags::tableTitle($text);
                            }
                        } else {
                            foreach ($value as $text) {
                                $this->html .= htmlTags::tableDetail($text);
                            }
                        }
                    }
                    $this->html .= htmlTags::tableLineEnd();
                }
                $this->html .= htmlTags::tableEnd();
            } else {
                $this->html .= htmlTags::changeRow('This is an empty CSV file');
                $this->html .= htmlTags::backButton('Back');
            }
        }
    }
?>