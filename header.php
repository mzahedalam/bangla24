<?php
/**
 * The header for our theme
 *
 * @package Bangla24
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'modern-news-portal' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-top">
			<div class="container">
				<div class="flex items-center justify-between p-0 m-0">
					<div class="header-top-left">
						<div class="date-time">
							<i class="far fa-calendar-alt"></i> <?php echo esc_html( date_i18n( get_option( 'date_format' ) ) ); ?>
						</div>
						<div class="social-links flex items-center">
							<?php
							if ( has_nav_menu( 'social-menu' ) ) {
								wp_nav_menu( array(
									'theme_location' => 'social-menu',
									'menu_class'     => 'social-menu flex items-center gap-3',
									'depth'          => 1,
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>',
									'container'      => false,
								) );
							}
							?>
						</div>
					</div>
					<div class="search-form">
                        <div class="search-form-wrapper">
                            <button type="button" id="search-toggle" class="search-toggle">
                                <i class="fas fa-search"></i>
                            </button>
                            <div class="search-form-container hidden">
                                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'modern-news-portal'); ?>" value="<?php echo get_search_query(); ?>" name="s">
                                    <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>
                                    <!-- Removed search-close button -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Removed duplicate search form wrapper here -->
					<div class="header-top-right p-0 m-0">
						<?php if ( has_nav_menu( 'top-menu' ) ) : ?>
							<nav class="top-navigation">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'top-menu',
									'menu_class'     => 'top-menu',
									'depth'          => 1,
								) );
								?>
							</nav>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<div class="header-main p-0">
			<div class="container">
				<div class="flex items-center justify-between header-main-inner">
					<div class="site-branding">
						<?php
						if ( has_custom_logo() ) :
							$custom_logo_id = get_theme_mod('custom_logo');
							$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
							?>
							<a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link" rel="home">
								<img src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="w-24">
							</a>
							<?php
						else :
							?>
							<h1 class="site-title">
							<?php
							$modern_news_portal_description = get_bloginfo( 'description', 'display' );
							if ( $modern_news_portal_description || is_customize_preview() ) :
								?>
								<p class="site-description"><?php echo $modern_news_portal_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
							<?php endif; ?>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<?php if ( is_active_sidebar( 'header-ad' ) ) : ?>
						<div class="header-ad">
							<?php dynamic_sidebar( 'header-ad' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="main-navigation">
			<div class="container">
				<nav id="site-navigation" class="main-nav">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<i class="fas fa-bars"></i> <?php esc_html_e( 'Menu', 'modern-news-portal' ); ?>
					</button>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'main-menu',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>

		<?php if ( is_front_page() && is_home() ) : ?>
			<div class="breaking-news">
				<div class="container">
					<div class="breaking-news-container">
						<div class="breaking-news-label">
							<?php esc_html_e( 'Breaking News', 'modern-news-portal' ); ?>
						</div>
						<div class="breaking-news-ticker">
							<div class="ticker-items">
								<?php
								$breaking_news = modern_news_portal_get_breaking_news( 5 );
								if ( $breaking_news->have_posts() ) :
									while ( $breaking_news->have_posts() ) :
										$breaking_news->the_post();
										?>
										<div class="ticker-item">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</div>
										<?php
									endwhile;
									wp_reset_postdata();
								endif;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</header><!-- #masthead -->
