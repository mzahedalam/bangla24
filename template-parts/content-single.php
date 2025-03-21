<?php
/**
 * Template part for displaying single article content
 *
 * @package Bangla24
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
    <header class="entry-header">
        <?php echo modern_news_portal_get_category(); ?>
        
        <h1 class="entry-title"><?php the_title(); ?></h1>
        
        <div class="entry-meta">
            <?php echo modern_news_portal_get_author(); ?>
            <?php echo modern_news_portal_get_date(); ?>
            <?php echo modern_news_portal_get_comments_count(); ?>
            <span class="article-views"><i class="far fa-eye"></i> <?php echo get_post_meta(get_the_ID(), 'post_views_count', true) ? get_post_meta(get_the_ID(), 'post_views_count', true) : '0'; ?> <?php esc_html_e('Views', 'modern-news-portal'); ?></span>
        </div>
        
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry-thumbnail">
                <?php the_post_thumbnail('modern-news-portal-featured-large'); ?>
                <?php if ( get_the_post_thumbnail_caption() ) : ?>
                    <div class="thumbnail-caption">
                        <?php the_post_thumbnail_caption(); ?>
                    </div>
                <?php endif; ?>
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
    
    <footer class="entry-footer">
        <?php
        // Display tags
        $tags_list = get_the_tag_list( '<div class="tags-links"><span>' . esc_html__( 'Tags:', 'modern-news-portal' ) . '</span> ', ', ', '</div>' );
        if ( $tags_list ) {
            echo $tags_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        
        // Display share buttons
        ?>
        <div class="share-buttons">
            <span><?php esc_html_e( 'Share:', 'modern-news-portal' ); ?></span>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="nofollow" class="facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" rel="nofollow" class="twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank" rel="nofollow" class="linkedin">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php the_post_thumbnail_url( 'full' ); ?>&description=<?php the_title(); ?>" target="_blank" rel="nofollow" class="pinterest">
                <i class="fab fa-pinterest-p"></i>
            </a>
            <a href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>" class="email">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </footer>
</article>
