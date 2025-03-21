<?php
/**
 * Functions to update functions.php to include responsive functionality
 */

// Add this to functions.php to include responsive.php
require get_template_directory() . '/inc/responsive.php';

// Add this to wp_enqueue_scripts action in functions.php
function modern_news_portal_enqueue_responsive_scripts() {
    wp_enqueue_script( 'modern-news-portal-responsive', get_template_directory_uri() . '/js/responsive.js', array('jquery'), MODERN_NEWS_PORTAL_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'modern_news_portal_enqueue_responsive_scripts' );
