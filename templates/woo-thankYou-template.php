<?php 
    /* Template Name: Woo Thank You Template */
    get_header();
?>

<section class="woo-login-container woo-thankYou-container ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title text-align-center">
                    <h1>
                        Order Received
                    </h1>
                </div>
            </div>
            <div class="thankYou-container">
                <?php echo do_shortcode('[woocommerce_thankyou]'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>