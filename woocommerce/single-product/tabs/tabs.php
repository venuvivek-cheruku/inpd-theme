<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
?>

<style>
.woocommerce div.product .woocommerce-tabs ul.tabs li,
.woocommerce div.product .woocommerce-tabs ul.tabs::before,
.woocommerce div.product .woocommerce-tabs ul.tabs li::before,
.woocommerce div.product .woocommerce-tabs ul.tabs li::after {
    border: none;
}

.product-testimonial {
    padding: 80px 0px;
}

.product-testimonial h2 {
    position: relative;
    margin-bottom: 40px;
    padding: 0 30px;
}

.woocommerce div.product .woocommerce-tabs ul.tabs {
    padding: 0;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li a {
    font-weight: 500 !important;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li {
    background-color: transparent !important;
    opacity: 0.5;
    font-weight: 500 !important;
    font-family: "Gilroy", sans-serif !important;
    text-transform: uppercase !important;
}

.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
    opacity: 1;
    border-bottom: 1px solid black;
    color: var(--bs-heading-color);
}

section.tabs-container {
    padding: 80px 0;
}

.product-description-wrapper {
    display: flex;
    gap: 20px;
}

.product-description-content.full-width {
    width: 100%;
    max-width: 100%;
}

@media screen and (max-width: 550px) {
    .woocommerce div.product .woocommerce-tabs ul.tabs li {
        padding: 0rem 1rem;
        font-size: 18px;
    }
}
</style>
<div class="container">
    <?php
    // Get the ACF group field
    $marketing_review = get_field('marketing_review_one'); 
    if ($marketing_review):
        $reviewer_image = $marketing_review['reviewer_image']; // Image field
        $review_text = $marketing_review['review']; // Review text field
        $reviewer_name = $marketing_review['reviewer']; // Reviewer name field
        ?>
    <div class="product-testimonial ">
        <div class="product-testimonial--avatar">
            <?php if($reviewer_image) { ?>
            <img src="<?php echo esc_url($reviewer_image['url']) ?>"
                alt="<?php echo esc_attr($reviewer_name ? $reviewer_name : 'Testimonial Image'); ?>" />
            <?php  } ?>

        </div>
        <div class="item single-test text-center">
            <h2><?php echo esc_html($review_text); ?></h2>
            <p class="job"><?php echo esc_html($reviewer_name); ?></p>
        </div>
    </div>
    <?php endif; ?>

    <?php
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

?>

</div>
<?php

if ( ! empty( $product_tabs ) ) : ?>

<section class="tabs-container grey-bg">
    <div class="container">
        <div class="woocommerce-tabs wc-tabs-wrapper">
            <ul class="tabs wc-tabs" role="tablist">
                <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
                <li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>"
                    role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                    <a href="#tab-<?php echo esc_attr( $key ); ?>">
                        <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab"
                id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel"
                aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                <?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
            </div>
            <?php endforeach; ?>

            <?php do_action( 'woocommerce_product_after_tabs' ); ?>
        </div>
    </div>
</section>

<?php endif; ?>