<?php 
    function csw_theme_customizer($wp_customize) {
        //Remove unrequired
        $wp_customize->remove_section('custom_css');
    }
    add_action('customize_register', 'csw_theme_customizer');

    add_theme_support('custom-logo', array(
        'height' => '100',
        'width' => '400',
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array('site-title', 'site-description'),
    ));