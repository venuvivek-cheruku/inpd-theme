<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

?>

<style>
.course-actions-landing {
    margin-top: 1rem;
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.product-title-with-icon--item {
    width: 200px;
    align-items: center;
}

@media screen and (max-width: 550px) {
    .product-title-with-icon--item {
        width: calc(100%/ 2 - 1rem);
    }
}
</style>

<div class="woocommerce-product-details__short-description">
    <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt); ?>
</div>


<!-- Custom Section for Course Info -->
<div class="course-info">
    <div class="course-details">
        <!-- Duration -->
        <div class="course-item">
            <span class="icon-clock">
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg fill="#102E43" width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm5,11H12a1,1,0,0,1-1-1V6a1,1,0,0,1,2,0v5h4a1,1,0,0,1,0,2Z" />
                </svg>
            </span>
            <h5>Duration:</h5>
            <p><?php echo esc_html( get_field('duration_delivery_method') ); ?></p>
        </div>

        <!-- Location -->
        <div class="course-item">
            <span class="icon-location">
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg width="30px" height="30px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.37892 10.2236L8 16L12.6211 10.2236C13.5137 9.10788 14 7.72154 14 6.29266V6C14 2.68629 11.3137 0 8 0C4.68629 0 2 2.68629 2 6V6.29266C2 7.72154 2.4863 9.10788 3.37892 10.2236ZM8 8C9.10457 8 10 7.10457 10 6C10 4.89543 9.10457 4 8 4C6.89543 4 6 4.89543 6 6C6 7.10457 6.89543 8 8 8Z"
                        fill="#102E43" />
                </svg>
            </span>
            <h5>Location:</h5>
            <p><?php echo esc_html( get_field('location') ); ?></p>
        </div>

        <!-- Qualification -->
        <div class="course-item">
            <span class="icon-graduation-cap">
                <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                <svg fill="#102E43" height="30px" width="30px" version="1.1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490 490"
                    xml:space="preserve">
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
            <p><?php echo esc_html( get_field('qualification') ); ?></p>
        </div>
    </div>
</div>

<a class="right-for-you-text" href="#is-course-right-for-you"> Is this course right for you? </a>

<div class="course-actions-landing">
    <a id="courseVariantsOpenModal" class="siteCTA blue">Book your place</a>
    <a href="#speakToTeam" class="siteCTA blue-border">Ask a question</a>
</div>

<!-- Course Variants Modal -->
<div class="course-variants-modal" id="courseModal">
    <div class="modal-content">
        <span id="courseVariantsCloseModal" class="close-modal">Close <span>&times;</span></span>
        <div class="container">
            <?php echo do_shortcode('[pvtfw_table_display]') ?>
        </div>
    </div>
</div>