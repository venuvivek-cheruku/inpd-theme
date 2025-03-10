<?php 
    if(function_exists('acf_add_options_page')){ 
        acf_add_options_page(array(
            'menu_title' => 'Theme Options',
            'menu_slug' => 'theme-options',
            'capability' => 'edit_posts',
            'icon_url' => 'dashicons-admin-settings',
            'position' => '60',
            'redirect' => true,
        ));
        acf_add_options_sub_page(array(
            'page_title' => 'Logos',
            'menu_title' => 'Logos',
            'menu_slug' => "logos",
            'capability' => 'edit_posts',
            'parent_slug' => 'theme-options',
            'redirect' => false,
        ));
        acf_add_options_sub_page(array(
            'page_title' => 'Contact Details',
            'menu_title' => 'Contact Details',
            'menu_slug' => "contact-details",
            'capability' => 'edit_posts',
            'parent_slug' => 'theme-options',
            'redirect' => false,
        ));
        acf_add_options_sub_page(array(
            'page_title' => 'Social Media',
            'menu_title' => 'Social Media',
            'menu_slug' => "social-media",
            'capability' => 'edit_posts',
            'parent_slug' => 'theme-options',
            'redirect' => false,
        ));

    }