<?php
/**
 * Template part for displaying posts in the article grid
 *
 * @package Bangla24
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article-item' ); ?>>
    <div class="article-image">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'modern-news-portal-featured-medium' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-image.png' ); ?>" alt="<?php the_title_attribute(); ?>">
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

</div>
</article>
