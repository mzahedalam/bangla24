<?php
/**
 * Widget functionality for Modern News Portal theme
 *
 * @package Modern_News_Portal
 */
if (!defined('ABSPATH')) {
	exit;
}
/**
 * Register widget areas.
 */

function modern_news_portal_widgets_init() {
	//Main Sidebar
	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'modern-news-portal' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'modern-news-portal' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Header Ad', 'modern-news-portal' ),
			'id'            => 'header-ad',
			'description'   => esc_html__( 'Add advertisement widget here to appear in your header.', 'modern-news-portal' ),
			'before_widget' => '<div id="%1$s" class="header-ad-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title screen-reader-text">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
        array(
            'name'          => esc_html__('Main Sidebar', 'modern-news-portal'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'modern-news-portal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'modern-news-portal' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 1.', 'modern-news-portal' ),
			'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'modern-news-portal' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 2.', 'modern-news-portal' ),
			'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'modern-news-portal' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 3.', 'modern-news-portal' ),
			'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 4', 'modern-news-portal' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here to appear in footer column 4.', 'modern-news-portal' ),
			'before_widget' => '<section id="%1$s" class="footer-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="footer-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'modern_news_portal_widgets_init' );

/**
 * Custom Recent Posts Widget
 */
class Modern_News_Portal_Recent_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'modern_news_portal_recent_posts',
			esc_html__( 'Modern News: Recent Posts', 'modern-news-portal' ),
			array(
				'description' => esc_html__( 'Display recent posts with thumbnails.', 'modern-news-portal' ),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		
		echo $args['before_widget'];
		
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		$recent_posts = new WP_Query(
			array(
				'posts_per_page'      => $number,
				'no_found_rows'       => true,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => true,
			)
		);
		
		if ( $recent_posts->have_posts() ) :
			?>
			<ul class="recent-posts-widget">
				<?php
				while ( $recent_posts->have_posts() ) :
					$recent_posts->the_post();
					?>
					<li class="recent-post-item">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="recent-post-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'thumbnail' ); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="recent-post-content">
							<h3 class="recent-post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<?php if ( $show_date ) : ?>
								<span class="recent-post-date">
									<i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?>
								</span>
							<?php endif; ?>
						</div>
					</li>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</ul>
			<?php
		endif;
		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Recent Posts', 'modern-news-portal' );
		$number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'modern-news-portal' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'modern-news-portal' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Display post date?', 'modern-news-portal' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		
		return $instance;
	}
}

/**
 * Custom Categories Widget
 */
class Modern_News_Portal_Categories_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
			'modern_news_portal_categories',
			esc_html__( 'Modern News: Categories', 'modern-news-portal' ),
			array(
				'description' => esc_html__( 'Display categories with post count.', 'modern-news-portal' ),
			)
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$show_count = isset( $instance['show_count'] ) ? (bool) $instance['show_count'] : true;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		
		echo $args['before_widget'];
		
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		$categories = get_categories(
			array(
				'orderby'      => 'name',
				'order'        => 'ASC',
				'hierarchical' => $hierarchical,
			)
		);
		
		if ( ! empty( $categories ) ) :
			?>
			<ul class="categories-widget">
				<?php
				foreach ( $categories as $category ) :
					?>
					<li class="category-item">
						<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
							<?php echo esc_html( $category->name ); ?>
							<?php if ( $show_count ) : ?>
								<span class="cat-count"><?php echo esc_html( $category->count ); ?></span>
							<?php endif; ?>
						</a>
					</li>
					<?php
				endforeach;
				?>
			</ul>
			<?php
		endif;
		
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Categories', 'modern-news-portal' );
		$show_count = isset( $instance['show_count'] ) ? (bool) $instance['show_count'] : true;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'modern-news-portal' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_count ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_count' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_count' ) ); ?>"><?php esc_html_e( 'Display post count?', 'modern-news-portal' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $hierarchical ); ?> id="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hierarchical' ) ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>"><?php esc_html_e( 'Show hierarchy?', 'modern-news-portal' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['show_count'] = isset( $new_instance['show_count'] ) ? (bool) $new_instance['show_count'] : false;
		$instance['hierarchical'] = isset( $new_instance['hierarchical'] ) ? (bool) $new_instance['hierarchical'] : false;
		
		return $instance;
	}
}

/**
 * Register custom widgets
 */
function modern_news_portal_register_custom_widgets() {
	register_widget( 'Modern_News_Portal_Recent_Posts_Widget' );
	register_widget( 'Modern_News_Portal_Categories_Widget' );
}
add_action( 'widgets_init', 'modern_news_portal_register_custom_widgets' );
