<?php
    class homepage extends page {
        public function get() {
            $this->html .= htmlTags::headingOne('Welcome to my Project');
            $this->html .= htmlTags::horizontalRule();
            $this->html .= htmlTags::turnPage('index.php?page=uploadForm','Continue');
        }
    }
?>