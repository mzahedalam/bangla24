<?php
/**
 * Template functions for this theme
 *
 * @package Modern_News_Portal
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function modern_news_portal_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	
	// Add class if dark mode is active
	if ( isset( $_COOKIE['modern_news_portal_dark_mode'] ) && $_COOKIE['modern_news_portal_dark_mode'] === 'true' ) {
		$classes[] = 'dark-mode';
	}

	return $classes;
}
add_filter( 'body_class', 'modern_news_portal_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function modern_news_portal_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'modern_news_portal_pingback_header' );

/**
 * Get breaking news posts
 */

/**
 * Functions which enhance the theme by hooking into WordPress.
 */

if (!function_exists('modern_news_portal_get_breaking_news')) :
    function modern_news_portal_get_breaking_news($count = 5) {
        $args = array(
            'post_type'           => 'post',
            'posts_per_page'      => $count,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'orderby'             => 'date',
            'order'               => 'DESC',
        );
        
        // Check if there's a breaking news category set in theme options
        $breaking_category = get_theme_mod( 'modern_news_portal_breaking_category' );
        if ( $breaking_category ) {
            $args['cat'] = absint( $breaking_category );
        }
        
        return new WP_Query( $args );
    }
endif;

if (!function_exists('modern_news_portal_get_featured_posts')) :
    function modern_news_portal_get_featured_posts($count = 3) {
        $args = array(
            'post_type'           => 'post',
            'posts_per_page'      => $count,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'orderby'             => 'comment_count',
            'order'               => 'DESC',
        );
        
        return new WP_Query( $args );
    }
endif;

if (!function_exists('modern_news_portal_get_popular_posts')) :
    function modern_news_portal_get_popular_posts($count = 5) {
        $args = array(
            'post_type'           => 'post',
            'posts_per_page'      => $count,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'orderby'             => 'comment_count',
            'order'               => 'DESC',
        );
        
        return new WP_Query( $args );
    }
endif;

/**
 * Get related posts based on categories
 */
function modern_news_portal_get_related_posts( $post_id, $count = 3 ) {
	$categories = get_the_category( $post_id );
	
	if ( $categories ) {
		$category_ids = array();
		foreach ( $categories as $category ) {
			$category_ids[] = $category->term_id;
		}
		
		$args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $count,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'post__not_in'        => array( $post_id ),
			'category__in'        => $category_ids,
		);
		
		return new WP_Query( $args );
	}
	
	return new WP_Query();
}

/**
 * Get social share links
 */
function modern_news_portal_get_social_share() {
	$share_url = urlencode( get_permalink() );
	$share_title = urlencode( get_the_title() );
	
	$facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $share_url;
	$twitter_url = 'https://twitter.com/intent/tweet?url=' . $share_url . '&text=' . $share_title;
	$linkedin_url = 'https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url . '&title=' . $share_title;
	$pinterest_url = 'https://pinterest.com/pin/create/button/?url=' . $share_url . '&description=' . $share_title;
	
	$output = '<div class="social-share">';
	$output .= '<span class="share-label">' . esc_html__( 'Share:', 'modern-news-portal' ) . '</span>';
	$output .= '<a href="' . esc_url( $facebook_url ) . '" target="_blank" class="facebook-share"><i class="fab fa-facebook-f"></i></a>';
	$output .= '<a href="' . esc_url( $twitter_url ) . '" target="_blank" class="twitter-share"><i class="fab fa-twitter"></i></a>';
	$output .= '<a href="' . esc_url( $linkedin_url ) . '" target="_blank" class="linkedin-share"><i class="fab fa-linkedin-in"></i></a>';
	$output .= '<a href="' . esc_url( $pinterest_url ) . '" target="_blank" class="pinterest-share"><i class="fab fa-pinterest-p"></i></a>';
	$output .= '</div>';
	
	return $output;
}

/**
 * Get reading time
 */
function modern_news_portal_get_reading_time() {
	$content = get_post_field( 'post_content', get_the_ID() );
	$word_count = str_word_count( strip_tags( $content ) );
	$reading_time = ceil( $word_count / 200 ); // Assuming 200 words per minute reading speed
	
	if ( $reading_time < 1 ) {
		$reading_time = 1;
	}
	
	/* translators: %d: Reading time in minutes */
	$reading_time_text = sprintf( _n( '%d min read', '%d min read', $reading_time, 'modern-news-portal' ), $reading_time );
	
	return '<span class="reading-time"><i class="far fa-clock"></i> ' . $reading_time_text . '</span>';
}

/**
 * Get post views
 */
function modern_news_portal_get_post_views() {
	$count = get_post_meta( get_the_ID(), 'post_views_count', true );
	
	if ( $count == '' ) {
		$count = 0;
	}
	
	/* translators: %s: Number of views */
	$views_text = sprintf( _n( '%s view', '%s views', $count, 'modern-news-portal' ), number_format_i18n( $count ) );
	
	return '<span class="post-views"><i class="far fa-eye"></i> ' . $views_text . '</span>';
}

if (!function_exists('modern_news_portal_set_post_views')) :
    /**
     * Set post views
     */
    function modern_news_portal_set_post_views() {
        if (!is_single()) {
            return;
        }
        
        $post_id = get_the_ID();
        $count = get_post_meta($post_id, 'post_views_count', true);
        
        if ($count == '') {
            $count = 0;
            delete_post_meta($post_id, 'post_views_count');
            add_post_meta($post_id, 'post_views_count', '1');
        } else {
            $count++;
            update_post_meta($post_id, 'post_views_count', $count);
        }
    }
endif;
add_action('wp', 'modern_news_portal_set_post_views');

/**
 * Add dark mode toggle script
 */
function modern_news_portal_dark_mode_script() {
	?>
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const darkModeToggle = document.querySelector('.dark-mode-toggle');
		const body = document.body;
		
		if (darkModeToggle) {
			// Check for saved dark mode preference
			const darkMode = localStorage.getItem('darkMode') === 'true';
			
			// Apply dark mode if saved preference exists
			if (darkMode) {
				body.classList.add('dark-mode');
				darkModeToggle.classList.add('active');
				document.cookie = 'modern_news_portal_dark_mode=true; path=/; max-age=31536000'; // 1 year
			}
			
			// Toggle dark mode on click
			darkModeToggle.addEventListener('click', function() {
				body.classList.toggle('dark-mode');
				darkModeToggle.classList.toggle('active');
				
				const isDarkMode = body.classList.contains('dark-mode');
				localStorage.setItem('darkMode', isDarkMode);
				document.cookie = 'modern_news_portal_dark_mode=' + isDarkMode + '; path=/; max-age=31536000'; // 1 year
			});
		}
	});
	</script>
	<?php
}
add_action( 'wp_footer', 'modern_news_portal_dark_mode_script' );
