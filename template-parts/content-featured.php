<?php
/**
 * Template part for displaying featured posts
 *
 * @package Bangla24
 */
?>

<?php
$count = $args['count'] ?? 0;

if ($count == 0) : // Main featured post
?>
    <div class="featured-main">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'modern-news-portal-featured-large' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-image.png' ); ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
            <div class="featured-main-content">
                <?php echo modern_news_portal_get_category(); ?>
                <h2 class="featured-main-title"><?php the_title(); ?></h2>
                <div class="featured-main-meta">
                    
                    <?php echo modern_news_portal_get_date(); ?>
                </div>
            </div>
        </a>
    </div>
<?php else : // Side featured posts ?>
    <div class="featured-side-item">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'modern-news-portal-featured-medium' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-medium.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
            <div class="featured-side-content">
                <?php echo modern_news_portal_get_category(); ?>
                <h3 class="featured-side-title"><?php the_title(); ?></h3>
                <div class="featured-side-meta">
                    <?php echo modern_news_portal_get_date(); ?>
                </div>
            </div>
        </a>
    </div>
<?php endif; ?>
