<?php
/**
 * The template for displaying all single posts
 *
 * @package Bangla24
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <div class="main-content">
                <?php
                while ( have_posts() ) :
                    the_post();
                    
                    get_template_part( 'template-parts/content', 'single' );
                    
                    // Author bio
                    ?>
                    <div class="author-bio">
                        <div class="author-avatar">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
                        </div>
                        <div class="author-info">
                            <h3 class="author-name"><?php the_author(); ?></h3>
                            <?php if ( get_the_author_meta( 'description' ) ) : ?>
                                <div class="author-description">
                                    <?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="author-links">
                                <?php if ( get_the_author_meta( 'url' ) ) : ?>
                                    <a href="<?php echo esc_url( get_the_author_meta( 'url' ) ); ?>" target="_blank" class="author-website">
                                        <i class="fas fa-globe"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'twitter' ) ) : ?>
                                    <a href="<?php echo esc_url( 'https://twitter.com/' . get_the_author_meta( 'twitter' ) ); ?>" target="_blank" class="author-twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'facebook' ) ) : ?>
                                    <a href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>" target="_blank" class="author-facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ( get_the_author_meta( 'linkedin' ) ) : ?>
                                    <a href="<?php echo esc_url( get_the_author_meta( 'linkedin' ) ); ?>" target="_blank" class="author-linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="related-posts">
                        <h3 class="related-posts-title"><?php esc_html_e( 'RELATED P', 'modern-news-portal' ); ?></h3>
                        <div class="related-posts-grid">
                            <?php
                            // Get current post categories
                            $categories = get_the_category();
                            if ( $categories ) {
                                $category_ids = array();
                                foreach ( $categories as $category ) {
                                    $category_ids[] = $category->term_id;
                                }
                                
                                // Query related posts
                                $related_args = array(
                                    'post_type'      => 'post',
                                    'posts_per_page' => 3,
                                    'post__not_in'   => array( get_the_ID() ),
                                    'category__in'   => $category_ids,
                                );
                                
                                $related_query = new WP_Query( $related_args );
                                
                                if ( $related_query->have_posts() ) :
                                    while ( $related_query->have_posts() ) :
                                        $related_query->the_post();
                                        ?>
                                        <div class="related-post-item">
                                            <div class="related-post-image">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php if ( has_post_thumbnail() ) : ?>
                                                        <?php the_post_thumbnail( 'modern-news-portal-featured-small' ); ?>
                                                    <?php else : ?>
                                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-small.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <h4 class="related-post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                            <div class="related-post-meta">
                                                <?php echo modern_news_portal_get_date(); ?>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                else :
                                    esc_html_e( 'No related posts found.', 'modern-news-portal' );
                                endif;
                            }
                            ?>
                        </div>
                    </div>
                    
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    
                endwhile; // End of the loop.
                ?>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
