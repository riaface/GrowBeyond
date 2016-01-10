<?php
/*
 * The template for displaying one article of blog streampage with style "Excerpt"
 * 
 * @package RockGroup
*/


$post_classes = get_post_class('blogStreampage'.
					($opt['number']%2==0 ? ' even' : ' odd').
					($opt['number']==1 ? ' first' : '').
					($opt['number']==$opt['posts_on_page']? ' last' : '').
					($opt['add_view_more'] ? ' viewmore' : '').
					(get_custom_option('show_post_icon',null,$post_data['post_id']) == 'no' ? ' emptyPostFormatIcon' : '').
					(get_custom_option('show_post_title',null,$post_data['post_id']) == 'no' || !$post_data['post_title']? ' emptyPostTitle' : '').
					(get_custom_option('show_post_info',null,$post_data['post_id']) == 'no' ? ' emptyPostInfo' : ''));

$body_style =  get_custom_option('body_style');
$side_bar = get_custom_option('show_sidebar_main');
$fullwidth = get_custom_option('show_sidebar_main') == 'fullWidth' || is_singular();
$streampage_columns = get_custom_option('blog_style') == 'excerpt' && !is_singular();
$layout_isotope = !empty($opt['layout_isotope']) ? $opt['layout_isotope'] : false;
$main_div = ($body_style == 'wide' && $side_bar == 'fullWidth') || ($body_style == 'boxed' && $side_bar == 'fullWidth') && !$layout_isotope;

$show_title = get_custom_option('show_post_title', null, $post_data['post_id'])=='yes' && (get_custom_option('show_post_title_on_quotes')=='yes' || !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote')));

	 if (in_shortcode_blogger(true)) { ?>
<div class="class="<?php echo join(' ',$post_classes).(!in_array('post', $post_classes) ? ' post' : ''); ?>" ">
<?php } else { 
	if( $layout_isotope ){ ?>
	<span class="isotopeNav isoPrev icon-left-open-big" data-nav-id=""></span>
	<span class="isotopeNav isoNext icon-right-open-big" data-nav-id=""></span>
<?php } ?>

<article class="<?php echo join(' ',$post_classes).(!in_array('post', $post_classes) ? ' post' : ''); ?>">
<?php }  

	//main block
	echo ($main_div ? '<div class="main">' : '');

	//main block in full Width
	echo ($fullwidth && $streampage_columns || $layout_isotope ? '<div class="sc_columns_2 sc_columns_indent blogStreampageColumns"> <div class="sc_columns_item">' : '');

	//icon post format
	echo get_custom_option('show_post_icon',null,$post_data['post_id']) == 'yes' && $side_bar != 'wide' ? '<div class="postFormatIcon '.getPostFormatIcon($post_data['post_format']).'"></div>' : '';

	//date 
	if($side_bar == 'wide'){ ?>
		<div class="postDate"><?php echo ($post_data['post_date']); ?></div>
	<?php } 

	//title
	if ($show_title && $post_data['post_title']) { ?>
	<h1 class="postTitle"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo balanceTags($post_data['post_title']); ?></a></h1>
	<?php } 

	//postinfo
	echo getPostInfo(get_custom_option('set_post_info',null,$post_data['post_id']),$post_data);
		
	//main block in full Width style
	echo ($fullwidth && $streampage_columns || $layout_isotope ? '</div><div class="sc_columns_item">' : '');

	//thumb
	if (!$post_data['post_protected'] && get_custom_option('show_featured_image',null,$post_data['post_id']) == 'yes' ) {
		if ($post_data['post_gallery']) {
			echo balanceTags($post_data['post_gallery']);
		} else if ($post_data['post_video']) {
			$post_thumb = $post_data['post_thumb'] != '' ? $post_data['post_thumb'] : getVideoImgCode($post_data['post_video_url']);
			echo getVideoFrame($post_data['post_video'], $post_thumb);
		} else if ( $post_data['post_audio'] ){
			echo balanceTags($post_data['post_audio']);
		} else if ($post_data['post_thumb'] && $post_data['post_format'] == 'image')  { ?>
			<div class="postThumb thumbZooom"><?php
				echo balanceTags('<a href="'.$post_data['post_attachment'].'" data-image="'.$post_data['post_attachment'].'"><span class="icon-search thumb-ico"></span>'.$post_data['post_thumb'].'</a>'); ?>
			</div>
			<?php 
		} else if ($post_data['post_thumb'] && $post_data['post_format'] != 'quote' && $post_data['post_format'] != 'aside') { ?>
			<div class="postThumb"><?php
				if ($post_data['post_format']=='link' && $post_data['post_url']!='')
					echo balanceTags('<a href="'.esc_url($post_data['post_url']).'"'.($post_data['post_url_target'] ? ' target="'.$post_data['post_url_target'].'"' : '').'>'.balanceTags($post_data['post_thumb']).'</a>');
				else if ($post_data['post_link']!='')
					echo balanceTags('<a href="'.esc_url($post_data['post_link']).'">'.balanceTags($post_data['post_thumb']).'</a>');
				else
					echo balanceTags($post_data['post_thumb']); ?>
			</div> <?php
		} 
	}
	
	//excerpt
	if ($post_data['post_protected']) {
		echo balanceTags($post_data['post_excerpt']); 
	} else {
		if ($post_data['post_excerpt'] && $post_data['post_format'] == 'link') { 
			echo balanceTags('<a href="'.$post_data['post_link'].'">'.$post_data['post_excerpt'].'</a>');
		} else if($post_data['post_excerpt']) { ?>
			<div class="post<?php echo themerex_strtoproper($post_data['post_format']); ?>">
				<?php echo balanceTags($post_data['post_excerpt']); ?>
			</div>
			<?php
		}
	}

	if($side_bar != 'wide')
	{
		//postshare
		echo getPostShare(get_custom_option('set_post_info',null,$post_data['post_id']),$post_data);

		//read more
		$show_all = !isset($postinfo_buttons) || !is_array($postinfo_buttons  );
		$show_button_format = $post_data['post_format'] != 'aside' && $post_data['post_format'] != 'chat' && $post_data['post_format'] != 'link' && $post_data['post_format'] != 'quote';
		if (($show_all || in_array('more', $postinfo_buttons)) && !$post_data['post_protected'] && $show_button_format && get_custom_option('show_read_more',null,$post_data['post_id']) == 'yes') { 
		echo balanceTags('<div class="readMore">'.do_shortcode('[trx_button skin="dark" style="bg" size="big" fullsize="no" link="'.$post_data['post_link'].'" ]'.__('Read more', 'themerex').'[/trx_button]').'</div>');
		} 
	}
	else{
		//read more
		$show_all = !isset($postinfo_buttons) || !is_array($postinfo_buttons  );
		$show_button_format = $post_data['post_format'] != 'aside' && $post_data['post_format'] != 'chat' && $post_data['post_format'] != 'link' && $post_data['post_format'] != 'quote';
		if (($show_all || in_array('more', $postinfo_buttons)) && !$post_data['post_protected'] && $show_button_format && get_custom_option('show_read_more',null,$post_data['post_id']) == 'yes') { 
		echo balanceTags('<div class="readMore">'.do_shortcode('[trx_button skin="dark" style="bg" size="big" fullsize="no" link="'.$post_data['post_link'].'" ]'.__('Continue reading...', 'themerex').'[/trx_button]').'</div>');
		} 

		//postshare
		echo getPostShare(get_custom_option('set_post_info',null,$post_data['post_id']),$post_data);
	}
	//main block in full Width
	echo ($fullwidth && $streampage_columns || $layout_isotope ? '</div><!--/.sc_columns-->' : '');

	//main block
	echo ($main_div ? '</div><!-- /.main -->' : '');
	
	if (in_shortcode_blogger(true)) { ?>
		</div><?php 
	} else { //main block in full Width
		echo ($fullwidth && $streampage_columns || $layout_isotope ? '</div>' : ''); ?>
		</article>
<?php } ?>