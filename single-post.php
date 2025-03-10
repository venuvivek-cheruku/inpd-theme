<?php get_header(); ?>

    <section class="post-content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-9">
                    <div class="title">
                        <h1><?=the_title();?></h1>
                    </div>
                </div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="col-12">
                        <div class="post-img">
                            <?php the_post_thumbnail( 'full' ); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-12 col-lg-9">
                    <div class="post-content">
                        <?=the_content();?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="post-next-prev">
                        <?php if( get_previous_post() !== '' ) : ?>
                            <div class="prev">
                                <a href="<?=get_the_permalink( get_previous_post()->ID );?>">Previous</a>
                            </div>
                        <?php endif; ?>
                        <?php if( get_next_post() !== '' ) : ?>
                            <div class="next">
                                <a href="<?=get_the_permalink( get_next_post()->ID );?>">Next</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="more-posts">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="text-wrapper">
                        <h2>You may also like...</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod accusamus cupiditate placeat unde eos! Assumenda at blanditiis aperiam veniam soluta.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="more-posts-slider">
                        <?php
                            $current_post_id = get_the_ID();

                            // Arguments for the query to get recent posts excluding the current post
                            $args = array(
                                'post_type'      => 'post', 
                                'posts_per_page' => 5, 
                                'post__not_in'   => array($current_post_id), 
                                'orderby'        => 'date', 
                                'order'          => 'DESC'  
                            );

                            // Custom query
                            $recent_posts_query = new WP_Query($args);

                            // The Loop
                            if ($recent_posts_query->have_posts()) :
                                while ($recent_posts_query->have_posts()) : $recent_posts_query->the_post();
                                    // Display post details (title and excerpt in this example)
                                    ?>
                                    <div class="item">
                                        <div class="single-post">
                                            <div class="inner">
                                                <div class="post-categories">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ( ! empty( $categories ) ) {
                                                        foreach ( $categories as $category ) {
                                                            echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="post-category">' . esc_html( $category->name ) . '</a> ';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <div class="post-thumbnail">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail( 'full' ); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="content">
                                                    <p class="date"><?php echo get_the_date( 'j F Y' ); ?></p>
                                                    <h4 class="post-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                    <div class="post-excerpt">
                                                        <?=wp_trim_words( get_the_excerpt(), 13, '...'); ?>
                                                    </div>
                                                    <div class="read-more">
                                                        <a href="<?php the_permalink(); ?>" class="siteCTA blue">Read More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                // Reset post data
                                wp_reset_postdata();
                            else :
                                // No posts found message
                                echo '<p>No recent posts available.</p>';
                            endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $page_id = 6; //need to get this to work?>
    <section class="three-stats">
        <div class="container">
            <div class="row">
                <?php if( have_rows('ts_stats', $page_id) ) : while( have_rows('ts_stats', $page_id) ) : the_row(); ?>
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