<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Modern_News_Portal
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function modern_news_portal_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'main',
			'render'    => 'modern_news_portal_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options',
		array(
			'post-details' => array(
				'stylesheet' => 'modern-news-portal-style',
				'date'       => '.posted-on',
				'categories' => '.cat-links',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive' => true,
				'post'    => true,
				'page'    => true,
			),
		)
	);
}
add_action( 'after_setup_theme', 'modern_news_portal_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function modern_news_portal_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_type() );
		endif;
	}
}

/**
 * Enqueue Jetpack-specific styles
 */
function modern_news_portal_jetpack_styles() {
	if ( class_exists( 'Jetpack' ) ) {
		wp_enqueue_style( 'modern-news-portal-jetpack', get_template_directory_uri() . '/css/jetpack.css', array(), MODERN_NEWS_PORTAL_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'modern_news_portal_jetpack_styles' );
