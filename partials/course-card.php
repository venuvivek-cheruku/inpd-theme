<div class="single-course">
    <div class="top position-relative">
        <a href="<?=get_the_permalink( get_the_ID() ); ?>" class="abs-link"><span class="d-none">View Course</span></a>
        <?php if( get_the_post_thumbnail_url(get_the_ID(), 'large') ) : ?>
        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="Card Header"
            class="img-fluid">
        <?php else : ?>
        <img src="/wp-content/uploads/2025/01/ddp-finance-for-non-finance-directors.jpg" alt="Card Header"
            class="img-fluid">
        <?php endif; ?>
    </div>
    <div class="content ">
        <p class="course-class d-none">
            <?php echo wp_kses_post(wc_get_product_category_list(get_the_ID(), ', ')); ?>
        </p>
        <h4><?php the_title(); ?></h4>
        <p><?php echo wp_strip_all_tags(wp_trim_words(get_the_excerpt(), 22)); ?></p>
        <div class="meta">
            <?php 
                while( have_rows('product_meta_fields') ) : the_row();
                    $dm = get_sub_field('duration_delivery_method');
                    $loc = get_sub_field('location');
                endwhile;
            ?>
            <?php if( wc_get_product(get_the_ID())->get_price_html() ) : ?>
            <p class="price"><?php echo wp_kses_post(wc_get_product(get_the_ID())->get_price_html()); ?></p>
            <?php endif; if( $dm ) : ?>
            <p class="duration"><?=$dm;?></p>
            <?php endif; if( $loc ) : ?>
            <p class="location"><?=$loc;?></p>
            <?php endif; ?>
        </div>
        <a href="<?=get_the_permalink( get_the_ID() ); ?>" class="siteCTA">Visit Course</a>
    </div>
</div>