<?php 
    /* Template Name: Page Template */
    get_header();
?>

    <?php if( have_rows('page_content') ): ?>
        <?php while( have_rows('page_content') ): the_row(); ?>
            
            <?php if( get_row_layout() == 'top_row_with_bg' ): ?>
                <?php the_sub_field('paragraph'); ?>
            
            <?php elseif( get_row_layout() == 'cent_top_row' ): ?> <!-- Centered Top Row -->
                <?php 
                    $cont = get_sub_field('ctr_content');
                    $sbtn = get_sub_field('ctr_sbtn');
                    $obtn = get_sub_field('ctr_obtn');
                ?>
                <section class="centered-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="text-wrapper">
                                    <?=$cont;?>
                                </div>
                                <?php if( $sbtn || $obtn ) {
                                    echo '<div class="button-wrapper">';
                                    if( $sbtn ) {
                                        $sbtn_txt = $sbtn['title'];
                                        $sbtn_url = $sbtn['url'];
                                        $sbtn_trgt = $sbtn['target'] ? $sbtn['target'] : '_self';
                                        echo '<a href="'.$sbtn_url.'" class="siteCTA blue" target="'.$sbtn_trgt.'">'.$sbtn_txt.'</a>';
                                    }
                                    if( $obtn ) {
                                        $obtn_txt = $obtn['title'];
                                        $obtn_url = $obtn['url'];
                                        $obtn_trgt = $obtn['target'] ? $obtn['target'] : '_self';
                                        echo '<a href="'.$obtn_url.'" class="siteCTA blue-border" target="'.$obtn_trgt.'">'.$obtn_txt.'</a>';
                                    }
                                    echo '</div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'banner_image' ) : ?> <!-- Banner Image -->
                <?php 
                    $bnr_h = get_sub_field('bnr_img_height');
                    $bnr_img = get_sub_field('bnr_img');
                ?>
                <section class="banner-image">
                    <div class="container-fluid px-0">
                        <img src="<?=$bnr_img['url'];?>" alt="<?=$bnr_img['alt'];?>" class="img-fluid" style="height: <?=$bnr_h;?>px;">
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'cent_tabs' ) : ?> <!-- Centered Tabs -->
                <section class="centered-tabs">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <?php if( have_rows('ct_tab_rep') ) :  $i = 1; while( have_rows('ct_tab_rep') ) : the_row(); ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?php if($i == 1) { echo 'active'; } ?>" id="tab-title-<?=$i;?>" data-bs-toggle="tab" data-bs-target="#tab-<?=$i;?>" type="button" role="tab" aria-controls="tab-<?=$i;?>" aria-selected="true"><h2><?=get_sub_field('tab_title');?></h2></button>
                                        </li>
                                        <?php $i++; ?>
                                    <?php endwhile; endif; ?>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <?php if( have_rows('ct_tab_rep') ) :  $i = 1; while( have_rows('ct_tab_rep') ) : the_row(); ?>
                                        <div class="tab-pane fade <?php if($i == 1) { echo 'active show'; } ?>" id="tab-<?=$i;?>" role="tabpanel" aria-labelledby="tab-title-<?=$i;?>">
                                            <div class="content">
                                                <?=get_sub_field('tab_content');?>
                                            </div>
                                            <?php if( get_sub_field('show_icons_inside_tab') ) : ?>
                                            <div class="icon-wrapper">
                                                <?php while( have_rows('tab_icon_repeater') ) : the_row(); ?>
                                                    <div class="item">
                                                        <?php $it_icon = get_sub_field('ir_icon'); ?>
                                                        <img src="<?=$it_icon['url'];?>" alt="<?=$it_icon['alt'];?>" class="img-fluid">
                                                        <p><?=get_sub_field('ir_text');?></p>
                                                    </div>
                                                <?php endwhile; ?>
                                            </div>
                                            <?php endif; ?>
                                            <?php
                                                $it_btn = get_sub_field('tab_inner_button');
                                                echo '<div class="button-wrapper">';
                                                if( $it_btn ) {
                                                    $itbtn_txt = $it_btn['title'];
                                                    $itbtn_url = $it_btn['url'];
                                                    $itbtn_trgt = $it_btn['target'] ? $it_btn['target'] : '_self';
                                                    echo '<a href="'.$itbtn_url.'" class="siteCTA blue" target="'.$itbtn_trgt.'">'.$itbtn_txt.'</a>';
                                                }
                                                echo '</div>';
                                            ?>
                                        </div>
                                        <?php $i++; ?>
                                    <?php endwhile; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'title_with_icons' ) : ?> <!-- Title With Icons -->
                <?php 
                    $sub_title = get_sub_field('twi_sub_title');
                    $title = get_sub_field('twi_title');
                    $icon_items = get_sub_field('icon_items');
                    if( $icon_items ) { 
                        $icon_count = count( $icon_items );
                    } else {
                        $icon_count = '';
                    }
                ?>
                <section class="title-with-icons <?=get_sub_field('background_colour');?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="title-wrapper">
                                    <p class="blue-underline text-uppercase"><?=$sub_title;?></p>
                                    <?=$title;?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="icon-wrapper icon-slider">
                                    <?php if( have_rows('icon_items') ) : while( have_rows('icon_items') ) : the_row(); ?>
                                        <?php 
                                            $icon = get_sub_field('icon');
                                            $text = get_sub_field('text');
                                        ?>
                                        <div class="item">
                                            <div class="icon-item">
                                                <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid">
                                                <p><?=$text;?></p>
                                            </div>
                                        </div>
                                    <?php endwhile; endif; ?>
                                </div>
                                <div class="icon-nav">
                                    <div class="prev">
                                        <img src="/wp-content/uploads/2024/07/blue-nav-arrow-left.svg" alt="Arrow Left" class="img-fluid">
                                    </div>
                                    <div class="icon-dots-container <?php if( $icon_count <= 5 ) { echo 'd-none'; } ?>"></div>
                                    <div class="next">
                                        <img src="/wp-content/uploads/2024/07/blue-nav-arrow-right.svg" alt="Arrow Right" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'content_left__float_image_right' ) : ?> <!-- Content / Float Img -->
                <?php
                    $fir_bg = get_sub_field('fir_bg');
                    $fir_stitle = get_sub_field('fir_sub_title');
                    $fir_cont = get_sub_field('fir_content');
                    $fir_img = get_sub_field('fir_image');
                    $fir_btn = get_sub_field('fir_button');
                ?>
                <section class="cleft-imgright <?=$fir_bg;?> position-relative">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="text-wrapper">
                                    <p class="blue-underline text-uppercase"><?=$fir_stitle;?></p>
                                    <?=$fir_cont;?>
                                </div>
                                <?php if( $fir_btn ) {
                                    echo '<div class="button-wrapper">';
                                        $fir_btn_txt = $fir_btn['title'];
                                        $fir_btn_url = $fir_btn['url'];
                                        $fir_btn_trgt = $fir_btn['target'] ? $fir_btn['target'] : '_self';
                                        echo '<a href="'.$fir_btn_url.'" class="siteCTA blue" target="'.$fir_btn_trgt.'">'.$fir_btn_txt.'</a>';
                                    echo '</div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="float-img <?php if( get_sub_field('contain_image_on_mobile') ) : ?>mob-contain mt-0<?php endif; ?>">
                        <img src="<?=$fir_img['url'];?>" alt="<?=$fir_img['alt'];?>" class="img-fluid">
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'float_image_left__content_right' ) : ?> <!-- Float Img / Content -->
                <?php
                    $fil_bg = get_sub_field('fil_bg');
                    $fil_stitle = get_sub_field('fil_sub_title');
                    $fil_cont = get_sub_field('fil_content');
                    $fil_img = get_sub_field('fil_image');
                    $fil_btn = get_sub_field('fil_button');
                ?>
                <section class="imgleft-contr <?=$fil_bg;?> position-relative">
                    <div class="float-img">
                        <img src="<?=$fil_img['url'];?>" alt="<?=$fil_img['alt'];?>" class="img-fluid">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-6">
                                <div class="text-wrapper">
                                    <p class="blue-underline text-uppercase"><?=$fil_stitle;?></p>
                                    <?=$fil_cont;?>
                                </div>
                                <?php if( $fil_btn ) {
                                    echo '<div class="button-wrapper">';
                                        $fir_btn_txt = $fil_btn['title'];
                                        $fir_btn_url = $fil_btn['url'];
                                        $fir_btn_trgt = $fil_btn['target'] ? $fil_btn['target'] : '_self';
                                        echo '<a href="'.$fir_btn_url.'" class="siteCTA blue" target="'.$fir_btn_trgt.'">'.$fir_btn_txt.'</a>';
                                    echo '</div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'title_with_cards' ) : ?> <!-- Title With Cards -->
                <section class="title-with-cards grey-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="title-wrapper">
                                    <p class="blue-underline lw-50 text-uppercase center"><?=get_sub_field('twc_sub_title');?></p> 
                                    <?=get_sub_field('twc_title');?>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <?php if( have_rows('card_repeater') ) : while( have_rows('card_repeater') ) : the_row(); ?>
                                <?php 
                                    $img = get_sub_field('image');
                                    $cont = get_sub_field('content');
                                    $button = get_sub_field('button');
                                ?>
                                <div class="col-12 col-lg-4">
                                    <div class="single-card">
                                        <?php if( $img ) : ?>
                                            <div class="image-wrapper">
                                                <img src="<?=$img['url'];?>" alt="<?=$img['alt'];?>" class="img-fluid">
                                            </div>
                                        <?php endif; ?>
                                        <div class="content br-cut">
                                            <?=$cont;?>
                                            <?php if( $button ) {
                                                echo '<div class="button-wrapper">';
                                                    $btn_txt = $button['title'];
                                                    $btn_url = $button['url'];
                                                    $btn_trgt = $button['target'] ? $button['target'] : '_self';
                                                    echo '<a href="'.$btn_url.'" class="siteCTA" target="'.$btn_trgt.'">'.$btn_txt.'</a>';
                                                echo '</div>';
                                            } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'cta_row' ) : ?> <!-- CTA Row -->
                <?php 
                    $cta_bg = get_sub_field('cta_bg');
                    $cta_cont = get_sub_field('cta_content');
                    $cta_btn = get_sub_field('cta_button');
                    if( $cta_bg == 'light-blue-bg' ) {
                        $btn_clr = 'blue';
                    } else {
                        $btn_clr = 'white';
                    }
                ?>
                <section class="cta-row <?=$cta_bg;?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="text-wrapper">
                                    <?=$cta_cont;?>
                                </div>
                                <?php if( $cta_btn ) {
                                    echo '<div class="button-wrapper">';
                                        $btn_txt = $cta_btn['title'];
                                        $btn_url = $cta_btn['url'];
                                        $btn_trgt = $cta_btn['target'] ? $cta_btn['target'] : '_self';
                                        echo '<a href="'.$btn_url.'" class="siteCTA '.$btn_clr.'" target="'.$btn_trgt.'">'.$btn_txt.'</a>';
                                    echo '</div>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </section>
                
            <?php elseif( get_row_layout() == 'course_comp' ) : ?> <!-- Course Comparison -->
                <section class="course-comp dark-blue-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="title-wrapper">
                                    <p class="white-underline lw-50 text-uppercase center"><?=get_sub_field('cc_subtitle');?></p> 
                                    <?=get_sub_field('cc_title');?>
                                </div>
                            </div>
                            <?php if( have_rows('inpd_course_card') ) : while( have_rows('inpd_course_card') ) : the_row(); ?>
                                <div class="col-12 col-lg-6">
                                    <div class="comp-card inpd">
                                        <h3><strong><?=get_sub_field('title');?></strong></h3>
                                        <?php if( have_rows('points_repeater') ) : while( have_rows('points_repeater') ) : the_row(); ?>
                                            <?php 
                                                $icon = get_sub_field('icon');
                                                $cont = get_sub_field('content');
                                            ?>
                                            <div class="comp-item text-center">
                                                <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid">
                                                <?=$cont;?>
                                            </div>
                                        <?php endwhile; endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; endif; ?>
                            <?php if( have_rows('trad_courses') ) : while( have_rows('trad_courses') ) : the_row(); ?>
                                <div class="col-12 col-lg-6">
                                    <div class="comp-card trad">
                                        <h3><strong><?=get_sub_field('title');?></strong></h3>
                                        <?php if( have_rows('points_repeater') ) : while( have_rows('points_repeater') ) : the_row(); ?>
                                            <?php 
                                                $icon = get_sub_field('icon');
                                                $cont = get_sub_field('content');
                                            ?>
                                            <div class="comp-item text-center">
                                                <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid">
                                                <?=$cont;?>
                                            </div>
                                        <?php endwhile; endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; endif; ?>
                            <?php 
                                $crs_btn = get_sub_field('course_button');
                                if( $crs_btn ) {
                                    echo '<div class="button-wrapper text-center mt-5">';
                                    if( $crs_btn ) {
                                        $btn_txt = $crs_btn['title'];
                                        $btn_url = $crs_btn['url'];
                                        $btn_trgt = $crs_btn['target'] ? $crs_btn['target'] : '_self';
                                        echo '<a href="'.$btn_url.'" class="siteCTA" target="'.$btn_trgt.'">'.$btn_txt.'</a>';
                                    }
                                    echo '</div>';
                                } 
                            ?>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'timeline_row' ) : ?> <!-- Course Comparison -->
                <section class="our-story dark-blue-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="intro">
                                    <p class="white-underline"><?=get_sub_field('tl_sub_title');?></p>
                                    <div class="years d-flex">
                                        <?php if( have_rows('tl_timeline') ) : $i = 0; while( have_rows('tl_timeline') ) : the_row(); if( get_sub_field('button_text') ) : ?>
                                            <p class="<?php if( $i == 0 ) { echo 'active'; } ?>" data-tl="<?=$i;?>"><?=get_sub_field('button_text');?></p>
                                        <?php endif; $i++; endwhile; endif; ?>
                                    </div>
                                </div>
                                <div class="timeline-slider">
                                    <?php if( have_rows('tl_timeline') ) : $i = 0; while( have_rows('tl_timeline') ) : the_row(); ?>
                                        <div class="item">
                                            <div class="tl-item">
                                                <h5><?=get_sub_field('title');?></h5>
                                                <p><?=get_sub_field('content');?></p>
                                            </div>
                                        </div>
                                    <?php $i++; endwhile; endif; ?>
                                </div>
                                <div class="tl-nav">
                                    <div class="prev">
                                        <img src="/wp-content/uploads/2024/07/nav-arrow-left.svg" alt="Left Arrow" class="img-fluid">
                                    </div>
                                    <div class="next">
                                        <img src="/wp-content/uploads/2024/07/nav-arrow-right.svg" alt="Right Arrow" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            <?php elseif( get_row_layout() == 'boxed_top_row' ) : ?> <!-- Boxed Top Row -->
                <section class="boxed-top-row <?php if( get_sub_field('large_lower_padding') ) { echo 'large-pb'; } ?>" style="background: url('<?=get_sub_field('btr_bg');?>') no-repeat center center / cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <div class="text-wrapper blue-box">
                                    <?=get_sub_field('btr_content');?>
                                    <?php 
                                        $btr_btn = get_sub_field('btr_button');
                                        $lbbtr_btn = get_sub_field('lb_btr_button');
                                        if( $btr_btn || $lbbtr_btn ) {
                                            echo '<div class="button-wrapper">';
                                            if( $btr_btn ) {
                                                $btrbtn_txt = $btr_btn['title'];
                                                $btrbtn_url = $btr_btn['url'];
                                                $btrbtn_trgt = $btr_btn['target'] ? $btr_btn['target'] : '_self';
                                                echo '<a href="'.$btrbtn_url.'" class="siteCTA" target="'.$btrbtn_trgt.'">'.$btrbtn_txt.'</a>';
                                            }
                                            if( $lbbtr_btn ) {
                                                $lbbtrbtn_txt = $lbbtr_btn['title'];
                                                $lbbtrbtn_url = $lbbtr_btn['url'];
                                                $lbbtrbtn_trgt = $lbbtr_btn['target'] ? $lbbtr_btn['target'] : '_self';
                                                echo '<a href="'.$lbbtrbtn_url.'" class="siteCTA" target="'.$lbbtrbtn_trgt.'">'.$lbbtrbtn_txt.'</a>';
                                            }
                                            echo '</div>';
                                        } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'vacancies_row' ) : ?> <!-- Vacancies Row -->
                <section class="vacancies dark-blue-bg" id="jobs">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="title text-center">
                                    <p class="white-underline px-3 text-uppercase">Vacancies</p>
                                    <h2><?=get_sub_field('vac_title');?></h2>
                                </div>
                                <div class="vacancy-wrap">
                                    <?php 
                                        $loop = new WP_Query( array( 'post_type' => 'jobs' ) );
                                        if ( $loop->have_posts() ) :
                                            while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                                <?php 
                                                    $title = get_the_title();
                                                    $intro = get_field('job_intro');
                                                    $job_spec = get_field('job_spec_pdf');
                                                    $job_url = get_field('job_url');
                                                ?>
                                                <div class="single-vac">
                                                    <div class="inner">
                                                        <h3><?=$title;?></h3>
                                                        <p><?=$intro;?></p>
                                                        <div class="button-wrapper">
                                                            <?php if( $job_spec ) : ?>
                                                                <a href="<?=$job_spec['url'];?>" class="siteCTA outline download " download>Download job spec</a>
                                                            <?php endif; ?>
                                                            <a href="<?=$job_url;?>" target="_blank" class="siteCTA">Apply now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; wp_reset_query(); ?>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'four_img_gal' ) : ?> <!-- 4 Image Gallery -->
                <?php 
                    $img1 = get_sub_field('left_image');
                    $img2 = get_sub_field('mid_img_top');
                    $img3 = get_sub_field('mid_img_bottom');
                    $img4 = get_sub_field('right_image');
                ?>
                <section class="four-img-gal">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <img src="<?=$img1['url'];?>" alt="<?=$img1['alt'];?>" class="img-fluid">
                            </div>
                            <div class="col-12 col-lg-5">
                                <img src="<?=$img2['url'];?>" alt="<?=$img2['alt'];?>" class="img-fluid">
                                <img src="<?=$img3['url'];?>" alt="<?=$img3['alt'];?>" class="img-fluid">
                            </div>
                            <div class="col-12 col-lg-3">
                                <img src="<?=$img4['url'];?>" alt="<?=$img4['alt'];?>" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'trustpilot_compact' ) : ?> <!-- Trustpilot Compact -->
                <?php
                    $tp_stars = get_sub_field('trustpilot_stars');
                    $tp_text = get_sub_field('rated_text');
                    $tp_logo = get_sub_field('trustpilot_logo');
                ?>
                <section class="compact-trustpilot grey-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="tp-wrap">
                                    <?php if( $tp_stars ) : ?>
                                        <img src="<?=$tp_stars['url'];?>" alt="<?=$tp_stars['alt'];?>" class="img-fluid">
                                    <?php endif; ?>
                                    <p><?=$tp_text;?></p>
                                    <?php if( $tp_logo ) : ?>
                                        <img src="<?=$tp_logo['url'];?>" alt="<?=$tp_logo['alt'];?>" class="img-fluid">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'three_stats_with_icons' ) : ?> <!-- Three Stats with Icons -->
                <section class="three-stats">
                    <div class="container">
                        <div class="row">
                            <?php if( have_rows('ts_stats') ) : while( have_rows('ts_stats') ) : the_row(); ?>
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

            <?php elseif( get_row_layout() == 'centered_quote' ) : ?> <!-- Centered Quote -->
                <section class="centered-quote grey-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="quote-wrapper text-center">
                                    <h2><?=get_sub_field('quote_text');?></h2>
                                    <p><?=get_sub_field('quote_author');?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'centered_content_blue_bg' ) : ?> <!-- Centered Content / Blue BG -->
                <section class="dark-blue-bg centered-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="text-wrapper">
                                    <h2 class="white-underline fw-200 center"><?=get_sub_field('ccbg_title');?></h2>
                                    <?=get_sub_field('ccbg_content');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'title_4_col_cont_8_col' ) : ?> <!-- Title (4) Content (8) -->
                <?php $title_font = get_sub_field('t4c8_title_font'); ?>
                <section class="title4-cont8 <?=get_sub_field('t4c8_bg');?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="title-wrapper">
                                    <h2 class="<?=$title_font;?>"><?=get_sub_field('tc_title');?></h2>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8">
                                <div class="text-wrapper">
                                    <?=get_sub_field('tc_content');?>
                                </div>
                                <?php 
                                    $tc_btn = get_sub_field('tc_button');
                                    if( $tc_btn ) {
                                        echo '<div class="button-wrapper mt-4">';
                                            $tcb_txt = $tc_btn['title'];
                                            $tcb_url = $tc_btn['url'];
                                            $tcb_trgt = $tc_btn['target'] ? $tc_btn['target'] : '_self';
                                            echo '<a href="'.$tcb_url.'" class="siteCTA blue" target="'.$tcb_trgt.'">'.$tcb_txt.'</a>';
                                        echo '</div>';
                                    } 
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            
            <?php elseif( get_row_layout() == 'client_logos_cent' ) : ?> <!-- Client Logos -->
                <section class="client-logos grey-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?php if( get_sub_field('clc_title') ) : ?>
                                    <div class="title-wrapper text-center">
                                        <h2><?=get_sub_field('clc_title');?></h2>
                                    </div>
                                <?php endif; ?>
                                <div class="logo-wrapper <?php if( get_sub_field('enable_slider') ) { echo 'c-logo-slider'; } ?>">
                                    <?php 
                                        $logos = get_sub_field('clc_logos');
                                        if( $logos ) : foreach( $logos as $l ) :
                                    ?>
                                        <img src="<?=$l['url'];?>" alt="<?=$l['alt'];?>" class="img-fluid">
                                    <?php endforeach; endif; ?>
                                </div>
                                <?php if( get_sub_field('enable_slider') ) : ?>
                                    <div class="cl-nav">
                                        <div class="prev">
                                            <img src="/wp-content/uploads/2024/07/blue-nav-arrow-left.svg" alt="Arrow Left" class="img-fluid">
                                        </div>
                                        <div class="cl-dots-container"></div>
                                        <div class="next">
                                            <img src="/wp-content/uploads/2024/07/blue-nav-arrow-right.svg" alt="Arrow Right" class="img-fluid">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'client_logos_cent_adj' ) : ?> <!-- Client Logos -->
                <section class="client-logos grey-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?php if( get_sub_field('clc_title') ) : ?>
                                    <div class="title-wrapper text-center">
                                        <h2><?=get_sub_field('clc_title');?></h2>
                                    </div>
                                <?php endif; ?>
                                <?php $width = get_Sub_field('image_width'); ?>
                                <div class="logo-wrapper <?php if( get_sub_field('enable_slider') ) { echo 'c-logo-slider'; } ?>">
                                    <?php 
                                        if( have_rows('logo_repeater') ) : while( have_rows('logo_repeater') ) : the_row(); 
                                        $img = get_sub_field('image');
                                        $link = get_sub_field('link');
                                    ?>
                                        <?php if( $link ) : ?><a href="<?=$link;?>"><?php endif; ?>
                                            <img src="<?=$img['url'];?>" alt="<?=$img['alt'];?>" class="img-fluid" loading="lazy" <?php if( $width ) : ?>style="max-width: <?=$width;?>px;" width="<?=$width;?>"<?php endif; ?>>
                                        <?php if( $link ) : ?></a><?php endif; ?>
                                    <?php endwhile; endif; ?>
                                </div>
                                <?php if( get_sub_field('enable_slider') ) : ?>
                                    <div class="cl-nav">
                                        <div class="prev">
                                            <img src="/wp-content/uploads/2024/07/blue-nav-arrow-left.svg" alt="Arrow Left" class="img-fluid">
                                        </div>
                                        <div class="cl-dots-container"></div>
                                        <div class="next">
                                            <img src="/wp-content/uploads/2024/07/blue-nav-arrow-right.svg" alt="Arrow Right" class="img-fluid">
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'title_with_benefit_items' ) : ?> <!-- Title With Benefit Cards -->
                <section class="title-with-benfits dark-blue-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="text-wrapper">
                                    <?php if( get_sub_field('twb_subtitle') ) : ?><p class="white-underline fw-200 text-uppercase"><?=get_sub_field('twb_subtitle');?></p><?php endif; ?>
                                    <?=get_sub_field('twb_intro_cont');?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="benefit-wrapper">
                                    <div class="row">
                                        <?php if( have_rows('twb_benefit_items') ) : while( have_rows('twb_benefit_items') ) : the_row(); ?>
                                            <div class="col-12 col-lg-4">
                                                <div class="benefit-item">
                                                    <?php 
                                                        $bfi_img = get_sub_field('icon'); 
                                                        if( $bfi_img ) :
                                                    ?>
                                                        <img src="<?=$bfi_img['url'];?>" alt="<?=$bfi_img['alt'];?>" class="img-fluid">
                                                    <?php endif; ?>
                                                    <?=get_sub_field('content');?>
                                                </div>
                                            </div>
                                        <?php endwhile; endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'intro7_and_cs_slider' ) : ?> <!-- Case Studies Slider -->
                <?php 
                    $css_st = get_sub_field('css_subtitle');
                    $css_intro = get_sub_field('css_intro_content');
                    $css_items = get_sub_field('css_items');
                ?>
                <section class="case-studies-row">
                    <div class="container">
                        <div class="row">
                            <?php if( $css_st || $css_intro ) : ?>
                                <div class="col-12 col-lg-7">
                                    <div class="text-wrapper">
                                        <?php if( $css_st ) : ?>
                                            <p class="blue-underline fw-200 text-uppercase"><?=$css_st;?></p>
                                        <?php endif; ?>
                                        <?php if( $css_intro ) : ?>
                                            <?=$css_intro;?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if( $css_items ) : ?>
                                <div class="col-12">
                                    <div class="cs-slider">
                                        <?php foreach ( $css_items as $post ) : setup_postdata($post); ?>
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
                                <div class="cs-nav">
                                    <div class="prev">
                                        <img src="/wp-content/uploads/2024/07/blue-nav-arrow-left.svg" alt="Arrow Left" class="img-fluid">
                                    </div>
                                    <div class="next">
                                        <img src="/wp-content/uploads/2024/07/blue-nav-arrow-right.svg" alt="Arrow Right" class="img-fluid">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php 
                                $css_btn = get_sub_field('css_button');
                                if( $css_btn ) {
                                echo '<div class="button-wrapper text-center">';
                                if( $css_btn ) {
                                    $cssb_txt = $css_btn['title'];
                                    $cssb_url = $css_btn['url'];
                                    $cssb_trgt = $css_btn['target'] ? $css_btn['target'] : '_self';
                                    echo '<a href="'.$cssb_url.'" class="siteCTA blue" target="'.$cssb_trgt.'">'.$cssb_txt.'</a>';
                                }
                                echo '</div>';
                            } ?>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'vid_left_bc_right' ) : ?> <!-- Case Studies Slider -->    
                <section class="video-with-bc <?=get_sub_field('vid_bg');?>">
                    <div class="container">
                        <div class="row">
                            <div class="float-vid">
                                <div class="video-img" data-aos="fade-right">
                                    <?php $vid_img = get_sub_field('vid_ph_img');?>
                                    <img src="<?=$vid_img['url'];?>" alt="<?=$vid_img['alt'];?>" class="img-fluid">
                                    <div class="vid-btn">
                                        <a data-bs-toggle="modal" data-bs-target=".vid-modal"><img src="/wp-content/uploads/2024/07/play-btn-1.svg" alt="Play Button" class="img-fluid"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-7 offset-lg-5">
                                <div class="text-wrapper">
                                    <?=get_sub_field('vr_box_cont');?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade vid-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col-12 video-wrapper">
                                        <div class="close" data-bs-dismiss="modal">&#10005;</div>
                                        <iframe src="<?=get_sub_field('vid_embed_url');?>" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'intro6_with_card_slider' ) : ?> <!-- Intro(6) with card slider -->    
                <section class="intro-card-slider">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="text-wrapper">
                                    <?php if( get_sub_field('subtitle') ) : ?>
                                        <p class="blue-underline fw-200 text-uppercase"><?=get_sub_field('subtitle');?></p>
                                    <?php endif; ?>
                                    <?=get_sub_field('intro_content'); ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card-slider">
                                    <?php if( have_rows('card_slid_repeater') ) : while( have_rows('card_slid_repeater') ) : the_row(); ?>
                                        <?php 
                                            $icon = get_sub_field('icon');
                                            $title = get_sub_field('card_title');
                                            $cont = get_sub_field('card_content');
                                            $btn = get_sub_field('button');
                                        ?>
                                        <div class="item">
                                            <div class="blue-card">
                                                <?php if( $icon ) : ?>
                                                    <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid">
                                                <?php endif; ?>
                                                <h4><?=$title;?></h4>
                                                <p><?=$cont;?></p>
                                                <?php if( $btn ) : ?>
                                                    <div class="button-wrapper mt-4">
                                                        <?php
                                                            $btn_title = $btn['title'];
                                                            $btn_url = $btn['url'];
                                                            $btn_target = $btn['target'] ? $btn['target'] : '_self';
                                                        ?>
                                                        <a href="<?=$btn_url;?>" class="siteCTA white" target="<?=$btn_target;?>"><?=$btn_title;?></a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endwhile; endif; ?>
                                </div>
                                <div class="card-nav">
                                    <div class="prev">
                                        <img src="/wp-content/uploads/2024/07/blue-nav-arrow-left.svg" alt="Arrow Left" class="img-fluid">
                                    </div>
                                    <div class="next">
                                        <img src="/wp-content/uploads/2024/07/blue-nav-arrow-right.svg" alt="Arrow Right" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'top_row_with_ol_blue_box' ) : ?> <!-- Top Row with Overlapping Blue box -->
                <section class="overlap-top" style="background: url('<?=get_sub_field('trol_bg');?>') no-repeat center center / cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="text-wrapper text-center">
                                    <?=get_sub_field('trol_content');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="overlap-bottom">
                    <div class="container">
                        <div class="row blue-box">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="text-wrapper text-center">
                                    <h3 class="white-underline center fw-200"><?=get_sub_field('trol_bb_title');?></h3>
                                    <?=get_sub_field('trol_bb_content');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            <?php elseif( get_row_layout() == 'tw_rounded_timeline' ) : ?> <!-- Rounded timeline -->
                <section class="rounded-timeline">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="text-wrapper text-center">
                                    <h2 class="blue-underline center"><?=get_sub_field('twr_title');?></h2>
                                    <?=get_sub_field('twr_intro_cont');?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="wavy-timeline">
                                    <?php if( have_rows('twr_timeline_items') ) : while( have_rows('twr_timeline_items') ) : the_row(); ?>
                                        <div class="wavy-item">
                                            <div class="inner">
                                                <div class="icon">
                                                    <?php $wi_img = get_sub_field('icon'); ?>
                                                    <img src="<?=$wi_img['url'];?>" alt="<?=$wi_img['alt'];?>" class="img-fluid" loading="lazy">
                                                </div>
                                                <div class="content">
                                                    <p><?=get_sub_field('text');?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'content_7_image_5' ) : ?> <!-- Content 7 Image 5 -->
                <section class="dark-blue-bg c7-blue-bg">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-6">
                                <div class="text-wrapper">
                                    <?php if( get_sub_field('c7_subtitle') ) : ?>
                                        <p class="white-underline text-uppercase"><?=get_sub_field('c7_subtitle');?></p>
                                    <?php endif; ?>
                                    <?=get_sub_field('c7_content');?>
                                </div>
                                <?php
                                    $c7_btn = get_sub_field('c7_button');
                                    echo '<div class="button-wrapper">';
                                    if( $c7_btn ) {
                                        $c7btn_txt = $c7_btn['title'];
                                        $c7btn_url = $c7_btn['url'];
                                        $c7btn_trgt = $c7_btn['target'] ? $c7_btn['target'] : '_self';
                                        echo '<a href="'.$c7btn_url.'" class="siteCTA" target="'.$c7btn_trgt.'">'.$c7btn_txt.'</a>';
                                    }
                                    echo '</div>';
                                ?>
                            </div>
                            <div class="col-12 col-lg-5 offset-lg-1">
                                <?php $c7_img = get_sub_field('i5_image'); ?>
                                <img src="<?=$c7_img['url'];?>" alt="<?=$c7_img['alt'];?>" class="img-fluid" loading="lazy">
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'centered_blue_card_slider' ) : ?> <!-- Centered Blue card slider -->
                <section class="blue-card-slider">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="text-wrapper text-center">
                                    <h3 class="blue-underline center"><?=get_sub_field('cbc_title');?></h3>
                                    <?php if( get_sub_field('cbc_intro_cont') ) : ?>
                                        <?=get_sub_field('cbc_intro_cont');?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-10 offset-lg-1 slider">
                                <div class="bc-slider">
                                    <?php if( have_rows('cb_cards') ) : while( have_rows('cb_cards') ) : the_row(); ?>
                                        <?php 
                                            $icon = get_sub_field('icon');
                                            $text = get_sub_field('content');
                                        ?>
                                        <div class="item">
                                            <div class="blue-card">
                                                <div class="inner">
                                                    <?php if( $icon ) : ?>
                                                        <div class="icon">
                                                            <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid" loading="lazy">
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="content">
                                                        <?=$text;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; endif; ?>
                                </div>
                            </div>
                            <?php if( get_sub_field('cbc_add_lc') ) : ?>
                                <div class="col-12 col-lg-10 offset-lg-1">
                                    <div class="lower-content text-center">
                                        <?=get_sub_field('cbc_add_lc');?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'half_and_half_cards' ) : ?> <!-- Half Half Cards -->
                <section class="half-half-cards course-comp dark-blue-bg">
                    <div class="container">
                        <div class="col-12 col-lg-8 offset-lg-2">
                            <div class="text-wrapper text-center">
                                <h3 class="white-underline center fw-200"><?=get_sub_field('hhc_title');?></h3>
                                <?=get_sub_field('hhc_intro_cont');?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <?php if( have_rows('hhc_cards') ) : while( have_rows('hhc_cards') ) : the_row(); ?>
                                    <div class="col-12 col-lg-6">
                                        <div class="comp-card inpd">
                                            <?php $hhc_img = get_sub_field('icon'); if( $hhc_img ) : ?>
                                                <div class="icon">
                                                    <img src="<?=$hhc_img['url'];?>" alt="<?=$hhc_img['alt'];?>" class="img-fluid">
                                                </div>
                                            <?php endif; ?>
                                            <h3 class="white-underline center fw-200"><?=get_sub_field('title');?></h3>
                                            <div class="content">
                                                <?=get_sub_field('content');?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'full_width_contact_form' ) : ?> <!-- FW Contact Form -->
                <section class="fw-contact-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <div class="text-wrapper">
                                    <?=get_sub_field('form_intro');?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-wrapper underlined-inputs blue no-labels">
                                    <?php 
                                        $form = get_sub_field('form_embed_code');
                                        $bare_form = str_replace(array('<p>','</p>'),'',$form);
                                    ?>
                                    <?=$bare_form;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'homepage_top_row' ) : ?> <!-- Homepage Top Row -->    
                <section class="home-top-row" style="background: url(<?=get_sub_field('htr_bg');?>) no-repeat center center / cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <div class="blue-box">
                                    <div class="text-wrapper">
                                        <?=get_sub_field('htr_content');?>
                                        <?php if( get_sub_field('htr_show_search_bar') ) : ?>
                                            <form role="search" method="get" class="search-form d-none" action="<?php echo esc_url(home_url('/')); ?>">
                                            <label>
                                                <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                                                <input type="search" class="search-field"
                                                placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
                                                value="<?php echo get_search_query() ?>" name="s"
                                                title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                                            </label>
                                                <input type="image" class="search-submit" src="/wp-content/uploads/2024/07/search-icon.png" alt="Submit" width="100" height="50">
                                            </form>
                                            <?=do_shortcode('[searchwp_form id="1"]');?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                

            <?php elseif( get_row_layout() == 'blue_video_card' ) : ?> <!-- video card -->
                <section class="video-card <?=get_sub_field('bvc_bg');?>">
                    <div class="container">
                        <div class="row">
                            <div class="float-vid">
                                <div class="video-img" data-aos="fade-right">
                                    <?php $vid_img = get_sub_field('vc_vid_ph');?>
                                    <img src="<?=$vid_img['url'];?>" alt="<?=$vid_img['alt'];?>" class="img-fluid">
                                    <div class="vid-btn">
                                        <a data-bs-toggle="modal" data-bs-target=".vid-modal"><img src="/wp-content/uploads/2024/07/play-btn-1.svg" alt="Play Button" class="img-fluid"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 offset-lg-6">
                                <div class="blue-box">
                                    <div class="text-wrapper">
                                        <?=get_sub_field('vc_content');?>
                                        <?php
                                            $vcard_btn = get_sub_field('vc_button');
                                            if( $vcard_btn ) {
                                                echo '<div class="button-wrapper mt-5">';
                                                    $vcbtn_txt = $vcard_btn['title'];
                                                    $vcbtn_url = $vcard_btn['url'];
                                                    $vcbtn_trgt = $vcard_btn['target'] ? $vcard_btn['target'] : '_self';
                                                    echo '<a href="'.$vcbtn_url.'" class="siteCTA" target="'.$vcbtn_trgt.'">'.$vcbtn_txt.'</a>';
                                                echo '</div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade vid-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="row">
                                    <div class="col-12 video-wrapper">
                                        <div class="close" data-bs-dismiss="modal">&#10005;</div>
                                        <iframe src="<?=get_sub_field('vc_vid_url');?>" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'centered_content' ): ?> <!-- Centered Content -->
                <section class="plain-centered-content <?=get_sub_field('cc_bg');?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1">
                                <div class="text-wrapper text-center">
                                    <?=get_sub_field('cc_cont');?>
                                    <?php
                                        $sld_btn = get_sub_field('cc_solid_btn');
                                        $ol_btn = get_sub_field('cc_outline_btn');
                                        if( $sld_btn || $ol_btn ) {
                                            echo '<div class="button-wrapper mt-5">';
                                            if( $sld_btn ) {
                                                $sbtn_txt = $sld_btn['title'];
                                                $sbtn_url = $sld_btn['url'];
                                                $sbtn_trgt = $sld_btn['target'] ? $sld_btn['target'] : '_self';
                                                echo '<a href="'.$sbtn_url.'" class="siteCTA blue" target="'.$sbtn_trgt.'">'.$sbtn_txt.'</a>';
                                            }
                                            if( $ol_btn ) {
                                                $olbtn_txt = $ol_btn['title'];
                                                $olbtn_url = $ol_btn['url'];
                                                $olbtn_trgt = $ol_btn['target'] ? $ol_btn['target'] : '_self';
                                                echo '<a href="'.$olbtn_url.'" class="siteCTA blue-border" target="'.$olbtn_trgt.'">'.$olbtn_txt.'</a>';
                                            }
                                            echo '</div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'blue_accordions' ): ?> <!-- Blue Accordion -->
                <section class="accordion-row">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="accordion" id="bluecard-accordion">
                                    <?php if( have_rows('accordion_rep') ) : $i = 1; while( have_rows('accordion_rep') ) : the_row(); ?>
                                        <?php $numrows = count( get_sub_field( 'acc_content' ) ); ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?=$i;?>" aria-expanded="false" aria-controls="collapse-<?=$i;?>">
                                                    <?=get_sub_field('acc_title');?>
                                                </button>
                                            </h2>
                                            <div id="collapse-<?=$i;?>" class="accordion-collapse collapse" data-bs-parent="#bluecard-accordion">
                                                <div class="accordion-body <?php if( $numrows == 1 ) { echo 'compact'; } ?>">
                                                    <?php if( have_rows('acc_content') ) : while( have_rows('acc_content') ) : the_row(); ?>
                                                        <?php if( get_row_layout() == 'standard_content' ): ?> <!-- Standard Content -->
                                                            <?php 
                                                                $cont = get_sub_field('content');
                                                                $align = get_sub_field('alignment');
                                                                if( $align == 'center' ) {
                                                                    $alignment = 'offset-lg-1';
                                                                } elseif( $align == 'right' ) {
                                                                    $alignment = 'offset-lg-2';
                                                                } else {
                                                                    $alignment = '';
                                                                }
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-12 col-lg-10 <?=$alignment;?>">
                                                                    <div class="text-<?=$align;?>">
                                                                        <?=get_sub_field('content'); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php elseif( get_row_layout() == '50_50_cards' ): ?> <!-- 50 50 cards -->
                                                            <div class="row align-items-stretch">
                                                                <?php if( have_rows('cards') ) : while( have_rows('cards') ) : the_row(); ?>
                                                                    <div class="col-12 col-lg-6">
                                                                        <div class="blue-card text-center">
                                                                            <?php $icn = get_sub_field('icon'); if( $icn ) : ?>
                                                                                <img src="<?=$icn['url'];?>" alt="<?=$icn['alt'];?>" class="img-fluid">
                                                                            <?php endif; ?>
                                                                            <div class="content">
                                                                                <?=get_sub_field('content');?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endwhile; endif; ?>
                                                            </div>
                                                        <?php elseif( get_row_layout() == 'tabbed_content' ): ?> <!-- Tabbed Content -->
                                                            <div class="row">
                                                                <div class="centered-tabs">
                                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                        <?php if( have_rows('inner_tab_rep') ) :  $tc = 1; while( have_rows('inner_tab_rep') ) : the_row(); ?>
                                                                            <li class="nav-item <?=$i;?>" role="presentation">
                                                                                <button class="nav-link <?php if($tc == 1) { echo 'active'; } ?>" id="tab-title-<?=$i.$tc;?>" data-bs-toggle="tab" data-bs-target="#tab-<?=$i.$tc;?>" type="button" role="tab" aria-controls="tab-<?=$i.$tc;?>"><h2><?=get_sub_field('tab_title');?></h2></button>
                                                                            </li>
                                                                            <?php $tc++; ?>
                                                                        <?php endwhile; endif; ?>
                                                                    </ul>
                                                                    <div class="tab-content" id="myTabContent">
                                                                        <?php if( have_rows('inner_tab_rep') ) :  $tc = 1; while( have_rows('inner_tab_rep') ) : the_row(); ?>
                                                                            <div class="tab-pane fade <?php if($tc == 1) { echo 'active show'; } ?>" id="tab-<?=$i.$tc;?>" role="tabpanel" aria-labelledby="tab-title-<?=$i.$tc;?>">
                                                                                <div class="content">
                                                                                    <?=get_sub_field('tab_content');?>
                                                                                </div>
                                                                            </div>
                                                                            <?php $tc++; ?>
                                                                        <?php endwhile; endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php elseif( get_row_layout() == 'full_width_cta' ): ?> <!-- Full width CTA --> 
                                                            <?php 
                                                                $row_bg = get_sub_field('background_colour'); 
                                                                if( $row_bg == 'light-blue-bg' ) {
                                                                    $btn_clr = 'blue';
                                                                } else {
                                                                    $btn_clr = 'white';
                                                                }
                                                            ?>   
                                                            <div class="row align-items-center cta-card <?=$row_bg;?>">
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="text-wrapper"><?=get_sub_field('content');?></div>
                                                                </div>
                                                                <div class="col-12 col-lg-5 offset-lg-1">
                                                                    <?php 
                                                                        $fw_cta_btn = get_sub_field('button');
                                                                        echo '<div class="button-wrapper">';
                                                                        if( $fw_cta_btn ) {
                                                                            $btn_txt = $fw_cta_btn['title'];
                                                                            $btn_url = $fw_cta_btn['url'];
                                                                            $btn_trgt = $fw_cta_btn['target'] ? $fw_cta_btn['target'] : '_self';
                                                                            echo '<a href="'.$btn_url.'" class="siteCTA '.$btn_clr.'" target="'.$btn_trgt.'">'.$btn_txt.'</a>';
                                                                        }
                                                                        echo '</div>';
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endwhile; endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $i++; endwhile; endif; ?>
                                </div>
                                <?php 
                                    $acr_btn = get_sub_field('acr_button');
                                    echo '<div class="button-wrapper text-center mt-5">';
                                    if( $acr_btn ) {
                                        $btn_txt = $acr_btn['title'];
                                        $btn_url = $acr_btn['url'];
                                        $btn_trgt = $acr_btn['target'] ? $acr_btn['target'] : '_self';
                                        echo '<a href="'.$btn_url.'" class="siteCTA blue" target="'.$btn_trgt.'">'.$btn_txt.'</a>';
                                    }
                                    echo '</div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'qualification_header' ): ?>
                <section class="quali-header" style="background: url('<?=get_sub_field('qh_bg');?>') no-repeat center center / cover;">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-7">
                                <div class="blue-box">
                                    <?php $qh_logo = get_sub_field('qh_logo'); if( $qh_logo ) : ?>
                                        <img src="<?=$qh_logo['url'];?>" alt="<?=$qh_logo['alt'];?>" class="img-fluid" loading="lazy">
                                    <?php endif; ?>
                                    <?=get_sub_field('qh_content');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'qualification_intro' ): ?>
                <section class="quali-intro grey-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="text-wrapper text-center">
                                    <p class="text-uppercase blue-underline center fw-200"><?=get_sub_field('qi_subtitle');?></p>
                                    <?=get_sub_field('qi_content');?>
                                    <?php $qi_img = get_sub_field('qi_image'); if( $qi_img ) : ?>
                                        <div class="image-wrapper text-center mt-5">
                                            <img src="<?=$qi_img['url'];?>" alt="<?=$qi_img['alt'];?>" class="img-fluid">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'testimonial_row' ): ?>
                <section class="testimonial-row <?=get_sub_field('test_bg');?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <?php $count = count(get_sub_field('testimonial_items')); ?>
                                <div class="testimonial-wrapper <?php if( $count > 1 ) { echo 'test-slider'; } ?>">
                                    <?php if( have_rows('testimonial_items') ) : while( have_rows('testimonial_items') ) : the_row(); ?>
                                        <?php 
                                            $text = get_sub_field('test_text');
                                            $auth = get_sub_field('test_author');
                                            $job = get_sub_field('test_job');
                                            $prog = get_sub_field('testimonial_programme');
                                            $logo = get_sub_field('logo');
                                        ?>
                                        <div class="item single-test text-center">
                                            <h2><?=$text;?></h2>
                                            <?php if( $auth ) : ?>
                                                <p class="auth"><?=$auth;?></p>
                                            <?php endif; ?>
                                            <?php if( $job ) : ?>
                                                <p class="job"><?=$job;?></p>
                                            <?php endif; ?>
                                            <?php if( $prog ) : ?>
                                                <p class="prog"><?=$prog;?></p>
                                            <?php endif; ?>
                                            <?php if( $logo ) : ?>
                                                <div class="image-wrapper text-center mt-4">
                                                    <img src="<?=$logo['url'];?>" alt="<?=$logo['alt'];?>" class="img-fluid" loading="lazy">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; endif; ?>
                                </div>
                                <div class="test-dots-container"></div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'three_stats_cent' ): ?>
                <?php 
                    $neg_mar = get_sub_field('tsc_ntm'); 
                    $mar_amount = get_sub_field('margin_top_amount');
                    if( $neg_mar ) {
                        $mar = 'margin-top: -' . $mar_amount . 'px;';
                    } else {
                        $mar = '';
                    }
                ?>
                <section class="three-stat-row">
                    <div class="container">
                        <div class="row <?=get_sub_field('tsc_row_bg');?>" style="<?=$mar;?>">
                            <?php if( have_rows('tsc_stats') ) : while( have_rows('tsc_stats') ) : the_row(); ?>
                                <?php
                                    $num = get_sub_field('stat_number');
                                    $symb = get_sub_field('stat_symbol');
                                    $txt = get_sub_field('stat_text');
                                ?>
                                <div class="col-12 col-lg-4">
                                    <div class="stat-wrap text-center">
                                        <h2 class="font-xl"><?=$num;?><?php if($symb): ?><span class="symbol"><?=$symb;?></span><?php endif;?></h2>
                                        <p><?=$txt;?></p>
                                    </div>
                                </div>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </section>
            <?php elseif( get_row_layout() == 'tab_left_bc_right' ): ?>
                <section class="tab-left-card-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <ul class="nav nav-tabs simple-tabs" id="simp-tabs" role="tablist">
                                    <?php if( have_rows('tl_bcr_left_tabs') ) :  $i = 25; while( have_rows('tl_bcr_left_tabs') ) : the_row(); ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?php if($i == 25) { echo 'active'; } ?>" id="tab-title-<?=$i;?>" data-bs-toggle="tab" data-bs-target="#tab-<?=$i;?>" type="button" role="tab" aria-controls="tab-<?=$i;?>" aria-selected="true"><h5><?=get_sub_field('title');?></h5></button>
                                        </li>
                                        <?php $i++; ?>
                                    <?php endwhile; endif; ?>
                                </ul>
                                <div class="tab-content" id="simp-tabs-content">
                                    <?php if( have_rows('tl_bcr_left_tabs') ) :  $i = 25; while( have_rows('tl_bcr_left_tabs') ) : the_row(); ?>
                                        <div class="tab-pane fade <?php if($i == 25) { echo 'active show'; } ?>" id="tab-<?=$i;?>" role="tabpanel" aria-labelledby="tab-title-<?=$i;?>">
                                            <div class="content">
                                                <?=get_sub_field('content');?>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    <?php endwhile; endif; ?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5 offset-lg-1">
                                <?php if( have_rows('tl_bcr_bc') ) : while( have_rows('tl_bcr_bc') ) : the_row(); ?>
                                    <?php 
                                        $del = get_sub_field('del_method');
                                        $loc = get_sub_field('location');
                                        $qual = get_sub_field('qualification');
                                    ?>
                                    <div class="blue-card">
                                        <?php if( $del ) : ?>
                                            <div class="block">
                                                <img src="/wp-content/uploads/2024/07/duration.svg" alt="clock" class="img-fluid">
                                                <p class="text-uppercase">Duration/Delivery Method:</p>
                                                <p><?=$del;?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if( $loc ) : ?>
                                            <div class="block">
                                                <img src="/wp-content/uploads/2024/07/location.svg" alt="location pin" class="img-fluid">
                                                <p class="text-uppercase">Location:</p>
                                                <p><?=$loc;?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if( $qual ) : ?>
                                            <div class="block">
                                                <img src="/wp-content/uploads/2024/07/qualification.svg" alt="qualification certificate" class="img-fluid">
                                                <p class="text-uppercase">Qualification:</p>
                                                <p><?=$qual;?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endwhile; endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'teacher_slider' ): ?>
                <section class="teacher-row <?php if( get_sub_field('remove_pt') ) : ?>pt-0 <?php endif; ?><?php if( get_sub_field('remove_pb') ) : ?>pb-0 <?php endif; ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="text-wrapper">
                                    <?php if( get_sub_field('ts_subtitle') ) : ?>
                                        <p class="blue-underline text-uppercase"><?=get_sub_field('ts_subtitle');?></p>
                                    <?php endif; ?>
                                    <?=get_sub_field('ts_intro');?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="teach-slider">
                                    <?php $bios = get_sub_field('show_t_bios'); ?>
                                    <?php if( have_rows('teachers') ) : $tc = 1; while( have_rows('teachers') ) : the_row(); ?>
                                    <?php $teacher = get_sub_field('teacher_item'); if( $teacher ): ?>
                                        <div class="item">
                                            <div class="single-teacher" style="background: url('<?=get_the_post_thumbnail_url( $teacher->ID );?>') no-repeat center center / cover;">
                                                <div class="inner">
                                                    <h4 class="mb-0"><?php echo esc_html( $teacher->post_title ); ?></h4>
                                                    <p class="mb-2"><?= get_field('job_title', $teacher->ID); ?></p>
                                                    <?php if( $bios ) : ?>
                                                        <p class="bio" data-bs-toggle="modal" data-bs-target="#tmodal-<?=$tc;?>">
                                                            Read bio
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.199" height="15.304" viewBox="0 0 33.199 15.304">
                                                                <g id="Icon_feather-arrow-left" data-name="Icon feather-arrow-left" transform="translate(32.699 14.597) rotate(180)">
                                                                    <path id="Path_7" data-name="Path 7" d="M32.2,0H0" transform="translate(0 6.945)" fill="none" stroke="#feffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                                    <path id="Path_8" data-name="Path 8" d="M6.945,13.89,0,6.945,6.945,0" fill="none" stroke="#feffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
                                                                </g>
                                                            </svg>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php 
                                                $teach_btn = get_sub_field('teacher_button');
                                                echo '<div class="teacher-btn">';
                                                if( $teach_btn ) {
                                                    $btn_txt = $teach_btn['title'];
                                                    $btn_url = $teach_btn['url'];
                                                    $btn_trgt = $teach_btn['target'] ? $teach_btn['target'] : '_self';
                                                    echo '<a href="'.$btn_url.'" class="siteCTA blue" target="'.$btn_trgt.'">'.$btn_txt.'</a>';
                                                }
                                                echo '</div>';
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php $tc++; endwhile; endif; ?>
                                </div>
                                <?php if( have_rows('teachers') ) : $tc = 1; while( have_rows('teachers') ) : the_row(); ?>
                                    <?php $teacher = get_sub_field('teacher_item'); if( $teacher ): ?>
                                    <div class="modal fade" id="tmodal-<?=$tc;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
                                            <div class="modal-content">
                                            <div class="modal-body p-5">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                <div class="row">
                                                    <div class="col-12 col-lg-4">
                                                        <img src="<?=get_the_post_thumbnail_url( $teacher->ID );?>" alt="" class="img-fluid">
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <h3><?php echo esc_html( $teacher->post_title ); ?></h3>
                                                        <div class="bio">
                                                            <?=get_field('bio', $teacher->ID); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                <?php $tc++; endwhile; endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'text_left_offset_image_right' ): ?>
                <section class="tl-oir">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="text-wrapper">
                                    <?php if( get_sub_field('tfoi_subtitle') ) : ?>
                                        <p class="blue-underline text-uppercase"><?=get_sub_field('tfoi_subtitle');?></p>
                                    <?php endif; ?>
                                    <?=get_sub_field('tfoi_content');?>
                                    <?php 
                                        $tfoi_btn = get_sub_field('tfoi_button');
                                        echo '<div class="button-wrapper mt-4">';
                                        if( $tfoi_btn ) {
                                            $btn_txt = $tfoi_btn['title'];
                                            $btn_url = $tfoi_btn['url'];
                                            $btn_trgt = $tfoi_btn['target'] ? $tfoi_btn['target'] : '_self';
                                            echo '<a href="'.$btn_url.'" class="siteCTA blue" target="'.$btn_trgt.'">'.$btn_txt.'</a>';
                                        }
                                        echo '</div>';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="float-img">
                        <?php $of_img = get_sub_field('tfoi_image'); if( $of_img ) : ?>
                            <img src="<?=$of_img['url'];?>" alt="<?=$of_img['alt'];?>" class="img-fluid">
                        <?php endif; ?>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'full_width_video' ): ?>
                <section class="full-width-vid grey-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?php if( get_sub_field('fwv_title') ) : ?>
                                    <div class="title-wrapper text-center">
                                        <h2 class="blue-underline center"><?=get_sub_field('fwv_title');?></h2>
                                    </div>
                                <?php endif; ?>
                                <div class="video-wrapper">
                                    <div class="video-img" data-aos="fade-right">
                                        <?php $vid_img = get_sub_field('fwv_vid_ph');?>
                                        <img src="<?=$vid_img['url'];?>" alt="<?=$vid_img['alt'];?>" class="img-fluid">
                                        <div class="vid-btn">
                                            <a data-bs-toggle="modal" data-bs-target=".vid-modal"><img src="/wp-content/uploads/2024/07/play-btn-1.svg" alt="Play Button" class="img-fluid"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade vid-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="row">
                                                <div class="col-12 video-wrapper">
                                                    <div class="close" data-bs-dismiss="modal">&#10005;</div>
                                                    <iframe src="<?=get_sub_field('video_embed_url');?>" frameborder="0" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'contact_row' ): ?>
                <section class="speak-to-team dark-blue-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="text-wrapper">
                                    <?=get_sub_field('cr_intro');?>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 offset-lg-1">
                                <div class="form-wrapper underlined-inputs">
                                    <?php 
                                        $cr_form = get_sub_field('cr_form_embed');
                                        $cr_bf = str_replace(array('<p>','</p>'),'',$cr_form);
                                    ?>
                                    <?=$cr_bf;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'blue_compact_cards' ): ?>
                <section class="blue-compact-cards">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 offset-lg-3">
                                <div class="text-wrapper text-center">
                                    <?php if( get_sub_field('bcc_subtitle') ) : ?>
                                        <p class="blue-underline center text-uppercase"><?=get_sub_field('bcc_subtitle');?></p>
                                    <?php endif; ?>
                                    <?=get_sub_field('bcc_title');?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="comp-cards">
                                    <?php if( have_rows('bcc_comp_cards') ) : while( have_rows('bcc_comp_cards') ) : the_row(); ?>
                                        <div class="comp-card">
                                            <?php
                                                $icon = get_sub_field('icon');
                                                $cont = get_sub_field('content');
                                                if( $icon ) :
                                            ?>
                                                <div class="icon-wrap">
                                                    <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid">
                                                </div>
                                            <?php endif; ?>
                                            <div class="content">
                                                <?=get_sub_field('content');?>
                                            </div>
                                        </div>
                                    <?php endwhile; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'title_progress_steps' ): ?>
                <section class="progress-steps dark-blue-bg">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-8 offset-lg-2">
                                <div class="text-wrapper text-center">
                                    <h2 class="white-underline center"><?=get_sub_field('tps_title');?></h2>
                                    <?php if( get_sub_field('tps_intro') ) : ?>
                                        <?=get_sub_field('tps_intro');?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if( have_rows('steps_repeater') ) : while( have_rows('steps_repeater') ) : the_row(); ?>
                                <div class="col-12 col-lg-4">
                                    <div class="single-step">
                                        <?php $icon = get_sub_field('icon'); if( $icon ) : ?>
                                            <div class="icon-wrapper text-center">
                                                <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid" loading="lazy">
                                            </div>
                                        <?php endif; ?>
                                        <div class="content text-center">
                                            <?=get_sub_field('content');?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; endif; ?>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'white_card_loop' ): ?>
                <section class="card-loop">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?php if( get_sub_field('wcl_cards_title') ) : ?>
                                    <div class="card-title text-center">
                                        <h2><?=get_sub_field('wcl_cards_title');?></h2>
                                    </div>
                                <?php endif; ?>
                                <?php if( have_rows('white_cards') ) : ?>
                                    <div class="card-wrapper">
                                        <?php while( have_rows('white_cards') ) : the_row(); ?>
                                            <?php 
                                                $c_img = get_sub_field('scard_img');
                                                $c_title = get_sub_field('scard_title');
                                                $c_cont = get_sub_field('scard_cont');
                                                $c_btn = get_sub_field('scard_btn');
                                            ?>
                                            <div class="single-white-card">
                                                <?php if( $c_img ) : ?>
                                                    <div class="image-wrapper">
                                                        <img src="<?=$c_img['url'];?>" alt="<?=$c_img['alt'];?>" class="img-fluid" loading="lazy">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="content">
                                                    <h5><?=$c_title;?></h5>
                                                    <?=wp_trim_words($c_cont, 38);?>
                                                    <?php if( $c_btn ) : ?>
                                                        <?php
                                                            $c_btn_txt = $c_btn['title'];
                                                            $c_btn_url = $c_btn['url'];
                                                            $c_btn_trgt = $c_btn['target'] ? $c_btn['target'] : '_self';
                                                        ?>
                                                        <div class="button-wrapper">
                                                            <a href="<?=$c_btn_url;?>" class="siteCTA blue" target="<?=$c_btn_trgt;?>"><?=$c_btn_txt;?></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                                <?php 
                                    $wcl_btn = get_sub_field('wcl_button'); if( $wcl_btn ) : 
                                        $wcl_btn_txt = $wcl_btn['title'];
                                        $wcl_btn_url = $wcl_btn['url'];
                                        $wcl_btn_trgt = $wcl_btn['target'] ? $wcl_btn['target'] : '_self';
                                ?>
                                    <div class="button-wrapper text-center mt-5">
                                        <a href="<?=$wcl_btn_url;?>" target="<?=$wcl_btn_trgt;?>"class="siteCTA blue"><?=$wcl_btn_txt;?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'quali_cards' ): ?>
                <section class="card-loop quali-cards">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?php if( get_sub_field('wcl_cards_title') ) : ?>
                                    <div class="card-title text-center">
                                        <h2><?=get_sub_field('wcl_cards_title');?></h2>
                                    </div>
                                <?php endif; ?>
                                <?php if( have_rows('white_cards') ) : ?>
                                    <div class="card-wrapper">
                                        <?php while( have_rows('white_cards') ) : the_row(); ?>
                                            <?php 
                                                $c_img = get_sub_field('scard_img');
                                                $c_title = get_sub_field('scard_title');
                                                $c_cont = get_sub_field('scard_cont');
                                                $c_btn = get_sub_field('scard_btn');
                                            ?>
                                            <div class="single-white-card">
                                                <?php if( $c_img ) : ?>
                                                    <div class="image-wrapper">
                                                        <img src="<?=$c_img['url'];?>" alt="<?=$c_img['alt'];?>" class="img-fluid" loading="lazy">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="content">
                                                    <h4><?=$c_title;?></h4>
                                                    <?=wp_trim_words($c_cont, 38);?>
                                                    <?php if( $c_btn ) : ?>
                                                        <?php
                                                            $c_btn_txt = $c_btn['title'];
                                                            $c_btn_url = $c_btn['url'];
                                                            $c_btn_trgt = $c_btn['target'] ? $c_btn['target'] : '_self';
                                                        ?>
                                                        <div class="button-wrapper">
                                                            <a href="<?=$c_btn_url;?>" class="siteCTA blue" target="<?=$c_btn_trgt;?>"><?=$c_btn_txt;?></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                                <?php 
                                    $wcl_btn = get_sub_field('wcl_button'); if( $wcl_btn ) : 
                                        $wcl_btn_txt = $wcl_btn['title'];
                                        $wcl_btn_url = $wcl_btn['url'];
                                        $wcl_btn_trgt = $wcl_btn['target'] ? $wcl_btn['target'] : '_self';
                                ?>
                                    <div class="button-wrapper text-center mt-5">
                                        <a href="<?=$wcl_btn_url;?>" target="<?=$wcl_btn_trgt;?>"class="siteCTA blue"><?=$wcl_btn_txt;?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'wider_top_row' ): ?>
                <section class="wider-top-row">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1">
                                <div class="text-wrapper text-center">
                                    <?=get_sub_field('wtr_content');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'course_package_cards' ): ?>
                <section class="package-cards">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="packages-wrapper">
                                    <?php if( have_rows('package_cards') ) : while( have_rows('package_cards') ) : the_row(); ?>
                                        <?php 
                                            $icon = get_sub_field('icon');
                                            $title = get_sub_field('package_title');
                                            $cont = get_sub_field('package_content');
                                            $link = get_sub_field('package_link');
                                        ?>
                                        <div class="single-package">
                                            <div class="inner">
                                                <div class="top">
                                                    <?php if( $icon ) : ?>
                                                        <img src="<?=$icon['url'];?>" alt="<?=$icon['alt'];?>" class="img-fluid">
                                                    <?php endif; ?>
                                                    <h4><?=$title;?></h4>
                                                </div>
                                                <div class="content">
                                                    <?=$cont;?>
                                                    <?php 
                                                        if( $link ) : 
                                                            $btn_txt = $link['title'];
                                                            $btn_url = $link['url'];
                                                            $btn_trgt = $link['target'] ? $link['target'] : '_self';
                                                    ?>
                                                        <div class="button-wrapper">
                                                            <a href="<?=$btn_url;?>" target="<?=$btn_trgt;?>" class="siteCTA blue"><?=$btn_txt;?></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == '6_courses_shortcode' ): ?>    
                <section class="just-program-cards <?=get_sub_field('padding');?>-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="course-wrapper">
                                    <?php $loop_cat = get_sub_field('loop_category'); if( $loop_cat ) : ?>
                                        <?=do_shortcode('[product_loop category="' . esc_attr($loop_cat->slug) . '" count="'.get_sub_field('loop_count').'"]');?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php elseif( get_row_layout() == 'simple_text' ): ?>  
                <?php 
                    $col_align = get_sub_field('col_alignment');
                    if( $col_align == 'left' ) {
                        $c_al = 'margin-right: auto;';
                    } elseif( $col_align == 'center' ) {
                        $c_al = 'margin: 0 auto;';
                    } else {
                        $c_al = 'margin-left: auto;';
                    }
                ?>
                <section class="simple-text <?=get_sub_field('padding');?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-wrapper <?=get_sub_field('text_alignment');?>" style="max-width: <?=get_sub_field('width');?>px; <?=$c_al;?>">
                                    <?=get_sub_field('content');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            
            <?php elseif( get_row_layout() == 'card_courses' ): ?>
                <section class="home-courses <?=get_sub_field('course_bg');?>">
                    <div class="container">
                        <div class="row">
                            <?php if( get_sub_field('course_intro') ) : ?>
                                <div class="col-12 col-lg-6 offset-lg-3">
                                    <div class="title-wrapper text-center">
                                        <?=get_sub_field('course_intro');?>
                                    </div> 
                                </div>
                            <?php endif; ?>
                            <div class="col-12">
                                <div class="course-tabs">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li>
                                            Filter by:
                                        </li>
                                        <?php if( have_rows('course_tabs') ) : $tc = 1; while( have_rows('course_tabs') ) : the_row(); ?>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link <?php if( $tc == 1 ) { echo 'active'; } ?>" id="<?=get_sub_field('course_category')->slug;?>-tabbtn" data-bs-toggle="tab" data-bs-target="#<?=get_sub_field('course_category')->slug;?>-tab" type="button" role="tab" aria-controls="<?=get_sub_field('course_category')->slug;?>" aria-selected="true"><?=get_sub_field('tab_name');?></button>
                                            </li>
                                        <?php $tc++; endwhile; endif; ?>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <?php if( have_rows('course_tabs') ) : $tc = 1; while( have_rows('course_tabs') ) : the_row(); ?>
                                            <?php $slug = get_sub_field('course_category')->slug; ?>
                                            <div class="tab-pane fade <?php if( $tc == 1 ) { echo 'show active'; } ?>" id="<?=$slug;?>-tab" role="tabpanel" aria-labelledby="<?=$slug;?>-tab">
                                                <div class="course-wrapper">
                                                    <?=do_shortcode('[product_loop category="'.$slug.'"]');?>
                                                </div>
                                                <div class="text-center mt-5">
                                                    <a href="/our-courses" class="siteCTA blue">All courses</a>
                                                </div>
                                            </div>
                                        <?php $tc++; endwhile; endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer();?>