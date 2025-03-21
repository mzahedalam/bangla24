<?php
/**
 * Template part for displaying search results
 *
 * @package Modern_News_Portal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
    <div class="search-item-inner">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="search-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('thumbnail'); ?>
                </a>
            </div>
        <?php endif; ?>
        
        <div class="search-content">
            <header class="entry-header">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                <?php if ( 'post' === get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php echo modern_news_portal_get_category(); ?>
                    <?php echo modern_news_portal_get_date(); ?>
                </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->

            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->

            <footer class="entry-footer">
                <a href="<?php the_permalink(); ?>" class="read-more">
                    <?php esc_html_e( 'Read More', 'modern-news-portal' ); ?> <i class="fas fa-arrow-right"></i>
                </a>
            </footer><!-- .entry-footer -->
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
