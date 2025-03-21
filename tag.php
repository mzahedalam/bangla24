<?php
/**
 * Template for displaying tag archives
 *
 * @package Bangla24
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="tag-header">
            <?php
            the_archive_title( '<h1 class="tag-title">', '</h1>' );
            the_archive_description( '<div class="tag-description">', '</div>' );
            ?>
            
            <?php if ( is_tag() ) : ?>
                <div class="tag-meta">
                    <span class="tag-post-count">
                        <i class="fas fa-tag"></i>
                        <?php 
                        printf(
                            /* translators: %s: number of posts */
                            _n( '%s Article', '%s Articles', get_queried_object()->count, 'modern-news-portal' ),
                            number_format_i18n( get_queried_object()->count )
                        );
                        ?>
                    </span>
                </div>
            <?php endif; ?>
        </header><!-- .tag-header -->

        <div class="content-area">
            <div class="main-content">
                <?php if ( have_posts() ) : ?>
                    <div class="tag-filter">
                        <span class="filter-label"><?php esc_html_e( 'Sort by:', 'modern-news-portal' ); ?></span>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'date', get_tag_link( get_queried_object_id() ) ) ); ?>" class="filter-option <?php echo ( ! isset( $_GET['orderby'] ) || $_GET['orderby'] == 'date' ) ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Latest', 'modern-news-portal' ); ?>
                        </a>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'comment_count', get_tag_link( get_queried_object_id() ) ) ); ?>" class="filter-option <?php echo ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'comment_count' ) ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Most Discussed', 'modern-news-portal' ); ?>
                        </a>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'views', get_tag_link( get_queried_object_id() ) ) ); ?>" class="filter-option <?php echo ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'views' ) ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Most Viewed', 'modern-news-portal' ); ?>
                        </a>
                    </div>
                    
                    <div class="article-grid">
                        <?php
                        /* Start the Loop */
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
