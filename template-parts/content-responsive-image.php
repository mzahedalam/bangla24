<?php
/**
 * Template part for displaying responsive images
 *
 * @package Bangla24
 */
?>

<picture>
    <!-- Small mobile screens -->
    <source media="(max-width: 576px)" 
            srcset="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'modern-news-portal-featured-small' ) ); ?>">
    
    <!-- Mobile screens -->
    <source media="(max-width: 768px)" 
            srcset="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'modern-news-portal-featured-medium' ) ); ?>">
    
    <!-- Default image -->
    <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'modern-news-portal-featured-large' ) ); ?>" 
         alt="<?php the_title_attribute(); ?>" 
         class="responsive-image"
         <?php if ( wp_is_mobile() ) echo 'loading="lazy"'; ?>>
</picture>
