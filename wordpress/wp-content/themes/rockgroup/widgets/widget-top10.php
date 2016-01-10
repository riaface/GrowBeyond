<?php
/**
 * Add function to widgets_init that will load our widget.
 */
add_action( 'widgets_init', 'widget_top10_load' );

/**
 * Register our widget.
 */
function widget_top10_load() {
	register_widget('themerex_top10_widget');
}

/**
 * Top10 Widget class.
 */
class themerex_top10_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function themerex_top10_widget() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_top10', 'description' => __('Top 10 posts by average reviews marks (by author and users)', 'themerex'));

		/* Widget control settings. */
		$control_ops = array('width' => 200, 'height' => 250, 'id_base' => 'themerex-top10-widget');

		/* Create the widget. */
		$this->WP_Widget('themerex-top10-widget', __('ThemeREX - Top 10 Posts', 'themerex'), $widget_ops, $control_ops);
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
			apply_filters('widget_title', isset($instance['title_author']) ? $instance['title_author'] : ''),
			apply_filters('widget_title', isset($instance['title_users']) ? $instance['title_users'] : '')
		);
		$number = isset($instance['number']) ? (int) $instance['number'] : '';
		$show_date = isset($instance['show_date']) ? (int) $instance['show_date'] : 0;
		$show_image = isset($instance['show_image']) ? (int) $instance['show_image'] : 0;
		$show_author = isset($instance['show_author']) ? (int) $instance['show_author'] : 0;
		$show_counters = isset($instance['show_counters']) ? (int) $instance['show_counters'] : 0;
		$category = isset($instance['category']) ? (int) $instance['category'] : 0;

		$counters = 'stars';

		$output = '';
		$tabs = array();

		$reviews_first_author = get_theme_option('reviews_first')=='author';
		$reviews_second_hide = get_theme_option('reviews_second')=='hide';

		

		for ($i=0; $i<2; $i++) {
			
			if ($i==0 && !$reviews_first_author && $reviews_second_hide) continue;
			if ($i==1 && $reviews_first_author && $reviews_second_hide) continue;
			
			$args = array(
				'post_type' => 'post',
				'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
				'post_password' => '',
				'posts_per_page' => $number,
				'ignore_sticky_posts' => 1,
				'order' => 'DESC',
				'orderby' => 'meta_value_num',
				'meta_key' => 'reviews_avg'.($i==0 ? '' : '2')
			);
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
				$tabs[$i] = '<li><a href="#widget_top10_' . $i . '" class="theme_button"><span>'.$title_tabs[$i].'</span></a></li>';
				$output .= '
					<div class="tab_content" id="widget_top10_' . $i . '"'.($i==1 && !$output ? ' style="display: block;"' : '').'>
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
					if ($show_counters) {
						$post_counters = marksToDisplay(get_post_meta($post_id, 'reviews_avg'.($i==0 ? '' : '2'), true));
						if ($post_counters > 0) {
							if (themerex_strlen($post_counters)==1) 
								$post_counters .= '.0';
							if ($show_counters == 2 && get_custom_option('show_reviews')=='yes') {
								$output .= '
									<div class="reviews_summary blog_reviews">
										<div class="criteria_summary criteria_row">
											' . getReviewsSummaryStars($post_counters) . '
										</div>
									</div>
								';
							}
						}
					}
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
											<span class="post_author">' . __('by', 'themerex') . ' <a href="' . $post_author_url . '">' . $post_author_name . '</a></span>
							';
						}
						if ($show_counters==1 && $post_counters) {
							$output .= '
										<span class="post_comments"><a href="'.$post_link.'">
											<span class="comments_icon icon-star"></span><span class="post_comments_number">' . $post_counters . '</span>
										</a></span>';
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
			if (!$reviews_second_hide) themerex_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);
	
			/* Before widget (defined by themes). */			
			echo balanceTags($before_widget);		
			
			/* Display the widget title if one was input (before and after defined by themes). */
			if ($title) echo balanceTags($before_title . $title . $after_title);		
	
			echo balanceTags('
				<div class="top10_tabs'.($show_image ? '' : ' ordered_list').($show_image || $show_date || $show_author ? '' : ' flat_list').'">'
					. (!$reviews_second_hide ? '<ul class="tabs">' . ($reviews_first_author ? $tabs[0].$tabs[1] : $tabs[1].$tabs[0]) . '</ul>' : '')
					. $output 
					. (!$reviews_second_hide
						? '
							<script type="text/javascript">
								jQuery(document).ready(function() {
									jQuery(\'.top10_tabs\').tabs();
								});
							</script>'
						: '')
					. '
				</div>
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
		$instance['title_author'] = strip_tags($new_instance['title_author']);
		$instance['title_users'] = strip_tags($new_instance['title_users']);
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
		$defaults = array('title' => '', 'title_author' => '', 'title_users' => '', 'number' => '4', 'show_date' => '1', 'show_image' => '1', 'show_author' => '1', 'show_counters' => '1', 'category'=>'0', 'description' => __('Top 10 posts from selected category', 'themerex'));
		$instance = wp_parse_args((array) $instance, $defaults); 
		$title = isset($instance['title']) ? $instance['title'] : '';
		$title_author = isset($instance['title_author']) ? $instance['title_author'] : '';
		$title_users = isset($instance['title_users']) ? $instance['title_users'] : '';
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
			<label for="<?php echo esc_attr($this->get_field_id('title_author')); ?>"><?php _e('Author rating tab title:', 'themerex'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('title_author')); ?>" name="<?php echo esc_attr($this->get_field_name('title_author')); ?>" value="<?php echo esc_attr($title_author); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title_users')); ?>"><?php _e('Users rating tab title:', 'themerex'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id('title_users')); ?>" name="<?php echo esc_attr($this->get_field_name('title_users')); ?>" value="<?php echo esc_attr($title_users); ?>" style="width:100%;" />
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
			<label for="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_2"><?php _e('As stars', 'themerex'); ?></label>
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_1" name="<?php echo esc_attr($this->get_field_name('show_counters')); ?>" value="1" <?php echo esc_attr($show_counters==1 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_1"><?php _e('As icon', 'themerex'); ?></label>
			<input type="radio" id="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_0" name="<?php echo esc_attr($this->get_field_name('show_counters')); ?>" value="0" <?php echo esc_attr($show_counters==0 ? ' checked="checked"' : ''); ?> />
			<label for="<?php echo esc_attr($this->get_field_id('show_counters')); ?>_0"><?php _e('Hide', 'themerex'); ?></label>
		</p>

	<?php
	}
}

?>