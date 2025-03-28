<?php
/**
 * Template part for displaying featured posts
 *
 * @package Bangla24
 */
?>

<?php
$count = $args['count'] ?? 0;

// For a three-column layout, we'll use count 0, 1, and 2
if ($count == 0) : // First featured post
?>
    <div class="featured-column featured-column-first">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'modern-news-portal-featured-medium' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-image.png' ); ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
            <div class="featured-column-content">
                <?php echo modern_news_portal_get_category(); ?>
                <h2 class="featured-column-title"><?php the_title(); ?></h2>
                <div class="featured-column-meta">
                    <?php echo modern_news_portal_get_date(); ?>
                </div>
            </div>
        </a>
    </div>
<?php elseif ($count == 1) : // Second featured post ?>
    <div class="featured-column featured-column-second">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'modern-news-portal-featured-medium' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-image.png' ); ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
            <div class="featured-column-content">
                <?php echo modern_news_portal_get_category(); ?>
                <h2 class="featured-column-title"><?php the_title(); ?></h2>
                <div class="featured-column-meta">
                    <?php echo modern_news_portal_get_date(); ?>
                </div>
            </div>
        </a>
    </div>
<?php else : // Third featured post ?>
    <div class="featured-column featured-column-third">
        <a href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'modern-news-portal-featured-medium' ); ?>
            <?php else : ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-featured-image.png' ); ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
            <div class="featured-column-content">
                <?php echo modern_news_portal_get_category(); ?>
                <h2 class="featured-column-title"><?php the_title(); ?></h2>
                <div class="featured-column-meta">
                    <?php echo modern_news_portal_get_date(); ?>
                </div>
            </div>
        </a>
    </div>
<?php endif; ?>
