<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'widget_popular_posts_load' );

/**
 * Register our widget.
 */
function widget_popular_posts_load() {
	register_widget('themerex_popular_posts_widget');
}

/**
 * Most popular and commented Widget class.
 */
class themerex_popular_posts_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function themerex_popular_posts_widget() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_popular_posts widget_trex_post', 'description' => __('The most popular and most commented blog posts (extended)', 'themerex'));

		/* Widget control settings. */
		$control_ops = array('width' => 200, 'height' => 250, 'id_base' => 'themerex-popular-posts-widget');

		/* Create the widget. */
		$this->WP_Widget('themerex-popular-posts-widget', __('ThemeREX - Most Popular & Commented Posts', 'themerex'), $widget_ops, $control_ops);
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget($args, $instance) {
		extract($args);

		global $wp_query, $post;

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
		$title_tabs = array(
			apply_filters('widget_title', isset($instance['title_popular']) ? ($instance['title_popular'] ? $instance['title_popular'] : __('Popular','themerex') ) : ''),
			apply_filters('widget_title', isset($instance['title_commented']) ? ($instance['title_commented'] ? $instance['title_commented'] : __('Commented','themerex')) : '')
		);
		$number = isset($instance['number']) ? (int) $instance['number'] : '';
		$show_date = isset($instance['show_date']) ? (int) $instance['show_date'] : 0;
		$show_image = isset($instance['show_image']) ? (int) $instance['show_image'] : 0;
		$show_author = isset($instance['show_author']) ? (int) $instance['show_author'] : 0;
		$show_counters = isset($instance['show_counters']) ? (int) $instance['show_counters'] : 0;
		$category = isset($instance['category']) ? (int) $instance['category'] : 0;

		$output = $tabs = '';

		for ($i=0; $i<2; $i++) {

			$args = array(
				'post_type' => 'post',
				'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
				'post_password' => '',
				'posts_per_page' => $number,
				'ignore_sticky_posts' => 1,
				'order' => 'DESC',
			);
			if ($i==0) {		// Most popular
				$args['meta_key'] = 'post_views_count';
				$args['orderby'] = 'meta_value_num';
			} else {			// Most commented
				$args['orderby'] = 'comment_count';
			}
			if ($category > 0) {
				$args['cat'] = $category;
			}
			$ex = get_theme_option('exclude_cats');
			if (!empty($ex)) {
				$args['category__not_in'] = explode(',', $ex);
			}
			query_posts($args); 
			
			/* Loop posts */
			if (have_posts()) {
				$tabs .= '<li><a href="#widget_popular_' . $i . '" class="theme_button"><span>'.$title_tabs[$i].'</span></a></li>';
				$output .= '
					<div class="tab_content" id="widget_popular_' . $i . '">
				';
				$post_number = 0;
				while (have_posts()) {
					the_post();
	
					$post_number++;
			
					$post_id = get_the_ID();
					$post_date = getDateOrDifference(get_the_date('Y-m-d H:i:s'));
					$post_title = $post->post_title;
					$post_link = get_permalink();
					
					$output .= '
						<div class="post_item' . ($post_number==1 ? ' first' : '') . '">
					';
					if ($show_image) {
						$post_thumb = getResizedImageTag($post_id, 60, 60);
						if ($post_thumb) {
							$output .= '
									<div class="post_thumb image_wrapper">' . $post_thumb . '</div>
							';
						}
					}
					$output .= '
									<div class="post_wrapper">
										<h5 class="post_title theme_title'.($show_counters==2 ? '' : ' title_padding').'"><a href="' . $post_link . '">' . $post_title . '</a></h5>
					';
					if ($show_date || $show_counters || $show_author) {
						$output .= '
										<div class="post_info theme_info">
						';
						if ($show_date) {
							$output .= '
												<span class="post_date theme_text">' . $post_date . '</span>
							';
						}
						if ($show_author) {
							$post_author_id   = $post->post_author;
							$post_author_name = get_the_author_meta('display_name', $post_author_id);
							$post_author_url  = get_author_posts_url($post_author_id, '');
							$output .= '
											<span class="post_author">' . __(' by', 'themerex') . ' <a href="' . $post_author_url . '">' . $post_author_name . '</a></span>
							';
						}
						if ($show_counters) {
							if ($i==0) {
								$post_counters = getPostViews($post_id);
								$post_comments_link = $post_link;
							} else {
								$post_counters = get_comments_number();
								$post_comments_link = get_comments_link( $post_id );
							}
							if ($show_counters==2 && ($show_date || $show_author)) {
								$output .= '<br />';
							}
							$output .= '
											<span class="post_comments' . ($show_counters==2 ? '_text' : '') . '"><a href="'.$post_comments_link.'">'
											. ($show_counters==2 ? '' : '<span class="comments_icon icon-' . ($i==0 ? 'eye' : 'chat-1') . '"></span>')
											. '<span class="post_comments_number">' . $post_counters . '</span>'
											. ($show_counters==2 ? ' '.($i==0 ? __('views', 'themerex') : __('comments', 'themerex')) : '')
											.'</a></span>
								';
						}
						$output .= '
										</div>
						';
					}
					$output .= '
							</div>
						</div>
					';
					if ($post_number >= $number) break;
				}
				$output .= '
					</div>
				';
			}
		}


		/* Restore main wp_query and current post data in the global var $post */
		wp_reset_query();
		wp_reset_postdata();

		
		if (!empty($output)) {
	
			themerex_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);
			themerex_enqueue_script( 'jquery-effects-slide', false, array('jquery','jquery-effects-core'), null, true);

	
			/* Before widget (defined by themes). */			
			echo balanceTags($before_widget);		
			
			/* Display the widget title if one was input (before and after defined by themes). */
			if ($title) echo balanceTags($before_title . $title . $after_title);		
	
			echo balanceTags('
				<div class="sc_tabs sc_tabs_effects'.($show_image ? '' : ' ordered_list').($show_image || $show_date || $show_counters>1 || $show_author ? '' : ' flat_list').'">
					<ul class="tabs">'.$tabs.'</ul>'
						.$output
					.'</div>
			');
			
			/* After widget (defined by themes). */
			echo balanceTags($after_widget);
		}
	}

	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance) {
		$instance = $old_instance;

		/* Strip tags for title and comments count to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['title_popular'] = strip_tags($new_instance['title_popular']);
		$instance['title_commented'] = strip_tags($new_instance['title_commented']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = (int) $new_instance['show_date'];
		$instance['show_image'] = (int) $new_instance['show_image'];
		$instance['show_author'] = (int) $new_instance['show_author'];
		$instance['show_counters'] = (int) $new_instance['show_counters'];
		$instance['category'] = (int) $new_instance['category'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance) {
 		/* Set up some default widget settings. */
		$defaults = array('title' => '', 'title_popular' => '', 'title_commented' => '', 'number' => '4', 'show_date' => '1', 'show_image' => '1', 'show_author' => '1', 'show_counters' => '1', 'category'=>'0', 'description' => __('The most popular & commented posts', 'themerex'));
		$instance = wp_parse_args((array) $instance, $defaults); 
		$title = isset($instance['title']) ? $instance['title'] : '';
		$title_popular = isset($instance['title_popular']) ? $instance['title_popular'] : '';
		$title_commented = isset($instance['title_commented']) ? $instance['title_commented'] : '';
		$number = isset($instance['number']) ? $instance['number'] : '';
		$show_date = isset($instance['show_date']) ? $instance['show_date'] : '1';
		$show_image = isset($instance['show_image']) ? $instance['show_image'] : '1';
		$show_author = isset($instance['show_author']) ? $instance['show_author'] : '1';
		$show_counters = isset($instance['show_counters']) ? $instance['show_counters'] : '1';
		$category = isset($instance['category']) ? $instance['category'] : '0';
		$categories = getCategoriesList(false);
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Widget title:', 'themerex'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title_popular')); ?>"><?php _e('Most popular tab title:', 'themerex'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('title_popular')); ?>" name="<?php echo esc_attr($this->get_field_name('title_popular')); ?>" value="<?php echo esc_attr($title_popular); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title_commented')); ?>"><?php _e('Most commented tab title:', 'themerex'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('title_commented')); ?>" name="<?php echo esc_attr($this->get_field_name('title_commented')); ?>" value="<?php echo esc_attr($title_commented); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php _e('Category:', 'themerex'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('category')); ?>" name="<?php echo esc_attr($this->get_field_name('category')); ?>" style="width:100%;">
				<option value="0"><?php _e('-- Any category --', 'themerex'); ?></option> 
			<?php
				foreach ($categories as $cat_id => $cat_name) {
					echo balanceTags('<option value="'.$cat_id.'"'.($category==$cat_id ? ' selected="selected"' : '').'>'.$cat_name.'</option>');
				}
			?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e('Number posts to show:', 'themerex'); ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($number); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_image')); ?>_1"><?php _e('Show post image:', 'themerex'); ?></label><br />
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_image')); ?>_1" name="<?php echo esc_attr($this->get_field_name('show_image')); ?>" value="1" <?php echo esc_attr($show_image==1 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_image')); ?>_1"><?php _e('Show', 'themerex'); ?></label>
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_image')); ?>_0" name="<?php echo esc_attr($this->get_field_name('show_image')); ?>" value="0" <?php echo esc_attr($show_image==0 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_image')); ?>_0"><?php _e('Hide', 'themerex'); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>_1"><?php _e('Show post author:', 'themerex'); ?></label><br />
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_author')); ?>_1" name="<?php echo esc_attr($this->get_field_name('show_author')); ?>" value="1" <?php echo esc_attr($show_author==1 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>_1"><?php _e('Show', 'themerex'); ?></label>
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_author')); ?>_0" name="<?php echo esc_attr($this->get_field_name('show_author')); ?>" value="0" <?php echo esc_attr($show_author==0 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>_0"><?php _e('Hide', 'themerex'); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>_1"><?php _e('Show post date:', 'themerex'); ?></label><br />
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_date')); ?>_1" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" value="1" <?php echo esc_attr($show_date==1 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>_1"><?php _e('Show', 'themerex'); ?></label>
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_date')); ?>_0" name="<?php echo esc_attr($this->get_field_name('show_date')); ?>" value="0" <?php echo esc_attr($show_date==0 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_date')); ?>_0"><?php _e('Hide', 'themerex'); ?></label>
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_1"><?php _e('Show post counters:', 'themerex'); ?></label><br />
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_2" name="<?php echo esc_attr($this->get_field_name('show_counters')); ?>" value="2" <?php echo esc_attr($show_counters==2 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_2"><?php _e('As text', 'themerex'); ?></label>
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_1" name="<?php echo esc_attr($this->get_field_name('show_counters')); ?>" value="1" <?php echo esc_attr($show_counters==1 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_1"><?php _e('As icon', 'themerex'); ?></label>
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_0" name="<?php echo esc_attr($this->get_field_name('show_counters')); ?>" value="0" <?php echo esc_attr($show_counters==0 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_0"><?php _e('Hide', 'themerex'); ?></label>
		</p>

	<?php
	}
}

?>