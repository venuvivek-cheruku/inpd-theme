<?php 
    function allow_svg_upload_to_acf($mime_types) {
        $mime_types['svg'] = 'image/svg+xml';
        return $mime_types;
    }
    add_filter('upload_mimes', 'allow_svg_upload_to_acf');