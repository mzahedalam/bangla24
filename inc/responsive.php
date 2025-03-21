<?php
/**
 * Enqueue the responsive CSS file
 */
function modern_news_portal_enqueue_responsive_styles() {
    wp_enqueue_style( 'modern-news-portal-responsive', get_template_directory_uri() . '/css/responsive.css', array('modern-news-portal-style'), MODERN_NEWS_PORTAL_VERSION );
}
add_action( 'wp_enqueue_scripts', 'modern_news_portal_enqueue_responsive_styles' );

/**
 * Add viewport meta tag to head
 */
function modern_news_portal_add_viewport_meta() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
}
add_action( 'wp_head', 'modern_news_portal_add_viewport_meta', 1 );

/**
 * Add responsive image support
 */
function modern_news_portal_responsive_image_settings() {
    add_theme_support( 'responsive-embeds' );
    add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
}
add_action( 'after_setup_theme', 'modern_news_portal_responsive_image_settings' );

/**
 * Add custom body classes for responsive design
 */
function modern_news_portal_responsive_body_classes( $classes ) {
    // Add class for mobile detection via JavaScript
    $classes[] = 'modern-news-responsive';
    
    return $classes;
}
add_filter( 'body_class', 'modern_news_portal_responsive_body_classes' );

/**
 * Modify the excerpt length for different devices
 */
function modern_news_portal_custom_excerpt_length( $length ) {
    // This will be overridden by JavaScript based on screen size
    return 20;
}
add_filter( 'excerpt_length', 'modern_news_portal_custom_excerpt_length' );

/**
 * Add responsive menu script
 */
function modern_news_portal_responsive_menu_script() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Adjust excerpt length based on screen width
        function adjustExcerptLength() {
            const excerpts = document.querySelectorAll('.article-excerpt');
            const windowWidth = window.innerWidth;
            
            excerpts.forEach(function(excerpt) {
                const text = excerpt.getAttribute('data-full-text') || excerpt.textContent;
                
                if (!excerpt.getAttribute('data-full-text')) {
                    excerpt.setAttribute('data-full-text', text);
                }
                
                let length = 20;
                
                if (windowWidth < 576) {
                    length = 10;
                } else if (windowWidth < 768) {
                    length = 15;
                }
                
                const words = text.split(' ');
                if (words.length > length) {
                    excerpt.textContent = words.slice(0, length).join(' ') + '...';
                }
            });
        }
        
        // Handle responsive images
        function handleResponsiveImages() {
            const featuredImages = document.querySelectorAll('.article-image img, .featured-main img, .featured-side-item img');
            const windowWidth = window.innerWidth;
            
            featuredImages.forEach(function(img) {
                if (windowWidth < 576) {
                    img.setAttribute('loading', 'lazy');
                }
            });
        }
        
        // Initialize responsive features
        adjustExcerptLength();
        handleResponsiveImages();
        
        // Update on resize
        window.addEventListener('resize', function() {
            adjustExcerptLength();
        });
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'modern_news_portal_responsive_menu_script' );
