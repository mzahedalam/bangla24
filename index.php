<?php
/**
 * The main template file
 *
 * @package Bangla24
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if ( is_home() && is_front_page() ) : ?>
            <!-- Featured Section -->
            <section class="featured-section">
                <div class="featured-grid">
                    <?php
                    $featured_posts = modern_news_portal_get_featured_posts( 3 );
                    if ( $featured_posts->have_posts() ) :
                        $count = 0;
                        while ( $featured_posts->have_posts() ) :
                            $featured_posts->the_post();
                            
                            get_template_part( 'template-parts/content', 'featured', array('count' => $count) );
                            
                            $count++;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                        </div><!-- .featured-side -->
                        <?php
                    endif;
                    ?>
                </div>
            </section>
        <?php endif; ?>

        <div class="content-area">
            <div class="main-content">
                <?php
                if ( have_posts() ) :
                    ?>
                    <div class="article-grid">
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            get_template_part( 'template-parts/content', get_post_type() );
                        endwhile;
                        ?>
                    </div>
                    
                    <div class="pagination">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-angle-left"></i>',
                            'next_text' => '<i class="fas fa-angle-right"></i>',
                        ) );
                        ?>
                    </div>
                    <?php
                else :
                    get_template_part( 'template-parts/content', 'none' );
                endif;
                ?>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
