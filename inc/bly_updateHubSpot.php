<?php

//add_action('woocommerce_review_order_after_submit', 'add_custom_button_to_checkout');
function add_custom_button_to_checkout()
{
    echo '<form method="post" action="' . esc_url($_SERVER['REQUEST_URI']) . '">
        <button type="submit" name="hubspot_callback_button" class="button alt" style="margin-top: 10px;">Send to HubSpot</button>
    </form>';
}


add_action('template_redirect', 'handle_hubspot_button_click');

function handle_hubspot_button_click()
{
    if (isset($_POST['hubspot_callback_button'])) {
        // Only execute if the button was clicked

        // Example logic: Get order details (you can adjust this to meet your needs)
        $order_id = rand(1000, 9999);  // Replace this with your actual order ID (e.g., $_GET['order_id']

        if ($order_id) {
            // Your HubSpot API request logic here
            //$response = send_to_hubspot(); //Todo: pass order_id as parameter
            $response = create_hubspot_contact_and_deal($order_id);

            if ($response) {
                // Handle successful API call (e.g., show a success message)
                echo '<script>alert("Data sent to HubSpot successfully!");</script>';
            } else {
                // Handle error
                echo '<script>alert("Data sent to HubSpot successfully!");</script>';
            }
        }
    }
}

function create_hubspot_contact_and_deal($order_id)
{
/*    if (!$order_id) {
        return;
    }*/
    error_log('executing');
    $order_id = 1234;
    $email = 'tim@tim.com';
    $first_name = 'Tim';
    $last_name = 'Smith';
    $phone = '1234567890';
    $order_total = 1000;

    // Dummy data for HubSpot contact
    $contact_data = [
        'properties' => [
            'email' => $email,
            'firstname' => $first_name,
            'lastname' => $last_name,
            'phone' => $phone,
        ]
    ];

    // Create Contact
    $contact_response = send_to_hubspot('contacts', $contact_data);

    // Extract contact ID if created successfully
    $contact_id = $contact_response['id'] ?? null;

    if ($contact_id) {
        // Dummy data for HubSpot deal
        $deal_data = [
            'properties' => [
                'dealname' => "Order #$order_id",
                'amount' => $order_total,
                'dealstage' => 'won',
                'pipeline' => 'default',
            ],
            'associations' => [
                [
                    'to' => [
                        'id' => $contact_id
                    ],
                    'types' => [
                        [
                            'associationCategory' => 'HUBSPOT_DEFINED',
                            'associationTypeId' => 3 // This is for Deal-to-Contact association
                        ]
                    ]
                ]
            ]
        ];

        // Create Deal
        send_to_hubspot('deals', $deal_data);
    }
}

function send_to_hubspot($endpoint, $data)
{
    $url = "https://api.hubapi.com/crm/v3/objects/$endpoint";
    $api_key = "pat-na1-334fd879-12ae-4d93-a4bf-65793eb160e8";

    $args = [
        'body' => json_encode($data),
        'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $api_key"
        ],
        'method' => 'POST'
    ];

    $response = wp_remote_post($url, $args);

    return json_decode(wp_remote_retrieve_body($response), true);
}
