<?php
    if(!function_exists('cswSetup')){
        function cswSetup(){
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails');
            add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));
            add_theme_support('woocommerce');

            register_nav_menus(array(
                'main_header_menu_nav' => __('Header Main Menu', 'cswSetup'),
                'footer_col1_menu_nav' => __('Footer Column 1 Menu', 'cswSetup'),
                'footer_col2_menu_nav' => __('Footer Column 2 Menu', 'cswSetup'),
            ));
        }
    }
    add_action('after_setup_theme', 'cswSetup');

    //Set custom post excerpt length (chars)
    function custom_excerpt_length( $length ) {
        return 30;
    }
    add_filter('excerpt_length', 'custom_excerpt_length', 999);

    //Remove the dots from post excerpt
    function remove_excerpt_more($more) {
        return '';
    }
    add_filter('excerpt_more', 'remove_excerpt_more');

    //Remove auto P from CF7
    add_filter('wpcf7_autop_or_not', '__return_false');


    // Add the custom lost password link above the login button
    function add_lost_password_above_button() {
        echo '<p class="woocommerce-LostPassword lost_password inpd">';
        echo '<a href="' . esc_url( wp_lostpassword_url() ) . '">';
        echo esc_html__('Forgot password?', 'woocommerce');
        echo '</a>';
        echo '</p>';
    }
    add_action('woocommerce_login_form', 'add_lost_password_above_button', 15);

    // // Remove product tabs from the single product page
    // remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

    // Filter to change the 'Stock' header to 'Spaces' in the variant table
add_filter('pvtfw_columns_labels', function($default) {
    // Change the label for the stock column (availability_html)
    if (isset($default['availability_html'])) {
        $default['availability_html'] = __('Spaces', 'product-variant-table-for-woocommerce');
    }
    return $default;
});

// Customize the stock availability text to only show the stock quantity
add_filter('woocommerce_get_availability_text', function($availability, $product) {
    if ($product->is_in_stock()) {
        $stock_quantity = $product->get_stock_quantity();
        if ($stock_quantity > 0) {
            $availability = sprintf(__('%d', 'woocommerce'), $stock_quantity); // Show only the quantity
        }
    }
    return $availability;
}, 10, 2);

// Override stock availability display for out of stock products to show "0"
add_filter('woocommerce_get_stock_html', function($html, $product) {
    if (!$product->is_in_stock()) {
        // If the product is out of stock, display "0" instead of "Out of stock"
        $html = '<p class="stock out-of-stock">' . __('0', 'woocommerce') . '</p>';
    }
    return $html;
}, 10, 2);


// Redirect to /basket instead of /cart after adding product to cart
add_filter('woocommerce_add_to_cart_redirect', function($url) {
    // Set the URL to the /basket page
    $basket_url = home_url('/cart');
    
    return $basket_url;
});

// Rename the Description tab
add_filter('woocommerce_product_tabs', 'rename_description_tab', 98);
function rename_description_tab($tabs) {
    if (isset($tabs['description'])) {
        $tabs['description']['title'] = __('Summary', 'cswSetup'); 
    }
    return $tabs;
}


// Remove the Additional Information tab
add_filter('woocommerce_product_tabs', 'remove_additional_information_tab', 98);
function remove_additional_information_tab($tabs) {
    if (isset($tabs['additional_information'])) {
        unset($tabs['additional_information']); 
    }
    return $tabs;
}


add_filter('woocommerce_product_tabs', 'add_custom_product_tabs');
function add_custom_product_tabs($tabs) {

    // Add Learning Outcomes tab
    $tabs['learning_outcomes_tab'] = array(
        'title'    => __('Learning Outcomes', 'cswSetup'),
        'priority' => 10,
        'callback' => 'learning_outcomes_tab_content',
    );

    // Add Agenda tab
    $tabs['agenda_tab'] = array(
        'title'    => __('Agenda', 'cswSetup'),
        'priority' => 15,
        'callback' => 'agenda_tab_content',
    );

    // Add Qualifications tab
    $tabs['qualifications_tab'] = array(
        'title'    => __('Qualifications', 'cswSetup'),
        'priority' => 20,
        'callback' => 'qualifications_tab_content',
    );



    return $tabs;
}

// Callback for Qualifications tab
function qualifications_tab_content() {
      $qualification_content = get_field('qualification_content');
        echo wp_kses_post($qualification_content);
}

// Callback for Learning Outcomes tab
// Callback for Learning Outcomes tab
function learning_outcomes_tab_content() {
    $learning_outcomes = get_field('learning_outcomes');
    $learning_outcomes_image = get_field('learning_outcomes_image'); 

    // Add a conditional class if no image is present
    $content_class = $learning_outcomes_image ? 'product-description-content' : 'product-description-content full-width';
?>

<div class="product-description-wrapper">
    <div class="<?php echo esc_attr($content_class); ?>">
        <?php if ($learning_outcomes) {
            echo '<p>' . wp_kses_post($learning_outcomes) . '</p>';
        } ?>
    </div>

    <?php if ($learning_outcomes_image) : ?>
    <div class="product-featured-image">
        <img src="<?php echo esc_url($learning_outcomes_image['url']); ?>"
            alt="<?php echo esc_attr($learning_outcomes_image['alt']); ?>" />
    </div>
    <?php endif; ?>
</div>

<?php
}


function agenda_tab_content() {
    $agenda = get_field('agenda');
    $agenda_image = get_field('agenda_image'); 

    // Add a conditional class if no image is present
    $content_class = $agenda_image ? 'product-description-content' : 'product-description-content full-width';
?>

<div class="product-description-wrapper">
    <div class="<?php echo esc_attr($content_class); ?>">
        <?php if ($agenda) {
            echo '<p>' . wp_kses_post($agenda) . '</p>';
        } ?>
    </div>

    <?php if ($agenda_image) : ?>
    <div class="product-featured-image">
        <img src="<?php echo esc_url($agenda_image['url']); ?>" alt="<?php echo esc_attr($agenda_image['alt']); ?>" />
    </div>
    <?php endif; ?>
</div>

<?php
}


add_action('add_meta_boxes', function () {
    // Add the Page Attributes meta box for the Product post type
    add_meta_box(
        'pageparentdiv',
        __('Page Attributes'),
        'page_attributes_meta_box',
        'product',
        'side',
        'low'
    );
});

add_filter('register_post_type_args', function ($args, $post_type) {
    if ($post_type === 'product') {
        // Ensure 'page-attributes' is added to the 'supports' array
        if (!in_array('page-attributes', $args['supports'])) {
            $args['supports'][] = 'page-attributes';
        }
    }
    return $args;
}, 10, 2);

add_action('admin_init', function () {
    // Add 'page-attributes' and 'page-templates' support to WooCommerce products
    add_post_type_support('product', 'page-attributes');
});


function load_products_ajax() {
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = 6;

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $posts_per_page,
        'paged'          => $paged
    );

    if ($category !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    $products = new WP_Query($args);
    
    $output = '';
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            ob_start();
            include get_template_directory() . '/partials/course-card.php';
            $output .= ob_get_clean();
        }
    }

    $has_more = $products->found_posts > ($paged * $posts_per_page);

    wp_reset_postdata();

    echo json_encode([
        'html' => $output,
        'has_more' => $has_more
    ]);
    wp_die();
}

add_action('wp_ajax_load_products_ajax', 'load_products_ajax');
add_action('wp_ajax_nopriv_load_products_ajax', 'load_products_ajax');


function custom_product_loop_shortcode($atts) {
    // Extract the category slug from the shortcode attributes
    $atts = shortcode_atts(
        array(
            'category' => '', // Default empty
        ), 
        $atts, 
        'product_loop'
    );

    if (empty($atts['category'])) {
        return '<p>Please specify a category.</p>';
    }

    // Query WooCommerce products in the specified category
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 6, // Adjust as needed
        'tax_query'      => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $atts['category'],
            ),
        ),
    );

    $query = new WP_Query($args);
    if (!$query->have_posts()) {
        return '<p>No products found in this category.</p>';
    }
    // Start output buffering
    ob_start();
    echo '<div class="product-loop">';
    while ($query->have_posts()) {
        $query->the_post();
        global $product;

        // Include the partial template and pass product data
        get_template_part('partials/course-card', null, array(
            'product' => $product
        ));
    }
    echo '</div>';
    wp_reset_postdata();
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('product_loop', 'custom_product_loop_shortcode');


// Define logout button
function add_logout_to_mobile_menu($items, $args) {
    if ($args->theme_location == 'main_header_menu_nav' && is_user_logged_in()) {
        $logout_item = '<li class="menu-item nav-item mobile-logout">
            <a class="nav-link siteCTA blue" href="' . wp_logout_url(home_url()) . '">
                Logout
            </a>
        </li>';

        $items .= $logout_item; 
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_logout_to_mobile_menu', 10, 2);