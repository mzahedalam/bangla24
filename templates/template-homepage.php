<?php
/**
 * Template Name: Homepage Template
 *
 * @package Modern_News_Portal
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <!-- Breaking News Section -->
        <?php if ( get_theme_mod( 'modern_news_portal_show_breaking_news', true ) ) : ?>
            <section class="breaking-news-section">
                <div class="breaking-news">
                    <div class="breaking-news-label">
                        <?php echo esc_html( get_theme_mod( 'modern_news_portal_breaking_news_label', __( 'Breaking News', 'modern-news-portal' ) ) ); ?>
                    </div>
                    <div class="ticker-wrapper">
                        <div class="ticker-items">
                            <?php
                            $breaking_news = modern_news_portal_get_breaking_news( 5 );
                            if ( $breaking_news->have_posts() ) :
                                while ( $breaking_news->have_posts() ) :
                                    $breaking_news->the_post();
                                    ?>
                                    <div class="ticker-item">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                ?>
                                <div class="ticker-item">
                                    <a href="#"><?php esc_html_e( 'Welcome to Modern News Portal', 'modern-news-portal' ); ?></a>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Featured Section -->
        <?php if ( get_theme_mod( 'modern_news_portal_show_featured_posts', true ) ) : ?>
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
                    endif;
                    ?>
                </div>
            </section>
        <?php endif; ?>

        <div class="content-area">
            <div class="main-content">
                <section class="latest-news-section">
                    <h2 class="section-title"><?php esc_html_e( 'Latest News', 'modern-news-portal' ); ?></h2>
                    
                    <?php
                    $latest_args = array(
                        'post_type'           => 'post',
                        'posts_per_page'      => 6,
                        'ignore_sticky_posts' => true,
                    );
                    
                    $latest_query = new WP_Query( $latest_args );
                    
                    if ( $latest_query->have_posts() ) :
                        ?>
                        <div class="article-grid">
                            <?php
                            while ( $latest_query->have_posts() ) :
                                $latest_query->the_post();
                                get_template_part( 'template-parts/content', get_post_type() );
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                        
                        <div class="view-all">
                            <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="view-all-link">
                                <?php esc_html_e( 'View All News', 'modern-news-portal' ); ?> <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <?php
                    endif;
                    ?>
                </section>
                
                <section class="category-sections">
                    <?php
                    // Get categories for homepage sections
                    $categories = get_categories( array(
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'number'     => 3,
                        'hide_empty' => true,
                    ) );
                    
                    foreach ( $categories as $category ) :
                        $cat_args = array(
                            'post_type'           => 'post',
                            'posts_per_page'      => 4,
                            'ignore_sticky_posts' => true,
                            'cat'                 => $category->term_id,
                        );
                        
                        $cat_query = new WP_Query( $cat_args );
                        
                        if ( $cat_query->have_posts() ) :
                            ?>
                            <div class="category-section">
                                <h2 class="section-title">
                                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                                        <?php echo esc_html( $category->name ); ?>
                                    </a>
                                </h2>
                                
                                <div class="category-posts">
                                    <?php
                                    $count = 0;
                                    while ( $cat_query->have_posts() ) :
                                        $cat_query->the_post();
                                        
                                        if ( $count === 0 ) :
                                            ?>
                                            <div class="category-main-post">
                                                <div class="category-main-image">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php if ( has_post_thumbnail() ) : ?>
                                                            <?php the_post_thumbnail( 'modern-news-portal-featured-medium' ); ?>
                                                        <?php else : ?>
                                                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-medium.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <h3 class="category-main-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="category-main-meta">
                                                    <?php echo modern_news_portal_get_date(); ?>
                                                </div>
                                                <div class="category-main-excerpt">
                                                    <?php echo modern_news_portal_get_excerpt( 20 ); ?>
                                                </div>
                                            </div>
                                            <div class="category-sub-posts">
                                            <?php
                                        else :
                                            ?>
                                            <div class="category-sub-post">
                                                <div class="category-sub-image">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php if ( has_post_thumbnail() ) : ?>
                                                            <?php the_post_thumbnail( 'modern-news-portal-featured-small' ); ?>
                                                        <?php else : ?>
                                                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-small.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="category-sub-content">
                                                    <h4 class="category-sub-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                    <div class="category-sub-meta">
                                                        <?php echo modern_news_portal_get_date(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endif;
                                        
                                        $count++;
                                    endwhile;
                                    wp_reset_postdata();
                                    ?>
                                    </div><!-- .category-sub-posts -->
                                </div><!-- .category-posts -->
                                
                                <div class="view-all">
                                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="view-all-link">
                                        <?php 
                                        /* translators: %s: category name */
                                        printf( esc_html__( 'More in %s', 'modern-news-portal' ), esc_html( $category->name ) ); 
                                        ?> <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div><!-- .category-section -->
                            <?php
                        endif;
                    endforeach;
                    ?>
                </section>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
