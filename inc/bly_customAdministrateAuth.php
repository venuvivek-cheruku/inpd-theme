<?php

add_action('admin_menu', 'custom_oauth_settings_page');

function custom_oauth_settings_page() {
    add_menu_page(
        'API Authentication', // Page title
        'Administrate Auth', // Menu title
        'manage_options', // Capability
        'custom-oauth-settings', // Slug
        'custom_oauth_settings_callback', // Callback function
        'dashicons-admin-network', // Icon
        80 // Position
    );
}

function custom_oauth_settings_callback() {
    ?>
    <div class="wrap">
        <h2>oAuth Authentication</h2>
        <p>Click the button below to authorize access to your API account.</p>
        <a href="<?php echo esc_url(get_authorization_url()); ?>" class="button button-primary" target="_blank">Authorize</a>
    </div>
    <?php
}

function get_authorization_url() {
    $client_id = '8RbUb738J6m7WjO74nnyOgXa1yZf0E0N';
    $redirect_uri = urlencode('https://yourwebsite.com/oauth-callback');
    $auth_url = "https://auth.getadministrate.com/oauth/authorize?response_type=code&client_id=$client_id&instance=inpd.administrateapp.com";

    return $auth_url;
}




add_action('init', function() {
    if (isset($_GET['code']) && strpos($_SERVER['REQUEST_URI'], 'administrate-callback') !== false) {
        $code = sanitize_text_field($_GET['code']);
        set_transient('administrate_oauth_temp_code', $code, 600);
        get_access_token();
        wp_redirect(admin_url('admin.php?page=custom-oauth-settings&custom_param=oauth_success'));
        exit;
    }
});


function get_access_token()
{
    $auth_code = get_transient('administrate_oauth_temp_code');
    // Prepare the token request data
    $token_url = 'https://auth.getadministrate.com/oauth/token'; // Replace with the actual OAuth2 token endpoint URL
    $client_id = '8RbUb738J6m7WjO74nnyOgXa1yZf0E0N';  // Your OAuth client ID
    $client_secret = '9xpWV3hlQYeZUtZKGyGCzudXrSiMGk4C'; // Your OAuth client secret
    $redirect_uri = 'https://inpd.heyoo.website/administrate-callback'; // Your redirect URI
    //https://auth.getadministrate.com/oauth/token?code=<Authorization Code>&grant_type=authorization_code&
    //client_id=<Client Key>&client_secret=<Client Secret>&redirect_uri=<OAuth Callback URL>

    $body = array(
        'grant_type'    => 'authorization_code',
        'code'          => $auth_code,
        'redirect_uri'  => $redirect_uri,
        'client_id'     => $client_id,
        'client_secret' => $client_secret
    );

    // Make the POST request to exchange the code for an access token
    $response = wp_remote_post($token_url, array(
        'method'    => 'POST',
        'body'      => $body,
        'headers'   => array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        ),
    ));

    // Check for success
    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        error_log('Error exchanging code for token: ' . $error_message);
    } else {
        // Process the response and extract the access token
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        /* { "access_token": "KtMcnaOuXr39wMDSEvOBnMnhVWeInD", "expires_in": 3600,
             "token_type": "Bearer",
             "scope": "instance",
             "refresh_token": "NkjG3GbdRtb5AQCkw4D4pkJEk6JNEF"}
        */

        if (isset($data['access_token'])) {
            $access_token = $data['access_token'];

            // Optionally, store the access token
            set_transient('administrate_oauth_access_token', $access_token, 3600); // 1 hour expiration
            update_option('administrate_oauth_refresh_token', $data['refresh_token'] ?? '');
            error_log('Access token received:' . $access_token);

        } else {
            error_log('Failed to get access token');
        }

    }
}

add_action('admin_notices', function() {
    if (isset($_GET['custom_param']) && $_GET['custom_param'] === 'oauth_success') {
        echo '<div class="updated notice is-dismissible">
                <p>Successfully Received oAuth Token</p>
              </div>';
    }
});
