<?php get_header(); ?>

    <section class="cs-top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="text-wrapper text-center">
                        <?=get_field('intro_content', 'option');?>
                    </div>
                </div>
                <div class="col-12">
                    <?php if( have_rows('blue_banner', 'option') ) : while( have_rows('blue_banner', 'option') ) : the_row(); ?>
                        <?php 
                            $img = get_sub_field('image');
                            $cont = get_sub_field('content');
                        ?>
                        <div class="blue-box">
                            <?php if( $img ) : ?>
                                <div class="image">
                                    <img src="<?=$img['url'];?>" alt="<?=$img['alt'];?>" class="img-fluid">
                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <?=$cont;?>
                            </div>
                        </div>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="cs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tax-filter">
                        <?php
                        // Get all terms from the 'industry' taxonomy
                        $industries = get_terms( array(
                            'taxonomy' => 'industry',
                            'hide_empty' => true, // Set to true if you want to hide terms with no posts
                        ) );

                        if ( ! empty( $industries ) && ! is_wp_error( $industries ) ) : ?>
                            <ul class="industry-list list-unstyled list-inline">
                                <li class="list-inline-item"><strong>Filter:</strong></li>
                                <?php foreach ( $industries as $industry ) : ?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo esc_url( get_term_link( $industry ) ); ?>">
                                            <?php echo esc_html( $industry->name ); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="cs-wrap">
                        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
                            <?php 
                                $logo = get_field('company_logo');
                                $title = get_the_title();
                                $overview = get_field('company_overview');
                                $link = get_the_permalink();
                            ?>
                            <div class="single-cs">
                                <img src="<?=$logo['url'];?>" alt="<?=$logo['alt'];?>" class="img-fluid">
                                <h4><?=$title;?></h4>
                                <p><?=wp_trim_words( $overview, 17 );?></p>
                                <a href="<?=$link;?>" class="arrow-cta">Find out more</a>
                            </div>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if( have_rows('call_to_action', 'option') ) : while( have_rows('call_to_action', 'option') ) : the_row(); ?>
        <section class="cta-row dark-blue-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="text-wrapper">
                            <?=get_sub_field('content');?>
                        </div>
                        <?php 
                            $cta_btn = get_sub_field('button');
                            if( $cta_btn ) {
                            echo '<div class="button-wrapper">';
                                $btn_txt = $cta_btn['title'];
                                $btn_url = $cta_btn['url'];
                                $btn_trgt = $cta_btn['target'] ? $cta_btn['target'] : '_self';
                                echo '<a href="'.$btn_url.'" class="siteCTA white" target="'.$btn_trgt.'">'.$btn_txt.'</a>';
                            echo '</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; endif; ?>

<?php get_footer(); ?>