<?php
// Add Meta Box with Button
add_action('add_meta_boxes', function() {
    add_meta_box('custom_graphql_box', 'GraphQL API', 'custom_graphql_button_callback', 'product', 'side');
});

function custom_graphql_button_callback($post) {
    // Retrieve the ACF field value
    $post_id = isset($_GET['post']) ? intval($_GET['post']) : get_the_ID();
    error_log('Post Id' . $post_id);


    // Retrieve the ACF group
    $courseCode = '';
    $group = get_field('product_meta_fields', $post_id);
    if ($group && isset($group['administrate_course_code'])) {
        // Retrieve the field value from the group
        $courseCode = $group['administrate_course_code'];
        error_log('Administrate Course Code' . $courseCode);
    } else {
        return 0;
    }

    error_log('Administrate Course Code' . $courseCode);
    // Output the button and pass the ACF value to JavaScript
    echo '<button id="custom-graphql-button" class="button">Call GraphQL API</button>';
    echo '<script>var courseCode = ' . json_encode($courseCode) . ';</script>';


}

// Add JavaScript to Handle Button Click and Make GraphQL Call
add_action('admin_footer', function() {
    ?>
    <script>
    document.getElementById('custom-graphql-button').addEventListener('click', function(e) {

        e.preventDefault();
        console.log(`Course Code + ${courseCode}`);


        const graphqlEndpoint = 'https://inpd.heyoo.website/wp-json/administrate/v1/fetch-sessions';

        // Make the GraphQL API call
        fetch(graphqlEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ courseCode: courseCode, productId: <?php echo get_the_ID(); ?> }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('GraphQL Response:', data); // Log the response to the console
            alert('GraphQL call successful! Check the console for the response.');
        })
        .catch(error => {
            console.error('Error:', error); // Log any errors
            alert('GraphQL call failed. Check the console for details.');
        });
    });
    </script>
    <?php
});