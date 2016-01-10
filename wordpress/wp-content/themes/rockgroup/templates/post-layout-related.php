<article class="sc_columns_item postBoxItem"  onClick="window.location='<?php echo esc_js($post_data['post_link']); ?>'">

	<?php 
	//thumb

	$icon = "icon-gallery";
	if($post_data['post_format'] == 'standard') $icon = "icon-post";
	if($post_data['post_format'] == 'video') $icon = "icon-videocam";
	if($post_data['post_format'] == 'audio') $icon = "icon-music";
	if($post_data['post_format'] == 'link') $icon = "icon-link";
	if($post_data['post_format'] == 'quote') $icon = "icon-quote";
	if($post_data['post_format'] == 'image') $icon = "icon-image";
	if($post_data['post_format'] == 'status') $icon = "icon-flag";
	if($post_data['post_format'] == 'aside') $icon = "icon-comment";
	if($post_data['post_format'] == 'chat') $icon = "icon-chat";


	if ($post_data['post_thumb']) { ?>
		<div class="postThumb" data-image="<?php echo esc_attr($post_data['post_attachment']); ?>" data-title="<?php echo esc_attr($post_data['post_title']); ?>">
		<?php echo balanceTags($post_data['post_thumb']); ?>
		</div> <?php
	} 
	else if ($post_data['post_gallery']) {
		$url = $post_data['post_gallery'];
		preg_match( '@src="([^"]+)"@' , $url, $match );
		$src = array_pop($match);
		?>
		<div class="postThumb noneThumb" data-title="Gallery Post Format">
			<img src="<?php echo esc_url($src); ?>" alt="">
			<span class="iconThumb icon-gallery"></span>
		</div>
		<?php
	} 
	else {?>
		<div class="postThumb noneThumb" data-title="<?php echo esc_attr($post_data['post_title']); ?>">
			<img src="<?php echo get_template_directory_uri(); ?>/images/none_thumb.png" alt="">
			<span class="iconThumb <?php echo esc_attr($icon); ?>"></span>
		</div> <?php
	}

	if(strlen($post_data['post_title']) > 20) $title = substr($post_data['post_title'], 0, 20).' ...';
	else $title = $post_data['post_title'];

	$categories = $post_data['post_categories_links_related'];
	?>

	<div class="postBoxInfoWrap">
	<div class="postBoxInfo">
		<h4><?php echo balanceTags($title); ?></h4>
		<span class="postBoxCategory hoverUnderline"><?php echo balanceTags($categories); ?></span>
	</div>
	</div>
	
</article>
