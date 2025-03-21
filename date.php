<?php
/**
 * Template for displaying date archives
 *
 * @package Bangla24
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <header class="date-header">
            <h1 class="date-title">
                <?php
                if ( is_day() ) {
                    /* translators: %s: Date */
                    printf( esc_html__( 'Daily Archives: %s', 'modern-news-portal' ), get_the_date() );
                } elseif ( is_month() ) {
                    /* translators: %s: Month and year */
                    printf( esc_html__( 'Monthly Archives: %s', 'modern-news-portal' ), get_the_date( 'F Y' ) );
                } elseif ( is_year() ) {
                    /* translators: %s: Year */
                    printf( esc_html__( 'Yearly Archives: %s', 'modern-news-portal' ), get_the_date( 'Y' ) );
                }
                ?>
            </h1>
            
            <div class="date-meta">
                <span class="date-post-count">
                    <i class="fas fa-calendar-alt"></i>
                    <?php 
                    $post_count = $wp_query->found_posts;
                    printf(
                        /* translators: %s: number of posts */
                        _n( '%s Article', '%s Articles', $post_count, 'modern-news-portal' ),
                        number_format_i18n( $post_count )
                    );
                    ?>
                </span>
            </div>
        </header><!-- .date-header -->

        <div class="content-area">
            <div class="main-content">
                <?php if ( have_posts() ) : ?>
                    <div class="date-filter">
                        <span class="filter-label"><?php esc_html_e( 'Sort by:', 'modern-news-portal' ); ?></span>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'date', get_permalink() ) ); ?>" class="filter-option <?php echo ( ! isset( $_GET['orderby'] ) || $_GET['orderby'] == 'date' ) ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Latest', 'modern-news-portal' ); ?>
                        </a>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'comment_count', get_permalink() ) ); ?>" class="filter-option <?php echo ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'comment_count' ) ? 'active' : ''; ?>">
                            <?php esc_html_e( 'Most Discussed', 'modern-news-portal' ); ?>
                        </a>
                        <a href="<?php echo esc_url( add_query_arg( 'orderby', 'views', get_permalink() ) ); ?>" class="filter-option <?php echo ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'views' ) ? 'active' : ''; ?>">
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
