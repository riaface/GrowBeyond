<?php
$post_data['post_views']++;
$avg_author = $avg_users = 0;
if (!$post_data['post_protected'] && $opt['reviews'] && get_custom_option('show_reviews')=='yes') {
	$avg_author = $post_data['post_reviews_author'];
	$avg_users  = $post_data['post_reviews_users'];
}

$body_style =  get_custom_option('body_style');
$side_bar = get_custom_option('show_sidebar_main');
$main_div = ($body_style == 'wide' && $side_bar == 'fullWidth') || ($body_style == 'boxed' && $side_bar == 'fullWidth') && !$layout_isotope;
$post_info = get_custom_option('show_post_info');

$class_array = array('itemscope',
					'singlePage',
					get_custom_option('show_post_icon') == 'no' ? ' emptyPostFormatIcon' : '',
					get_custom_option('show_post_title') == 'no' || !$post_data['post_title']? ' emptyPostTitle' : '',
					$post_info == 'no' ? ' emptyPostInfo' : '');

$show_title = get_custom_option('show_post_title')=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside','chat','status','link','quote')));

	echo ($main_div ? '<div class="main">' : '');
?>
	<section <?php post_class($class_array) ?> itemscope itemtype="http://schema.org/<?php echo ($avg_author > 0 || $avg_users > 0 ? 'Review' : 'Article'); ?>">
		<article class="postContent">
			<?php 

			//pass
			if ($post_data['post_protected']) { 
				echo balanceTags($post_data['post_excerpt']);
				echo get_the_password_form(); 
			} else if (!$post_data['post_protected']) {

			//dedicated
			if (!empty($opt['dedicated'])) { echo balanceTags($opt['dedicated']); }?>

			<?php echo get_custom_option('show_post_icon') == 'yes' ? '<div class="postFormatIcon '.getPostFormatIcon($post_data['post_format']).'"></div>' : ''; 

			//date 
			if(is_single() && ($side_bar == 'fullWidth' || $side_bar == 'wide')  && $post_data['post_date'] != ''){ ?>
				<div class="postDate"><?php echo balanceTags($post_data['post_date']); ?></div>
			<?php } 

			//title
			echo sc_param_is_on($show_title) ? '<h1 class="postTitle">'.balanceTags($post_data['post_title']).'</h1>' : '';

			//post info
			echo ($post_info ? getPostInfo(get_theme_option('set_post_info'),$post_data) : '');

			//thumb
			$f_thumb = get_custom_option('show_featured_image') == 'yes';
			if ($post_data['post_thumb'] && $post_data['post_format'] == 'image' && $f_thumb)  { ?>
				<div class="postThumb thumbZooom"><?php
					echo balanceTags('<a href="'.$post_data['post_attachment'].'" data-image="'.$post_data['post_attachment'].'"><span class="icon-search thumb-ico"></span>'.$post_data['post_thumb'].'</a>'); ?>
				</div>
				<?php 
			} else if ($post_data['post_thumb'] && $f_thumb) { ?>
				<div class="postThumb">
					<?php echo balanceTags($post_data['post_thumb']); ?>
				</div>
				<?php 
			} ?>

			<div class="postTextArea" itemprop="<?php echo ($avg_author > 0 || $avg_users > 0 ? 'reviewBody' : 'articleBody'); ?>">
			<?php

			// Post content
			if ($post_data['post_protected']) { 
				echo balanceTags($post_data['post_excerpt']); 
			} else {
				echo balanceTags($post_data['post_content']); 
				wp_link_pages( array( 
					'before' => '<div class="nav_pages_parts"><span class="pages">' . __( 'Pages:', 'themerex' ) . '</span>', 
					'after' => '</div>',
					'link_before' => '<span class="page_num">',
					'link_after' => '</span>'
				) ); 
			} ?> 
			</div>
			<?php } 
			//postshare
			echo getPostShare(get_custom_option('set_post_info',null,$post_data['post_id']),$post_data);
			//pass end ?>

		</article>

		<?php 
			require(get_template_directory() . '/templates/page-part-reviews-block.php');
			//editor
			if ( !$post_data['post_protected'] && $post_data['post_edit_enable']) {
				require(themerex_get_file_dir('/templates/page-part-editor-area.php'));
			}
		?>
		
	</section>

	<?php	

	if (!$post_data['post_protected']) {
		require(get_template_directory().'/templates/page-part-author-info.php');
		require(get_template_directory().'/templates/page-part-related-posts.php');
		require(get_template_directory().'/templates/page-part-comments.php');
	}
	
	require(get_template_directory() . '/templates/page-part-views-counter.php'); 

	echo ($main_div ? '</div>' : '');
?>