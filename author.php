<?php
/**
 * Template for displaying author archives
 *
 * @package Bangla24
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="author-header">
            <?php
            $author_id = get_queried_object_id();
            ?>
            <div class="author-bio">
                <div class="author-avatar">
                    <?php echo get_avatar( $author_id, 120 ); ?>
                </div>
                <div class="author-info">
                    <h1 class="author-title"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></h1>
                    
                    <?php if ( get_the_author_meta( 'description', $author_id ) ) : ?>
                        <div class="author-description">
                            <?php echo wpautop( get_the_author_meta( 'description', $author_id ) ); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="author-meta">
                        <span class="author-post-count">
                            <i class="fas fa-newspaper"></i>
                            <?php 
                            $author_post_count = count_user_posts( $author_id );
                            printf(
                                /* translators: %s: number of posts */
                                _n( '%s Article', '%s Articles', $author_post_count, 'modern-news-portal' ),
                                number_format_i18n( $author_post_count )
                            );
                            ?>
                        </span>
                    </div>
                    
                    <div class="author-links">
                        <?php if ( get_the_author_meta( 'url', $author_id ) ) : ?>
                            <a href="<?php echo esc_url( get_the_author_meta( 'url', $author_id ) ); ?>" target="_blank" class="author-website">
                                <i class="fas fa-globe"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( get_the_author_meta( 'twitter', $author_id ) ) : ?>
                            <a href="<?php echo esc_url( 'https://twitter.com/' . get_the_author_meta( 'twitter', $author_id ) ); ?>" target="_blank" class="author-twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( get_the_author_meta( 'facebook', $author_id ) ) : ?>
                            <a href="<?php echo esc_url( get_the_author_meta( 'facebook', $author_id ) ); ?>" target="_blank" class="author-facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>
                        <?php if ( get_the_author_meta( 'linkedin', $author_id ) ) : ?>
                            <a href="<?php echo esc_url( get_the_author_meta( 'linkedin', $author_id ) ); ?>" target="_blank" class="author-linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header><!-- .author-header -->

        <div class="content-area">
            <div class="main-content">
                <?php if ( have_posts() ) : ?>
                    <div class="author-filter">
                        <span class="filter-label"><?php esc_html_e( 'Sort by:', 'modern-news-portal' ); ?></span>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'date', get_author_posts_url( $author_id ) ) ); ?>" class="filter-option <?php echo ( ! isset( $_GET['orderby'] ) || $_GET['orderby'] == 'date' ) ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Latest', 'modern-news-portal' ); ?>
                        </a>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'comment_count', get_author_posts_url( $author_id ) ) ); ?>" class="filter-option <?php echo ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'comment_count' ) ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Most Discussed', 'modern-news-portal' ); ?>
                        </a>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'views', get_author_posts_url( $author_id ) ) ); ?>" class="filter-option <?php echo ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'views' ) ? 'active' : ''; ?>">
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
