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

    <div class="article-share">
    <?php
    $share_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : '';
    $share_title = get_the_title();
    $share_url = get_permalink();
    ?>
    <div class="share-buttons">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($share_url); ?>&picture=<?php echo urlencode($share_image); ?>" 
           target="_blank" 
           rel="nofollow noopener" 
           class="facebook">
            <i class="fab fa-facebook-f"></i>
        </a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($share_url); ?>&text=<?php echo urlencode($share_title); ?>" 
           target="_blank" 
           rel="nofollow noopener" 
           class="twitter">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($share_title . ' - ' . $share_url); ?>" 
           target="_blank" 
           rel="nofollow noopener" 
           class="whatsapp">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>
</div>
</article>
