<?php
/**
 * Custom template tags for this theme
 *
 * @package Modern_News_Portal
 */

if ( ! function_exists( 'modern_news_portal_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function modern_news_portal_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on"><i class="fas fa-calendar-alt"></i> ' . $time_string . '</span>';
	}
endif;

if ( ! function_exists( 'modern_news_portal_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function modern_news_portal_posted_by() {
		echo '<span class="byline"><i class="fas fa-user"></i> <span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';
	}
endif;

if ( ! function_exists( 'modern_news_portal_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function modern_news_portal_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'modern-news-portal' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><i class="fas fa-folder"></i> ' . esc_html__( 'Posted in %1$s', 'modern-news-portal' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'modern-news-portal' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><i class="fas fa-tags"></i> ' . esc_html__( 'Tagged %1$s', 'modern-news-portal' ) . '</span>', $tags_list );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="fas fa-comment"></i> ';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'modern-news-portal' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'modern-news-portal' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link"><i class="fas fa-edit"></i> ',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'modern_news_portal_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function modern_news_portal_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'modern_news_portal_get_category' ) ) :
	/**
	 * Returns HTML for the primary category of the current post.
	 */
	function modern_news_portal_get_category() {
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			$category = $categories[0];
			return '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="article-category">' . esc_html( $category->name ) . '</a>';
		}
		return '';
	}
endif;

if ( ! function_exists( 'modern_news_portal_get_author' ) ) :
	/**
	 * Returns HTML for the author of the current post.
	 */
	function modern_news_portal_get_author() {
		return '<span class="article-author"><i class="fas fa-user"></i> <a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
	}
endif;

if ( ! function_exists( 'modern_news_portal_get_date' ) ) :
	/**
	 * Returns HTML for the date of the current post.
	 */
	function modern_news_portal_get_date() {
		return '<span class="article-date"><i class="fas fa-calendar-alt"></i> ' . esc_html( get_the_date() ) . '</span>';
	}
endif;

if ( ! function_exists( 'modern_news_portal_get_comments' ) ) :
	/**
	 * Returns HTML for the comment count of the current post.
	 */
	function modern_news_portal_get_comments() {
		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			return '<span class="article-comments"><i class="fas fa-comment"></i> ' . get_comments_number() . '</span>';
		}
		return '';
	}
endif;

if ( ! function_exists( 'modern_news_portal_get_excerpt' ) ) :
	/**
	 * Returns a custom excerpt with specified word count.
	 *
	 * @param int $word_count Number of words to include in the excerpt.
	 */
	function modern_news_portal_get_excerpt( $word_count = 20 ) {
		$excerpt = get_the_excerpt();
		$excerpt = wp_trim_words( $excerpt, $word_count, '...' );
		return $excerpt;
	}
endif;

if ( ! function_exists( 'modern_news_portal_get_featured_posts' ) ) :
	/**
	 * Returns a WP_Query object with featured posts.
	 *
	 * @param int $count Number of posts to retrieve.
	 */
	function modern_news_portal_get_featured_posts( $count = 3 ) {
		$args = array(
			'post_type'           => 'post',
			'posts_per_page'      => $count,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'meta_query'          => array(
				array(
					'key'   => '_thumbnail_id',
					'compare' => 'EXISTS',
				),
			),
		);
		
		// Check if there's a featured category set in theme options
		$featured_category = get_theme_mod( 'modern_news_portal_featured_category' );
		if ( $featured_category ) {
			$args['cat'] = absint( $featured_category );
		}
		
		return new WP_Query( $args );
	}
endif;
