<?php
/**
 * Performance optimization functions for BANGLA24 theme
 *
 * @package Bangla24
 */

/**
 * Optimize CSS delivery
 */
function modern_news_portal_optimize_css() {
    // Remove unnecessary WordPress CSS
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS if not using WooCommerce
    
    // Preload fonts
    add_action('wp_head', function() {
        echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" as="style">';
    }, 1);
    
    // Add critical CSS inline
    add_action('wp_head', 'modern_news_portal_add_critical_css', 1);
}
add_action('wp_enqueue_scripts', 'modern_news_portal_optimize_css', 100);

/**
 * Add critical CSS inline
 */
function modern_news_portal_add_critical_css() {
    ?>
    <style id="critical-css">
        /* Critical CSS for above-the-fold content */
        body{font-family:'Roboto',Arial,sans-serif;font-size:16px;line-height:1.6;color:#333;background-color:#f8f8f8;margin:0}
        .container{width:100%;max-width:1200px;margin:0 auto;padding:0 15px}
        .site-header{background-color:#fff;box-shadow:0 2px 5px rgba(0,0,0,.1);position:relative;z-index:100}
        .site-branding{display:flex;align-items:center}
        .site-title{font-size:28px;font-weight:700;margin:0}
        .site-description{font-size:14px;color:#666;margin:5px 0 0}
        .main-navigation{background-color:#1e73be}
        .main-menu{display:flex;list-style:none;margin:0;padding:0}
        .main-menu a{display:block;padding:15px 20px;color:#fff;font-weight:500;text-decoration:none}
        .breaking-news{background-color:#f5f5f5;padding:10px 0;border-bottom:1px solid #eee}
        .featured-section{padding:30px 0}
        @media (max-width:768px){.main-menu{display:none}.menu-toggle{display:block}}
    </style>
    <?php
}

/**
 * Optimize JavaScript delivery
 */
function modern_news_portal_optimize_js() {
    // Move jQuery to footer
    if (!is_admin()) {
        wp_scripts()->add_data('jquery', 'group', 1);
        wp_scripts()->add_data('jquery-core', 'group', 1);
        wp_scripts()->add_data('jquery-migrate', 'group', 1);
    }
    
    // Add defer to non-critical scripts
    add_filter('script_loader_tag', 'modern_news_portal_defer_scripts', 10, 3);
}
add_action('wp_enqueue_scripts', 'modern_news_portal_optimize_js');

/**
 * Add defer attribute to scripts
 */
function modern_news_portal_defer_scripts($tag, $handle, $src) {
    // List of scripts to defer
    $defer_scripts = array(
        'modern-news-portal-main',
        'modern-news-portal-ticker',
        'modern-news-portal-responsive'
    );
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}

/**
 * Optimize images
 */
function modern_news_portal_optimize_images() {
    // Add image sizes optimized for different devices
    add_image_size('modern-news-portal-featured-large', 1200, 675, true);
    add_image_size('modern-news-portal-featured-medium', 600, 400, true);
    add_image_size('modern-news-portal-featured-small', 300, 200, true);
    
    // Add support for WebP
    add_filter('upload_mimes', 'modern_news_portal_add_webp_mime');
}
add_action('after_setup_theme', 'modern_news_portal_optimize_images');

/**
 * Add WebP to allowed mime types
 */
function modern_news_portal_add_webp_mime($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}

/**
 * Add browser caching headers
 */
function modern_news_portal_add_caching_headers() {
    if (!is_admin()) {
        // Check if .htaccess exists and is writable
        $htaccess_file = get_home_path() . '.htaccess';
        if (file_exists($htaccess_file) && is_writable($htaccess_file)) {
            $htaccess_content = file_get_contents($htaccess_file);
            
            // Add browser caching rules if not already present
            if (strpos($htaccess_content, '# BEGIN Browser Caching') === false) {
                $caching_rules = "
# BEGIN Browser Caching
<IfModule mod_expires.c>
ExpiresActive On
ExpiresByType image/jpg \"access plus 1 year\"
ExpiresByType image/jpeg \"access plus 1 year\"
ExpiresByType image/gif \"access plus 1 year\"
ExpiresByType image/png \"access plus 1 year\"
ExpiresByType image/webp \"access plus 1 year\"
ExpiresByType text/css \"access plus 1 month\"
ExpiresByType application/pdf \"access plus 1 month\"
ExpiresByType text/javascript \"access plus 1 month\"
ExpiresByType application/javascript \"access plus 1 month\"
ExpiresByType application/x-javascript \"access plus 1 month\"
ExpiresByType application/x-shockwave-flash \"access plus 1 month\"
ExpiresByType image/x-icon \"access plus 1 year\"
ExpiresDefault \"access plus 2 days\"
</IfModule>
# END Browser Caching
";
                file_put_contents($htaccess_file, $htaccess_content . $caching_rules);
            }
        }
    }
}
add_action('admin_init', 'modern_news_portal_add_caching_headers');

/**
 * Optimize database queries
 */
function modern_news_portal_optimize_queries() {
    // Disable post revisions
    if (!defined('WP_POST_REVISIONS')) {
        define('WP_POST_REVISIONS', 3);
    }
    
    // Disable Heartbeat API on non-admin pages
    add_action('init', function() {
        if (!is_admin()) {
            wp_deregister_script('heartbeat');
        }
    });
    
    // Limit number of posts in RSS feed
    add_filter('pre_get_posts', function($query) {
        if ($query->is_feed) {
            $query->set('posts_per_rss', 10);
        }
        return $query;
    });
}
add_action('after_setup_theme', 'modern_news_portal_optimize_queries');

/**
 * Remove query strings from static resources
 */
function modern_news_portal_remove_query_strings() {
    if (!is_admin()) {
        add_filter('script_loader_src', 'modern_news_portal_remove_query_strings_split', 15);
        add_filter('style_loader_src', 'modern_news_portal_remove_query_strings_split', 15);
    }
}
add_action('init', 'modern_news_portal_remove_query_strings');

/**
 * Helper function to remove query strings
 */
function modern_news_portal_remove_query_strings_split($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}

/**
 * Disable emojis for better performance
 */
function modern_news_portal_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // Remove emoji CDN hostname from DNS prefetching hints
    add_filter('wp_resource_hints', function($urls, $relation_type) {
        if ('dns-prefetch' === $relation_type) {
            $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/');
            $urls = array_diff($urls, array($emoji_svg_url));
        }
        return $urls;
    }, 10, 2);
}
add_action('init', 'modern_news_portal_disable_emojis');

/**
 * Add preconnect for external resources
 */
function modern_news_portal_resource_hints($hints, $relation_type) {
    if ('preconnect' === $relation_type) {
        // Add preconnect for Google Fonts
        $hints[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $hints[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
        
        // Add preconnect for Font Awesome
        $hints[] = array(
            'href' => 'https://cdnjs.cloudflare.com',
            'crossorigin' => 'anonymous',
        );
    }
    
    return $hints;
}
add_filter('wp_resource_hints', 'modern_news_portal_resource_hints', 10, 2);

/**
 * Lazy load images
 */
function modern_news_portal_lazy_load_images($content) {
    if (is_admin() || is_feed()) {
        return $content;
    }
    
    // Replace image tags with lazy loading
    $content = preg_replace_callback('/<img([^>]+)>/i', function($matches) {
        // Skip if already has loading attribute
        if (strpos($matches[1], 'loading=') !== false) {
            return $matches[0];
        }
        
        // Add loading="lazy" attribute
        $replacement = '<img' . $matches[1] . ' loading="lazy">';
        return $replacement;
    }, $content);
    
    return $content;
}
add_filter('the_content', 'modern_news_portal_lazy_load_images', 99);
add_filter('post_thumbnail_html', 'modern_news_portal_lazy_load_images', 99);
add_filter('get_avatar', 'modern_news_portal_lazy_load_images', 99);
