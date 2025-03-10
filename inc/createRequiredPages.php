<?php 

    if(isset($_GET['activated']) && is_admin()){
        //Setup the homepage
        $new_page_title = 'Homepage';
        $new_page_content = 'This is the homepage';
        $new_page_template = '';

        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
            'post_type' => 'page',
            'post_title' => $new_page_title,
            'post_content' => $new_page_content,
            'post_status' => 'publish',
            'post_author' => 1,
        );
        if(!isset($page_check->ID)){
            $new_page_id = wp_insert_post($new_page);
            if(!empty($new_page_template)){
                update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
            }
        }
    }
    if(isset($_GET['activated']) && is_admin()){
        //Setup the homepage
        $new_page_title = 'About Us';
        $new_page_content = 'This is the About Us Page';
        $new_page_template = '';

        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
            'post_type' => 'page',
            'post_title' => $new_page_title,
            'post_content' => $new_page_content,
            'post_status' => 'publish',
            'post_author' => 1,
        );
        if(!isset($page_check->ID)){
            $new_page_id = wp_insert_post($new_page);
            if(!empty($new_page_template)){
                update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
            }
        }
    }
    if(isset($_GET['activated']) && is_admin()){
        //Setup the homepage
        $new_page_title = 'Contact Us';
        $new_page_content = 'This is the Contact Us Page';
        $new_page_template = '';

        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
            'post_type' => 'page',
            'post_title' => $new_page_title,
            'post_content' => $new_page_content,
            'post_status' => 'publish',
            'post_author' => 1,
        );
        if(!isset($page_check->ID)){
            $new_page_id = wp_insert_post($new_page);
            if(!empty($new_page_template)){
                update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
            }
        }
    }
    if(isset($_GET['activated']) && is_admin()){
        //Setup the homepage
        $new_page_title = 'Cookies Policy';
        $new_page_content = '';
        $new_page_template = '';

        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
            'post_type' => 'page',
            'post_title' => $new_page_title,
            'post_content' => $new_page_content,
            'post_status' => 'publish',
            'post_author' => 1,
        );
        if(!isset($page_check->ID)){
            $new_page_id = wp_insert_post($new_page);
            if(!empty($new_page_template)){
                update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
            }
        }
    }
    if(isset($_GET['activated']) && is_admin()){
        //Setup the homepage
        $new_page_title = 'Terms and Conditions';
        $new_page_content = '';
        $new_page_template = '';

        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
            'post_type' => 'page',
            'post_title' => $new_page_title,
            'post_content' => $new_page_content,
            'post_status' => 'publish',
            'post_author' => 1,
        );
        if(!isset($page_check->ID)){
            $new_page_id = wp_insert_post($new_page);
            if(!empty($new_page_template)){
                update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
            }
        }
    }