<?php
/**
 * The footer for our theme
 *
 * @package Bangla24
 */
?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer-widgets">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="footer-widget-area">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<div class="footer-widget-area">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<div class="footer-widget-area">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<div class="footer-widget-area">
						<?php dynamic_sidebar( 'footer-4' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="copyright">
					<?php
					/* translators: %s: Current year and site name */
					printf( esc_html__( '© %s - All Rights Reserved.', 'modern-news-portal' ), date_i18n( 'Y' ) . ' ' . get_bloginfo( 'name' ) );
					?>
					<span class="sep"> | </span>
					<?php
					/* translators: %s: Theme name and link */
					printf( esc_html__( 'Theme: %s', 'modern-news-portal' ), '<a href="https://example.com/modern-news-portal/">BANGLA24</a>' );
					?>
				</div>

				<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
					<nav class="footer-navigation">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'footer-menu',
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
						) );
						?>
					</nav>
				<?php endif; ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
