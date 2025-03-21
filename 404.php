<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Bangla24
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'modern-news-portal' ); ?></h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'modern-news-portal' ); ?></p>

                <?php get_search_form(); ?>

                <div class="error-404-widgets">
                    <div class="widget">
                        <h2 class="widget-title"><?php esc_html_e( 'Recent Posts', 'modern-news-portal' ); ?></h2>
                        <ul>
                            <?php
                            $recent_posts = wp_get_recent_posts( array(
                                'numberposts' => 5,
                                'post_status' => 'publish',
                            ) );
                            
                            foreach ( $recent_posts as $post ) {
                                echo '<li><a href="' . esc_url( get_permalink( $post['ID'] ) ) . '">' . esc_html( $post['post_title'] ) . '</a></li>';
                            }
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>

                    <div class="widget">
                        <h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'modern-news-portal' ); ?></h2>
                        <ul>
                            <?php
                            wp_list_categories( array(
                                'orderby'    => 'count',
                                'order'      => 'DESC',
                                'show_count' => 1,
                                'title_li'   => '',
                                'number'     => 5,
                            ) );
                            ?>
                        </ul>
                    </div>
                </div>
            </div><!-- .page-content -->
        </div><!-- .error-404 -->
    </div>
</main><!-- #main -->

<?php
get_footer();
