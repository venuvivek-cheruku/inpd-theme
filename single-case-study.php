<?php get_header(); ?>
    <section class="csi-top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h1 class="d-none"><?=the_title();?></h1>
                    <?php $logo = get_field('company_logo'); ?>
                    <img src="<?=$logo['url'];?>" alt="<?=$logo['alt'];?>" class="img-fluid">
                </div>
                <div class="col-12 col-lg-7">
                    <?php
                        $comp_prof = get_field('company_profile');
                        $comp_ov = get_field('company_overview');
                    ?>
                    <div class="blue-box">
                        <div class="image-wrapper d-block d-lg-none">
                            <img src="<?=get_the_post_thumbnail_url();?>" alt="<?=the_title();?>" class="img-fluid">
                        </div>
                        <?php if( $comp_prof ) : ?>
                            <div class="comp-prof">
                                <h2>Company Profile</h2>
                                <p><?=$comp_prof;?></p>
                            </div>
                        <?php endif; ?>
                        <?php if( $comp_ov ) : ?>
                            <div class="comp-ov">
                                <h2>Company Overview</h2>
                                <p><?=$comp_ov;?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-5 d-none d-lg-block">
                    <div class="image-wrapper">
                        <img src="<?=get_the_post_thumbnail_url();?>" alt="<?=the_title();?>" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="cs-content">

    <?php if( have_rows('cs_content') ) : while( have_rows('cs_content') ): the_row(); ?>

        <?php if( get_row_layout() == 'video_row' ): ?>
            <?php
                $ph = get_sub_field('vid_ph');
                $vid = get_sub_field('video_embed_url'); 
            ?>
            <section class="cs-video">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-10 offset-lg-1">
                            <div class="video-img" data-aos="fade-right">
                                <img src="<?=$ph['url'];?>" alt="<?=$ph['alt'];?>" class="img-fluid">
                                <div class="vid-btn">
                                    <a data-bs-toggle="modal" data-bs-target=".vid-modal"><img src="/wp-content/uploads/2024/07/play-btn-1.svg" alt="Play Button" class="img-fluid"></a>
                                </div>
                            </div>
                            <div class="modal fade vid-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="row">
                                            <div class="col-12 video-wrapper">
                                                <div class="close" data-bs-dismiss="modal">&#10005;</div>
                                                <iframe src="<?=$ph;?>" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'title_with_content' ): ?>
            <section class="title4-cont8">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="title-wrapper">
                                <h2><?=get_sub_field('title');?></h2>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="text-wrapper">
                                <?=get_sub_field('content');?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif( get_row_layout() == 'banner_image' ): ?>        
            <?php 
                $img = get_sub_field('image');
                $img_h = get_sub_field('image_height');
            ?>
            <section class="banner-image">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="image-wrapper">
                                <img src="<?=$img['url'];?>" alt="<?=$img['alt'];?>" style="width: 100%; height: <?=$img_h;?>px;" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>

    <?php endwhile; endif; ?>

    </div>

    <div class="container">
        <div class="cs-next-prev">
            <?php if( get_previous_post() !== '' ) : ?>
                <div class="prev">
                    <a href="<?=get_the_permalink( get_previous_post()->ID );?>">Previous case study</a>
                </div>
            <?php endif; ?>
            <?php if( get_next_post() !== '' ) : ?>
                <div class="next">
                    <a href="<?=get_the_permalink( get_next_post()->ID );?>">Next case study</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if( have_rows('cs_slider') ) : while( have_rows('cs_slider') ) : the_row(); ?>
        <?php if( get_sub_field('show_slider') ) : ?>
            <section class="case-studies-row more-cs">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="text-wrapper">
                                <?=get_sub_field('intro_text');?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="cs-slider">
                                <?php $cs_items = get_sub_field('cs_selection'); ?>
                                <?php foreach ( $cs_items as $post ) : setup_postdata($post); ?>
                                    <?php 
                                        $logo = get_field('company_logo');
                                        $title = get_the_title();
                                        $overview = get_field('company_overview');
                                        $link = get_the_permalink();
                                    ?>
                                    <div class="item">
                                        <div class="single-cs">
                                            <img src="<?=$logo['url'];?>" alt="<?=$logo['alt'];?>" class="img-fluid">
                                            <h4><?=$title;?></h4>
                                            <p><?=wp_trim_words( $overview, 17 );?></p>
                                            <a href="<?=$link;?>" class="arrow-cta">Find out more</a>
                                        </div>
                                    </div>
                                <?php endforeach; wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; endif; ?>

    <section class="three-stats grey-bg mt-5">
        <div class="container">
            <div class="row">
                <?php if( have_rows('ts_stats', 'option') ) : while( have_rows('ts_stats', 'option') ) : the_row(); ?>
                    <?php
                        $icon = get_sub_field('icon');
                        $num = get_sub_field('number');
                        $symb = get_sub_field('symbol');
                        $txt = get_sub_field('text');
                    ?>
                    <div class="col-12 col-lg-4">
                        <div class="single-stat">
                            <div class="icon">
                                <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid">
                            </div>
                            <div class="text">
                                <h4><span class="number"><?=$num;?></span><?php if( $symb ) : ?><span class="extra"><?=$symb;?></span><?php endif; ?></h4>
                                <p><?=$txt;?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>