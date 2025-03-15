<?php
/**
 * Description tab
 *
 * Template: woocommerce/single-product/tabs/description.php
 * 
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );

// Get the featured image URL
$featured_image_url = get_the_post_thumbnail_url( $post->ID, 'full' ); 

?>

<style>
.product-description-wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 50px;
    justify-content: space-between;
    margin-top: 20px;
}

.product-description-content {
    flex: 1 1 40%;
    max-width: 50%;
    min-width: 200px;
}

.product-featured-image {
    flex: 1 1 40%;
    max-width: 40%;
}

.product-featured-image img {
    width: 100%;
    height: auto;
    display: block;
}

@media screen and (max-width: 728px) {
    .product-description-wrapper {
        display: flex;
        flex-direction: column;
    }

    .product-description-content {
        flex: 1;
        max-width: 100%;
        min-width: 200px;
    }

    .product-featured-image {
        flex: 11;
        max-width: 100%;
    }
}
</style>

<div class="product-description-wrapper">
    <!-- Product Description Content -->
    <div class="product-description-content">
        <?php the_content(); ?>
    </div>

    <!-- Product Featured Image -->
    <?php if ( $featured_image_url ) : ?>
    <div class="product-featured-image">
        <img src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
    </div>
    <?php endif; ?>
</div>