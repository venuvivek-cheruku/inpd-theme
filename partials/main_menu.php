<?php 
    if( get_field('header_font_colour') ) {
        $hc = get_field('header_font_colour');
    } elseif( is_404() ) { 
        $hc = 'white';
    } elseif( is_post_type_archive( 'podcasts' ) ) {
        $hc = 'dark-blue';
    } else {
        $hc = 'dark-blue';
    }
?>
<header class="<?=$hc;?> d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="/" class="navbar-brand">
                    <?php if(get_field('main_logo', 'option')): ?>
                    <img src="<?=get_field('main_logo', 'option');?>" alt="" class="navbar-brand-image main">
                    <img src="<?=get_field('alt_logo', 'option');?>" alt="" class="navbar-brand-image alt">
                    <?php else: ?>
                    <img src="<?=get_template_directory_uri();?>/assets/images/image-coming-soon.jpg" alt=""
                        class="navbar-brand-image-temp" style=' height: 75px; margin:0; width: auto'>
                    <?php endif; ?>
                </a>
            </div>
            <div class="col-9">
                <div class="upper">
                    <div class="header-search">
                        <?=do_shortcode('[searchwp_form id=2]');?>
                    </div>
                    <div class="basket">
                        <a href="<?php echo wc_get_cart_url(); ?>" style="text-decoration: none;">
                            <!-- Cart Item Count -->
                            <?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
                            <?php if ( $cart_count > 0 ) : ?>
                            <span class=" cart-count">
                                <?php echo esc_html( $cart_count ); ?>
                            </span>
                            <?php endif; ?>
                            <svg id="Icon_ionic-ios-cart" data-name="Icon ionic-ios-cart"
                                xmlns="http://www.w3.org/2000/svg" width="28.441" height="26.269"
                                viewBox="0 0 28.441 26.269">
                                <path id="Path_1" data-name="Path 1"
                                    d="M11.624,29.156a1.031,1.031,0,1,1-1.031-1.031,1.031,1.031,0,0,1,1.031,1.031Z"
                                    transform="translate(-3.259 -3.917)" fill="#fff" />
                                <path id="Path_2" data-name="Path 2"
                                    d="M27.409,29.156a1.031,1.031,0,1,1-1.031-1.031,1.031,1.031,0,0,1,1.031,1.031Z"
                                    transform="translate(-1.35 -3.917)" fill="#fff" />
                                <path id="Path_3" data-name="Path 3"
                                    d="M31.813,9.512a.41.41,0,0,0-.356-.309L9.182,6.889a.682.682,0,0,1-.513-.345,7.561,7.561,0,0,0-.834-1.367c-.527-.691-1.518-.669-3.338-.683A1.024,1.024,0,0,0,3.382,5.529,1.008,1.008,0,0,0,4.449,6.565a8.471,8.471,0,0,1,1.778.14c.321.1.581.669.677,1.161a.028.028,0,0,0,.007.022c.014.088.137.75.137.757L9.784,24.2a5.953,5.953,0,0,0,.992,2.624,2.668,2.668,0,0,0,2.25,1.191H29.207a1,1,0,0,0,.985-.985.994.994,0,0,0-.957-1.073H13.012a.758.758,0,0,1-.568-.206,3.4,3.4,0,0,1-.787-1.911l-.294-1.742a.04.04,0,0,1,.027-.044L30.383,18.6a.418.418,0,0,0,.335-.382L31.813,9.7A.45.45,0,0,0,31.813,9.512Z"
                                    transform="translate(-3.382 -4.493)" fill="#fff" />
                            </svg>

                        </a>
                    </div>
                    <div class="buttons">
                        <?php if ( is_user_logged_in() ) : ?>
                        <!-- If user is logged in, show My Account and Logout buttons -->
                        <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"
                            class="siteCTA no-arrow">My Account</a>
                        <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="siteCTA no-arrow">Logout</a>
                        <?php else : ?>
                        <!-- If user is not logged in, show Login and Sign Up buttons -->
                        <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"
                            class="siteCTA no-arrow">Sign Up</a>
                        <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ); ?>"
                            class="siteCTA no-arrow">Log In</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="lower">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navigation" aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>
                        <?php 
                            wp_nav_menu(array(
                                'theme_location' => 'main_header_menu_nav',
                                'depth' => '2',
                                'container' => 'div',
                                'container_class' => 'collapse navbar-collapse',
                                'container_id' => 'navigation',
                                'menu_class' => 'navbar-nav ms-auto',
                                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                                'walker' => new WP_Bootstrap_Navwalker(),
                            ));
                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<header class="<?=$hc;?> d-block d-lg-none">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a href="<?=bloginfo('url');?>" class="navbar-brand">
                <?php if(get_field('main_logo', 'option')): ?>
                <img src="<?=get_field('main_logo', 'option');?>" alt="" class="navbar-brand-image main">
                <img src="<?=get_field('alt_logo', 'option');?>" alt="" class="navbar-brand-image alt">
                <?php else: ?>
                <img src="<?=get_template_directory_uri();?>/assets/images/image-coming-soon.jpg" alt=""
                    class="navbar-brand-image-temp" style=' height: 75px; margin:0; width: auto'>
                <?php endif; ?>
            </a>
            <div class="header-search d-none">
                <form role="search" method="get" id="searchform" class="searchform" action="http://www.test.dev/">
                    <div>
                        <label class="screen-reader-text" for="s">Search for:</label>
                        <input type="text" value="" name="s" id="s" />
                        <input type="submit" id="searchsubmit" value="Search" />
                    </div>
                </form>
            </div>
            <div class="basket">
                <a href="<?php echo wc_get_cart_url(); ?>" style="text-decoration: none;">
                    <!-- Cart Item Count -->
                    <?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
                    <?php if ( $cart_count > 0 ) : ?>
                    <span class=" cart-count" style="background-color: rgba(255, 255, 255, 0.35); color: #102E43;">
                        <?php echo esc_html( $cart_count ); ?>
                    </span>
                    <?php endif; ?>
                    <svg id="Icon_ionic-ios-cart" data-name="Icon ionic-ios-cart" xmlns="http://www.w3.org/2000/svg"
                        width="28.441" height="26.269" viewBox="0 0 28.441 26.269">
                        <path id="Path_1" data-name="Path 1"
                            d="M11.624,29.156a1.031,1.031,0,1,1-1.031-1.031,1.031,1.031,0,0,1,1.031,1.031Z"
                            transform="translate(-3.259 -3.917)" fill="#fff" />
                        <path id="Path_2" data-name="Path 2"
                            d="M27.409,29.156a1.031,1.031,0,1,1-1.031-1.031,1.031,1.031,0,0,1,1.031,1.031Z"
                            transform="translate(-1.35 -3.917)" fill="#fff" />
                        <path id="Path_3" data-name="Path 3"
                            d="M31.813,9.512a.41.41,0,0,0-.356-.309L9.182,6.889a.682.682,0,0,1-.513-.345,7.561,7.561,0,0,0-.834-1.367c-.527-.691-1.518-.669-3.338-.683A1.024,1.024,0,0,0,3.382,5.529,1.008,1.008,0,0,0,4.449,6.565a8.471,8.471,0,0,1,1.778.14c.321.1.581.669.677,1.161a.028.028,0,0,0,.007.022c.014.088.137.75.137.757L9.784,24.2a5.953,5.953,0,0,0,.992,2.624,2.668,2.668,0,0,0,2.25,1.191H29.207a1,1,0,0,0,.985-.985.994.994,0,0,0-.957-1.073H13.012a.758.758,0,0,1-.568-.206,3.4,3.4,0,0,1-.787-1.911l-.294-1.742a.04.04,0,0,1,.027-.044L30.383,18.6a.418.418,0,0,0,.335-.382L31.813,9.7A.45.45,0,0,0,31.813,9.512Z"
                            transform="translate(-3.382 -4.493)" fill="#fff" />
                    </svg>

                </a>
            </div>
            <button type='button' data-bs-toggle='collapse' data-bs-target='.navbar-collapse' id='nav-btn'
                class='navbar-toggler ml-auto menu' aria-label='Menu Button'>
                <svg width="35" height="35" viewBox="0 0 100 100">
                    <path class="line line1"
                        d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058">
                    </path>
                    <path class="line line2" d="M 20,50 H 80"></path>
                    <path class="line line3"
                        d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942">
                    </path>
                </svg>
            </button>
            <?php 
                wp_nav_menu(array(
                    'theme_location' => 'main_header_menu_nav',
                    'depth' => '2',
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'navigation',
                    'menu_class' => 'navbar-nav ms-auto',
                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ));
                
            ?>

        </div>
    </nav>
</header>