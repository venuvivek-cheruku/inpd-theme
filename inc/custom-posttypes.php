<?php

  if ( ! function_exists('jobs_pt') ) {
    // Register Custom Post Type
    function jobs_pt() {
      $labels = array(
        'name'                  => _x( 'Jobs', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Jobs', 'text_domain' ),
        'name_admin_bar'        => __( 'Jobs', 'text_domain' ),
        'archives'              => __( 'Job Archives', 'text_domain' ),
        'attributes'            => __( 'Job Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Job:', 'text_domain' ),
        'all_items'             => __( 'All Jobs', 'text_domain' ),
        'add_new_item'          => __( 'Add New Job', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Job', 'text_domain' ),
        'edit_item'             => __( 'Edit Job', 'text_domain' ),
        'update_item'           => __( 'Update Job', 'text_domain' ),
        'view_item'             => __( 'View Job', 'text_domain' ),
        'view_items'            => __( 'View Job', 'text_domain' ),
        'search_items'          => __( 'Search Job', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into job', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this job', 'text_domain' ),
        'items_list'            => __( 'Jobs list', 'text_domain' ),
        'items_list_navigation' => __( 'Jobs list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter jobs list', 'text_domain' ),
      );
      $args = array(
        'label'                 => __( 'Jobs', 'text_domain' ),
        'description'           => __( 'Jobs', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => array( 'slug' => 'jobs', 'with_front' => false ),  
        'capability_type'       => 'page',
      );
      register_post_type( 'jobs', $args );
    }
    add_action( 'init', 'jobs_pt', 0 );
  } 
  
  if ( ! function_exists('case_studies_pt') ) {
    // Register Custom Post Type
    function case_studies_pt() {
      $labels = array(
        'name'                  => _x( 'Case Studies', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Case Study', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Case Studies', 'text_domain' ),
        'name_admin_bar'        => __( 'Case Studies', 'text_domain' ),
        'archives'              => __( 'Case Study Archives', 'text_domain' ),
        'attributes'            => __( 'Case Study Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Case Study:', 'text_domain' ),
        'all_items'             => __( 'All Case Studies', 'text_domain' ),
        'add_new_item'          => __( 'Add New Case Study', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Case Study', 'text_domain' ),
        'edit_item'             => __( 'Edit Case Study', 'text_domain' ),
        'update_item'           => __( 'Update Case Study', 'text_domain' ),
        'view_item'             => __( 'View Case Study', 'text_domain' ),
        'view_items'            => __( 'View Case Study', 'text_domain' ),
        'search_items'          => __( 'Search Case Study', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Case Study', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Case Study', 'text_domain' ),
        'items_list'            => __( 'Case Studies list', 'text_domain' ),
        'items_list_navigation' => __( 'Case Studies list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Case Studies list', 'text_domain' ),
      );
      $args = array(
        'label'                 => __( 'Case Study', 'text_domain' ),
        'description'           => __( 'Case Study', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'thumbnail' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-groups',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => array( 'slug' => 'case-study', 'with_front' => false ),  
        'capability_type'       => 'page',
      );
      register_post_type( 'case-study', $args );
    }
    add_action( 'init', 'case_studies_pt', 0 );
  } 


  function create_industry_taxonomy() {
    // Labels for the Industry taxonomy
    $labels = array(
        'name'                       => _x( 'Industries', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Industry', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Industries', 'textdomain' ),
        'popular_items'              => __( 'Popular Industries', 'textdomain' ),
        'all_items'                  => __( 'All Industries', 'textdomain' ),
        'parent_item'                => __( 'Parent Industry', 'textdomain' ),
        'parent_item_colon'          => __( 'Parent Industry:', 'textdomain' ),
        'edit_item'                  => __( 'Edit Industry', 'textdomain' ),
        'update_item'                => __( 'Update Industry', 'textdomain' ),
        'add_new_item'               => __( 'Add New Industry', 'textdomain' ),
        'new_item_name'              => __( 'New Industry Name', 'textdomain' ),
        'separate_items_with_commas' => __( 'Separate industries with commas', 'textdomain' ),
        'add_or_remove_items'        => __( 'Add or remove industries', 'textdomain' ),
        'choose_from_most_used'      => __( 'Choose from the most used industries', 'textdomain' ),
        'not_found'                  => __( 'No industries found.', 'textdomain' ),
        'menu_name'                  => __( 'Industries', 'textdomain' ),
    );

    // Arguments for the Industry taxonomy
    $args = array(
        'hierarchical'          => true, // Make it hierarchical (like categories)
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'industry' ),
    );

    // Register the Industry taxonomy for the Case Study post type
    register_taxonomy( 'industry', 'case-study', $args );
}

// Hook into the init action and call create_industry_taxonomy when it fires
add_action( 'init', 'create_industry_taxonomy', 0 );


if ( ! function_exists('teacher_pt') ) {
  // Register Custom Post Type
  function teacher_pt() {
    $labels = array(
      'name'                  => _x( 'Teachers', 'Post Type General Name', 'text_domain' ),
      'singular_name'         => _x( 'Teacher', 'Post Type Singular Name', 'text_domain' ),
      'menu_name'             => __( 'Teachers', 'text_domain' ),
      'name_admin_bar'        => __( 'Teachers', 'text_domain' ),
      'archives'              => __( 'Teacher Archives', 'text_domain' ),
      'attributes'            => __( 'Teacher Attributes', 'text_domain' ),
      'parent_item_colon'     => __( 'Parent Teacher:', 'text_domain' ),
      'all_items'             => __( 'All Teachers', 'text_domain' ),
      'add_new_item'          => __( 'Add New Teacher', 'text_domain' ),
      'add_new'               => __( 'Add New', 'text_domain' ),
      'new_item'              => __( 'New Teacher', 'text_domain' ),
      'edit_item'             => __( 'Edit Teacher', 'text_domain' ),
      'update_item'           => __( 'Update Teacher', 'text_domain' ),
      'view_item'             => __( 'View Teacher', 'text_domain' ),
      'view_items'            => __( 'View Teacher', 'text_domain' ),
      'search_items'          => __( 'Search Teacher', 'text_domain' ),
      'not_found'             => __( 'Not found', 'text_domain' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
      'featured_image'        => __( 'Teacher Photo', 'text_domain' ),
      'set_featured_image'    => __( 'Set teacher photo', 'text_domain' ),
      'remove_featured_image' => __( 'Remove teacher photo', 'text_domain' ),
      'use_featured_image'    => __( 'Use as teacher photo', 'text_domain' ),
      'insert_into_item'      => __( 'Insert into Teacher', 'text_domain' ),
      'uploaded_to_this_item' => __( 'Uploaded to this Teacher', 'text_domain' ),
      'items_list'            => __( 'Teachers list', 'text_domain' ),
      'items_list_navigation' => __( 'Teachers list navigation', 'text_domain' ),
      'filter_items_list'     => __( 'Filter Teachers list', 'text_domain' ),
    );
    $args = array(
      'label'                 => __( 'Teacher', 'text_domain' ),
      'description'           => __( 'Teacher', 'text_domain' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'thumbnail' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-groups',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => false,
      'can_export'            => false,
      'has_archive'           => false,
      'exclude_from_search'   => true,
      'publicly_queryable'    => true,
      'rewrite'               => array( 'slug' => 'teacher', 'with_front' => false ),  
      'capability_type'       => 'page',
    );
    register_post_type( 'teacher', $args );
  }
  add_action( 'init', 'teacher_pt', 0 );
} 