<?php
    class homepage extends page {
        public function get() {
            $this->html .= htmlTags::headingOne('Welcome to my Project');
            $this->html .= htmlTags::horizontalRule();
            //Set a button link to the uploadForm page.
            $this->html .= htmlTags::turnPage('index.php?page=uploadForm','Continue');
        }
    }
?>