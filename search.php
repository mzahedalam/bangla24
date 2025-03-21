<?php
/**
 * The template for displaying search results pages
 *
 * @package Bangla24
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'modern-news-portal' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </h1>
        </header><!-- .page-header -->

        <div class="content-area">
            <div class="main-content">
                <?php if ( have_posts() ) : ?>
                    <div class="article-grid">
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) :
                            the_post();
                            ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'article-item' ); ?>>
                                <div class="article-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'modern-news-portal-featured-medium' ); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-medium.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                
                                <?php echo modern_news_portal_get_category(); ?>
                                
                                <h2 class="article-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="article-meta">
                                    <?php echo modern_news_portal_get_author(); ?>
                                    <?php echo modern_news_portal_get_date(); ?>
                                </div>
                                
                                <div class="article-excerpt">
                                    <?php echo modern_news_portal_get_excerpt( 20 ); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php esc_html_e( 'Read More', 'modern-news-portal' ); ?> <i class="fas fa-arrow-right"></i>
                                </a>
                            </article>
                            <?php
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
                    ?>
                    <div class="no-results">
                        <h2><?php esc_html_e( 'Nothing Found', 'modern-news-portal' ); ?></h2>
                        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'modern-news-portal' ); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                    <?php
                endif;
                ?>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
