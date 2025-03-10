<?php

add_action('woocommerce_before_single_product', 'refresh_product_stock');

function refresh_product_stock() {
    if (is_product()) {

        $post_id = isset($_GET['post']) ? intval($_GET['post']) : get_the_ID();
        $courseCode = 0;
        $group = get_field('product_meta_fields', $post_id);
        $cache_key = 'visited_product_' . $post_id;

        // Check if function has already run recently
        if (get_transient($cache_key)) {
            return;
        }


        if ($group && isset($group['administrate_course_code'])) {
            // Retrieve the field value from the group
            $courseCode = $group['administrate_course_code'];
            error_log('Administrate Course Code' . $courseCode);
        }

        get_sessions($post_id, $courseCode);
        set_transient($cache_key, true, 3600);
    }
}

