<?php get_header(); ?>

    <section class="news-top">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="text-wrapper">
                        <h1 class="semi-bold">Category: <?php single_cat_title(); ?></h1>
                        <?=category_description(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="posts-row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter">
                        <?php
                        $categories = get_categories(array(
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'hide_empty' => true, // Only show categories with posts
                        ));

                        if (!empty($categories)) {
                            echo '<p class="m-0">Filter:</p>';
                            echo '<ul class="category-filter"><li><a href="/news">All</a></li>';
                            foreach ($categories as $category) {
                                $active_class = (is_category() && get_queried_object_id() == $category->term_id) ? ' class="active"' : '';
                                echo '<li><a href="' . get_category_link($category->term_id) . '"' . $active_class . '>' . $category->name . '</a></li>';
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>
                    <div class="posts-wrap">
                        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
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
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php if( has_post_thumbnail() ) : the_post_thumbnail( 'full' ); ?>
                                                <?php else : ?> 
                                                    <img width="637" height="618" src="/wp-content/uploads/2024/07/placeholder.jpg" class="attachment-full size-full wp-post-image" alt="" decoding="async" fetchpriority="high" srcset="/wp-content/uploads/2024/07/placeholder.jpg 637w, /wp-content/uploads/2024/07/placeholder-600x582.jpg 600w, /wp-content/uploads/2024/07/placeholder-300x291.jpg 300w" sizes="(max-width: 637px) 100vw, 637px">
                                                <?php endif; ?>
                                            </a>
                                        </div>
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
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </div>
            <div class="pagination">
            <?php
                echo paginate_links( array(
                    'prev_text' => __('<img class="img-fluid" src="/wp-content/uploads/2024/07/blue-nav-arrow-left.svg" alt="arrow left">', 'textdomain'),
                    'next_text' => __('<img class="img-fluid" src="/wp-content/uploads/2024/07/blue-nav-arrow-right.svg" alt="arrow right">', 'textdomain'),
                ) );
            ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>