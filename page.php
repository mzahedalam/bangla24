<?php
/**
 * The template for displaying all pages
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
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="entry-thumbnail">
                                    <?php the_post_thumbnail('modern-news-portal-featured-large'); ?>
                                </div>
                            <?php endif; ?>
                        </header>
                        
                        <div class="entry-content">
                            <?php the_content(); ?>
                            
                            <?php
                            wp_link_pages(
                                array(
                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'modern-news-portal' ),
                                    'after'  => '</div>',
                                )
                            );
                            ?>
                        </div>
                    </article>
                    
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
