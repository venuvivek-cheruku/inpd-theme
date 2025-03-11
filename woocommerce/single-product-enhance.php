<?php
/**
 * Template Name: Enhanced Product Template
 * Template Post Type: product
 * 
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */
?>
<style>
.woocommerce #content div.product div.summary,
.woocommerce div.product div.summary,
.woocommerce-page #content div.product div.summary,
.woocommerce-page div.product div.summary {
    float: right;
    width: 55% !important;
    clear: none;
}

.woocommerce #content div.product div.images,
.woocommerce div.product div.images,
.woocommerce-page #content div.product div.images,
.woocommerce-page div.product div.images {
    float: left;
    width: 40% !important;
}

section.woo-single-container.enhanced {
    position: relative;
    padding: 0 0;
}

.nav-tabs-course {
    width: 60%;
}

.course-variants-buttons {
    display: flex;
    gap: 20px;
    align-items: center;
}

.course-info.blue-card {
    background: #102E43;
    color: #fff;
    padding: 50px;
    padding-right: 70px;
    clip-path: polygon(0 0, 100% 0, 100% calc(100% - 30px), calc(100% - 30px) 100%, 0 100%);
}

.course-info.blue-card .course-details {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.course-info.blue-card .course-details .course-item {
    max-width: 300px;
    text-align: center;
}

.course-info.blue-card .course-details .course-item h5 {
    margin-top: 1rem;
}

.tabs-with-course-info {
    margin: 2rem 0rem;
}

.tabs-with-course-info-container {
    display: flex;
    justify-content: space-between;
    gap: 4rem;
}

.tabs-with-course-info-container .content {
    padding: 2rem 0rem;
}

.tabs-with-course-info-container .nav.nav-tabs {
    display: flex;
    align-items: center;
}

.tabs-with-course-info-container .nav-tabs button.nav-link.active {
    border-bottom: 1px solid;
    opacity: 1;
}

.tabs-with-course-info-container .nav-link.active {
    color: black;
}

.tabs-with-course-info-container .nav-tabs button.nav-link {
    opacity: 0.5;
    transition: all 333ms ease;
    border: unset;
    outline: unset !important;
}

.tabs-with-course-info-container .nav-tabs button.nav-link {
    position: relative;
    opacity: 0.5;
    transition: all 333ms ease;
    border: unset;
    outline: unset !important;
}

.tabs-with-course-info-container .nav-link {
    color: gray;
}

@media screen and (max-width: 767px) {
    .nav-tabs-course {
        width: 100%;
    }
}
</style>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
    get_header();
 ?>

<section class="boxed-top-row"
    style="background: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>') no-repeat center center / cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="text-wrapper blue-box">
                    <!-- Product Title -->
                    <h1><?php echo esc_html(get_the_title()); ?></h1>
                    <!-- Product Short Description -->
                    <div class="woocommerce-product-details__short-description">
                        <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt); ?>
                    </div>

                    <section class="woo-single-container enhanced">

                        <div class="course-variants-buttons">
                            <a id="courseVariantsOpenModal" class=" courseVariantsOpenModal siteCTA">Book your
                                place</a>
                            <?php 
                            // Button from ACF Sub Field
                            $btr_btn = get_field('product_main_cta');
                            if ($btr_btn) {
                                $btrbtn_txt = $btr_btn['title'];
                                $btrbtn_url = $btr_btn['url'];
                                $btrbtn_trgt = $btr_btn['target'] ? $btr_btn['target'] : '_self';
                                echo '<a href="' . esc_url($btrbtn_url) . '" class="siteCTA" target="' . esc_attr($btrbtn_trgt) . '">' . esc_html($btrbtn_txt) . '</a>';
                            }
                        ?>
                        </div>
                        <!-- Course Variants Modal -->
                        <div class="course-variants-modal" id="courseModal">
                            <div class="modal-content">
                                <span id="courseVariantsCloseModal" class="close-modal">Close
                                    <span>&times;</span></span>
                                <div class="container">
                                    <?php 
                                        // Dynamically get the current product ID
                                        $product_id = get_the_ID();
                                        // Pass the product ID dynamically into the shortcode
                                        echo do_shortcode('[pvtfw_table_display id="' . esc_attr($product_id) . '"]'); 
                                 ?>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Three Stats with Icons -->
<section class="three-stat-row">
    <div class="container">
        <div class="row grey-bg" style="margin-top: -50px; z-index: 1; position: relative;">
            <?php
            // Get the main group field
            $product_stat_fields = get_field('product_stat_fields');
            
            if ($product_stat_fields) :
                // Iterate through each stat group
                foreach ($product_stat_fields as $group_key => $stat_group) :
                    // Retrieve the stat number and text from each group
                    $stat_number = $stat_group['stat_number'] ?? '';
                    $stat_text = $stat_group['stat_text'] ?? '';
            ?>
            <div class="col-12 col-lg-4">
                <div class="stat-wrap text-center">
                    <h2 class="font-xl"><?= esc_html($stat_number); ?></h2>
                    <p><?= esc_html($stat_text); ?></p>
                </div>
            </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Custom Section for Course Info -->
<section class="tabs-with-course-info">
    <div class="container">
        <div class="tabs-with-course-info-container">
            <div class="nav-tabs-course">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-title-1" data-bs-toggle="tab" data-bs-target="#tab-1"
                            type="button" role="tab" aria-controls="tab-1" aria-selected="true">
                            <?=get_field('tab_one_title');?>
                        </button>
                    </li>
                    <span>|</span>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-title-2" data-bs-toggle="tab" data-bs-target="#tab-2"
                            type="button" role="tab" aria-controls="tab-2" aria-selected="false" tabindex="-1">
                            <?=get_field('tab_two_title');?>
                        </button>
                    </li>
                    <span>|</span>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-title-2" data-bs-toggle="tab" data-bs-target="#tab-2"
                            type="button" role="tab" aria-controls="tab-2" aria-selected="false" tabindex="-1">
                            <?=get_field('tab_three_title');?>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-title-1">
                        <div class="content">
                            <?=get_field('tab_one_content');?>
                        </div>
                        <div class="button-wrapper"></div>
                    </div>
                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-title-2">
                        <div class="content">
                            <?=get_field('tab_two_content');?>
                        </div>
                        <div class="button-wrapper"></div>
                    </div>
                    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-title-3">
                        <div class="content">
                            <?=get_field('tab_three_content');?>
                        </div>
                        <div class="button-wrapper"></div>
                    </div>
                </div>
            </div>
            <div class="course-info blue-card">
                <div class="course-details">
                    <?php $product_meta_fields = get_field('product_meta_fields'); ?>
                    <!-- Duration -->
                    <div class="course-item">
                        <span class="icon-clock">
                            <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                            <svg fill="#fff" width="30px" height="30px" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm5,11H12a1,1,0,0,1-1-1V6a1,1,0,0,1,2,0v5h4a1,1,0,0,1,0,2Z" />
                            </svg>
                        </span>
                        <h5>Duration Delivery Method:</h5>
                        <p><?php echo esc_html( $product_meta_fields['duration_delivery_method'] ); ?></p>
                    </div>

                    <!-- Location -->
                    <div class="course-item">
                        <span class="icon-location">
                            <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                            <svg width="30px" height="30px" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.37892 10.2236L8 16L12.6211 10.2236C13.5137 9.10788 14 7.72154 14 6.29266V6C14 2.68629 11.3137 0 8 0C4.68629 0 2 2.68629 2 6V6.29266C2 7.72154 2.4863 9.10788 3.37892 10.2236ZM8 8C9.10457 8 10 7.10457 10 6C10 4.89543 9.10457 4 8 4C6.89543 4 6 4.89543 6 6C6 7.10457 6.89543 8 8 8Z"
                                    fill="#fff" />
                            </svg>
                        </span>
                        <h5>Location:</h5>
                        <p><?php echo esc_html( $product_meta_fields['location'] ); ?></p>
                    </div>

                    <!-- Qualification -->
                    <div class="course-item">
                        <span class="icon-graduation-cap">
                            <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                            <svg fill="#fff" height="30px" width="30px" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 490 490" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M480,15.871H10c-5.523,0-10,4.477-10,10v410c0,5.523,4.477,10,10,10h260V299.577c-3.229-8.972-5-18.635-5-28.706
				c0-46.869,38.131-85,85-85c46.869,0,85,38.131,85,85c0,10.071-1.771,19.733-5,28.706v146.294h50c5.523,0,10-4.477,10-10v-410
				C490,20.349,485.523,15.871,480,15.871z M45,175.871h40v20H45V175.871z M175,395.871H45v-20h130V395.871z M235,345.871H45v-20
				h190V345.871z M235,295.871H45v-20h190V295.871z M235,245.871H45v-20h190V245.871z M285,135.871h-80v-20h80V135.871z M335,95.871
				H155v-20h180V95.871z" />
                                            <path d="M290,331.02v143.109l50-42.857v-55.4h20v55.4l50,42.857V331.02c-15.385,15.348-36.603,24.852-60,24.852
				C326.603,355.872,305.385,346.368,290,331.02z" />
                                            <path
                                                d="M350,205.871c-35.841,0-65,29.159-65,65s29.159,65,65,65s65-29.159,65-65S385.841,205.871,350,205.871z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <h5>Qualification:</h5>
                        <p><?php echo esc_html( $product_meta_fields['qualification'] ); ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<?php if (have_rows('course_additional_information')): // Flexible Content Field ?>
<?php while (have_rows('course_additional_information')): the_row(); ?>
<?php if( get_row_layout() == 'by_leaders' ) : ?>
<!-- Title (4) Content (8) -->
<section class="title4-cont8 <?=get_sub_field('background_colour');?>">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="title-wrapper">
                    <h2 style="font-size: <?=get_sub_field('heading_font_size'); ?>px; line-height:100%;">
                        <?=get_sub_field('heading');?>
                    </h2>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="text-wrapper">
                    <?=get_sub_field('content');?>
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
<?php elseif( get_row_layout() == 'teacher_slider_section' ): ?>
<section class="teacher-row">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="text-wrapper">
                    <?php if( get_sub_field('sub_heading') ) : ?>
                    <p class="blue-underline text-uppercase"><?=get_sub_field('sub_heading');?></p>
                    <?php endif; ?>
                    <?=get_sub_field('heading');?>
                </div>
            </div>
            <div class="col-12">
                <div class="teach-slider">
                    <?php if( have_rows('teachers') ) : while( have_rows('teachers') ) : the_row(); ?>
                    <?php $teacher = get_sub_field('teacher_item'); if( $teacher ): ?>
                    <div class="item">
                        <div class="single-teacher"
                            style="background: url('<?=get_the_post_thumbnail_url( $teacher->ID );?>') no-repeat center center / cover;">
                            <div class="inner">
                                <h5><?php echo esc_html( $teacher->post_title ); ?></h5>
                                <p><?= get_field('job_title', $teacher->ID); ?></p>
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
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif( get_row_layout() == 'marketing_review_section' ): ?>
<section class="testimonial-row <?=get_sub_field('background_colour');?>">
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
<?php elseif (get_row_layout() == 'brochure_section'): ?>
<section class="product-download-brochure <?=get_sub_field('background_colour');?>">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-7" style="padding-bottom: 4rem;">
                <div class="text-wrapper">
                    <p class=" text-uppercase <?php if (get_sub_field('background_colour') === 'no-colour') {
                                    echo 'blue-underline';
                                } else {
                                    echo 'white-underline'; 
                                } ?>">Download our brochure</p>
                    <h2><?php the_sub_field('brochure_heading'); ?></h2>

                    <div class="button-wrapper">
                        <?php 
                            $teach_btn = get_sub_field('speak_to_an_expert');

                            if ($teach_btn) {
                                $btn_txt = $teach_btn['title'];
                                $btn_url = $teach_btn['url'];
                                $btn_trgt = $teach_btn['target'] ? $teach_btn['target'] : '_self';

                                echo '<div class="brochure-btn">';
                                echo '<a style="margin-right: 20px;" href="' . esc_url($btn_url) . '" target="' . esc_attr($btn_trgt) . '" class="siteCTA ';

                                // Check the background color field
                                if (get_sub_field('background_colour') === 'no-colour') {
                                    echo 'blue';
                                }

                                echo '">' . esc_html($btn_txt) . '</a>';
                                echo '</div>';
                            }
                            ?>
                        <?php
                                    $brochure = get_sub_field('brochure_link'); 
                                    if ($brochure):
                                        $brochure_url = is_array($brochure) ? $brochure['url'] : $brochure;
                                    ?>
                        <a href="<?php echo esc_url($brochure_url); ?>"
                            class="siteCTA outline download  <?php if (get_sub_field('background_colour') === "no-colour") { echo 'blue'; } ?>"
                            target="
                            _self">
                            Download brochure
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="image-wrapper">
                    <?php
                                $brochure_image = get_sub_field('brochure_image');
                                if ($brochure_image):
                                    $brochure_image_url = is_array($brochure_image) ? $brochure_image['url'] : $brochure_image;
                                    $brochure_image_alt = is_array($brochure_image) ? $brochure_image['alt'] : 'Brochure Image';
                                ?>
                    <img src="<?php echo esc_url($brochure_image_url); ?>"
                        alt="<?php echo esc_attr($brochure_image_alt); ?>" />
                    <?php else: ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/image-coming-soon.jpg"
                        alt="Default Brochure Image" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php elseif (get_row_layout() == 'course_video_section'): ?>
<section class="product-video grey-bg">
    <div class="container">
        <div class="title-wrapper text-center">
            <h2 class="blue-underline center"> <?=get_sub_field('heading');?></h2>
        </div>
        <?php
                    $video_placeholder = get_sub_field('course_thumbnail');
                    $course_video = get_sub_field('course_video'); 
                    ?>
        <div class="float-vid">
            <div class="video-img" data-aos="fade-right">
                <img src="<?php echo esc_url($video_placeholder ? $video_placeholder : get_template_directory_uri() . '/assets/images/placeholder.jpg'); ?>"
                    alt="Video Placeholder" class="img-fluid">
                <?php if ($course_video): ?>
                <div class="vid-btn">
                    <a data-bs-toggle="modal" data-bs-target=".vid-modal">
                        <img src="/wp-content/uploads/2024/07/play-btn-1.svg" alt="Play Button" class="img-fluid">
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($course_video): ?>
        <div class="modal fade vid-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-12 video-wrapper">
                            <div class="close" data-bs-dismiss="modal">✕</div>
                            <iframe src="<?php echo esc_url($course_video); ?>" frameborder="0"
                                allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php elseif (get_row_layout() == 'marketing_review_two_section'): ?>
<section class="product-testimonial">
    <?php
                $review_text = get_sub_field('review');
                $reviewer_name = get_sub_field('reviewer');
                if ($review_text && $reviewer_name): ?>
    <div class="item single-test text-center">
        <h2><?php echo esc_html($review_text); ?></h2>
        <p class="job"><?php echo esc_html($reviewer_name); ?></p>
    </div>
    <?php endif; ?>
</section>

<?php elseif (get_row_layout() == 'who_is_it_for_section'): ?>
<section id="is-course-right-for-you" class="product-title-with-icons-container title-with-icons dark-blue-bg">
    <div class="container">
        <div class="row">
            <!-- Section Title -->
            <div class="title-wrapper" style="text-align: left;">
                <p class="white-underline text-uppercase"><?php the_sub_field('sub_heading'); ?></p>
                <h2><?php the_sub_field('who_is_it_for_heading'); ?></h2>
            </div>
            <!-- Icons and Descriptions -->
            <div class="col-12 product-title-with-icons"
                style="display: flex; gap: 20px; justify-content: start; align-items: flex-start; flex-wrap: wrap;">
                <?php 
                // Get the group field
                $who_is_it_for = get_sub_field('whoisitforfield');
                if ($who_is_it_for): ?>
                <?php
                    // Hardcoded icons
                    $icon_map = [
                        'job_seniority' => 'https://inpd.heyoo.website/wp-content/uploads/2024/08/network-wired-solid.svg',
                        'job_function'  => 'https://inpd.heyoo.website/wp-content/uploads/2024/08/benefits-executive-coaching.svg',
                        'time_in_role'  => 'https://inpd.heyoo.website/wp-content/uploads/2024/08/business-time-solid.svg',
                        'sector'        => 'https://inpd.heyoo.website/wp-content/uploads/2024/08/chart-pie-solid.svg',
                        'key_objective' => 'https://inpd.heyoo.website/wp-content/uploads/2024/08/bullseye-solid.svg',
                    ];
                    ?>

                <?php foreach ($who_is_it_for as $key => $value): ?>
                <?php
                        // Get the icon, title, and description based on the field key
                        $icon = isset($icon_map[$key]) ? $icon_map[$key] : '';
                        $title = '';
                        $description = '';

                        switch ($key) {
                            case 'job_seniority':
                            case 'job_function':
                            case 'sector':
                                if (!empty($value) && is_array($value)) {
                                    $title = ucwords(str_replace('_', ' ', $key)); // Convert field key to readable title
                                    $description = implode(', ', wp_list_pluck($value, 'name')); // Get taxonomy term names
                                }
                                break;

                            case 'time_in_role':
                                if (!empty($value) && is_array($value)) {
                                    $title = 'Time in Role';
                                    $description = implode(', ', array_map(function ($term_id) {
                                        $term = get_term($term_id); // Fetch term object by ID
                                        return $term ? $term->name : '';
                                    }, $value)); // Get term names
                                }
                                break;

                            case 'key_objective':
                                if (!empty($value)) {
                                    $title = 'Key Objective';
                                    $description = $value; // Text field
                                }
                                break;
                        }
                        ?>

                <?php if (!empty($icon) && !empty($title) && !empty($description)): ?>
                <div class="product-title-with-icon--item" style="width: 200px; text-align: center;">
                    <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($title); ?>"
                        class="product-title-with-icon--item__icon"
                        style="width: 40px; height: 40px; object-fit: contain; margin-bottom: 1rem;">
                    <h5><?php echo esc_html($title); ?></h5>
                    <p><?php echo esc_html($description); ?></p>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php elseif (get_row_layout() == 'in-house_approach_section'): ?>
<section class="title-with-cards grey-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="title-wrapper">
                    <p class="blue-underline lw-50 text-uppercase center"><?php the_sub_field('sub_heading'); ?></p>
                    <h2><?php the_sub_field('heading'); ?></h2>
                    <?php the_sub_field('content'); ?>
                </div>
                <div class="text-center mt-5"
                    style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center; justify-content: center;">
                    <a href="<?php the_sub_field('button_one_url'); ?>"
                        class="siteCTA blue"><?php the_sub_field('button_one_text'); ?></a>
                    <a href="<?php the_sub_field('button_two_url'); ?>"
                        class="siteCTA blue"><?php the_sub_field('button_two_text'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php elseif (get_row_layout() == 'upcoming_courses_section'): ?>
<?php
// Dynamically get the current product ID
$product_id = get_the_ID();
$product = wc_get_product($product_id);

// Check if product exists and is a variable product
if ($product && $product->is_type('variable')) {
    $variations = $product->get_available_variations();

    // Categorise variations into tabs
    $virtual_variants = [];
    $face_to_face_variants = [];
    $in_house_variants = [];

    foreach ($variations as $variation) {
        $variation_id = $variation['variation_id'];

        // Handle undefined keys by setting defaults
        $date = $variation['attributes']['attribute_dates'] ?? 'N/A';
        $time = $variation['attributes']['attribute_time'] ?? 'N/A';
        $location = $variation['attributes']['attribute_location'] ?? 'Online';
        $programme_type = $variation['attributes']['attribute_programme-type'] ?? 'Other';

        $price = wc_price($variation['display_price'] ?? 0);
        $stock = $variation['max_qty'] ?? 0;
        $availability = ($stock > 0) ? "Available: $stock space(s) remaining" : "Fully booked";

        // Generate unique Add to Cart URL safely
        $add_to_cart_url = wc_get_cart_url() . "?add-to-cart=" . $product_id . "&variation_id=" . $variation_id . 
        (!empty($date) ? "&attribute_dates=" . urlencode($date) : "") . 
        (!empty($time) ? "&attribute_time=" . urlencode($time) : "") . 
        (!empty($location) ? "&attribute_location=" . urlencode($location) : "") . 
        (!empty($programme_type) ? "&attribute_programme-type=" . urlencode($programme_type) : "");

        // Sort variations into categories
        if (strcasecmp($programme_type, 'Virtual') === 0) {
            $virtual_variants[] = compact('date', 'time', 'location', 'price', 'availability', 'add_to_cart_url');
        } elseif (strcasecmp($programme_type, 'Face to Face') === 0) {
            $face_to_face_variants[] = compact('date', 'time', 'location', 'price', 'availability', 'add_to_cart_url');
        } elseif (in_array(strtolower($programme_type), ['in house', 'in-house'])) {
            $in_house_variants[] = compact('date', 'time', 'location', 'price', 'availability', 'add_to_cart_url');
        }
    }
?>

<section class="product-centered-tabs centered-tabs white-bg">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="title-wrapper">
                    <p class="blue-underline lw-50 text-uppercase center"><?php the_sub_field('sub_heading'); ?></p>
                    <h2><?php the_sub_field('heading'); ?></h2>
                </div>
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" id="virtual-tab" data-bs-toggle="tab" data-bs-target="#virtual"
                            type="button" role="tab">VIRTUAL</button>
                    </li>
                    <li>|</li>
                    <li class="nav-item">
                        <button class="nav-link" id="face-to-face-tab" data-bs-toggle="tab"
                            data-bs-target="#face-to-face" type="button" role="tab">FACE TO FACE</button>
                    </li>
                    <li>|</li>
                    <li class="nav-item">
                        <button class="nav-link" id="in-house-tab" data-bs-toggle="tab" data-bs-target="#in-house"
                            type="button" role="tab">IN HOUSE</button>
                    </li>
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content" id="programmeTabsContent">
                    <!-- Virtual Tab -->
                    <div class="tab-pane fade show active" id="virtual" role="tabpanel">
                        <div class="row">
                            <?php if (!empty($virtual_variants)) { 
                                foreach ($virtual_variants as $variant) { ?>
                            <div class="col-md-6">
                                <div class="variant-card">
                                    <h3><?php echo esc_html($variant['date']); ?> -
                                        <?php echo esc_html($variant['time']); ?></h3>
                                    <p><strong>Location:</strong> <?php echo esc_html($variant['location']); ?></p>
                                    <p><strong>Price:</strong> <?php echo $variant['price']; ?></p>
                                    <p><?php echo esc_html($variant['availability']); ?></p>
                                    <a href="<?php echo esc_url($variant['add_to_cart_url']); ?>"
                                        class="siteCTA blue">Book Your Place</a>
                                </div>
                            </div>
                            <?php } } else { echo "<p>No virtual training sessions available.</p>"; } ?>
                        </div>
                    </div>

                    <!-- Face to Face Tab -->
                    <div class="tab-pane fade" id="face-to-face" role="tabpanel">
                        <div class="row">
                            <?php if (!empty($face_to_face_variants)) { 
                                foreach ($face_to_face_variants as $variant) { ?>
                            <div class="col-md-6">
                                <div class="variant-card">
                                    <h3><?php echo esc_html($variant['date']); ?> -
                                        <?php echo esc_html($variant['time']); ?></h3>
                                    <p><strong>Location:</strong> <?php echo esc_html($variant['location']); ?></p>
                                    <p><strong>Price:</strong> <?php echo $variant['price']; ?></p>
                                    <p><?php echo esc_html($variant['availability']); ?></p>
                                    <a href="<?php echo esc_url($variant['add_to_cart_url']); ?>"
                                        class="siteCTA blue">Book Your Place</a>
                                </div>
                            </div>
                            <?php } } else { echo "<p>No face-to-face training sessions available.</p>"; } ?>
                        </div>
                    </div>

                    <!-- In House Tab -->
                    <div class="tab-pane fade" id="in-house" role="tabpanel">
                        <div class="row">
                            <?php if (!empty($in_house_variants)) { 
                                foreach ($in_house_variants as $variant) { ?>
                            <div class="col-md-6">
                                <div class="variant-card">
                                    <h3><?php echo esc_html($variant['date']); ?> -
                                        <?php echo esc_html($variant['time']); ?></h3>
                                    <p><strong>Location:</strong> <?php echo esc_html($variant['location']); ?></p>
                                    <p><strong>Price:</strong> <?php echo $variant['price']; ?></p>
                                    <p><?php echo esc_html($variant['availability']); ?></p>
                                    <a href="<?php echo esc_url($variant['add_to_cart_url']); ?>"
                                        class="siteCTA blue">Book Your Place</a>
                                </div>
                            </div>
                            <?php } } else { echo "<p>No in-house training sessions available.</p>"; } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    .variant-card {
        min-height: 270px;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        background: #fff;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .variant-card h3 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .variant-card p {
        margin: 5px 0;
    }

    .variant-card .siteCTA {
        display: block;
        width: fit-content;
        margin: 0 auto;
        margin-top: 1rem;
    }
    </style>
</section>

<?php } else { ?>
<p>No available training sessions.</p>
<?php } ?>

<?php elseif (get_row_layout() == 'contact_section'): ?>
<section id="speakToTeam" class="speak-to-team dark-blue-bg">
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

<?php elseif (get_row_layout() == 'related_products'): ?>
<!-- Start WooCommerce Related Products Section -->
<div id="product-content" class="home-courses related-products-section grey-bg">
    <div class="container">
        <div class="text-wrapper">
            <p class="blue-underline text-uppercase"><?php the_sub_field('sub_heading'); ?></p>
            <h2><?php the_sub_field('heading'); ?></h2>
        </div>
        <div class="row">
            <?php
            global $product;

            $related_products = wc_get_related_products( $product->get_id(), 4 );

            if ( $related_products ) : ?>
            <div class="col-12">
                <div class="filter"></div>
                <div class="course-wrapper">
                    <?php foreach ( $related_products as $related_product_id ) :
                            $related_product = wc_get_product( $related_product_id );
                            $product_title = $related_product->get_name();
                            $product_price = $related_product->get_price_html();
                            $product_permalink = get_permalink( $related_product_id );
                            $product_image = wp_get_attachment_url( $related_product->get_image_id() );
                        ?>
                    <div class="single-course">
                        <div class="top">
                            <img src="<?php echo esc_url( $product_image ); ?>" alt="Card Header" class="img-fluid">
                        </div>
                        <div class="content ">
                            <!-- <p class="course-class"><?php echo esc_html( $related_product->get_type() ); ?></p> -->
                            <h4><?php echo esc_html( $product_title ); ?></h4>
                            <p><?php echo wp_strip_all_tags(get_the_excerpt()); ?></p>
                            <div class="meta">
                                <p class="price"><?php echo wp_kses_post( $product_price ); ?></p>
                            </div>
                            <a href="<?php echo esc_url( $product_permalink ); ?>" class="siteCTA">Visit Course</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php
                    $shop_link = the_sub_field('view_more_courses_url'); 
                    ?>
                <div class="text-center py-5">
                    <a href="<?php echo esc_url( $shop_link ); ?>" class="siteCTA blue">View More Courses</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- End WooCommerce Related Products Section -->

<?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>


<?php
get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */