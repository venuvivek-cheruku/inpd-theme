<?php
require get_template_directory().'/inc/bly_authFunctions.php';

add_action('rest_api_init', 'custom_rest_endpoint_init');
global $wpdb;

function custom_rest_endpoint_init()
{
    // Register a custom REST route
    register_rest_route('administrate/v1', '/fetch-sessions', array(
        'methods' => 'POST', // HTTP method (GET, POST, PUT, DELETE, etc.)
        'callback' => 'fetch_sessions_callback', // Function to handle the request
        'permission_callback' => '__return_true', // Optional: Control access to the endpoint
    ));
}


// Callback function to handle the request
function fetch_sessions_callback($request)
{
    // Retrieve the course code from the request body
    $courseCode = $request->get_param('courseCode');
    $productId = $request->get_param('productId');

    get_sessions($productId, $courseCode);

    // Return a REST response
    return new WP_REST_Response(['data' => 'Success'], 200);
}