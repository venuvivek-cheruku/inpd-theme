        </main>
        <footer>
            <div class="footerMain dark-blue-bg">
                <div class="container">
                    <div class="row">
                        <?php if( have_rows('column_1', 'option') ) : while( have_rows('column_1', 'option') ) : the_row(); ?>
                            <div class="col-12 col-lg-2">
                                <h5><?=get_sub_field('menu_title');?></h5>
                                <?php 
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer_col1_menu_nav',
                                        'depth' => '1',
                                        'container' => 'div',
                                        'container_class' => 'footer-menu',
                                        'menu_class' => 'list-unstyled',
                                        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                                        'walker' => new WP_Bootstrap_Navwalker(),
                                    ));
                                ?>
                            </div>
                        <?php endwhile; endif; ?>
                        <?php if( have_rows('column_2', 'option') ) : while( have_rows('column_2', 'option') ) : the_row(); ?>
                            <div class="col-12 col-lg-2">
                                <h5><?=get_sub_field('menu_title');?></h5>
                                <?php 
                                    wp_nav_menu(array(
                                        'theme_location' => 'footer_col2_menu_nav',
                                        'depth' => '1',
                                        'container' => 'div',
                                        'container_class' => 'footer-menu',
                                        'menu_class' => 'list-unstyled',
                                        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                                        'walker' => new WP_Bootstrap_Navwalker(),
                                    ));
                                ?>
                            </div>
                        <?php endwhile; endif; ?>
                        <?php if( have_rows('column_3', 'option') ) : while( have_rows('column_3', 'option') ) : the_row(); ?>
                            <div class="col-12 col-lg-3">
                                <h5><?=get_sub_field('column_title');?></h5>
                                <?php 
                                    $phone = get_field('phone_number', 'option');
                                    $email_address = get_field('email_address', 'option');
                                    $location = get_field('address_linked', 'option');
                                ?>
                                <div class="contact-details">
                                    <?php if( $phone ) : ?>
                                        <a class="phone-link" href="tel:<?=$phone;?>"><?=$phone;?></a>
                                    <?php endif; ?>
                                    <?php if( $email_address ) : ?>
                                        <a class="email-link" href="mailto:<?=$email_address;?>"><?=$email_address;?></a>
                                    <?php endif; ?>
                                    <?php if( $location ) : ?>
                                        <?=$location;?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                        <?php if( have_rows('column_4', 'option') ) : while( have_rows('column_4', 'option') ) : the_row(); ?>
                            <div class="col-12 col-lg-4 offset-lg-1">
                                <h5><?=get_sub_field('form_title');?></h5>
                                <div class="footer-form">
                                    <?php 
                                        $form = get_sub_field('form_embed');
                                        $bare_form = str_replace(array('<p>','</p>'),'',$form);
                                    ?>
                                    <?=$bare_form;?>
                                </div>
                                <div class="social-icons">
                                    <?php
                                        $li = get_field('linkedin_url', 'option');
                                        $fb = get_field('facebook_url', 'option');
                                        $yt = get_field('youtube_url', 'option');
                                    ?>
                                    <?php if( $li ) : ?>
                                        <a class="li-link" href="<?=$li;?>" target="_blank"><img src="/wp-content/uploads/2024/06/linkedin.svg" alt="Linkedin Icon" class="img-fluid"></a>
                                    <?php endif; ?>
                                    <?php if( $fb ) : ?>
                                        <a class="fb-link" href="<?=$fb;?>" target="_blank"><img src="/wp-content/uploads/2024/06/facebook.svg" alt="Facebook Icon" class="img-fluid"></a>
                                    <?php endif; ?>
                                    <?php if( $yt ) : ?>
                                        <a class="yt-link" href="<?=$yt;?>" target="_blank"><img src="/wp-content/uploads/2024/06/youtube.svg" alt="YouTube Icon" class="img-fluid"></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
            <div class="footerBottom">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-10 offset-lg-1">
                            <p>In-Professional Development is a company registered in England and Wales. Registered number: 10777587. VAT registration Number: 285136002. Registered office: In-Professional Development, Blackthorn House, Appley Bridge, Greater Manchester, WN6 9DB. HTML Sitemap</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php wp_footer();?>
    </body>
</html>