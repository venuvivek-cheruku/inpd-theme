<?php 
    /* Template Name: Woo Login Template */
    get_header();
?>

<section class="woo-login-container ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="title text-align-center">
                    <h1>
                        <?php 
                        // Check if user is logged in or not
                        if ( is_user_logged_in() ) {
                            echo 'My Account'; 
                        } else {
                            echo 'Login'; 
                        }
                        ?>
                    </h1>
                </div>
            </div>
            <div class="login-signup-container">
                <?php echo do_shortcode('[woocommerce_my_account]'); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>