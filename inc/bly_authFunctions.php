<?php

function refresh_access_token()
{
    $refresh_token = get_option('administrate_oauth_refresh_token');

    // Prepare the token request data
    $token_url = 'https://auth.getadministrate.com/oauth/token'; // Replace with the actual OAuth2 token endpoint URL
    $client_id = '8RbUb738J6m7WjO74nnyOgXa1yZf0E0N';  // Your OAuth client ID
    $client_secret = '9xpWV3hlQYeZUtZKGyGCzudXrSiMGk4C'; // Your OAuth client secret
    $redirect_uri = 'https://inpd.heyoo.website/administrate-callback'; // Your redirect URI
    //https://auth.getadministrate.com/oauth/token?code=<Authorization Code>&grant_type=authorization_code&
    //client_id=<Client Key>&client_secret=<Client Secret>&redirect_uri=<OAuth Callback URL>
    https://auth.getadministrate.com/oauth/token?refresh_token=<Refresh Token>&
    //grant_type=refresh_token&client_id=<Client Key>&client_secret=<Client Secret>&redirect_uri=<OAuth Callback URL>

    $body = array(
        'refresh_token' => $refresh_token,
        'grant_type' => 'refresh_token',
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
    );

    // Make the POST request to exchange the code for an access token
    $response = wp_remote_post($token_url, array(
        'method' => 'POST',
        'body' => $body,
        'headers' => array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        ),
    ));

    // Check for success
    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        error_log('Error Getting Refresh Token: ' . $error_message);
    } else {
        // Process the response and extract the access token
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);
        if (isset($data['access_token'])) {
            $access_token = $data['access_token'];
            // Optionally, store the access token
            set_transient('administrate_oauth_access_token', $access_token, 3600); // 1 hour expiration
            update_option('administrate_oauth_refresh_token', $data['refresh_token'] ?? '');
            error_log('Refresh Token Received' . $access_token);
        } else {
            error_log('Failed to get access token' . $data['error'] ?? '');
        }
    }
}


function get_sessions($productId, $courseCode)
{
    // Replace with GraphQL endpoint
    $graphqlEndpoint = 'https://developer.getadministrate.com/graphql';

    // Replace with your Administrate API token
    $administrateToken = get_transient('administrate_oauth_access_token');

    if (!$administrateToken) {
        refresh_access_token();
        $administrateToken = get_transient('administrate_oauth_access_token');
    }

    error_log('Administrate Token' . $administrateToken);
    error_log('Course Code' . $courseCode);
    error_log('Attempting to fetch sessions');

    // Use the ACF field value in the GraphQL query
    $graphqlQuery = '
            query {
                  events(
                    filters:[
                       {field: status, operation: eq, value: "Active"},
                       {field: code, operation: eq, value: "' . $courseCode . '"},
                      
                    ]
                    orderBy: [
                      {field: code, direction: asc}
                      {field: timeZonedStart, direction: asc}
                    ]
                  ) {
                    edges{
                      node{
                        id
                        displayId
                        code
                        status
                        title
                        learningMode
                        start
                        end
                        hasPlacesRemaining
                        remainingPlaces
                        bookedPlaces
                        maxPlaces
                        minPlaces
                        price,
                        prices {
                          edges {
                            node {
                              id
                              amount
                              priceLevel {
                                name
                              }

                            }
                          }
                        }
                        location {
                            name
                            id
                        }
                      }
                    }
                  }
              }
        ';

    $args = array(
        'body' => json_encode(array('query' => $graphqlQuery)), // Encode the query as JSON
        'headers' => array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $administrateToken,
        )
    );

    $response = wp_remote_post($graphqlEndpoint, $args);

    if (is_wp_error($response)) {
        // Handle error
        $error_message = $response->get_error_message();
        error_log("Something went wrong: . $error_message");
    } else {
        // Process the response
        $body = wp_remote_retrieve_body($response); // Get the response body
        $data = json_decode($body, true); // Decode JSON response (if applicable)

        $events = $data['data']['events']['edges'] ?? [];

        if (empty($events)) {
            error_log('No events found');
            return new WP_REST_Response(['data' => 'No events found'], 200);
        }

        // Get the Variable product object (parent)
        $product = wc_get_product($productId);

        if (!$product) {
            error_log('Product not found');
            return new WP_REST_Response(['data' => 'Product not found'], 200);
        }


        // Step 1: Collect Unique Attribute Options
        $attributes = [
            'Dates' => [],
            'Times' => [],
            'Location' => [],
            'Type' => []
        ];

        foreach ($events as $event) {
            $node = $event['node'];
            $location = $node['location']['name'];
            $date = date('d M Y', strtotime($node['start']));
            $time = date('H:i A', strtotime($node['start']));

            foreach ($node['prices']['edges'] as $priceNode) {
                $priceLevel = $priceNode['node']['priceLevel']['name'];

                if (!in_array($date, $attributes['Dates'])) {
                    $attributes['Dates'][] = $date;
                }

                if (!in_array($time, $attributes['Times'])) {
                    $attributes['Times'][] = $time;
                }

                if (!in_array($location, $attributes['Location'])) {
                    $attributes['Location'][] = $location;
                }

                if (!in_array($priceLevel, $attributes['Type'])) {
                    $attributes['Type'][] = $priceLevel;
                }
            }
        }

        error_log('Attributes: ' . json_encode($attributes));

        // Step 2: Create Attributes
        $productAttributes = [];


        global $wpdb;
        //  {"Location":["London","Virtual"],"Dates":["13 Jan 2025","19 May 2025","15 Jul 2025","20 Oct 2025","10 Feb 2026"],"Price Level":["Face to Face","Normal"]}
        foreach ($attributes as $name => $options) {
            $attr_slug = 'pa_' . wc_sanitize_taxonomy_name($name);

            // Ensure attribute exists in WooCommerce's system
            //$attribute_name = strtolower(str_replace(' ', '_', $name));
            $attribute_name = wc_sanitize_taxonomy_name($name);
            $existing_attribute = $wpdb->get_row(
                "SELECT * FROM {$wpdb->prefix}woocommerce_attribute_taxonomies WHERE attribute_name = '$attribute_name'"
            );

            if (!$existing_attribute) {
                $wpdb->insert(
                    "{$wpdb->prefix}woocommerce_attribute_taxonomies",
                    [
                        'attribute_name' => $attribute_name,
                        'attribute_label' => $name,
                        'attribute_type' => 'select',
                        'attribute_orderby' => 'menu_order',
                        'attribute_public' => 0,
                    ]
                );
                error_log('Attribute created in woocommerce_attribute_taxonomies: ' . $attribute_name);
                delete_transient('wc_attribute_taxonomies');
            }

            // Assign terms correctly
            $term_ids = [];
            foreach ($options as $option) {
                $term = term_exists($option, $attr_slug);
                if (!$term) {
                    $term = wp_insert_term($option, $attr_slug);
                    error_log('Term created: ');
                }
                if (!is_wp_error($term)) {
                    $term_ids[] = intval($term['term_id']);
                }
            }
            wp_set_object_terms($productId, $term_ids, $attr_slug);


            error_log('Product attributes: ' . print_r($productAttributes, true));

            // Refresh Product
            $product = wc_get_product($productId);

            // Set attributes
            $attribute = new \WC_Product_Attribute();
            $attribute->set_name($attr_slug);
            $attribute->set_options($options);
            $attribute->set_position(0);
            $attribute->set_visible(true); // Make this attribute visible on the product page
            $attribute->set_variation(true); // Make this attribute available for variations
            $productAttributes[] = $attribute;
        }

        error_log('Product attributes: ' . print_r($productAttributes, true));

        // Set the attributes to the product
        $product->set_attributes($productAttributes);
        $product->save();

        // Debugging
        $product = wc_get_product($productId);
        error_log('Final Product attributes: ' . print_r($product->get_attributes(), true));


        foreach ($events as $event) {
            $node = $event['node'];
            $administrateEventId = $node['id'] ?? '';
            error_log('Administrate Event ID: ' . $administrateEventId);
            $location = $node['location']['name'];
            $date = date('d M Y', strtotime($node['start']));
            $time = date('H:i A', strtotime($node['start']));
            $remainingPlaces = $node['remainingPlaces'];

            foreach ($node['prices']['edges'] as $priceNode) {
                $price = $priceNode['node']['amount'];
                $priceLevel = $priceNode['node']['priceLevel']['name'];

                // Check if the variation already exists
                $WC_Product_Data_Store_CPT = new WC_Product_Data_Store_CPT;
                $matchingIdFound = $WC_Product_Data_Store_CPT->find_matching_product_variation($product, [
                    'attribute_pa_location' => $location,
                    'attribute_pa_dates' => $date,
                    'attribute_pa_times' => $time,
                    'attribute_pa_type' => $priceLevel,
                ]);

                // Return 0 if no matching variation is found else returns the variation ID
                if ($matchingIdFound !== 0) {
                    $variableProductFound = wc_get_product($matchingIdFound);
                    $variableProductFound->set_stock_quantity($remainingPlaces);
                    $variableProductFound->set_stock_status(($remainingPlaces > 0) ? 'instock' : 'outofstock');
                    $variableProductFound->update_meta_data('_administrate_event_id', $administrateEventId);
                    $variableProductFound->save();
                    error_log("Matching ID Found and Product Updated: ID $matchingIdFound");
                } else {
                    // Create the variation
                    $variation = new WC_Product_Variation;
                    $variation->set_parent_id($productId);
                    $variation->set_price($price);
                    $variation->set_regular_price($price);
                    $variation->set_stock_quantity($remainingPlaces);
                    $variation->set_manage_stock(true);
                    $variation->set_stock_status(($remainingPlaces > 0) ? 'instock' : 'outofstock');
                    $variation->set_attributes([
                        'pa_location' => $location,
                        'pa_dates' => $date,
                        'pa_times' => $time,
                        'pa_type' => $priceLevel,

                    ]);
                    $variation->update_meta_data('_administrate_event_id', $administrateEventId);
                    $variation->save();

                    $variationId = $variation->get_id();
                    error_log("New Variation Created: ID". $variationId);


                    //update_post_meta($variationId, '_administrate_event_id', $administrateEventId);
                }

                $product = wc_get_product($productId);
                $product->save();

                delete_transient('wc_attribute_taxonomies');
                error_log("Variation Creation for Price Edges is complete" . $productId);
            }
        }
        error_log('Variations created successfully!');
    }
}
