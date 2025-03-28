<?php
/**
 * Customizer functionality for Modern News Portal theme
 *
 * @package Modern_News_Portal
 */

// Include WordPress customizer classes
require_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function modern_news_portal_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'modern_news_portal_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'modern_news_portal_customize_partial_blogdescription',
			)
		);
	}
	
	// Theme Colors
	$wp_customize->add_setting(
		'modern_news_portal_primary_color',
		array(
			'default'           => '#1e73be',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'modern_news_portal_primary_color',
			array(
				'label'    => __( 'Primary Color', 'modern-news-portal' ),
				'section'  => 'colors',
				'settings' => 'modern_news_portal_primary_color',
			)
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_secondary_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'modern_news_portal_secondary_color',
			array(
				'label'    => __( 'Secondary Color', 'modern-news-portal' ),
				'section'  => 'colors',
				'settings' => 'modern_news_portal_secondary_color',
			)
		)
	);
	
	// Header Options
	$wp_customize->add_section(
		'modern_news_portal_header_options',
		array(
			'title'    => __( 'Header Options', 'modern-news-portal' ),
			'priority' => 30,
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_show_date',
		array(
			'default'           => true,
			'sanitize_callback' => 'modern_news_portal_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_control(
		'modern_news_portal_show_date',
		array(
			'label'    => __( 'Show Date in Header', 'modern-news-portal' ),
			'section'  => 'modern_news_portal_header_options',
			'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_show_search',
		array(
			'default'           => true,
			'sanitize_callback' => 'modern_news_portal_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_control(
		'modern_news_portal_show_search',
		array(
			'label'    => __( 'Show Search in Header', 'modern-news-portal' ),
			'section'  => 'modern_news_portal_header_options',
			'type'     => 'checkbox',
		)
	);
	
	// Breaking News Options
	$wp_customize->add_section(
		'modern_news_portal_breaking_news',
		array(
			'title'    => __( 'Breaking News', 'modern-news-portal' ),
			'priority' => 35,
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_show_breaking_news',
		array(
			'default'           => true,
			'sanitize_callback' => 'modern_news_portal_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_control(
		'modern_news_portal_show_breaking_news',
		array(
			'label'    => __( 'Show Breaking News Ticker', 'modern-news-portal' ),
			'section'  => 'modern_news_portal_breaking_news',
			'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_breaking_news_label',
		array(
			'default'           => __( 'Breaking News', 'modern-news-portal' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	
	$wp_customize->add_control(
		'modern_news_portal_breaking_news_label',
		array(
			'label'    => __( 'Breaking News Label', 'modern-news-portal' ),
			'section'  => 'modern_news_portal_breaking_news',
			'type'     => 'text',
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_breaking_category',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Category_Control(
			$wp_customize,
			'modern_news_portal_breaking_category',
			array(
				'label'    => __( 'Breaking News Category', 'modern-news-portal' ),
				'section'  => 'modern_news_portal_breaking_news',
			)
		)
	);
	
	// Featured Posts Options
	$wp_customize->add_section(
		'modern_news_portal_featured_posts',
		array(
			'title'    => __( 'Featured Posts', 'modern-news-portal' ),
			'priority' => 40,
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_show_featured_posts',
		array(
			'default'           => true,
			'sanitize_callback' => 'modern_news_portal_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_control(
		'modern_news_portal_show_featured_posts',
		array(
			'label'    => __( 'Show Featured Posts Section', 'modern-news-portal' ),
			'section'  => 'modern_news_portal_featured_posts',
			'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_featured_category',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Category_Control(
			$wp_customize,
			'modern_news_portal_featured_category',
			array(
				'label'    => __( 'Featured Posts Category', 'modern-news-portal' ),
				'section'  => 'modern_news_portal_featured_posts',
			)
		)
	);
	
	// Footer Options
	$wp_customize->add_section(
		'modern_news_portal_footer_options',
		array(
			'title'    => __( 'Footer Options', 'modern-news-portal' ),
			'priority' => 100,
		)
	);
	
	$wp_customize->add_setting(
		'modern_news_portal_copyright_text',
		array(
			'default'           => sprintf( __( 'Copyright &copy; %s. All Rights Reserved.', 'modern-news-portal' ), date( 'Y' ) ),
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	
	$wp_customize->add_control(
		'modern_news_portal_copyright_text',
		array(
			'label'    => __( 'Copyright Text', 'modern-news-portal' ),
			'section'  => 'modern_news_portal_footer_options',
			'type'     => 'textarea',
		)
	);
}
add_action( 'customize_register', 'modern_news_portal_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function modern_news_portal_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function modern_news_portal_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function modern_news_portal_customize_preview_js() {
	wp_enqueue_script( 'modern-news-portal-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'modern_news_portal_customize_preview_js' );

/**
 * Sanitize checkbox values
 */
function modern_news_portal_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Generate custom CSS based on customizer settings
 */
function modern_news_portal_customizer_css() {
	$primary_color = get_theme_mod( 'modern_news_portal_primary_color', '#ffbe00' );
	$secondary_color = get_theme_mod( 'modern_news_portal_secondary_color', '#333333' );
	
	$custom_css = "
		.main-navigation,
		.article-category,
		.featured-main-category,
		.featured-side-category,
		.pagination .current,
		.back-to-top,
		.widget-title:after,
		.categories-widget .cat-count,
		.dark-mode-toggle.active {
			background-color: {$primary_color};
		}
		
		a,
		.site-title a,
		.main-menu .current-menu-item > a,
		.article-title a:hover,
		.article-meta a:hover,
		.widget a:hover {
			color: {$primary_color};
		}
		
		.widget-title,
		blockquote {
			border-color: {$primary_color};
		}
		
		body,
		button,
		input,
		select,
		optgroup,
		textarea {
			color: {$secondary_color};
		}
	";
	
	wp_add_inline_style( 'modern-news-portal-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'modern_news_portal_customizer_css' );

// Define the custom category control class
if (!class_exists('WP_Customize_Category_Control')) :
    class WP_Customize_Category_Control extends WP_Customize_Control {
        public $type = 'category';

        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __('&mdash; Select &mdash;', 'modern-news-portal'),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );

            $dropdown = str_replace('<select', '<select ' . $this->get_link(), $dropdown);

            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span>%s</label>',
                esc_html($this->label),
                $dropdown
            );
        }
    }
endif;
