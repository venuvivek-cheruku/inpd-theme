<?php
get_header(); 
// Get current term details
$term = get_queried_object();
$thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
$thumbnail_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : 'https://your-default-image-url.com/default.jpg';
?>

<!-- Category Header Section -->
<section class="boxed-top-row"
    style="background: url('<?php echo esc_url($thumbnail_url); ?>') no-repeat center center / cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="text-wrapper blue-box">
                    <h1><?php single_term_title(); ?></h1>
                    <?php if (category_description()) : ?>
                    <p><?php echo category_description(); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-courses taxonomy-products-section">
    <div class="container">
        <div class="row mt-4">
            <div class="course-wrapper mt-4">
                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        include get_template_directory() . '/partials/course-card.php';
                    endwhile;
                else :
                    echo '<p>No products found in this category.</p>';
                endif;
                ?>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>