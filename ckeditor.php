<?php

        require_once 'ckeditor/ckeditor.php';
        $ckeditor = new CKEditor();
        $ckeditor->basePath = 'ckeditor/';
        $ckeditor->config['width'] = '850';
        $ckeditor->config['height'] = '300';

		echo $ckeditor->editor('content');
?>