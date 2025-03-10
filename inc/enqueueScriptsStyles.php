<?php  
    if(!function_exists('cswEnqueueStylesScripts')) {
        function cswEnqueueStylesScripts(){
            //Styles
            wp_enqueue_style('bootstrapStyles', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
            wp_enqueue_style('fontAwesome6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
            wp_enqueue_style('slickStyle', get_template_directory_uri().'/assets/css/slick.css');
            wp_enqueue_style('slickTheme', get_template_directory_uri().'/assets/css/slick-theme.css');
            wp_enqueue_style('mainCustomStyles', get_template_directory_uri().'/assets/css/main.min.css');


            //Scripts
            wp_enqueue_script('jqueryScript', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), '3.6.4', true);
            wp_enqueue_script('jqueryUiScript', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js', array(), '1.13.2', true);
            wp_enqueue_script('bootstrapScript', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array(), '5.3.2', true);
            wp_enqueue_script('slickScript', get_template_directory_uri().'/assets/js/slick.min.js', array(), '', true);
            wp_enqueue_script('mainCustomScript', get_template_directory_uri().'/assets/js/main.min.js', array(), '', true);

        }
    }
    add_action('wp_enqueue_scripts', 'cswEnqueueStylesScripts');