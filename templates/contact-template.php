<?php 
    /* Template Name: Contact Page Template */
    get_header();
?>

    <?php if( have_rows('contact_row') ) : while( have_rows('contact_row') ) : the_row(); ?>
        <section class="contact-top dark-blue-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="text-wrapper">
                            <?=get_sub_field('intro');?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-wrapper underlined-inputs">
                            <?php 
                                $form = get_sub_field('form_embed');
                                $bare_form = str_replace(array('<p>','</p>'),'',$form);
                            ?>
                            <?=$bare_form;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; endif; ?>

    <?php if( have_rows('contact_details') ) : while( have_rows('contact_details') ) : the_row(); ?>
        <section class="contact-lower light-blue-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 offset-lg-6">
                        <div class="contact-details">
                            <?php 
                                $phone = get_field('phone_number', 'option');
                                $email_address = get_field('email_address', 'option');
                                $location = get_field('address_linked', 'option');
                            ?>
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
                </div>
            </div>
        </section>
    <?php endwhile; endif; ?>

<?php get_footer();?>