<?php
$show_title = get_custom_option('show_post_title', null, $post_data['post_id'])=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));

?>

	<article class="isotopeItem <?php 
		echo 'post_format_'.$post_data['post_format'] 
			.($opt['number']%2==0 ? ' even' : ' odd') 
			.($opt['number']==0 ? ' first' : '') 
			.($opt['number']==$opt['posts_on_page'] ? ' last' : '')
			.($opt['add_view_more'] ? ' viewmore' : '') 
			.(get_custom_option('show_filters')=='yes' 
				? ' flt_'.join(' flt_', get_custom_option('filter_taxonomy')=='categories' ? $post_data['post_categories_ids'] : $post_data['post_tags_ids'])
				: '');
		?>" data-postid="<?php echo esc_attr($post_data['post_id']); ?>">
		<div class="isotopeItemWrap">
			<?php 
			//thumb
			if ($post_data['post_thumb']) { ?>
				<div class="thumb">
					<?php 
						$thumb_crop = array( 'portfolio_big' => '1','portfolio_medium' => '2','portfolio_mini' => '3');
						$thumb_sizes = getThumbSizes(array(
							'thumb_size' => getThumbColumns('cub',$thumb_crop[$post_data['post_layout']]),
							'thumb_crop' => true,
							'sidebar' => false
						));
						$thumb_img = getResizedImageURL($post_data['post_attachment'], $thumb_sizes['w'], $thumb_sizes['h']);
					?>
					<img src="<?php echo esc_url($thumb_img); ?>" alt="<?php echo esc_attr($post_data['post_title']); ?>">
				</div>
			<?php
			} else if ($post_data['post_gallery']) {
				echo balanceTags($post_data['post_gallery']);
			} else if ($post_data['post_video']) {
				echo getVideoFrame($post_data['post_video'], $post_data['post_thumb'], true);
			} else { ?>

			<div class="thumb noneThumb">
				<img src="<?php echo get_template_directory_uri(); ?>/images/none_thumb.png" alt="">
				<span class="iconThumb icon-gallery"></span>
			</div>
			<?php }


			//review
			if( $post_data['post_reviews_author'] ){
				$avg_author = $post_data['post_reviews_'.(get_theme_option('reviews_first')=='author' ? 'author' : 'users')];
				$rating_max = get_custom_option('reviews_max_level');
				$reviews_style = get_custom_option('reviews_style'); 
				$review_title = sprintf($rating_max<100 ? __('Rating: %s from %s', 'themerex') : __('Rating: %s', 'themerex'), number_format($avg_author,1).($rating_max < 100 ? '' : '%'), $rating_max.($rating_max < 100 ? '' : '%'));?>

				<div class="isotopeRating" title="<?php echo esc_attr($review_title); ?>"><span class="rInfo"><?php echo balanceTags($avg_author); ?></span></div>
			<?php } ?>
			<div class="isotopeMore icon-down-open-big"></div>
			<div class="isotopeContentWrap">
				<div class="isotopeContent">
					<?php if ($show_title) { ?>
					<h4 class="isotopeTitle"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo balanceTags($post_data['post_title']); ?></a></h4>
					<?php } ?>
					
					<?php echo balanceTags($post_data['post_excerpt'] ? '<div class="isotopeExcerpt">'.getShortString(strip_tags($post_data['post_excerpt']), 100 ).'</div>' : ''); ?>
					
					<?php if ($post_data['post_categories_links']!='') { ?>
						<div class="isotopeCats hoverUnderline"><?php echo balanceTags($post_data['post_categories_links']); ?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	</article>
