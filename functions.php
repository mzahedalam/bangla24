<?php
/**
 * BANGLA24 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bangla24
 */

if ( ! defined( 'MODERN_NEWS_PORTAL_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'MODERN_NEWS_PORTAL_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function modern_news_portal_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'modern-news-portal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// Set default thumbnail size
	set_post_thumbnail_size( 1200, 675, true );

	// Add custom image sizes
	add_image_size( 'modern-news-portal-featured-large', 1200, 675, true );
	add_image_size( 'modern-news-portal-featured-medium', 600, 400, true );
	add_image_size( 'modern-news-portal-featured-small', 300, 200, true );

	// This theme uses wp_nav_menu() in multiple locations.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'modern-news-portal' ),
			'top-menu' => esc_html__( 'Top Menu', 'modern-news-portal' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'modern-news-portal' ),
			'social-menu' => esc_html__( 'Social Menu', 'modern-news-portal' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'modern_news_portal_custom_background_args',
			array(
				'default-color' => 'f8f8f8',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for custom color scheme.
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => esc_html__( 'Primary', 'modern-news-portal' ),
			'slug'  => 'primary',
			'color' => '#1e73be',
		),
		array(
			'name'  => esc_html__( 'Secondary', 'modern-news-portal' ),
			'slug'  => 'secondary',
			'color' => '#e53935',
		),
		array(
			'name'  => esc_html__( 'Dark', 'modern-news-portal' ),
			'slug'  => 'dark',
			'color' => '#333333',
		),
		array(
			'name'  => esc_html__( 'Light', 'modern-news-portal' ),
			'slug'  => 'light',
			'color' => '#f8f8f8',
		),
	) );
}
add_action( 'after_setup_theme', 'modern_news_portal_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function modern_news_portal_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'modern_news_portal_content_width', 1200 );
}
add_action( 'after_setup_theme', 'modern_news_portal_content_width', 0 );

/**
 * Register widget area.
 */

/**
 * Enqueue scripts and styles.
 */
function modern_news_portal_scripts() {
	// Enqueue Google Fonts
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap', array(), null );
	
	// Enqueue Font Awesome
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4' );
	
	// Main stylesheet (includes processed Tailwind CSS and custom styles)
	wp_enqueue_style( 'modern-news-portal-style', get_stylesheet_uri(), array(), MODERN_NEWS_PORTAL_VERSION );
	
	// Custom CSS
	wp_enqueue_style( 'modern-news-portal-custom', get_template_directory_uri() . '/css/custom.css', array(), MODERN_NEWS_PORTAL_VERSION );
	
	// Navigation script
	wp_enqueue_script( 'modern-news-portal-navigation', get_template_directory_uri() . '/js/navigation.js', array(), MODERN_NEWS_PORTAL_VERSION, true );
	
	// Ticker script
	wp_enqueue_script( 'modern-news-portal-ticker', get_template_directory_uri() . '/js/ticker.js', array('jquery'), MODERN_NEWS_PORTAL_VERSION, true );
	
	// Main script
	wp_enqueue_script( 'modern-news-portal-main', get_template_directory_uri() . '/js/main.js', array('jquery'), MODERN_NEWS_PORTAL_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'modern_news_portal_scripts' );



/**
 * Custom widgets for this theme.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Get the category of the post.
 */
function modern_news_portal_get_category() {
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		return '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="article-category">' . esc_html( $categories[0]->name ) . '</a>';
	}
	return '';
}

/**
 * Get the post author with avatar.
 */
function modern_news_portal_get_author() {
	$author_id = get_the_author_meta( 'ID' );
	$author_avatar = get_avatar( $author_id, 20 );
	$author_name = get_the_author_meta( 'display_name' );
	
	return '<span class="article-author">' . $author_avatar . ' ' . esc_html( $author_name ) . '</span>';
}

/**
 * Get the post date.
 */
function modern_news_portal_get_date() {
	return '<span class="article-date"><i class="far fa-clock"></i> ' . esc_html( get_the_date() ) . '</span>';
}

/**
 * Get the post comments count.
 */
function modern_news_portal_get_comments_count() {
	$comments_count = get_comments_number();
	if ( $comments_count == 0 ) {
		$comments_text = esc_html__( 'No Comments', 'modern-news-portal' );
	} elseif ( $comments_count == 1 ) {
		$comments_text = esc_html__( '1 Comment', 'modern-news-portal' );
	} else {
		$comments_text = sprintf( esc_html__( '%d Comments', 'modern-news-portal' ), $comments_count );
	}
	
	return '<span class="article-comments"><i class="far fa-comment"></i> ' . $comments_text . '</span>';
}

/**
 * Get the post excerpt with custom length.
 */
function modern_news_portal_get_excerpt( $length = 20 ) {
	$excerpt = get_the_excerpt();
	$excerpt = wp_trim_words( $excerpt, $length, '...' );
	return $excerpt;
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Get the breaking news posts.
 */
function modern_news_portal_get_breaking_news( $count = 5 ) {
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $count,
		'meta_key'       => '_breaking_news',
		'meta_value'     => 'yes',
	);
	
	$breaking_news = new WP_Query( $args );
	
	if ( ! $breaking_news->have_posts() ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
		);
		$breaking_news = new WP_Query( $args );
	}
	
	return $breaking_news;
}

/**
 * Get the featured posts.
 */
function modern_news_portal_get_featured_posts( $count = 3 ) {
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $count,
		'meta_key'       => '_featured_post',
		'meta_value'     => 'yes',
	);
	
	$featured_posts = new WP_Query( $args );
	
	if ( ! $featured_posts->have_posts() ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
		);
		$featured_posts = new WP_Query( $args );
	}
	
	return $featured_posts;
}

/**
 * Get the popular posts.
 */
function modern_news_portal_get_popular_posts( $count = 5 ) {
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $count,
		'meta_key'       => 'post_views_count',
		'orderby'        => 'meta_value_num',
		'order'          => 'DESC',
	);
	
	$popular_posts = new WP_Query( $args );
	
	if ( ! $popular_posts->have_posts() ) {
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $count,
			'orderby'        => 'comment_count',
			'order'          => 'DESC',
		);
		$popular_posts = new WP_Query( $args );
	}
	
	return $popular_posts;
}


/**
 * Add post view count.
 */
// Remove the modern_news_portal_set_post_views() function from here
// It's now in template-functions.php

/**
 * Add meta boxes for breaking news and featured posts.
 */
function modern_news_portal_add_meta_boxes() {
	add_meta_box(
		'modern_news_portal_post_options',
		esc_html__( 'Post Options', 'modern-news-portal' ),
		'modern_news_portal_post_options_callback',
		'post',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'modern_news_portal_add_meta_boxes' );

/**
 * Meta box callback function.
 */
function modern_news_portal_post_options_callback( $post ) {
	wp_nonce_field( 'modern_news_portal_post_options', 'modern_news_portal_post_options_nonce' );
	
	$breaking_news = get_post_meta( $post->ID, '_breaking_news', true );
	$featured_post = get_post_meta( $post->ID, '_featured_post', true );
	
	?>
	<p>
		<label for="breaking_news">
			<input type="checkbox" id="breaking_news" name="breaking_news" value="yes" <?php checked( $breaking_news, 'yes' ); ?> />
			<?php esc_html_e( 'Mark as Breaking News', 'modern-news-portal' ); ?>
		</label>
	</p>
	<p>
		<label for="featured_post">
			<input type="checkbox" id="featured_post" name="featured_post" value="yes" <?php checked( $featured_post, 'yes' ); ?> />
			<?php esc_html_e( 'Mark as Featured Post', 'modern-news-portal' ); ?>
		</label>
	</p>
	<?php
}

/**
 * Save meta box data.
 */
function modern_news_portal_save_post_options( $post_id ) {
	if ( ! isset( $_POST['modern_news_portal_post_options_nonce'] ) ) {
		return;
	}
	
	if ( ! wp_verify_nonce( $_POST['modern_news_portal_post_options_nonce'], 'modern_news_portal_post_options' ) ) {
		return;
	}
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	$breaking_news = isset( $_POST['breaking_news'] ) ? 'yes' : 'no';
	$featured_post = isset( $_POST['featured_post'] ) ? 'yes' : 'no';
	
	update_post_meta( $post_id, '_breaking_news', $breaking_news );
	update_post_meta( $post_id, '_featured_post', $featured_post );
}
add_action( 'save_post', 'modern_news_portal_save_post_options' );

// Add this to functions.php to include performance.php
require get_template_directory() . '/inc/performance.php';


// Add this to functions.php to include responsive.php
require get_template_directory() . '/inc/responsive.php';

// Add this to wp_enqueue_scripts action in functions.php
function modern_news_portal_enqueue_responsive_scripts() {
    wp_enqueue_script( 'modern-news-portal-responsive', get_template_directory_uri() . '/js/responsive.js', array('jquery'), MODERN_NEWS_PORTAL_VERSION, true );

	// Enqueue Font Awesome 6 from CDN
    wp_enqueue_style(
        'font-awesome-6',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css',
        array(),
        '6.4.2'
    );

	// Enqueue Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap',
        array(),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'modern_news_portal_enqueue_responsive_scripts' );



