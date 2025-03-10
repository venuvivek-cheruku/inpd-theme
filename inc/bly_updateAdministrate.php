<?php

$graphqlEndpoint = 'https://developer.getadministrate.com/graphql';


add_action('woocommerce_thankyou', 'custom_after_purchase', 10, 1);

function custom_after_purchase($order_id)
{
    error_log('executing');

    if (!$order_id) {
        return;
    }

    // Get order details
    $order = wc_get_order($order_id);
    $order_data = $order->get_data(); // Get order data as an array

    // error_log('Order Data' . print_r($order_data, true));

    // Extract necessary information
    $company = $order_data['billing']['company'];
    $customer_name = $order_data['billing']['first_name'] . ' ' . $order_data['billing']['last_name'];
    $customer_first_name = $order_data['billing']['first_name'];
    $customer_last_name = $order_data['billing']['last_name'];
    $customer_email = $order_data['billing']['email'];
    $total = $order_data['total'];
    $items = [];


    error_log("Customer Name" . $customer_name);
    error_log("Customer Email" . $customer_email);

    // Find or Create Administrate Account
    $administrateAccountId = findAccount($company ?? $customer_name);
    if (!$administrateAccountId) {
        $administrateAccountId = createAccount($company ?? $customer_name, $customer_email);
        error_log("Administrate Account Created" . $administrateAccountId);
    }

    error_log("Account ID" . $administrateAccountId);

    // Find or Create Administrate Contact
    $administrateContactId = findContact($customer_email);
    if (!$administrateContactId) {
        $administrateContactId = createContact($customer_first_name, $customer_last_name, $customer_email, $administrateAccountId);
        error_log("Administrate Contact Created" . $administrateContactId);
    }

    error_log("Contact ID" . $administrateContactId);

    // Find or Create HubSpot Contact
    $hubspotContactId = findHubspotContact($customer_email);

    if (!$hubspotContactId) {
        $hubspotContactId = create_hubspot_contact($customer_first_name, $customer_last_name, $customer_email);
        error_log("Hubspot Contact Created" . $hubspotContactId);
    }

    error_log("HubSpot Contact ID" . $hubspotContactId);


    // Get order items
    foreach ($order->get_items() as $item_id => $item) {
        $product_name = $item->get_name();
        $product_id = $item->get_variation_id();
        $price = $item->get_total();
        $administrateEventId = get_post_meta($product_id, '_administrate_event_id', true);

        error_log("Product Id" . $product_id);
        error_log("Administrate Event Id" . $administrateEventId);
        error_log("Customer First Name" . $customer_first_name);
        error_log("Customer Last Name" . $customer_last_name);
        error_log("Customer Email" . $customer_email);


        $salesOpportunity = createSalesOpportunity($product_name, $administrateAccountId, $administrateContactId);

        $assignLearnerToEvent = assignLearnerToEvent(
            $salesOpportunity,
            $administrateEventId,
            $price,
            $administrateContactId
        );
        error_log("Learner Assigned to Event - ID" . $assignLearnerToEvent);


        create_hubspot_deal($hubspotContactId, $product_name, $price);

    }
}


function findAccount($name)
{
    error_log("executing find account" . $name);

    // Step 1: Check if the account already exists
    $query = '
        query {
          accounts(filters: [{
            field: name, operation: eq, value: "' . $name . '"
          }]) {
            edges {
              node {
                id
                name
              }
            }
          }
        }';

    $checkBody = send_to_administrate($query);

    if (!empty($checkBody['data']['accounts']['edges'])) {
        // Account already exists, return the existing ID
        $existingAccount = $checkBody['data']['accounts']['edges'][0]['node'];
        error_log('Account Found: ' . print_r($existingAccount, true));
        return $existingAccount['id'];
    }

    return false;
}

function findContact($email)
{
    error_log("executing find contact" . $email);

    // Step 1: Check if the account already exists
    $query = '
        query {
          contacts(filters: [{
            field: emailAddress, operation: eq, value: "' . $email . '"
          }]) {
             edges {
              node {
                id
                personalName {
                  firstName
                  lastName
                }
                emailAddress
              }
            }
          }
        }';

    $checkBody = send_to_administrate($query);

    if (!empty($checkBody['data']['contacts']['edges'][0]['node'])) {
        // contact already exists, return the existing ID
        return $checkBody['data']['contacts']['edges'][0]['node']['id'];
    }

    return false;
}


function createAccount($name, $email)
{

    //emailAddress: "' . $email . '"
    $graphqlQuery = '
            mutation {
              account{
                create(input:{
                  name: "' . $name . '"
                }){
                  account{
                    id
                  }
                  errors{
                    label 
                    message 
                    value
                  }
                }
              }
        }';

    $checkBody = send_to_administrate($graphqlQuery);
    error_log('Response: ' . print_r($checkBody, true));

    if (!empty($checkBody['data']['account']['create']['account']['id'])) {
        return $checkBody['data']['account']['create']['account']['id'];
    }
    return false;
}

function createContact($customer_first_name, $customer_last_name, $customer_email, $administrateAccountId)
{

    //emailAddress: "' . $email . '"
    $graphqlQuery = <<<GRAPHQL
            mutation {
              contact{
                create(input:{
                  accountId: "$administrateAccountId"
                  personalName:{
                    firstName: "$customer_first_name"
                    lastName: "$customer_last_name"
                  },
                  emailAddresses: [
                    {
                        address: "$customer_email"
                        usage: primary
                      }
                   ]
                }) {
                  contact{
                    id
                  }
                  errors{
                    label 
                    message 
                    value
                  }
                }
              } 
            }
            GRAPHQL;

    $checkBody = send_to_administrate($graphqlQuery);

    if (!empty($checkBody['data']['contact']['create']['contact']['id'])) {
        return $checkBody['data']['contact']['create']['contact']['id'];
    }
    return false;
}


function createSalesOpportunity($salesOpportunityName, $accountId, $contactId)
{

    $graphqlQuery = <<<GRAPHQL
                mutation{
                     opportunities{
                       create(input:{
                         name: "$salesOpportunityName"
                         regionId:"UmVnaW9uOkRS"
                         accountId: "$accountId"
                         contactId: "$contactId"
                         financialUnitId: "GBP",
                         marketingSourceTypeId: "TWFya2V0aW5nU291cmNlVHlwZToxNg=="
                       }) {
                         errors{
                           label
                           message
                           value
                         }
                         opportunity{
                           id
                           step{
                             id
                             name
                             stage{
                               id
                               name
                               state
                             }
                           }
                         }
                       }
                     }
                   }
            GRAPHQL;


    $checkBody = send_to_administrate($graphqlQuery);
    if (!empty($checkBody['data']['opportunities']['create']['opportunity']['id'])) {
        error_log("Sales Opportunity Created - ID" . $checkBody['data']['opportunities']['create']['opportunity']['id']);
        return $checkBody['data']['opportunities']['create']['opportunity']['id'];
    }

    return false;
}

function assignLearnerToEvent($opportunityId, $eventId, $price, $administrateContactId)
{
    $graphqlQuery = <<<GRAPHQL
        mutation {
          opportunities {
            addInterest(input: {
              opportunityId: "$opportunityId"
              interestDetails: {
                id: "$eventId"
                reserve: true
                quantity: 1
                unitAmount: $price
                eventDetails: {
                  existingLearners: [
                  {
                  id: "$administrateContactId"
                  }
                  ]
                  newLearners: []
                }
              }
            }) {
              errors {
                label
                message
                value
              }
              interests {
                id
                item {
                  id
                  __typename
                  ... on CourseTemplate {
                    code
                    title
                  }
                }
              }
            }
          }
        }
        GRAPHQL;

    error_log('Add Interest Query: ' . json_encode(array('query' => $graphqlQuery)));
    $checkBody = send_to_administrate($graphqlQuery);
    error_log('Response: ' . print_r($checkBody, true));

    if (!empty($checkBody['data'])) {
        return $checkBody['data'];
    }
    return false;
}

function findHubspotContact($email)
{
    $searchData = [
        "filterGroups" => [
            [
                "filters" => [
                    [
                        "propertyName" => "email",
                        "operator" => "EQ",
                        "value" => $email
                    ]
                ]
            ]
        ]
    ];

    // Find Contact
    $contactFound = send_to_hubspot('contacts/search', $searchData);
    $contactId = null;
    if($contactFound['total'] > 0)
    {
        $contactId = $contactFound['results'][0]['id'] ?? null;
    }

    return $contactId;
}

function create_hubspot_contact($contactFirstName, $contactLastName, $contactEmail,)
{
    $email = $contactEmail;
    $first_name = $contactFirstName;
    $last_name = $contactLastName;


    // Dummy data for HubSpot contact
    $contact_data = [
        'properties' => [
            'email' => $email,
            'firstname' => $first_name,
            'lastname' => $last_name,
        ]
    ];

    // Create Contact
    $contact_response = send_to_hubspot('contacts', $contact_data);
    // Extract contact ID if created successfully
    return $contact_response['id'] ?? null;
}

function create_hubspot_deal($contact_id, $orderName, $orderTotal)
{
    if (!$orderTotal || !$contact_id) {
        error_log('Order Total or Contact ID not found');
        return;
    }

    // Data for HubSpot deal
    $deal_data = [
        'properties' => [
            'dealname' => "Order #$orderName",
            'amount' => $orderTotal,
            'dealstage' => 'closedwon',
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

    error_log('Deal Data: ' . json_encode($deal_data));
    $dealCreation = send_to_hubspot('deals', $deal_data);
    return true;
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

    if (is_wp_error($response)) {
        error_log('Error from Hubspot API Call: ' . $response->get_error_message());
        return;
    }

    return json_decode(wp_remote_retrieve_body($response), true);
}

function send_to_administrate($data)
{
    $url = "https://developer.getadministrate.com/graphql";
    $administrateToken = get_transient('administrate_oauth_access_token');

    if (!$administrateToken) {
        refresh_access_token();
        $administrateToken = get_transient('administrate_oauth_access_token');
    }

    $args = array(
        'body' => json_encode(array('query' => $data)), // Encode the query as JSON
        'headers' => array(
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $administrateToken,
        )
    );

    $response = wp_remote_post($url, $args);

    if (is_wp_error($response)) {
        error_log('Error talking to GraphQL: ' . $response->get_error_message());
        return;
    }

    return json_decode(wp_remote_retrieve_body($response), true);
}


