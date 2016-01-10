<?php
/**
 * ThemeREX Shortcodes
*/

require_once( 'shortcodes_settings.php' );

 if (class_exists('WPBakeryShortCode')) {
 require_once( 'vc/shortcodes_vc.php' );
}


// ---------------------------------- [toggles / accordion] --------------------------------------- Ok

add_shortcode('trx_toggles', 'sc_toggles');

$THEMEREX_sc_toggle_counter = 0;
$THEMEREX_sc_toggle_style = 1;
$THEMEREX_sc_toggle_show_counter = false;
function sc_toggles($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"type" => "toggles",
		"style" => "4",
		"counter" => "off",
		"initial" => "1",
		"icon" => "right",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
    $counter_position = (($counter != 'off' && $icon != 'off') ? $icon == 'left' ? 'right' : 'left' : '');
    $initial = max(0, (int) $initial);
	$c = 'sc_'.$type.'_init'
		.' sc_toggl'
		.' sc_toggl_style_'.$style
		.($icon != 'off' ? ' sc_toggl_icon_show sc_toggl_icon_'.$icon : '')
		.($counter != 'off' ? ' sc_toggl_counter_show sc_toggl_counter_'.$counter_position : '');
	$s = ($top !== '' ? ' margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? ' margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? ' margin-left:'.$left.'px;' : '')
		.($right !== '' ? ' margin-right:'.$right.'px;' : '');
	global $THEMEREX_sc_toggle_counter, $THEMEREX_sc_toggle_type, $THEMEREX_sc_toggle_style,  $THEMEREX_sc_toggle_show_counter;
	$THEMEREX_sc_toggle_counter = 0;
	$THEMEREX_sc_toggle_type = $type;
	$THEMEREX_sc_toggle_style = max(1, min(3, $style));
	$THEMEREX_sc_toggle_show_counter = sc_param_is_on($counter);
	if($type == 'toggles'){
		themerex_enqueue_script('jquery-effects-slide', false, array('jquery','jquery-effects-core'), null, true);
	} else if($type == 'accordion') {
		themerex_enqueue_script('jquery-ui-accordion', false, array('jquery','jquery-ui-core'), null, true);
	}

	return '<div'.($id ? ' id="sc_'.$type.'_'.$id.'"' : '').($c!='' ? ' class="'.$c. '"' : '').($s!='' ? ' style="'.$s.'"' : '').' data-active="'.($initial-1).'" >'
			.do_shortcode($content)
			.'</div>';
}


add_shortcode('trx_toggles_item', 'sc_toggles_item');

//[trx_toggles_item]
function sc_toggles_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"title" => "",
		"open" => ""
	), $atts));
	global $THEMEREX_sc_toggle_counter, $THEMEREX_sc_toggle_show_counter, $THEMEREX_sc_toggle_type;
	$THEMEREX_sc_toggle_counter++;
	$c = ($THEMEREX_sc_toggle_counter % 2 == 1 ? ' odd' : ' even') 
		.($THEMEREX_sc_toggle_counter == 1 ? ' first' : '');
	return '<div'.($id ? ' id="sc_'.$THEMEREX_sc_toggle_type.'_'.$id.'"' : '').' class="sc_toggl_item'.(sc_param_is_on($open) && $THEMEREX_sc_toggle_type == 'toggles' ? ' sc_active' : '').$c.'">'
				. '<h4 class="sc_toggl_title">'
				. ($THEMEREX_sc_toggle_show_counter ? '<span class="sc_items_counter">'.$THEMEREX_sc_toggle_counter.'</span>' : '').$title 
				. '</h4>'
				. '<div class="sc_toggl_content"'.(sc_param_is_on($open) ? ' style="display:block;"' : ' style="display:none;"').'>' 
				. do_shortcode($content) 
				. '</div>'
			. '</div>';
}
// ---------------------------------- [/toggles / accordion] ---------------------------------------


// ---------------------------------- [br] --------------------------------------- Ok

add_shortcode("trx_br", "sc_br");

function sc_br($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"clear" => ""
    ), $atts));
	return '<br'.(in_array($clear, array('left', 'right', 'both')) ? ' clear="'.$clear.'"' : '').' />';
}
// ---------------------------------- [/br] ---------------------------------------


// ---------------------------------- [blogger] --------------------------------------- Ok

add_shortcode('trx_blogger', 'sc_blogger');

$THEMEREX_sc_blogger_busy = false;
$THEMEREX_sc_blogger_counter = 0;
function sc_blogger($atts, $content=null){	
	if (in_shortcode_blogger(true)) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "regular", //'regular','date','image_large','image_medium','image_small','image_tiny','accordion_1','accordion_2','accordion_3','list','classic','masonry','portfolio','excerpt','related'
		"filters" => "no", 
		"ids" => "", 
		"cat" => "", 
		"indent" => "yes",
		"count" => "3", 
		"visible" => "",  
		"offset" => "", 
		"orderby" => "date", 
		"order" => "desc",
		"descr" => "0",  
		"readmore" => "", 
		"location" => "default", 
		"dir" => "horizontal", 
		"scroll" => "no", 
		"rating" => "no", 
		"info" => "yes", 
		"width" => "-1", 
		"height" => "-1", 
		"top" => "", 
		"bottom" => "", 
		"left" => "", 
		"right" => "" 
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_style(  'swiperslider-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.css', array(), null );
	themerex_enqueue_script( 'swiperslider', get_template_directory_uri() . '/js/swiper/idangerous.swiper-2.1.js', array('jquery'), null, true );
	themerex_enqueue_style(  'swiperslider-scrollbar-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar.css', array(), null );
	themerex_enqueue_script( 'swiperslider-scrollbar', get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar-2.1.js', array('jquery'), null, true );
		
    $count = min(6,max(1,$count));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($width > 0 ? 'width:'.$width.$ed.';' : '')
		.($height > 0 ? 'height:'.$height.'px;' : '');

	$c = ' sc_blogger_'.($dir=='vertical' ? 'vertical' : 'horizontal')
		.' style_'.(in_array($style, array('accordion_1', 'accordion_2', 'accordion_3')) ? 'accordion' : (themerex_strpos($style, 'image')!==false ? 'image style_' : '').$style)
		.(in_array($style, array('accordion_1', 'accordion_2', 'accordion_3')) ? ' sc_toggl sc_accordion_init sc_toggl_icon_show sc_toggl_icon_right' : '')
		.($style == 'accordion_1' ? ' sc_toggl_style_1' : '')
		.($style == 'accordion_2' ? ' sc_toggl_style_2' : '')
		.($style == 'accordion_3' ? ' sc_toggl_style_3' : '')
		.(themerex_strpos($style, 'masonry')!==false || themerex_strpos($style, 'classic')!==false ? ' masonryWrap' : '')
		.(themerex_strpos($style, 'portfolio')!==false ? ' portfolioWrap' : '')
		.($style=='related' ? ' relatedPostWrap' : '')
		.($indent=='yes' ? ' sc_blogger_indent' : '');
	
	global $THEMEREX_sc_blogger_busy, $THEMEREX_sc_blogger_counter, $post;

	$THEMEREX_sc_blogger_busy = true;
	$THEMEREX_sc_blogger_counter = 0;

	if (!in_array($style, array('regular','date','image_large','image_medium','image_small','image_tiny','accordion_1','accordion_2','accordion_3','list','classic','masonry','portfolio','excerpt','related')))
		$style='regular';	
	if (!empty($ids)) {
		$posts = explode(',', str_replace(' ', '', $ids));
		$count = count($posts);
	}
	if (in_array($style, array('accordion_1', 'accordion_2', 'accordion_3', 'list')))
		$dir = 'vertical';
	if ($visible <= 0) $visible = $count;

	if (sc_param_is_on($scroll) && empty($id)) $id = 'sc_blogger_'.str_replace('.', '', mt_rand());
	
	$output = ($style=='list' ? '<ul' : '<div')
			 .($id ? ' id="sc_blogger_'.$id.'"' : '') 
			 .' class="sc_blogger'.$c.'"'
			 .($s!='' ? ' style="'.$s.'"' : '')
		.'>'
		.($dir!='vertical' &&  $count>1 ? '<div class="sc_columns_'.$visible.($indent=='yes' ? ' sc_columns_indent' : '').'">' : '')
		.(sc_param_is_on($scroll) 
			? '<div id="sc_blogger_'.$id.'_scroll" class="sc_scroll sc_scroll_'.$dir.' swiper-container scroll-container"'
				.' style="'.($dir=='vertical' ? 'height:'.($height > 0 ? $height : "230").'px;' : 'width:'.($width > 0 ? $width.'px;' : "100%;")).'"'
				.'>'
				.'<div class="sc_scroll_wrapper swiper-wrapper">' 
			: '');
	if (themerex_strpos($style, 'masonry')!==false || themerex_strpos($style, 'classic')!==false) {
		$output .= '<section class="masonry '.(sc_param_is_on($filters) ? 'isotope' : 'isotopeNOamin').'" data-columns="'.themerex_substr($style, -1).'">';
	}

	$args = array(
		'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish',
		'posts_per_page' => $count,
		'ignore_sticky_posts' => 1,
		'order' => $order=='asc' ? 'asc' : 'desc',
		'orderby' => 'date',
	);

	if ($offset > 0 && empty($ids)) {
		$args['offset'] = $offset;
	}

	$args = addSortOrderInQuery($args, $orderby, $order);
	$args = addPostsAndCatsInQuery($args, $ids, $cat);

	$query = new WP_Query( $args );

	while ( $query->have_posts() ) { $query->the_post();

		$THEMEREX_sc_blogger_counter++;

		$output .= showPostLayout(
			array(
				'layout' => in_array(themerex_substr($style, 0, 7), array('classic', 'masonry', 'portfol', 'excerpt', 'related')) ? themerex_substr($style, 0, 7) : 'blogger',
				'show' => false,
				'number' => $THEMEREX_sc_blogger_counter,
				'add_view_more' => false,
				'posts_on_page' => $count,
				"reviews" => sc_param_is_on($rating),
				'thumb_size' => $style,
				'thumb_crop' => themerex_strpos($style, 'masonry')===false,
				'strip_teaser' => false,
				// Additional options to layout generator
				"location" => $location,
				"descr" => $descr,
				"readmore" => $readmore,
				"dir" => $dir,
				"scroll" => sc_param_is_on($scroll),
				"info" => sc_param_is_on($info),
				"orderby" => $orderby,
				"posts_visible" => $visible,
				"categories_list" => in_array($style, array('excerpt')),
				"tags_list" => false
			)
		);

	}

	wp_reset_postdata();

	if (themerex_strpos($style, 'masonry')!==false || themerex_strpos($style, 'classic')!==false) {
		$output .= '</section>';
	}
	$output	.= (sc_param_is_on($scroll) ? '</div><div id="'.$id.'_scroll_bar" class="sc_scroll_bar sc_scroll_bar_'.$dir.' '.$id.'_scroll_bar"></div></div>' : '')
		. ($dir!='vertical' ? '</div>' : '')
		. ($style == 'list' ? '</ul>' : '</div>');
	if (in_array($style, array('accordion_1', 'accordion_2'))) {
		themerex_enqueue_script('jquery-ui-accordion', false, array('jquery','jquery-ui-core'), null, true);
	}
	
	$THEMEREX_sc_blogger_busy = false;
	
	return $output;
}

function in_shortcode_blogger($from_blogger = false) {
	if (!$from_blogger) return false;
	global $THEMEREX_sc_blogger_busy;
	return $THEMEREX_sc_blogger_busy;
}
// ---------------------------------- [/blogger] ---------------------------------------


// ---------------------------------- [button] --------------------------------------- Ok

add_shortcode('trx_button', 'sc_button');

function sc_button($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"skin" => "dark", //global, dark
		"style" => "regular", //regular, shadow, line
		"size" => "medium", //medium, mini, big
		"title" => "", 
		"fullsize" => "0", 
		"icon" => "", 
		"background" => "", 
		"color" => "", 
		"link" => "", 
		"target" => "", 
		"align" => "", 
		"rel" => "", 
		"popup" => "no", 
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_style(  'magnific-style', get_template_directory_uri() . '/js/magnific-popup/magnific-popup.css', array(), null );
	themerex_enqueue_script( 'magnific', get_template_directory_uri() . '/js/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), null, true );
		
    $s = ($background !== '' ? ' background-color:'.$background.';' : '')
    	.($color !== '' ? ' color:'.$color.';' : '')
    	.($top !== '' ? ' margin-top:'.$top.'px;' : '')
		.($left !== '' ? ' margin-left:'.$left.'px;' : '')
		.($bottom !== '' ? ' margin-bottom:'.$bottom.'px;' : '')
		.($right !== '' ? ' margin-right:'.$right.'px;' : '')
		.($width !== '' ? ' width:'.$width.'px;' : '')
    	.($height !== '' ? ' height:'.$height.'px;' : '');
    $style_batton = $s ? ' style="'.$s.'" ': '';

    $c = ($skin = ' sc_button_skin_'.$skin)
    	.($style = ' sc_button_style_'.$style)
    	.($size = ' sc_button_size_'.$size)
    	.($align && $align!='none' ? ' align_'.$align : '')
    	.(sc_param_is_on($fullsize) ? ' sc_button_full_size' : '')
    	.(sc_param_is_on($popup) ? ' user-popup-link' : '')
    	.($icon!='' ? ' ico '.$icon : '')
    	.(do_shortcode($content) !== '' ? '' : ' no_content');
    $class_batton = $c ? ' class="sc_button '.$c.'" ' : '';


    return ($align == 'center' ? '<div class="sc_button_wrap">' : '').'<a'.($id ? ' id="'.$id.'"' : '').($title ? ' title="'.$title.'"' : '').' href="'.(empty($link) ? '#' : ($popup == 'yes' ? '#sc_popup_'.$link : $link)).'" '.$style_batton.$class_batton.(sc_param_is_on($target) ? ' target="_blank"' : '').(!empty($rel) ? ' rel="'. $rel.'"' : '').'>'.do_shortcode($content).'</a>'.($align == 'center' ? '</div>' : '');

}

// ---------------------------------- [/button] ---------------------------------------


// ---------------------------------- [chat] -------------------------------------- Ok

add_shortcode('trx_chat', 'sc_chat'); 

function sc_chat($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"link" => "",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($width > 0 ? 'width:'.$width.$ed.';' : '')
		.($height > 0 ? 'height:'.$height.'px;' : '')
		;
	$title = $title=='' ? $link : $title;
	$content = do_shortcode($content);
	if (themerex_substr($content, 0, 2)!='<p') $content = '<p>'.$content.'</p>';
	return '<div'.($id ? ' id="sc_chat_'.$id.'"' : '').' class="sc_chat"'.($s ? ' style="'.$s.'"' : '').'>'
		.($title == '' ? '' : ('<div class="sc_quote_title">'.($link!='' ? '<a href="'.$link.'">' : '').$title.':'.($link!='' ? '</a>' : '').'</div>'))
		.'<div class="sc_chat_content">'.$content.'</div>'
		.'</div>';
}
// ---------------------------------- [/chat] ---------------------------------------


// ---------------------------------- [columns] --------------------------------------- Ok

add_shortcode('trx_columns', 'sc_columns');

function sc_columns($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"columns" => "1",
		"indent" => "yes",
		"class" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

	global $THEMEREX_sc_columns, $THEMEREX_sc_columns_count, $THEMEREX_sc_columns_prefix, $THEMEREX_sc_columns_after;

    $prefix = ' sc_columns';
    $columns = max(1, min(12, (int) $columns));
    $THEMEREX_sc_columns = $columns;
    $THEMEREX_sc_columns_count = 1;
    $THEMEREX_sc_columns_after = '';
    $THEMEREX_sc_columns_prefix = $prefix;

	$s = ($top !== '' ? ' margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? ' margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? ' margin-left:' . $left . 'px;' : '')
		.($right !== '' ? ' margin-right:' . $right . 'px;' : '');

	$c = ($prefix.'_'.$columns)
		.($indent === 'yes' ? $prefix.'_indent' : '');

	return '<div'.($id ? ' id="'.$prefix.'_'.$id.'"' : '').' class="'.$prefix.' '.$class.' '.$c.'"'.($s!='' ? ' style="'.$s.'"' : '').'>'.do_shortcode($content).'</div>';
}


add_shortcode('trx_column_item', 'sc_column_item');

function sc_column_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"colspan" => "1"
	), $atts));
	global $THEMEREX_sc_columns, $THEMEREX_sc_columns_count, $THEMEREX_sc_columns_prefix, $THEMEREX_sc_columns_after;
	$prefix = $THEMEREX_sc_columns_prefix;
	$colspan = max(1, min(11, (int) $colspan));
	$c = ($prefix.'_item_coun_'.$THEMEREX_sc_columns_count)
		.($colspan > 1 ? ' colspan_'.$colspan : '')
		.(!empty($THEMEREX_sc_columns_after) ? $THEMEREX_sc_columns_after : '' )
		.($THEMEREX_sc_columns_count % 2 == 1 ? ' odd' : ' even')
		.($THEMEREX_sc_columns_count == 1 ? ' first' : '');
	
	$THEMEREX_sc_columns_count += 1 ;
	$THEMEREX_sc_columns_after = $colspan > 1 ? ' colspan_'.$colspan.'_after' : '';

	return '<div'.($id ? ' id="'.$prefix.'_item_'.$id.'"' : '').' class="'.$prefix.'_item '.$c.'">'.do_shortcode($content).'</div>';

}

// ---------------------------------- [/columns] ---------------------------------------


// ---------------------------------- [Contact form] --------------------------------------- Ok

add_shortcode('trx_contact_form', 'sc_contact_form');

function sc_contact_form($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"description" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		;
	themerex_enqueue_script( 'form-contact', get_template_directory_uri().'/js/_form_contact.js', array('jquery'), null, true );
	global $THEMEREX_ajax_nonce, $THEMEREX_ajax_url;
	return '<div '.($id ? ' id="sc_contact_form_'.$id.'"' : '').'class="sc_form" data-formtype="contact" '.($s!='' ? ' style="'.$s.'"' : '') .'>'
			.($title ? '<h3 class="title">'.$title.'</h3>' : '')
			.($description ? '<div class="sc_form_description">'.$description.'</div>' : '')
			.'<form'.($id ? ' id="'.$id.'"' : '').' method="post" action="'.$THEMEREX_ajax_url.'">'
				.'<div class="sc_columns_2 sc_columns_indent">'
					.'<div class="sc_columns_item sc_form_username">' 
						.'<input id="sc_form_contact_username" type="text" name="username" placeholder="'.__('Name', 'themerex').'">'
					.'</div>'
					.'<div class="sc_columns_item sc_form_email">'
						.'<input id="sc_form_contact_email" type="text" name="email" placeholder="'.__('E-mail', 'themerex').'">'
					.'</div>'
				.'</div>'
				.'<div class="sc_columns_item sc_form_subj">'
					.'<input id="sc_form_contact_subj" type="text" name="subject" placeholder="'.__('Subject', 'themerex').'">'
				.'</div>'
				.'<div class="sc_form_message">'
					.'<textarea id="sc_form_contact_message" class="textAreaSize" name="message" placeholder="'.__('Your Message', 'themerex').'"></textarea>'
				.'</div>'
				.'<div class="sc_form_button">'
					.do_shortcode('[trx_button skin="global" style="regular" link="#" size="big" fullsize="no" target="no" popup="no"]'.__('Send Message', 'themerex').'[/trx_button]')
				.'</div>'
				.'<div class="sc_result sc_infobox sc_infobox_closeable"></div>'
			.'</form>'
		.'</div>';
}
// ---------------------------------- [/Contact form] ---------------------------------------



// ---------------------------------- [Contact info] --------------------------------------- Ok

add_shortcode('trx_contact_info', 'sc_contact_info');

function sc_contact_info($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"description" => "",
		"contact_list" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '');

    $contact_list = get_theme_option('contact_address_1')
    				.'?'.get_theme_option('contact_address_2')
    				.'?'.get_theme_option('contact_phone_1')
    				.'?'.get_theme_option('contact_phone_2')
    				.'?'.get_theme_option('contact_fax')
    				.'?'.get_theme_option('contact_website')
    				.'?'.get_theme_option('contact_email');

 	$contact_list  = explode('?', $contact_list);

 	$list_title = array('Address', 'Address', 'Phone', 'Phone', 'Fax', 'Website', 'Email');

 	$list_data = '';
 	$S = 0;
	foreach ( $contact_list as $contact_lists  ) {
		if($contact_lists != ''){
			$list_data .= '<div class="sc_contact_info_item sc_contact_'.$contact_lists.'">
						   <div class="sc_contact_info_lable"><span class="sc_contact_info_name">'.$list_title[$S].':</span> '.$contact_lists.'</div>'
						   .get_theme_option('contact_'.$contact_lists).'</div>';
		}
		$S++;
	}

	return '<div '.($id ? ' id="sc_contact_info_'.$id.'"' : '').'class="sc_contact_info" '.($s!='' ? ' style="'.$s.'"' : '') .'>'
			.($title ? '<h3 class="sc_contact_info_title">'.$title.'</h3>' : '')
			.($description ? '<div class="sc_contact_info_description">'.$description.'</div>' : '')
			.'<div class="sc_contact_info_wrap">'.$list_data.'</div>'
		.'</div>';
}
// ---------------------------------- [/Contact info] ---------------------------------------


// ---------------------------------- [Countdown] ---------------------------------------Ok

add_shortcode('trx_countdown', 'sc_countdown');

function sc_countdown($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"date" => "",
		"time" => "",
		"style" => "round", //flip,round
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($width > 0 ? 'width:'.$width.$ed.';' : '')
		.($height > 0 ? 'height:'.$height.'px;' : '');
	$c = ($style == 'flip' ? ' sc_countdown_flip' : ' sc_countdown_round');

	if($style == 'flip'){
		themerex_enqueue_style(  'flipclock-style', get_template_directory_uri().'/js/flipclock/flipclock.css', array(), null );
		themerex_enqueue_script( 'flipclock', get_template_directory_uri().'/js/flipclock/flipclock.custom.js', array(), null, true );
	} else {
		themerex_enqueue_script( 'countdown-plugin', get_template_directory_uri().'/js/countdown/jquery.countdown-plugin.js', array(), null, true );
		themerex_enqueue_script( 'countdown', get_template_directory_uri().'/js/countdown/jquery.countdown.js', array(), null, true );
		
	}

	return '<div '.($id ? ' id="sc_countdown_'.$id.'"' : '').'class="sc_countdown'.$c.'"'.($s ? ' style="'.$s.'"' : '').'><div class="sc_countdown_counter" data-style="'.($style == 'flip' ? 'flip' : 'round').'" data-date="'.$date.'" data-time="'.$time.'"></div></div>';
}
// ---------------------------------- [/Countdown] ---------------------------------------


// ---------------------------------- [dropcaps] ---------------------------------------Ok

add_shortcode('trx_dropcaps', 'sc_dropcaps');

function sc_dropcaps($atts, $content=null){
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '');		

	$style = min(4, max(1, $style));
	$content = do_shortcode($content);
	return '<p'.($id ? ' id="sc_dropcaps_'.$id.'"' : '').' class="sc_dropcaps sc_dropcaps_style_'.$style.'" '.($s ? ' style="'.$s.'"' : '').'>' 
			.'<span class="sc_dropcap">'.themerex_substr($content, 0, 1).'</span>'.themerex_substr($content, 1)
			.'</p>';
}
// ---------------------------------- [/dropcaps] ---------------------------------------


// ---------------------------------- [E-mail collector] ---------------------------------------Ok

add_shortcode('trx_emailer', 'sc_emailer');

function sc_emailer($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"group" => "",
		"align" => "",
		"top" => "",
		"open" => "no",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '');

	return '<div '.($id ? ' id="sc_emailer_'.$id.'"' : '').' class="sc_emailer '.($align && $align!='none' ? ' sc_align_'.$align : '').'">'
			.'<form class="sc_eform_form '.(sc_param_is_on($open) ? ' sc_eform_opened sc_eform_show' : ' sc_eform_hide').'" data-type="emailer">'
			.'<a href="#" class="sc_eform_button sc_button sc_button_skin_dark sc_button_style_bg sc_button_size_medium ico icon-mail no_content" title="'.__('Submit', 'themerex').'" data-group="'.($group ? $group : __('E-mail collector group', 'themerex')).'"></a>'
			.'<div class="sc_eform_wrap"><input type="text" class="sc_eform_input" name="email" value="" placeholder="'.__('Please, enter you email address.', 'themerex').'"></div>'
			.'</form></div>';
}
// ---------------------------------- [/E-mail collector] ---------------------------------------



// ---------------------------------- [Search collector] ---------------------------------------Ok

add_shortcode('trx_search', 'sc_searchform');

function sc_searchform($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"align" => "",
		"top" => "",
		"open" => "no",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "",
		"height" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '');


	return '<div '.($id ? ' id="sc_searchform_'.$id.'"' : '').' class="sc_searchform '.($align && $align!='none' ? ' sc_align_'.$align : '').'"'.($s!='' ? ' style="'.$s.'"' : '').'>'
			.'<form class="sc_eform_form '.(sc_param_is_on($open) ? ' sc_eform_opened sc_eform_show' : ' sc_eform_hide').'" data-type="search"  action="'.home_url().'" method="get">'
			.'<a href="#" class="sc_eform_button sc_button sc_button_skin_dark sc_button_style_bg sc_button_size_medium ico " title="'.__('Submit', 'themerex').'">'.__('Submit', 'themerex').'</a>'
			.'<div class="sc_eform_wrap"><input type="text" class="sc_eform_input" name="s" value="" placeholder="'.__('Subscribe to get notified when we launch', 'themerex').'"></div>'
			.'</form></div>';
}
// ---------------------------------- [/Search collector] ---------------------------------------




// --------------------- [Gallery] - only filter, not shortcode ------------------------

add_filter('post_gallery', 'sc_gallery_filter', 10, 2);

function sc_gallery_filter($prm1, $atts) {
	if ( in_shortcode_blogger() ) return ' ';
	if ( get_custom_option('substitute_gallery', null,  get_the_ID()) =='no') return '';
	extract(shortcode_atts(array(
		"columns" => 0,
		"order" => "asc",
		"orderby" => "",
		"link" => "attachment",
		"include" => "",
		"exclude" => "",
		"ids" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "",
		"height" => ""
    ), $atts));

	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '')
		.($height > 0 ? 'height:' . $height . 'px;' : '');

	$post = get_post();

	static $instance = 0;
	$instance++;
	
	$post_id = $post ? $post->ID : 0;
	
	if (empty($orderby)) $orderby = 'post__in';
	else $orderby = sanitize_sql_orderby( $orderby );

	if ( !empty($include) ) {
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$attachments = get_children( array('post_parent' => $post_id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $post_id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if (empty($columns) || $columns<2)
		$columns = count($attachments);

	$thumb_columns = max(2, min(4, intval($columns)));

	$thumb_sizes = getThumbSizes(array(
		'thumb_size' => getThumbColumns('cub',$thumb_columns),
		'thumb_crop' => true,
		'sidebar' => false
	));
	
	

	$output = '<div id="sc_gallery_'.$instance.'" class="sc_gallery sc_columns_'.$columns.'" '.($s ? ' style="'.$s.'"' : '').'>';
	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$thumb = getResizedImageTag(-$id, $thumb_sizes['w'], $thumb_sizes['h']);
		$full = wp_get_attachment_url($id);
		$url = $link!='file' ? get_permalink($id) : esc_attr($full);
		$post_name = esc_attr($attachment->post_excerpt);
		//crop a title
		if(strlen($post_name) > 40) $post_name = substr($post_name, 0, 40).' ...';

		$output .= '
			<div class="sc_columns_item sc_gallery_item">
				<div class="thumb">'.$thumb.'</div>
				<a class="sc_gallery_info_wrap" href="'.$url.'" data-image="'.esc_attr($full).'" title="'.esc_attr($attachment->post_excerpt).'">
					<span class="sc_gallery_info">'
						.(esc_attr($attachment->post_excerpt)!='' ? '<h4>'.$post_name.'</h4>' : '')
						.'<span class="sc_gallery_href '.($link=='file' ? 'icon-search' : 'icon-link').'"></span>
					</span>
				</a>
			</div>';
	}
	$output .= '</div>';

	return $output;
	
}
// ---------------------------------- [/Gallery] ---------------------------------------


// ---------------------------------- [Google maps] ---------------------------------------Ok

add_shortcode('trx_googlemap', 'sc_google_map');

function sc_google_map($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"width" => "100%",
		"height" => "300",
		"address" => "San Francisco, CA 94102, US",
		"latlng" => "",
		"scroll" => "no",
		"zoom" => 10,
		"style" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	if ((int) $width < 100 && $ed != '%') $width='100%';
	if ((int) $height < 50) $height='100';
	$width = (int) str_replace('%', '', $width);

	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($width >= 0 ? 'width:'.$width.$ed.';' : '')
		.($height >= 0 ? 'height:'.$height.'px;' : '');

	themerex_enqueue_script( 'googlemap', 'http://maps.google.com/maps/api/js?sensor=false', array(), null, true );
	themerex_enqueue_script( 'googlemap_init', get_template_directory_uri().'/js/_googlemap_init.js', array(), null, true );

	return '<div id="sc_googlemap_'.($id != '' ? $id : mt_rand(0, 1000)).'" class="sc_googlemap"'.($s!='' ? ' style="'.$s.'"' : '') 
		.' data-address="'.esc_attr($address).'"'
		.' data-latlng="'.esc_attr($latlng).'"'
		.' data-zoom="'.esc_attr($zoom).'"'
		.' data-style="'.esc_attr($style).'"'
		.' data-scroll="'.esc_attr($scroll).'"'
		.' data-point="'.esc_attr(get_custom_option('googlemap_marker')).'"'
		.'></div>';
}
// ---------------------------------- [/Google maps] ---------------------------------------


// ---------------------------------- [hide] ---------------------------------------Ok

add_shortcode('trx_hide', 'sc_hide');

function sc_hide($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"selector" => ""
    ), $atts));
	$selector = trim(chop($selector));
	return $selector == '' ? '' : 
		'<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery("'.$selector.'").hide();
			});
		</script>';
}
// ---------------------------------- [/hide] ---------------------------------------



// ---------------------------------- [highlight] ---------------------------------------Ok

add_shortcode('trx_highlight', 'sc_highlight');

function sc_highlight($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"color" => "",
		"backcolor" => "",
		"style" => "",
		"type" => "", //1,2,3,4
		"tooltip" => "", 
		"link" => ""
    ), $atts));
	$s = ($color != '' ? 'color:'.$color.';' : '')
		.($backcolor != '' ? 'background-color:'.$backcolor.';' : '')
		.($style != '' ? $style : '');
	
	return '<span'.($id ? ' id="sc_highlight_'.$id.'"' : '').' class="sc_highlight'.($type!='' ? ' sc_highlight_style_'.$type : '').'"  ' .($s!='' ? ' style="'.$s.'"' : '').'>'.($link != '' ? '<a href="'.$link.'">'.do_shortcode($content).'</a>' : ''.do_shortcode($content).'').'</span>';
}
// ---------------------------------- [/highlight] ---------------------------------------

// ---------------------------------- [image] ---------------------------------------Ok

add_shortcode('trx_image', 'sc_image');

function sc_image($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"src" => "",
		"url" => "",
		"title" => "",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "",
		"height" => ""
    ), $atts));

    if($url > 0) $url = getAttachmentID($url);
    
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$image = $image_full = $src!='' ? $src : $url;
	$no_crop = getThumbSizes(array(
				'thumb_size' => 'image_large',
				'thumb_crop' => true,
				'sidebar' => false ));
	$crop = array(
		"w" => $width != '' && $ed != '%' ? $width : $no_crop['w'],
		"h" => $height != '' && $ed != '%' ? $height : null
		);
	$src = getResizedImageURL($image, $crop['w'], $crop['h']);


	
	

	$s = ($top !=='' ? 'margin-top:' . $top . 'px !important;' : '')
		.($bottom !=='' ? 'margin-bottom:' . $bottom . 'px !important;' : '')
		.($left !=='' ? 'margin-left:' . $left . 'px !important;' : '')
		.($right !=='' ? 'margin-right:' . $right . 'px !important;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '')
		.($height > 0  ? 'height:' . $height . 'px;' : '');

	return '<div '.($id ? ' id="sc_image_'.$id.'"' : '').($s!='' ? ' style="'.$s.'"' : '').' class="sc_image '.($align != 'none' ? 'align'.$align : '').'">
				 '.($url != 'none' ? '<a href="'.$image_full.'"><img  src="'.$image.'" alt="'.($title != '' ? $title : '' ).'" /></a>' : '<img  src="'.$image.'" alt="'.($title != '' ? $title : '' ).'" />')
				  .($title != '' ? '<div class="sc_image_caption">'.$title.'</div>' : '' )
				  .'</div>';

}

// ---------------------------------- [/image] ---------------------------------------


// ---------------------------------- [infobox] ---------------------------------------Ok

add_shortcode('trx_infobox', 'sc_infobox');

function sc_infobox($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "regular", //regular, info, Notice, Warning, Success
		"title" => "",
		"closeable" => "no",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"dir" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '');
	$c = ('sc_infobox_style_'.$style)
		.(sc_param_is_on($closeable) ? ' sc_infobox_closeable' : '')
		.(sc_param_is_on($title) ? ' sc_infobox_title_show' : '');
	$d = ($dir == 'horizontal' ?' sc_infobox_horizontal' : '');

	return '<div'.($id ? ' id="sc_infobox_'.$id.'"' : '').' class="sc_infobox '.$c.''.$d.'"'.($s!='' ? ' style="'.$s.'"' : '').'>'
		.($title !== "" ? '<h4 class="sc_infobox_title">'.$title.'</h4><span class="sc_infobox_line"></span>' : '')
		.'<span class="sc_infobox_content">'.do_shortcode($content)
		.'</span></div>';
}

// ---------------------------------- [/infobox] ---------------------------------------


// ---------------------------------- [line] ---------------------------------------Ok

add_shortcode('trx_line', 'sc_line');

function sc_line($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "solid",
		"color" => "",
		"width" => "-1",
		"height" => "-1",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($width >= 0 ? 'max-width:' . $width . $ed . ';' : '')
		.($height >= 0 ? 'border-bottom-width:' . $height . 'px;' : '')
		.($style != '' ? 'border-bottom-style:' . $style . ';' : '')
		.($color != '' ? 'border-bottom-color:' . $color . ';' : '');

	$c = ($style != '' ? ' sc_line_style_'.$style : '')
		.($align != '' ? ' sc_line_align_'.$align : '');


	return '<div'.($id ? ' id="sc_line_'.$id.'"' : '').' class="sc_line '.$c.'"'.($s!='' ? ' style="'.$s.'"' : '').'></div>';
}

// ---------------------------------- [/line] ---------------------------------------


// ---------------------------------- [list] ---------------------------------------Ok

add_shortcode('trx_list', 'sc_list');

$THEMEREX_sc_list_icon = '';
$THEMEREX_sc_list_style = '';
$THEMEREX_sc_list_counter = 0;
function sc_list($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "ul",
		"marked" => "no",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

	global $THEMEREX_sc_list_counter, $THEMEREX_sc_list_icon, $THEMEREX_sc_list_style, $THEMEREX_sc_list_marked;
	$icon='';
	if($style == 'iconed')
	{
	 	$icon = 'icon-right-open-micro';
	}

	$THEMEREX_sc_list_counter = 0;
	$THEMEREX_sc_list_icon = $icon;
	$THEMEREX_sc_list_style = $style;
	$THEMEREX_sc_list_marked = $marked == 'yes';

	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '');
	$c = ($marked != 'no' ? ' sc_list_marked_'.$marked : '')
		.($style !== '' ? ' sc_list_style_'.$style : '');

	return '<'.($style=='ol' ? 'ol' : 'ul').($id ? ' id="sc_list_'.$id.'"' : '').' class="sc_list '.$c.'" '.($s!='' ? ' style="'.$s.'"' : '').'>'
			.do_shortcode($content) 
			.'</'.($style=='ol' ? 'ol' : 'ul').'>';
}


add_shortcode('trx_list_item', 'sc_list_item');

//[trx_list_item]

function sc_list_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"marked" => "no",
		"icon" => "",
		"color" => "",
		"title" => ""
	), $atts));
	global $THEMEREX_sc_list_counter, $THEMEREX_sc_list_icon, $THEMEREX_sc_list_style, $THEMEREX_sc_list_marked;
	$THEMEREX_sc_list_counter++;
	$icon = $icon != '' ? $icon : $THEMEREX_sc_list_icon ;
	$c = ($icon!='' ? 'ico '.$icon : '') 
		.($THEMEREX_sc_list_counter % 2 == 1 ? ' odd' : ' even') 
		.($THEMEREX_sc_list_counter == 1 ? ' first' : '')
		.($marked != '' ? ' sc_list_marked_'.$marked : '');

	return '<li'.($id ? ' id="sc_list_item_'.$id.'"' : '').' class="sc_list_item '.$c.'"'.($title ? ' title="'.$title.'"' : '').'>' 
		.do_shortcode($content)
		.'</li>';
}

// ---------------------------------- [/list] ---------------------------------------


// ---------------------------------- [popup] --------------------------------------- Ok

add_shortcode('trx_popup', 'sc_popup');

function sc_popup($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
		"style" => "",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_style(  'magnific-style', get_template_directory_uri() . '/js/magnific-popup/magnific-popup.css', array(), null );
	themerex_enqueue_script( 'magnific', get_template_directory_uri() . '/js/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), null, true );
	
    $ed_w = themerex_substr($width, -1)=='%' ? '%' : 'px';
    $ed_h = themerex_substr($height, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$height = (int) str_replace('%', '', $height);
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($width > 0 ? 'width:'.$width.$ed_w.'; max-width:'.$width.$ed_w.';' : '')
		.($height > 0 ? 'height:'.$height.$ed_h.'; max-height:'.$height.$ed_h.';' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.$style;
	return '<div' . ($id ? ' id="sc_popup_'.$id.'"' : '').' class="sc_popup sc_popup_light mfp-with-anim mfp-hide'.($class ? ' '.$class : '').'"'.($s!='' ? ' style="'.$s.'"' : '').'>' 
			.do_shortcode($content) 
			.'</div>';
}

// ---------------------------------- [/popup] ---------------------------------------


// ---------------------------------- [price] ---------------------------------------Ok

add_shortcode('trx_price', 'sc_price');

function sc_price($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"money" => "",
		"currency" => "$",
		"period" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$output = '';
	if (!empty($money)) {
		$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
			.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
			.($left !== '' ? 'margin-left:'.$left.'px;' : '')
			.($right !== '' ? 'margin-right:'.$right.'px;' : '');
		$m = explode('.', str_replace(',', '.', $money));
		if (count($m)==1) $m[1] = '';
		$output = '
			<div '.($id ? ' id="sc_price_'.$id.'"' : '').' class="sc_price_item"'.($s != '' ? ' style="'.$s.'"' : '').'>
				<span class="sc_price_currency">'.$currency.'</span>
				<span class="sc_price_money">'.$m[0].'</span>
				<span class="sc_price_penny">.'.$m[1].'</span>
				<span class="sc_price_period">'.$period.'</span>
			</div>
		';
	}
	return $output;
}

// ---------------------------------- [/price] ---------------------------------------



// ---------------------------------- [price_table] ---------------------------------------Ok

add_shortcode('trx_price_table', 'sc_price_table');

$THEMEREX_sc_price_table_columns = 0;
function sc_price_table($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"align" => "",
		"count" => 1,
		"style" => "1",
		"color" => "green", //regular, blue
		"indent" => "no",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($width !== '' ? 'width:'.$width.'px;' : '');

	$c = ($align && $align!='none' ? ' sc_align_'.themerex_strtoproper($align) : '')
		.($style != '' ? ' sc_pricing_table_style_'.$style : ' sc_pricing_table_style_1');

	global $THEMEREX_sc_price_table_columns;
	$THEMEREX_sc_price_table_columns = $count = max(1, min(12,$count));
	return '<div'.($id ? ' id="sc_price_table_'.$id.'"' : '').' class="sc_pricing_table_'.$color.' sc_pricing_table'.$c.'"'.($s != '' ? ' style="'.$s.'"' : '').'>'
			.'<div class="sc_columns_'.($count).($indent == 'yes' ? ' sc_columns_indent' : '').'">'
			.do_shortcode($content)
			.'</div>'
		.'</div>';
}


add_shortcode('trx_price_item', 'sc_price_item');

//[trx_price_item]
function sc_price_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"animation" => "yes"
	), $atts));
	return '<div class="sc_pricing_item sc_columns_item"><ul'.(sc_param_is_on($animation) ? ' class="sc_columns_animate"' : '').($id ? ' id="'.$id.'"' : '') . '>'
		.do_shortcode($content) 
		.'</ul></div>';
}


add_shortcode('trx_price_data', 'sc_price_data');

//[trx_price_data]
function sc_price_data($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"type" => "",
		"image" => "",
		"money" => "",
		"currency" => "$",
		"period" => ""
	), $atts));

	global $THEMEREX_sc_price_table_columns;

	if (!in_array($type, array('title', 'price', 'footer', 'united', 'image'))) $type="";
	if ($type=='price' && $money!='') {
		$m = explode('.', str_replace(',', '.', $money));
		if (count($m)==1) $m[1] = '';
		$content = '
			<div class="sc_price_item">
				<span class="sc_price_currency">'.$currency.'</span>
				<span class="sc_price_money">'.$m[0].'</span>
				<span class="sc_price_penny">.'.$m[1].'</span>
				<span class="sc_price_period">/'.$period.'</span>
			</div>
		';
	} else if ($type=='image' && $image!='') {
		//image crop
		$columns = max(1, min(4, $THEMEREX_sc_price_table_columns ));
		$crop = getThumbSizes(array(
				'thumb_size' => getThumbColumns('cub',$columns),
				'thumb_crop' => true,
				'sidebar' => false ));
		$image = getAttachmentID($image);
		$image = getResizedImageURL($image, $crop['w'], $crop['h']);

		$type = 'title_img';
		$content = '<div class="image" style="background-image: url('.$image.');" border="0"></div>';
	} else {
		$content = do_shortcode($content);
	}
	$c = ($type!='' ? ' sc_pricing_'.$type : '');
	return '<li'.($id ? ' id="sc_price_data_'.$id.'"' : '').' class="sc_pricing_data'.$c.'">'.$content.'</li>';
}

// ---------------------------------- [/price_table] ---------------------------------------


// ---------------------------------- [table] ---------------------------------------Ok

add_shortcode('trx_table', 'sc_table');

function sc_table($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1",
		"align" => "center",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? ' margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? ' margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? ' margin-left:'.$left.'px;' : '')
		.($right !== '' ? ' margin-right:'.$right.'px;' : '');

	$c = ($style !== '' ? ' sc_table_style_'.$style : '') 
		.($align !== '' ? ' sc_table_align_'.$align : '');

	$content = str_replace(
				array('<p><table', 'table></p>', '><br />'),
				array('<table', 'table>', '>'),
				html_entity_decode($content, ENT_COMPAT, 'UTF-8'));
	return '<div'.($id ? ' id="sc_table_'.$id.'"' : '').' class="sc_table '.$c.'"'.($s!='' ? ' style="'.$s.'"' : '') .'>' 
			. do_shortcode($content) 
			. '</div>';
}

// ---------------------------------- [/table] ---------------------------------------


// ---------------------------------- [quote] --------------------------------------- Ok

add_shortcode('trx_quote', 'sc_quote');

function sc_quote($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"author" => "",
		"link" => "",
		"years" => "",
		"style" => "",
		"image" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => ""
    ), $atts));

    $s = ($width >= 0 ? 'width:'.$width.'px; ' : '')
		.($top !== '' ? 'margin-top:'.$top.'px; ' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px; ' : '')
		.($left !== '' ? 'margin-left:'.$left.'px; ' : '')
		.($right !== '' ? 'margin-right:'.$right.'px; ' : '');
	$image = getAttachmentID($image);
	$content = do_shortcode($content);
	$quote = '';
	if($style == '' || $style == '1') $quote = '<div class="icon"></div>';
	if($style == '2') $quote = '<div class="icon-quote"></div>';
	if (themerex_substr($content, 0, 2)!='<p') $content = '<p>'.$content.'</p>';
	return '<blockquote'.($id ? ' id="sc_quote_'.$id.'"' : '').' class="sc_quote '.($style != '' ? 'sc_quote_style'.($style).'' : '').'" style="'.$s.'">'
		. $quote
		. $content
		. ($image != '' && $style == '2' ? '<div class="sc_quote_image"><img src="'.$image.'" alt=""></div>' : '')
		. ($author != '' ?  ('<div class="sc_quote_title">'.($link!='' ? '<a href="'.$link.'">' : '').($style == '' ? '- ' : '').$author.($link!='' ? '</a>'
		. ($years != '' && $style == '2' ? '<a href="'.$link.'">'.$years.'</a>' : '').'' : '').'</div>') : '')
		.'</blockquote>';
}

// ---------------------------------- [/quote] ---------------------------------------


// ---------------------------------- [trx_content] ---------------------------------------Ok

add_shortcode('trx_content', 'sc_content'); 

function sc_content($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
		"style" => "",
		"top" => "",
		"bottom" => "", 
		"align" => "left",
		"width" => ""
    ), $atts));

	$s = ($top !== '' ? ' margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? ' margin-bottom:'.$bottom.'px;' : '')
		.($width !== '' ? ' max-width:'.$width.'px;' : '')
		.($align !== '' ? 'text-align:'.$align.';' : '')
		.$style;

	$output = '<div' . ($id ? ' id="' . $id . '"' : '') 
		. ' class="sc_content main' . ($class ? ' ' . $class : '') . '"'
		. ($s!='' ? ' style="'.$s.'"' : '').'>' 
		. do_shortcode($content) 
		. '</div>';

	return $output;
}
// ---------------------------------- [/trx_content] ---------------------------------------


// ---------------------------------- [section] and [block] ---------------------------------------Ok

add_shortcode('trx_section', 'sc_section');
add_shortcode('trx_block', 'sc_section');

$THEMEREX_sc_section_dedicated = '';

function sc_section($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
		"style" => "",
		"align" => "none",
		"columns" => "none",
		"dedicated" => "no",
		"scroll" => "no",
		"dir" => "horizontal",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"link" => "",
		"background" => "",
		"src" => "",
		"padding" => ""
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_style(  'swiperslider-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.css', array(), null );
	themerex_enqueue_script( 'swiperslider', get_template_directory_uri() . '/js/swiper/idangerous.swiper-2.1.js', array('jquery'), null, true );
	themerex_enqueue_style(  'swiperslider-scrollbar-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar.css', array(), null );
	themerex_enqueue_script( 'swiperslider-scrollbar', get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar-2.1.js', array('jquery'), null, true );
		
	$edW = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$edH = themerex_substr($height, -1)=='%' ? '%' : 'px';

	$width = (int) str_replace('%', '', $width);
	$src = getAttachmentID($src);

	$s = ($width >= 0 ? 'width:'.$width.$edW.'; ' : '')
		.($height >= 0 ? 'height:'.$height.$edH.'; ' : '')
		.($top !== '' ? 'margin-top:'.$top.'px; ' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px; ' : '')
		.($left !== '' ? 'margin-left:' . $left . ((int) $left > 0 || (int) $left < 0 ? 'px' : '') . ';' : '')
		.($right !== '' ? 'margin-right:' . $right . ((int) $right > 0 || (int) $right < 0 ? 'px' : '') . ';' : '')
		.($background !== '' ? 'background-color:'.($background).';' : '')
		.($padding !== '' ? 'padding: '.$padding.';' : '')
		.($src !== '' ? 'background-image:url('.$src.');' : '')
		.$style;

	$c = ($class ? ' '.$class : '') 
		.($align != 'none' && $align != 'center' ? ' sc_float_'.$align.'' : '') 
		.($align == 'center' ? ' sc_float_'.$align.'' : '') 
		.(!empty($columns) && $columns!='none' ? ' sc_columns_'.$columns.'' : '')
		.($dedicated == 'yes' ? ' sc_dedicated' : '');

	if (sc_param_is_on($scroll) && empty($id)) $id = 'sc_section_'.str_replace('.', '', mt_rand());

	$e = (sc_param_is_on($scroll) ? 
			'<div id="'.$id.'_scroll" class="sc_scroll sc_scroll_'.$dir.' swiper-container scroll-container"'
			.' style="'.($dir == 'vertical' ? 'min-height:'.($height > 0 ? $height : "100").'px;' : 'width:'.($width > 0 ? $width.'px;' : "100%;")).'"'
			.'>'
			.'<div class="sc_scroll_wrapper swiper-wrapper">' 
			.'<div class="sc_scroll_slide swiper-slide">' 
		: '')
		.do_shortcode($content) 
		.(sc_param_is_on($scroll) ? '</div></div><div id="'.$id.'_scroll_bar" class="sc_scroll_bar sc_scroll_bar_'.$dir.' '.$id.'_scroll_bar"></div></div>' : '');

	$output = '<div'.($id ? ' id="sc_section_'.$id.'"' : '').' class="sc_section '.$c.'" '.($s!='' ? ' style="'.$s.'"' : '').'>' 
				.($link != '' ? '<a href="'.$link.'">'.$e.'</a>' : $e)
			   .'</div>';

	if (sc_param_is_on($dedicated)) {
		global $THEMEREX_sc_section_dedicated;
		if (empty($THEMEREX_sc_section_dedicated)) {
			$THEMEREX_sc_section_dedicated = $output;
		}
		$output = '';
	}
	return $output;
}

function clear_dedicated_content() {	
	global $THEMEREX_sc_section_dedicated;
	$THEMEREX_sc_section_dedicated = '';
}

function get_dedicated_content() {	
	global $THEMEREX_sc_section_dedicated;
	return $THEMEREX_sc_section_dedicated;
}
// ---------------------------------- [/section] ---------------------------------------


// ---------------------------------- [trx_icons_widget] ---------------------------------------Ok

add_shortcode('trx_icons_widget', 'sc_icons_widget'); 

function sc_icons_widget($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"icon" => "icon-heart",
		"count" => "10",
		"value" => "5",
		"size" => "40",
		"top" => "",
		"bottom" => "", 
		"left" => "",
		"right" => "",
		"width" => ""
    ), $atts));

	$s = ($top !== '' ? ' margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? ' margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? ' margin-left:'.$left.'px;' : '')
		.($right !== '' ? ' margin-right:'.$right.'px;' : '')
		.($width !== '' ? ' max-width:'.$width.'px;' : '')
		.($size !== '' ? 'font-size:'.$size.'px;' : '');
	$color = get_custom_option('theme_color');
	$output = '<div' . ($id ? ' id="' . $id . '"' : '') 
		. ' class="sc_icons_widget "'
		. ($s!='' ? ' style="'.$s.'"' : '').'>';
	for($i = 0; $i < $count; $i++)
	{
		if($i <= $value) $output .= '<div class="sc_icons_item active '.$icon.'" data-color="'.$color.'"></div>';
		else   $output .= '<div class="sc_icons_item '.$icon.'"></div>';
	}
	$output .= '</div>';
	return $output;
}
// ---------------------------------- [/trx_icons_widget] ---------------------------------------


// ---------------------------------- [skills] ---------------------------------------Ok

add_shortcode('trx_skills', 'sc_skills');

$THEMEREX_sc_skills_counter = 0;
$THEMEREX_sc_skills_columns = 0;
$THEMEREX_sc_skills_height = 0;
$THEMEREX_sc_skills_max = 100;
$THEMEREX_sc_skills_dir = '';
$THEMEREX_sc_skills_type = '';
$THEMEREX_sc_skills_color = '';
$THEMEREX_sc_skills_legend = '';
$THEMEREX_sc_skills_data = '';
$THEMEREX_sc_skills_style = '';
function sc_skills($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"type" => "bar",
		"dir" => "",
		"layout" => "",
		"count" => "",
		"align" => "",
		"color" => "",
		"style" => "1",
		"maximum" => "100",
		"title" => "",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_script( 'diagram-chart', get_template_directory_uri() . '/js/diagram/chart.min.js', array(), null, true );
	themerex_enqueue_script( 'diagram-raphael', get_template_directory_uri() . '/js/diagram/diagram.raphael.js', array(), null, true );
	
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$ed_l = ($left !== 'auto' ? themerex_substr($left, -1)=='%' ? '%' : 'px' : '');
    $ed_r = ($right !== 'auto' ? themerex_substr($right, -1)=='%' ? '%' : 'px' : '');

	$width = (int) str_replace('%', '', $width);
	$s = ($width >= 0 ? 'width:' . $width . $ed . ';' : '')
		.($height >= 0 ? 'height:' . $height . 'px;' : '')
		.($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		 .($left !== '' ? 'margin-left:' . $left .$ed_l. ';' : '')
		 .($right !== '' ? 'margin-right:' . $right .$ed_r. ';' : '')
		.($align != '' && $align != 'none' ? 'float:' . $align . ';' : '');

	$c = (' sc_skills_'.$type)
		.($type=='bar' ? ' sc_skills_'.$dir : '')
		.($layout=='columns' ? ' sc_skills_columns' : '');

	global $THEMEREX_sc_skills_counter, $THEMEREX_sc_skills_columns, $THEMEREX_sc_skills_height, $THEMEREX_sc_skills_max, $THEMEREX_sc_skills_dir, $THEMEREX_sc_skills_type, $THEMEREX_sc_skills_color, $THEMEREX_sc_skills_legend, $THEMEREX_sc_skills_data, $THEMEREX_sc_skills_style;
	$THEMEREX_sc_skills_counter = 0;
	$THEMEREX_sc_skills_columns = 0;
	$THEMEREX_sc_skills_height = 0;
	$THEMEREX_sc_skills_type = $type;
	$THEMEREX_sc_skills_color = $color;
	$THEMEREX_sc_skills_legend = '';
	$THEMEREX_sc_skills_data = '';
	if ($type!='arc') {
		if ($layout=='' || ($layout=='columns' && $count<1)) $layout = 'rows';
		if ($layout=='columns') $THEMEREX_sc_skills_columns = $count;
		if ($type=='bar') {
			if ($dir=='') $dir = 'horizontal';
			if ($dir == 'vertical') {
				if ($height < 1) $height = 300;
			}
		}
	} else {
		if (empty($id)) $id = 'sc_skills_diagram_'.str_replace('.','',mt_rand());
	}
	if ($maximum < 1) $maximum = 100;
	if ($style) $THEMEREX_sc_skills_style = $style = max(1, min(4, $style));
	$THEMEREX_sc_skills_max = $maximum;
	$THEMEREX_sc_skills_dir = $dir;
	$THEMEREX_sc_skills_height = $height;
	$content = do_shortcode($content);
	return ($type!='
		' && $title!='' ? '<h2>'.$title.'</h2>' : '')
			.'<div'.($id ? ' id="sc_skills_' . $id . '"' : '').' class="sc_skills '.$c.'"'.($s!='' ? ' style="'.$s.'"' : '')
				.' data-type="'.$type.'"'
				.($type=='bar' ? ' data-dir="'.$dir.'"' : '')
			.'>'
				.($layout == 'columns' ? '<div class="sc_columns_'.$count.' sc_columns_indent sc_skills_'.$layout.'">' : '')
				.($type=='arc' 
					? ('<div class="sc_skills_legend">'.($title!='' ? '<h2>'.$title.'</h2>' : '').'<ul>'.$THEMEREX_sc_skills_legend.'</ul></div>'
						.'<div id="'.$id.'_diagram" class="sc_skills_arc_canvas"></div>'
						.'<div class="sc_skills_data" style="display:none;">'
						.$THEMEREX_sc_skills_data
						.'</div>'
					  )
					: '')
				. $content
				. ($layout == 'columns' ? '</div>' : '')
			. '</div>';
}


add_shortcode('trx_skills_item', 'sc_skills_item');

//[trx_skills_item]
function sc_skills_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"title" => "",
		"level" => "",
		"color" => "",
		"style" => "",
		"width" => "",
		"bottom" => ""
	), $atts));
	global $THEMEREX_sc_skills_counter, $THEMEREX_sc_skills_columns, $THEMEREX_sc_skills_height, $THEMEREX_sc_skills_max, $THEMEREX_sc_skills_dir, $THEMEREX_sc_skills_type, $THEMEREX_sc_skills_color, $THEMEREX_sc_skills_legend, $THEMEREX_sc_skills_data, $THEMEREX_sc_skills_style, $THEMEREX_sc_skills_title;
	$THEMEREX_sc_skills_counter++;
	$ed = themerex_substr($level, -1)=='%' ? '%' : '';
	$level = (int) str_replace('%', '', $level);

	if($level > $THEMEREX_sc_skills_max) $level = $THEMEREX_sc_skills_max;
	$percent = round($level / $THEMEREX_sc_skills_max * 100);
	$start = 0;
	$stop = $ed == '%' ? max(0,min($level,100)) : $level;
	$steps = 100;
	$step = max(1, round($THEMEREX_sc_skills_max/$steps));
	$speed = mt_rand(10,40);
	$animation = round(($stop - $start) / $step * $speed);
	$title_block = '<div class="sc_skills_info">'.$title.'</div>';
	if (empty($color)) $color = $THEMEREX_sc_skills_color;
	if ($style) $style = max(1, min(4, $style));
	if (empty($style)) $style = $THEMEREX_sc_skills_style;
	$style = max(1, min(4, $style));
	$output = '';
	$ds='';
	if($THEMEREX_sc_skills_dir == 'vertical') $ds = ' width:'.$width.'px;';

	
		if ($THEMEREX_sc_skills_type=='arc') {
			if (empty($color)) $color = get_custom_option('theme_color');
			$THEMEREX_sc_skills_legend .= '<li style="background-color:'.$color.'">'.$title.'</li>';
			$THEMEREX_sc_skills_data .= '<div class="arc"><input type="hidden" class="percent" value="'.$percent.'" /><input type="hidden" class="color" value="'.$color.'" /></div>';
		} 
		else {

			$output .= ($THEMEREX_sc_skills_type == 'bar' && $THEMEREX_sc_skills_dir == 'horizontal' && $THEMEREX_sc_skills_columns == 0 ? $title_block : '');

			$output .= ($THEMEREX_sc_skills_columns > 0 ? '<div class="sc_columns_item ">' : '')
					.'<div'.($id ? ' id="sc_skills_item_'.$id.'"' : '').' class="sc_skills_item'.($style ? ' sc_skills_style_'.$style : '').($THEMEREX_sc_skills_counter % 2 == 1 ? ' odd' : ' even').($THEMEREX_sc_skills_counter == 1 ? ' first' : '').'"'
						.($THEMEREX_sc_skills_height > 0 ? ' style="'.$ds.' height: '.$THEMEREX_sc_skills_height.'px;"' : '').($bottom != '' ? ' style="margin-bottom: '.$bottom.'px;"' : '')
					.'>';


			if (in_array($THEMEREX_sc_skills_type, array('bar', 'counter'))) {
				$output .= '<div class="sc_skills_count"' . ($THEMEREX_sc_skills_type=='bar' && $color ? ' style="background-color:' . $color . '"' : '') . '>'
							.'<div class="sc_skills_total"'
								.' data-start="'.$start.'"'
								.' data-stop="'.$stop.'"'
								.' data-step="'.$step.'"'
								.' data-max="'.$THEMEREX_sc_skills_max.'"'
								.' data-speed="'.$speed.'"'
								.' data-duration="'.$animation.'"'
								.' data-ed="'.$ed.'">'
								.'<span>'
								.$start.$ed
								.'</span>'
							.'</div>'
						.'</div>';
			} else if ($THEMEREX_sc_skills_type=='pie') {
				if (empty($color)) $color = get_custom_option('theme_color');
				if (empty($id)) $id = 'sc_skills_canvas_'.str_replace('.','',mt_rand());
				$output .= '<canvas id="'.$id.'"></canvas>'
					.'<div class="sc_skills_total"'
						.' data-start="'.$start.'"'
						.' data-stop="'.$stop.'"'
						.' data-step="'.$step.'"'
						.' data-steps="'.$steps.'"'
						.' data-max="'.$THEMEREX_sc_skills_max.'"'
						.' data-speed="'.$speed.'"'
						.' data-duration="'.$animation.'"'
						.' data-color="'.$color.'"'
						.' data-easing="easeOutCirc"'
						.' data-ed="'.$ed.'">'
						.'<span>'
						.$start.$ed
						.'</span>'
					.'</div>';
			}
			
			$output .= ($THEMEREX_sc_skills_type=='counter' ? $title_block : '')
					.'</div>'
					.($THEMEREX_sc_skills_type == 'bar' && $THEMEREX_sc_skills_dir == 'horizontal' && $THEMEREX_sc_skills_columns != 0 ? $title_block : '')
					.($THEMEREX_sc_skills_type == 'bar' && $THEMEREX_sc_skills_dir == 'vertical' || $THEMEREX_sc_skills_type == 'pie' ? $title_block : '')
					.($THEMEREX_sc_skills_columns > 0 ? '</div>' : '');
		}
	
	return $output;
}

// ---------------------------------- [/skills] ---------------------------------------


// ---------------------------------- [/rocks] ---------------------------------------Ok
add_shortcode('trx_rocks', 'sc_rocks');

$THEMEREX_sc_rocks_counter = 0;
$THEMEREX_sc_rocks_columns = 0;
$THEMEREX_sc_rocks_height = 0;
$THEMEREX_sc_rocks_max = 100;
$THEMEREX_sc_rocks_dir = '';
$THEMEREX_sc_rocks_type = '';
$THEMEREX_sc_rocks_color = '';
$THEMEREX_sc_rocks_legend = '';
$THEMEREX_sc_rocks_data = '';
$THEMEREX_sc_rocks_style = '';
function sc_rocks($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"count" => "",
		"title" => "",
		"width" => "",
		"maximum" => "",
		"color" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . ((int) $left > 0 || (int) $left < 0 ? 'px' : '') . ';' : '')
		.($right !== '' ? 'margin-right:' . $right . ((int) $right > 0 || (int) $right < 0 ? 'px' : '') . ';' : '')
		.($width !== '' ? 'max-width:' . $width . ((int) $width > 0 ? 'px' : '') . ';' : 'width: 100%;');


	global $THEMEREX_sc_rocks_counter, $THEMEREX_sc_rocks_height, $THEMEREX_sc_rocks_data, $THEMEREX_sc_rocks_max, $THEMEREX_sc_rocks_color;
	if($color == '') $THEMEREX_sc_rocks_color = "#fff";
	else $THEMEREX_sc_rocks_color = $color;
	$THEMEREX_sc_rocks_counter = 0;
	$THEMEREX_sc_rocks_columns = 0;
	$THEMEREX_sc_rocks_width = 0;
	$THEMEREX_sc_rocks_data = '';

	if ($maximum < 1) $maximum = 100;
	//if ($style) $THEMEREX_sc_skills_style = $style = max(1, min(4, $style));
	$THEMEREX_sc_rocks_max = $maximum;
	if ($id == '') $id = 'sc_rocks_'.str_replace('.','',mt_rand());

	$content = do_shortcode($content);
	return  '<div class="sc_rocks_skills '.($count != '' ? 'sc_rocks_count_'.$count.'' : '' ).'" '.($s!='' ? ' style="'.$s.'"' : '').'>'
                .'<div class="sc_rocks_inner">'
                	.$THEMEREX_sc_rocks_data
                .'</div>'
            .'</div>';
}


add_shortcode('trx_rocks_item', 'sc_rocks_item');

//[trx_rocks_item]
function sc_rocks_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"title" => "",
		"level" => ""
	), $atts));
	global $THEMEREX_sc_rocks_counter, $THEMEREX_sc_rocks_height, $THEMEREX_sc_rocks_data, $THEMEREX_sc_rocks_max, $THEMEREX_sc_rocks_color;
	$THEMEREX_sc_rocks_counter++;
	if($level > $THEMEREX_sc_rocks_max) $level = $THEMEREX_sc_rocks_max;
	$ed = themerex_substr($level, -1)=='%' ? '%' : '';
	$level = (int) str_replace('%', '', $level);
	$percent = round($level / $THEMEREX_sc_rocks_max * 100);
	$title_block = '<div class="sc_rocks_info">'.$title.'</div>';
	$output = '';

	$THEMEREX_sc_rocks_data .= '<div class="sc_rocks_row" style="color: '.$THEMEREX_sc_rocks_color.'">'
	                               .'<span class="sc_rocks_value">'.$level.'</span>'
	                               .'<div class="sc_rocks_progressbar">'
	                                    .'<div class="sc_rocks_progress" data-process="'.$percent.'">'
	                                       .'<div class="sc_rocks_before"></div>'
	                                        .'<div class="sc_rocks_after"></div>'
	                                    .'</div>'
	                                    .'<div class="sc_rocks_foot"></div>'
	                                    .'<div class="sc_rocks_shadow"></div>'
	                                .'</div>'
	                                .'<span class="sc_rocks_caption">'.$title.'</span>'
                           		.'</div>';

	return $output;
}

// ---------------------------------- [/rocks] ---------------------------------------


// ---------------------------------- [chart] ----------------------------------------Ok

add_shortcode('trx_chart', 'sc_chart');

$THEMEREX_sc_chart_counter = 0;
$THEMEREX_sc_chart_columns = 0;
$THEMEREX_sc_chart_height = 0;
$THEMEREX_sc_chart_max = 100;
$THEMEREX_sc_chart_dir = '';
$THEMEREX_sc_chart_type = '';
$THEMEREX_sc_chart_color = '';
$THEMEREX_sc_chart_legend = '';
$THEMEREX_sc_chart_legend_option = '';
$THEMEREX_sc_chart_data = '';
$THEMEREX_sc_chart_style = '';
$THEMEREX_sc_chart_marg = '';
$THEMEREX_sc_chart_id = '';
function sc_chart($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"width" => "",
		"color" => "",
		"size" => "",
		"legend" => "",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_script( 'diagram-chart', get_template_directory_uri() . '/js/diagram/chart.min.js', array(), null, true );
	themerex_enqueue_script( 'diagram-raphael', get_template_directory_uri() . '/js/diagram/diagram.raphael.js', array(), null, true );
		
    if($width == '') $width = '520';
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$s = ($width >= 0 && 'legend' == 'yes' ? 'width:' . $width . $ed . ';' : '')
		.($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.($align != '' && $align != 'none' && $align != 'center' ? 'float:' . $align . ';' : '')
		.($align == 'center' ? 'text-align: center;' : '');

	$d = ($color !== '' ? 'color: '.$color.' !important;' :'')
		.($size !== '' ? 'font-size: '.$size.'px;' : '');

	global $THEMEREX_sc_chart_counter, $THEMEREX_sc_chart_height,  $THEMEREX_sc_chart_legend, $THEMEREX_sc_chart_data, $THEMEREX_sc_chart_legend_option, $THEMEREX_sc_chart_marg, $THEMEREX_sc_chart_id;
	$THEMEREX_sc_chart_counter = 0;
	$THEMEREX_sc_chart_height = 0;
	$THEMEREX_sc_chart_legend = '';
	$THEMEREX_sc_chart_data = '';
	$THEMEREX_sc_chart_marg = $width * 0.1171875;
	$THEMEREX_sc_chart_legend_option = "no";
	$THEMEREX_sc_chart_id = $id;

	if($legend == "yes" ) $THEMEREX_sc_chart_legend_option = "yes";

	$THEMEREX_sc_chart_height = $width + $THEMEREX_sc_chart_marg;

	$content = do_shortcode($content);
	return '<div class="sc_chart_diagram" style="'.$s.'">'
				.($legend == "yes" ? '<div class="sc_chart_legend"><ul>'.$THEMEREX_sc_chart_legend.'</ul></div>' : '')
                .'<div class="sc_chart_data" style="width: '.$width.'px; height: '.$width.'px;">'
                .($title != "" ? '<div class="sc_chart_title"><span style="'.$d.'">'.$title.'</span></div>' : '')
                .$THEMEREX_sc_chart_data
                .'</div>'
            .'</div>'
            ;
}


add_shortcode('trx_chart_item', 'sc_chart_item');

//[trx_skills_item]
function sc_chart_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"title" => "",
		"level" => "",
		"color" => "",
		"style" => "",
		"bottom" => "",
		"icon" => "",
		"icon_color" => ""
	), $atts));
	global $THEMEREX_sc_chart_counter, $THEMEREX_sc_chart_height,  $THEMEREX_sc_chart_legend, $THEMEREX_sc_chart_data, $THEMEREX_sc_chart_legend_option, $THEMEREX_sc_chart_marg, $THEMEREX_sc_chart_id;
	$THEMEREX_sc_chart_counter++;

	$id = $THEMEREX_sc_chart_id.'_sk_'.mt_rand(0,1000);

	$THEMEREX_sc_chart_height = $THEMEREX_sc_chart_height - $THEMEREX_sc_chart_marg;
	$THEMEREX_sc_chart_height = round($THEMEREX_sc_chart_height, 0);
	if((int) $level > 100) $level = '100';

	$ed = themerex_substr($level, -1)=='%' ? '%' : '';
	$level = (int) str_replace('%', '', $level);
	$percent = round($level / 100 * 100);
	if (empty($color)) $color = get_custom_option('theme_color');
	$output = '';
	$content = do_shortcode($content);

	if (empty($color)) $color = get_custom_option('theme_color');
	$THEMEREX_sc_chart_legend .= '<li style="background-color:'.$color.'"><span>'.$title.'</span><span class="mask">'.$title.'</span></li>';
	$THEMEREX_sc_chart_data .= '<div id="'.$id.'" class="sc_chart_item">'
	                            .'<canvas id="canvas_'.$id.'" height="'.$THEMEREX_sc_chart_height.'" width="'.$THEMEREX_sc_chart_height.'" data-percent="'.$percent.'" data-color="'. $color.'"></canvas>'
	                            .($THEMEREX_sc_chart_legend_option != "yes" && ($title != '' || $icon != '') ? 
	                            '<div class="sc_chart_line">'
	                                .'<div class="sc_chart_tail"></div>'
	                            .'</div>' 
	                            .' <div class="sc_chart_content">' 
	                                .($icon !== '' ? '<span class="icon '.$icon.'" '.($icon_color != '' ? 'style="color: '.$icon_color.'"' : '').'></span>' : '')
	                                .'<span>'.$title.'</span>'
	                                .($content != '' ? '<div class="sc_chart_description">'.$content.'</div>' : '')
	                            .'</div>' : '')
	                        .'</div>';
	return $output;
}
// ---------------------------------- [/chart] ---------------------------------------


// ---------------------------------- [slider] ---------------------------------------Ok

add_shortcode('trx_slider', 'sc_slider');

$THEMEREX_sc_slider_engine = '';
$THEMEREX_sc_slider_width = 0;
$THEMEREX_sc_slider_height = 0;
$THEMEREX_sc_slider_links = false;

function sc_slider($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"engine" => "flex",
		"alias" => "",
		"ids" => "",
		"theme" => "dark",
		"cat" => "",
		"count" => "0",
		"offset" => "",
		"orderby" => "date",
		"order" => 'desc',
		"controls" => "no",
		"pagination" => "no",
		"titles" => "no",
		"links" => "no",
		"rev_style" => "rev_full",
		"align" => "",
		"width" => "100%",
		"height" => "400",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_style(  'swiperslider-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.css', array(), null );
	themerex_enqueue_script( 'swiperslider', get_template_directory_uri() . '/js/swiper/idangerous.swiper-2.1.js', array('jquery'), null, true );
	themerex_enqueue_style(  'swiperslider-scrollbar-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar.css', array(), null );
	themerex_enqueue_script( 'swiperslider-scrollbar', get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar-2.1.js', array('jquery'), null, true );
	
	themerex_enqueue_script( 'hover-dir', get_template_directory_uri() . '/js/hover/jquery.hoverdir.js', array(), null, true );
	themerex_enqueue_style( 'hover-intent', get_template_directory_uri() . '/js/hover/hoverIntent.js', array(), null );
		
	global $THEMEREX_sc_slider_engine, $THEMEREX_sc_slider_width, $THEMEREX_sc_slider_height, $THEMEREX_sc_slider_links;
	$THEMEREX_sc_slider_engine = $engine;
	$THEMEREX_sc_slider_width = $width;
	$THEMEREX_sc_slider_height = $height;
	$THEMEREX_sc_slider_links = sc_param_is_on($links);

	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . ((int) $left > 0 || (int) $left < 0 ? 'px' : '') . ';' : '')
		.($right !== '' ? 'margin-right:' . $right . ((int) $right > 0 || (int) $right < 0 ? 'px' : '') . ';' : '')
		.(!empty($width) ? 'width:'.$width.(themerex_strpos($width, '%')!==false ? '' : 'px').';' : '')
		.(!empty($height) ? 'height:'.$height.(themerex_strpos($height, '%')!==false ? '' : 'px').';' : '');
	
	$c = ' sc_slider_'.$engine
		.(sc_param_is_on($controls) ? ' sc_slider_controls' : '')
		.(sc_param_is_on($pagination) ? ' sc_slider_pagination' : '')
		.($align!='' && $align!='none' ? ' sc_float_'.$align : '')
		.($engine=='swiper' ? ' swiper-container' : '');

	$output = '<div'.($id ? ' id="sc_slider_'.$id.'"' : '').' class="sc_slider '.$c.'" ' .($s!='' ? ' style="'.$s.'"' : '').' data-settings="horizontal">';

	if ($engine=='revo') {
		if (revslider_exists() && !empty($alias))
		{
			$output .= do_shortcode('[rev_slider '.$alias.']');
		}
		else
			$output = '';
	} else if ($engine=='royal') {
		if (royalslider_exists() && !empty($alias))
			$output .= do_shortcode('[[new_royalslider id="'.$alias.'"]');
		else
			$output = '';
	} else if ($engine=='flex' || $engine=='swiper') {
		
		$output .= '<ul class="slides'.($engine=='swiper' ? ' swiper-wrapper' : '').'">';

		$content = do_shortcode($content);
		
		if ($content) {
			$output .= $content;
		} else {
			global $post;
	
			if (!empty($ids)) {
				$posts = explode(',', $ids);
				$count = count($posts);
			}
		
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => $count,
				'ignore_sticky_posts' => 1,
				'order' => $order=='asc' ? 'asc' : 'desc',
			);
	
			if ($offset > 0 && empty($ids)) {
				$args['offset'] = $offset;
			}
	
			$args = addSortOrderInQuery($args, $orderby, $order, true);
			$args = addPostsAndCatsInQuery($args, $ids, $cat);
	
			$query = new WP_Query( $args );
	
			while ( $query->have_posts() ) { 
				$query->the_post();
				$post_id = get_the_ID();
				$post_link = get_permalink();
				$post_attachment = wp_get_attachment_url(get_post_thumbnail_id($post_id));
				$post_accent_color = '';
				$post_category = '';
				$post_category_link = '';
				$post_title = getPostTitle($post_id);
				$avg_author = 0;
				$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
				//image crop
				$no_crop = getThumbSizes(array(
						'thumb_size' => 'image_large',
						'thumb_crop' => true,
						'sidebar' => false ));
				$crop = array(
					"w" => $width != '' && $ed != '%' ? $width : $no_crop['w'],
					"h" => $height != '' && $ed != '%' ? $height : null
					);
				$post_attachment = getResizedImageURL($post_attachment, $crop['w'], $crop['h']);

				$output .= '<li'.($engine=='swiper' ? ' class="swiper-slide"' : '').' data-theme="'.( $theme != '' ? $theme : 'dark' ).'" style="background-image:url('.$post_attachment . ');'.(!empty($width) ? ' width:' . $width . (themerex_strpos($width, '%')!==false ? '' : 'px').';' : '').(!empty($height) ? ' height:' . $height . (themerex_strpos($height, '%')!==false ? '' : 'px').';' : '').'">' . (sc_param_is_on($links) ? '<a href="'.$post_attachment.'" title="'.htmlspecialchars($post_title).'">' : '');
				if (!sc_param_is_off($titles)) {
					$post_hover_bg  = get_custom_option('theme_color', null, $post_id);
					$post_bg = '';
					if ($post_hover_bg!='' && !is_inherit_option($post_hover_bg)) {
						$rgb = Hex2RGB_1($post_hover_bg);
						$post_hover_ie = str_replace('#', '', $post_hover_bg);
						$post_bg = "background-color: rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0.8);";
					}
					$output .= '<div class="sc_slider_info' . ($titles=='fixed' ? ' sc_slider_info_fixed' : ' sc_slider_info_slide') . ($engine=='swiper' ? ' content-slide' : '') . '"><div class="main">';
					$post_descr = getPostDescription();
					//reviews
					if (get_custom_option('show_reviews')=='yes' && get_custom_option('slider_reviews')=='yes') {
						$output_reviews = '';
						$rating_max = get_custom_option('reviews_max_level');
						$review_title = sprintf($rating_max<100 ? __('Rating: %s from %s', 'themerex') : __('Rating: %s', 'themerex'), number_format($avg_author,1).($rating_max < 100 ? '' : '%'), $rating_max.($rating_max < 100 ? '' : '%'));
						$avg_author = marksToDisplay(get_post_meta($post_id, 'reviews_avg'.((get_theme_option('reviews_first')=='author' && $orderby != 'users_rating') || $orderby == 'author_rating' ? '' : '2'), true));

						if( $avg_author > 0 && get_custom_option('slider_reviews_style')=='rev_short' ){
							$output .= '<div class="sc_slider_reviews_short" title="'.$review_title.'"><span class="rInfo">'.$avg_author.'</span><span class="rDelta">'.($rating_max < 100 ? '<span class="icon-star"></span>' : '%').'</span></div>';
						} else if ($avg_author > 0 && get_custom_option('slider_reviews_style')=='rev_full') {
							$output_reviews .= '<div class="sc_slider_reviews reviews_summary blog_reviews" title="'.$review_title.'">'
								.'<div class="criteria_summary criteria_row">' . getReviewsSummaryStars($avg_author) . '</div>'
								.'</div>';
						}
						$output .= $output_reviews;
					}
					//category
					if (get_custom_option("slider_info_category")=='yes') { // || empty($cat)) {
						// Get all post's categories
						$post_categories = getCategoriesByPostId($post_id);
						$post_categories_str = '';
						for ($i = 0; $i < count($post_categories); $i++) {
							if ($post_category=='') {
								if (get_theme_option('close_category')=='parental') {
									$parent_cat_id = 0;//(int) get_custom_option('category_id');
									$parent_cat = getParentCategory($post_categories[$i]['term_id'], $parent_cat_id);
									if ($parent_cat) {
										$post_category = $parent_cat['name'];
										$post_category_link = $parent_cat['link'];
										if ($post_accent_color=='') $post_accent_color = get_category_inherited_property($parent_cat['term_id'], 'theme_color');
									}
								} else {
									$post_category = $post_categories[$i]['name'];
									$post_category_link = $post_categories[$i]['link'];
									if ($post_accent_color=='') $post_accent_color = get_category_inherited_property($post_categories[$i]['term_id'], 'theme_color');
								}
							}
							if ($post_category!='' && $post_accent_color!='') break;
						}
						if ($post_category=='' && count($post_categories)>0) {
							$post_category = $post_categories[0]['name'];
							$post_category_link = $post_categories[0]['link'];
							if ($post_accent_color=='') $post_accent_color = get_category_inherited_property($post_categories[0]['term_id'], 'theme_color');
						}
						if ($post_category!='') {
							$output .= '<div class="sc_slider_category"'.(themerex_substr($post_accent_color, 0, 1)=='#' ? ' style="background-color: '.$post_accent_color.'"' : '').'><a href="'.$post_category_link.'">'.$post_category.'</a></div>';
						}
					}
					//title
					if(strlen($post_title) > 25) $post_title = substr($post_title, 0, 25).'...';
					$output .= '<h2 class="sc_slider_subtitle"><a href="'.$post_link.'">'.$post_title.'</a></h2>';
					//descriptions
					if (get_custom_option('slider_descriptions')=='yes') {
						$output .= '<div class="sc_slider_descr">'.$post_descr.'</div>';
					}
					$output .= '</div></div>';
				}
				$output .= (sc_param_is_on($links) ? '</a>' : '' ) . '</li>';
			}
			wp_reset_postdata();
		}
	
		$output .= '</ul>';
		if ($engine=='swiper') {
			if (sc_param_is_on($controls))
				$output .= '
					<ul class="slider-control-nav">
						<li class="slide-prev"><a class="icon-left-open-big" href="#"></a></li>
						<li class="slide-next"><a class="icon-right-open-big" href="#"></a></li>
					</ul>';
			if (sc_param_is_on($pagination))
				$output .= '
					<div class="slider-pagination-nav"></div>
				';
		}
	
	} else
		$output = '';
	$output .= !empty($output) ? '</div>' : '';
	return $output;
}

add_shortcode('trx_slider_item', 'sc_slider_item');

//[trx_slider_item]
function sc_slider_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"src" => "",
		"url" => "",
		"theme" => ""
	), $atts));

	global $THEMEREX_sc_slider_engine, $THEMEREX_sc_slider_width, $THEMEREX_sc_slider_height, $THEMEREX_sc_slider_links;
	
	$width = $THEMEREX_sc_slider_width;
	$height = $THEMEREX_sc_slider_height;
	$image = $src ? $src : $url;
	$image = getAttachmentID($image);
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	//image crop
	$no_crop = getThumbSizes(array(
			'thumb_size' => 'image_large',
			'thumb_crop' => true,
			'sidebar' => false ));
	$crop = array(
		"w" => $width != '' && $ed != '%' ? $width : $no_crop['w'],
		"h" => $height != '' && $ed != '%' ? $height : null
		);
	$image = getResizedImageURL($image, $crop['w'], $crop['h']);

	$c = ($THEMEREX_sc_slider_engine=='swiper' ? ' swiper-slide' : '');

	return '<li'.($id ? ' id="sc_slider_item_'.$id.'"' : '').' class="'.$c.'"'
			.' data-theme="'.( $theme != '' ? $theme : 'dark' ).'"'
			.' style="background-image:url('.$image.');'
			.(!empty($THEMEREX_sc_slider_width) ? ' width:'.$THEMEREX_sc_slider_width.(themerex_strpos($THEMEREX_sc_slider_width, '%')!==false ? '' : 'px').';' : '')
			.(!empty($THEMEREX_sc_slider_height) ? ' height:'.$THEMEREX_sc_slider_height.(themerex_strpos($THEMEREX_sc_slider_height, '%')!==false ? '' : 'px').';' : '')
		.'">' 
		.(sc_param_is_on($THEMEREX_sc_slider_links) ? '<a href="'.($src ? $src : $url).'"></a>' : '')
		.'</li>';
}
// ---------------------------------- [/slider] ---------------------------------------


// ---------------------------------- [tabs] ---------------------------------------Ok

add_shortcode("trx_tabs", "sc_tabs");

$THEMEREX_sc_tab_counter = 0;
$THEMEREX_sc_tab_scroll = "no";
$THEMEREX_sc_tab_height = 0;
$THEMEREX_sc_tab_id = '';
function sc_tabs($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "1",
		"tab_names" => "",
	//	"initial" => "1", 
		"scroll" => "no",
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '')
		.(!empty($width) ? 'width:'.$width.(themerex_strpos($width, '%')!==false ? '' : 'px').';' : '');

	$c = 'sc_tabs sc_tabs_style_'.$style
		.($scroll == 'yes' ? ' sc_tabs_scroll_show' : '');

	global $THEMEREX_sc_tab_counter, $THEMEREX_sc_tab_id, $THEMEREX_sc_tab_scroll, $THEMEREX_sc_tab_height;
	$THEMEREX_sc_tab_counter = 0;
	$THEMEREX_sc_tab_scroll = $scroll;
	$THEMEREX_sc_tab_height = $height;
	$THEMEREX_sc_tab_id = $id ? $id : 'sc_tab_'.str_replace('.', '', mt_rand());
	$title_chunks = explode("|", $tab_names);
	$initial = '1';
	$initial = max(1, min(count($title_chunks), (int) $initial));
	$tabs_output = '<div'.($id ? ' id="sc_tabs_'.$id.'"' : '').' class="'.$c.'"'.($s!='' ? ' style="'.$s.'"' : '').' data-active='.($initial).'>'
					.'<ul class="sc_tabs_titles">';
	$titles_output = '';
	for ($i = 0; $i < count($title_chunks); $i++) {
		$classes = array('tab_names');
		if ($i == 0) $classes[] = 'first';
		else if ($i == count($title_chunks) - 1) $classes[] = 'last';
		$titles_output .= '<li class="'.join(' ', $classes).'"><a href="#'.$THEMEREX_sc_tab_id.'_'.($i+1).'" class="theme_button">' . $title_chunks[$i] . '</a></li>';
	}

	themerex_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);

	$tabs_output .= $titles_output
		. '</ul><div class="sc_tabs_array">' 
		. do_shortcode($content) 
		.'</div></div>';
	return $tabs_output;
}

//[trx_tab id="tab_id"]

add_shortcode('trx_tab', 'sc_tab');

function sc_tab($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"class" => "",
		"tab_id" => "",		// get it from VC
		"title" => ""		// get it from VC
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_style(  'swiperslider-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.css', array(), null );
	themerex_enqueue_script( 'swiperslider', get_template_directory_uri() . '/js/swiper/idangerous.swiper-2.1.js', array('jquery'), null, true );
	themerex_enqueue_style(  'swiperslider-scrollbar-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar.css', array(), null );
	themerex_enqueue_script( 'swiperslider-scrollbar', get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar-2.1.js', array('jquery'), null, true );
		
	global $THEMEREX_sc_tab_counter, $THEMEREX_sc_tab_id, $THEMEREX_sc_tab_scroll, $THEMEREX_sc_tab_height;
	$THEMEREX_sc_tab_counter++;
	$id = $THEMEREX_sc_tab_id . '_' . $THEMEREX_sc_tab_counter;
	return '<div id="'.$id.'" class="sc_tabs_content' . ($THEMEREX_sc_tab_counter % 2 == 1 ? ' odd' : ' even') . ($THEMEREX_sc_tab_counter == 1 ? ' first' : '') . '">' 
		. (sc_param_is_on($THEMEREX_sc_tab_scroll) ? '<div id="'.$id.'_scroll" class="sc_scroll sc_scroll_vertical" style="height:'.($THEMEREX_sc_tab_height > 0 ? $THEMEREX_sc_tab_height : 230).'px;"><div class="sc_scroll_wrapper swiper-wrapper"><div class="sc_scroll_slide swiper-slide">' : '')
		. do_shortcode($content) 
		. (sc_param_is_on($THEMEREX_sc_tab_scroll) ? '</div></div><div id="'.$id.'_scroll_bar" class="sc_scroll_bar sc_scroll_bar_vertical '.$id.'_scroll_bar"></div></div>' : '')
		. '</div>';
}
// ---------------------------------- [/tabs] ---------------------------------------


// ---------------------------------- [team] ---------------------------------------Ok

add_shortcode('trx_team', 'sc_team');


$THEMEREX_sc_team_columns = 0;
$THEMEREX_sc_team_counter = 0;
$THEMEREX_sc_team_style = 0;
function sc_team($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"columns" => 0,
		"indent" => "yes",
		"rounding" => "yes",
		"style" => "1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => ""
    ), $atts));

	$style = $style != '' ? max(1,min(3,$style)) : '1';

	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . ((int) $left > 0 ? 'px' : '') . ';' : '')
		.($right !== '' ? 'margin-right:' . $right . ((int) $right > 0 ? 'px' : '') . ';' : '')
		.($width !== '' ? 'width:'.$width . ((int) $width > 0 ? 'px' : '') . ';' : '');
	$c = (sc_param_is_on($rounding) ? ' sc_team_item_avatar_rounding' : '')
		.(' sc_team_item_style_'.$style);

	global $THEMEREX_sc_team_columns, $THEMEREX_sc_team_counter, $THEMEREX_sc_team_style;
	$THEMEREX_sc_team_style = $style;
	$THEMEREX_sc_team_columns = $columns = max(1, min(6, $columns));
	$THEMEREX_sc_team_counter = 0;
	$content = do_shortcode($content);
	return '<div' . ($id ? ' id="sc_team_'.$id.'"' : '').' class="sc_team '.$c.' '.($style == '3' ? 'sc_team_vertical' : '').'"'.($s!='' ? ' style="'.$s.'"' : '') .'>'
				. '<div '.($style != '3' ? 'class="sc_team_columns sc_columns_'.$columns.(sc_param_is_on($indent) ? ' sc_columns_indent' : '').'"' : 'class="sc_columns_1"').'>'
					. $content
				. '</div>'
			. '</div>';
}


add_shortcode('trx_team_item', 'sc_team_item');

//[trx_team_item]
function sc_team_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"id" => "",
		"user" => "",
		"name" => "",
		"position" => "",
		"photo" => "",
		"email" => "",
		"socials" => "",
		"border" => "no",
		"align" => ""
	), $atts));
	global $THEMEREX_sc_team_counter, $THEMEREX_sc_team_columns, $THEMEREX_sc_team_style;
	$THEMEREX_sc_team_counter++;
	$style = $THEMEREX_sc_team_style;
	$descr = do_shortcode($content);
	if (!empty($user) && $user!='none' && ($user_obj = get_user_by('login', $user)) != false) {
		$meta = get_user_meta($user_obj->ID);
		if (empty($email))		$email = $user_obj->data->user_email;
		if (empty($name))		$name = $user_obj->data->display_name;
		if (empty($position))	$position = isset($meta['user_position'][0]) ? $meta['user_position'][0] : '';
	//	if (empty($descr))		$descr = isset($meta['description'][0]) ? $meta['description'][0] : '';
		if (empty($socials))	$socials = showUserSocialLinks(array('author_id'=>$user_obj->ID, 'echo'=>false, 'before'=>'<li>', 'after' => '</li>', 'style' => 'icons'));
	} else {
		global $THEMEREX_user_social_list;
		$allowed = explode('|', $socials);
		$socials = '';
		for ($i=0; $i<count($allowed); $i++) {
			$s = explode('=', $allowed[$i]);
			if (!empty($s[1]) && array_key_exists($s[0], $THEMEREX_user_social_list)) {
				$img = get_template_directory_uri().'/images/socials/'.$s[0].'.png';
				$socials .= '<li><a href="'.$s[1].'" class="social_icons social_'.$s[0].' '.$s[0] . '" target="_blank" style="background-image: url('.$img.');">'
						. '<span style="background-image: url('.$img.');"></span>'
						. '</a></li>';
			}
		}
	}

	$photo_sizes = getThumbSizes(array(
		'thumb_size' => getThumbColumns('cub',$THEMEREX_sc_team_columns),
		'thumb_crop' => true,
		'sidebar' => false
	));

	if (empty($photo)) {
		if (!empty($email)) $photo = get_avatar($email, $photo_sizes['w']);
	} else {
		$photo = getResizedImageTag($photo, $photo_sizes['w'], $photo_sizes['h']);
	}
	if (!empty($name) || !empty($position)) {
		if($style != '3')
		{
			return '<div class="sc_columns_item">'
					.'<div'.($id ? ' id="sc_team_item_'.$id.'"' : '').' class="sc_team_item sc_team_item_'.$THEMEREX_sc_team_counter.($THEMEREX_sc_team_counter % 2 == 1 ? ' odd' : ' even').($THEMEREX_sc_team_counter == 1 ? ' first' : '').'">'
						.'<div class="sc_team_item_avatar_wrap">'
							.'<div class="sc_team_item_avatar '.($border == "yes" ? 'sc_team_item_border' : '').'">'.$photo.'</div>'
							.(!empty($socials) ? '<div class="sc_team_item_socials"><ul>'.$socials.'</ul></div>' : '')						
						.'</div>'
						.($name != '' ? '<h3 class="sc_team_item_title">'.$name.'</h3>' : '')
						.($position != '' ? '<div class="sc_team_item_position">'.$position.'</div>' : '')
						.($descr != '' ? '<div class="sc_team_item_description">'.$descr.'</div>' : '')
					.'</div>'
				.'</div>';
		}
		else if($style == '3')
		{
			if($align == "left")
			{
				return '<div class="sc_columns_item sc_team_left" >'
						.'<div'.($id ? ' id="sc_team_item_'.$id.'"' : '').' class="sc_team_item sc_team_item_'.$THEMEREX_sc_team_counter.($THEMEREX_sc_team_counter % 2 == 1 ? ' odd' : ' even').($THEMEREX_sc_team_counter == 1 ? ' first' : '').'">'
							.'<div class="sc_team_content"><div class="sc_team_middle">'
							.($name != '' ? '<h3 class="sc_team_item_title">'.$name.'</h3>' : '')
							.($position != '' ? '<div class="sc_team_item_position">'.$position.'</div>' : '')
							.($descr != '' ? '<div class="sc_team_item_description">'.$descr.'</div>' : '')
							.'</div></div>'
							.'<div class="sc_team_item_avatar_wrap">'
								.'<div class="sc_team_line"></div>'
								.'<div class="sc_team_item_avatar '.($border == "yes" ? 'sc_team_item_border' : '').'">'.$photo.'</div>'
								.(!empty($socials) ? '<div class="sc_team_item_socials"><ul>'.$socials.'</ul></div>' : '')						
							.'</div>'
							.'<div class="sc_space_column"></div>'
						.'</div>'
					.'</div>';
			}
			else{
					return '<div class="sc_columns_item">'
					.'<div'.($id ? ' id="sc_team_item_'.$id.'"' : '').' class="sc_team_item sc_team_item_'.$THEMEREX_sc_team_counter.($THEMEREX_sc_team_counter % 2 == 1 ? ' odd' : ' even').($THEMEREX_sc_team_counter == 1 ? ' first' : '').'">'
						.'<div class="sc_space_column"></div>'
						.'<div class="sc_team_item_avatar_wrap">'
							.'<div class="sc_team_line"></div>'
							.'<div class="sc_team_item_avatar">'.$photo.'</div>'
							.(!empty($socials) ? '<div class="sc_team_item_socials"><ul>'.$socials.'</ul></div>' : '')						
						.'</div>'
						.'<div class="sc_team_content"><div class="sc_team_middle">'
						.($name != '' ? '<h3 class="sc_team_item_title">'.$name.'</h3>' : '')
						.($position != '' ? '<div class="sc_team_item_position">'.$position.'</div>' : '')
						.($descr != '' ? '<div class="sc_team_item_description">'.$descr.'</div>' : '')
						.'</div></div>'
					.'</div>'
				.'</div>';

			}
		}
	}
	return '';
}
// ---------------------------------- [/team] ---------------------------------------


// ---------------------------------- [testimonials] ---------------------------------------Ok

add_shortcode('trx_testimonials', 'sc_testimonials');

$THEMEREX_sc_testimonials_count = 0;
$THEMEREX_sc_testimonials_width = 0;
$THEMEREX_sc_testimonials_height = 0;
function sc_testimonials($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"style" => "1",
		"controls" => "yes",
		"pagination" => "yes",
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_style(  'swiperslider-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.css', array(), null );
	themerex_enqueue_script( 'swiperslider', get_template_directory_uri() . '/js/swiper/idangerous.swiper-2.1.js', array('jquery'), null, true );
	themerex_enqueue_style(  'swiperslider-scrollbar-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar.css', array(), null );
	themerex_enqueue_script( 'swiperslider-scrollbar', get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar-2.1.js', array('jquery'), null, true );
		
    $style = $style != '' ? $style : 1;

	$s = ($top !== '' ? 'margin-top:' . $top . 'px;' : '')
		.($bottom !== '' ? 'margin-bottom:' . $bottom . 'px;' : '')
		.($left !== '' ? 'margin-left:' . $left . 'px;' : '')
		.($right !== '' ? 'margin-right:' . $right . 'px;' : '');

	$s2 = (!empty($width) ? 'width:' . $width . (themerex_strpos($width, '%')!==false ? '' : 'px').';' : '')
		.(!empty($height) ? 'height:' . $height . (themerex_strpos($height, '%')!==false ? '' : 'px').';' : '');

	$c = (' sc_testimonials_style_'.$style );

	$c2 = ($height == '' ? ' sc_slider_swiper_autoheight' : '')
		 .(sc_param_is_on($controls) ? ' sc_slider_controls' : '')
		 .(sc_param_is_on($pagination) ? ' sc_slider_pagination' : '');

	$control_nav = (sc_param_is_on($controls) ? '<ul class="slider-control-nav"><li class="slide-prev"><a class="icon-left-open-big" href="#"></a></li><li class="slide-next"><a class="icon-right-open-big" href="#"></a></li></ul>' : '');
	$pagination_nav = (sc_param_is_on($pagination) ? '<div class="slider-pagination-nav"></div>' : '');


	global $THEMEREX_sc_testimonials_count, $THEMEREX_sc_testimonials_width, $THEMEREX_sc_testimonials_height;
	$THEMEREX_sc_testimonials_count = 0;
	$THEMEREX_sc_testimonials_width = $width;
	$THEMEREX_sc_testimonials_height = $height;
	$content = do_shortcode($content);

	return '<div' . ($id ? ' id="sc_testimonials_' . $id . '"' : '') . ' class="sc_testimonials '.$c.'"'.($s!='' ? ' style="'.$s.'"' : '').'>'
			.($title ? '<h1 class="sc_testimonials_title">'.$title.'</h1>' : '')
			.($THEMEREX_sc_testimonials_count>1 ? '<div class="sc_slider sc_slider_swiper swiper-container'.$c2.'"'.($s2 ? ' style="'.$s2.'"' : '').'>' : '')
				.'<ul class="sc_testimonials_items'.($THEMEREX_sc_testimonials_count>1 ? ' slides swiper-wrapper' : '').'">'
				.$content
				.'</ul>'
			.($THEMEREX_sc_testimonials_count>1 ? $control_nav.$pagination_nav.'</div>' : '')
		.'</div>';
}


add_shortcode('trx_testimonials_item', 'sc_testimonials_item');

function sc_testimonials_item($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"name" => "",
		"position" => "",
		"photo" => "",
		"email" => ""
    ), $atts));
	global $THEMEREX_sc_testimonials_count, $THEMEREX_sc_testimonials_width, $THEMEREX_sc_testimonials_height;
	$THEMEREX_sc_testimonials_count++;
	$photo = getAttachmentID($photo);
	if (empty($photo)) {
		if (!empty($email))
			$photo = get_avatar($email, 50);
	} else {
		$photo = getResizedImageTag($photo, 50, 50);
	}

	$author_show = $position.$photo.$email != ''; 

	$s = (!empty($THEMEREX_sc_testimonials_width) ? 'width:'.$THEMEREX_sc_testimonials_width.(themerex_strpos($THEMEREX_sc_testimonials_width, '%')!==false ? '' : 'px').';' : '').(!empty($THEMEREX_sc_testimonials_height) ? 'height:'.$THEMEREX_sc_testimonials_height.(themerex_strpos($THEMEREX_sc_testimonials_height, '%')!==false ? '' : 'px').';' : '');

	$c = ( $author_show ? ' sc_testimonials_item_author_show' : '');

	//if (empty($photo)) $photo = '<img src="'.get_template_directory_uri().'/images/no-ava.png" alt="">';

	return '<li'.($id ? ' id="sc_testimonials_item_'.$id.'"' : '').' class="sc_testimonials_item swiper-slide'.$c.'" '.($s != '' ? 'style="'.$s.'"' : '').'>'
				.'<div class="sc_testimonials_item_content">'
					.'<div class="sc_testimonials_item_quote"><span class="sc_testimonials_item_text"><span class="sc_testimonials_item_text_before">'.do_shortcode(strip_tags($content)).'</span></span></div>'
					.($author_show ? 
					'<div class="sc_testimonials_item_author">'
						.($photo != '' ? '<div class="sc_testimonials_item_avatar">'.$photo.'</div>' : '' )
						.'<div class="sc_testimonials_item_user">'
							.($name != ''? '<span class="sc_testimonials_item_name">'.$name.'</span>' : '')
							.($position != '' ? '<span class="sc_testimonials_item_position">'.$position.'</span>' : '')
						.'</div>'
					.'</div>' : '')
				.'</div>'
			.'</li>';
}

// ---------------------------------- [/testimonials] ---------------------------------------


// ---------------------------------- [icon] ---------------------------------------Ok

add_shortcode('trx_icon', 'sc_icon');

function sc_icon($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"icon" => "",
		"size" => "20",
		"color" => "",
		"weight" => "",
		"box_style" => "none",
		"bg_color" => "",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"style" => ""
    ), $atts));

    $size = max(5,min(250,$size));
    $height = $size;
    if($box_style == 'square' || $box_style == 'circle') $height = $size * 1.5;

	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($weight != '' ? 'font-weight:'. $weight.';' : '')
		.((int) $size > 0 ? 'font-size:'.$size.'px;' : '')
		.($color !== '' ? 'color:'.$color.';' : '')
		.($bg_color !== '' ? 'background-color:'.$bg_color.';' : '')
		.('font-size: '.$size.'px;')
		.('line-height: '.$size.'px;')
		.('width: '.$height.'px;')
		.('height: '.$height.'px;')
		.$style;

	$c = $icon
		.($align !== ''? ' sc_icon_'.$align : '')
		.($box_style !=='none' || $bg_color !== '' ? ' sc_icon_box sc_icon_box_'.$box_style : '' );

	return $icon!='' ? '<span '.($id ? ' id="sc_icon_'.$id.'"' : '').' class="sc_icon '.$c.'"'.($s != '' ? ' style="'.$s.'"' : '').'></span>' : '';
}

// ---------------------------------- [/icon] ---------------------------------------


// ---------------------------------- [title] ---------------------------------------Ok

add_shortcode('trx_title', 'sc_title');

function sc_title($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"type" => "1",
		"align" => "left",
		"weight" => "inherit",
		"color" => "",
		"height" => "",
		"class" => "",
		//icon
		"size" => "inherit",
		"position" => "inline",
		"box_style" => "none",
		"bg_color" => "",
		"icon_color" => "",
		"icon" => "",
		"icon_image" => "",
		"image_url" => "",
		
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

    $factor = array(
		'inherit' => 1,
		'small' => 0.35,
		'medium' => 0.55,
		'large' => 1.2,
		'huge' => 2 );

    $image_url = getAttachmentID($image_url);
	$type = min(6, max(1, $type));
	$font_size = get_custom_option('header_font_size_h'.$type) * $factor[$size];
	$style_icon = $icon != '' || $bg_color != '' ? 'icon' : ($image_url != '' || $icon_image != '' ? 'image' : '');

	$block_size = getThumbSizes(array(
								'thumb_size' => 'cub_mini',
								'thumb_crop' => true,
								'sidebar' => false ));
	$image_url = $image_url !== ''?	getResizedImageURL($image_url, $block_size['w'], $block_size['h']) : '';

	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($weight && $weight!='inherit' ? 'font-weight:'.$weight .';' : '')
		.($color !== '' ? 'color:'.$color.';' : '')
		.($height !== '' ? 'line-height: '.$height.'px;' : '');

	$c = ($style_icon !== '' ? ' sc_title_style_'.$style_icon : '')
		.($align !=='' ? ' sc_title_'.$align : '')
		.($box_style !== '' && $box_style !=='none' && $style_icon !== '' ? ' sc_title_icon_box_'.$box_style : '' )
		.($class !== '' ? ' '.$class : '');;

	$c_ico = (' sc_icon_size_'.$size)
			.($position !== '' ?  ' sc_icon_'.$position : ' sc_icon_inline')
			.($box_style !== 'none' || $bg_color != '' ? ' sc_icon_box sc_icon_box_'.$box_style : '')
			.($icon!=='' && $icon!=='none' ? ' '.$icon : '');

	$s_ico = ($style_icon == 'icon' ? 'font-size: '.$font_size.'px; line-height: '.$font_size.'px; '.($icon_color !== '' ? 'color:'.$icon_color.';' : '') : '')
			.($style_icon == 'image' ? 'background-image:url('.($image_url !== '' ? $image_url : ($icon_image !=='' ? get_template_directory_uri().'/images/icons/'.$icon_image.'.png' : '' )).');' : ''  )
			.('width: '.$font_size.'px;')
			.('height: '.$font_size.'px;')
			.($bg_color !== '' ? 'background-color: '.$bg_color.';' : '');


	$icons = $style_icon !== '' ? '<span class="sc_icon '.$c_ico.'" '.($s_ico != '' ? 'style="'.$s_ico.'"' : '').'></span>' : '';	
	$icon_left_top = $icon_right = '';
	if($position == 'left' || $position == 'top' || $position == 'inline' ){
		$icon_left_top = $icons;
	} else if($position == 'right'){
		$icon_right = $icons;
	}

	return '<h'.$type.($id ? ' id="sc_title_'.$id.'"' : '').' class="sc_title '.$c.'"'.($s!='' ? ' style="'.$s.'"' : '').'>'
		.$icon_left_top.do_shortcode($content).$icon_right
		.'</h'.$type.'>';
}

// ---------------------------------- [/title] ---------------------------------------


// ---------------------------------- [tooltip] ---------------------------------------Ok

add_shortcode('trx_tooltip', 'sc_tooltip');

function sc_tooltip($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => ""
    ), $atts));
	return '<span'.($id ? ' id="sc_tooltip_'.$id.'"' : '').' class="sc_tooltip">'.do_shortcode($content).'<span class="sc_tooltip_item">'.$title.'</span></span>';
}
// ---------------------------------- [/tooltip] ---------------------------------------

				
// ---------------------------------- [audio] ---------------------------------------Ok

add_shortcode("trx_audio", "sc_audio");
						
function sc_audio($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"author" => "",
		"mp3" => "",
		"wav" => "",
		"src" => "",
		"url" => "",
		"image" => "",
		"controls" => "",
		"autoplay" => "",
		"width" => "100%",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

	// Media elements library

	if ($src=='' && $url=='' && isset($atts[0])) {
		$src = $atts[0];
	}
	if ($src=='') {
		if ($url) $src = $url;
		else if ($mp3) $src = $mp3;
		else if ($wav) $src = $wav;
	}
	$url = getAttachmentID($url);
	$image = getAttachmentID($image);
	$src = getAttachmentID($src);

	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);

	$s = ($top !== '' ? ' margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? ' margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? ' margin-left:'.$left.'px;' : '')
		.($right !== '' ? ' margin-right:'.$right.'px;' : '')
		.($height !== '' && $height > 120 ? ' min-height:'.$height.'px;' : '')
		.($width !== '' ? ' width:'.$width.$ed.';' : '');

	$data = ($title != '' ? ' data-title="'.$title.'"' : '')
		   .($author != '' ? ' data-author="'.$author.'"' : '')
		   .($image != '' ? ' data-image="'.$image.'"' : '');

	$audio = '<audio' . ($id ? ' id="sc_audio_' . $id . '"' : '').' src="'.$src.'" '.(sc_param_is_on($controls) ? ' controls="controls"' : '').(sc_param_is_on($autoplay) && is_single() ? ' autoplay="autoplay"' : '') .$data.'></audio>';

	return getAudioFrame($audio, $image, $s);
}
// ---------------------------------- [/audio] ---------------------------------------


// ---------------------------------- [video] ---------------------------------------Ok

add_shortcode('trx_video', 'sc_video');

function sc_video($atts, $content = null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"url" => "",
		"src" => "",
		"image" => "",
		"title" => "",
		"autoplay" => "off",
		"width" => "",
		"height" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

	if ($src=='' && $url=='' && isset($atts[0])) {
		$src = $atts[0];
	}
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '');
	$block_size = getThumbSizes(array(
								'thumb_size' => 'image_large',
								'thumb_crop' => true,
								'sidebar' => false ));
	$image = getAttachmentID($image);
	if($image!='no'){
		$image_thumb = getResizedImageURL($image, $block_size['w'], $block_size['h']);
		$image_youtube = getVideoImgCode($url);
	}

	$start_frame = $image != 'no' ? true : false;
	$url = getVideoPlayerURL($src!='' ? $src : $url);
	
	$output = '';
	$video = '<div class="videoThumb"><video' . ($id ? ' id="sc_video_' . $id . '"' : '') . ' class="sc_video" src="'.$url.'" width="'.$width.'" height="'.$height.'"' . 
		( is_single() ? ( $image!='no'  || sc_param_is_on($autoplay) ? ' autoplay="autoplay"' : '') : ($image!='no' ? ' autoplay="autoplay"' : '')) . ($s!='' ? ' style="'.$s.'"' : '') . ' controls="controls"></video></div>';

	if( $width == ''){
		$width = $block_size['w'];
		$height = $block_size['h'];
	} else if($width == '' || $width = '100%'){
		$width = $block_size['w'];
		$height = $block_size['h'];
	}

	if ($image && $image!='no') {
		$video = substituteVideo($video, $width, $height, $start_frame);
		$output = getVideoFrame($video,  $image_thumb, $title, $autoplay, $s);
		} else if ( $image!='no') {
			$video = substituteVideo($video, $width, $height, $start_frame);
			$output = getVideoFrame($video, $image_youtube, $title, $autoplay, $s);
			} else {
				$output = $video;
				}
	return $output;
}
// ---------------------------------- [/video] ---------------------------------------


// ---------------------------------- [zoom] ---------------------------------------Ok

add_shortcode('trx_zoom', 'sc_zoom');

function sc_zoom($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"src" => "",
		"url" => "",
		"over" => "",
		"border" => "none",
		"align" => "",
		"width" => "-1",
		"height" => "-1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

    $url = getAttachmentID($url);
    $src = getAttachmentID($src);
    $over = getAttachmentID($over);

	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);

	$s = ($top > 0 ? 'margin-top:' . $top . 'px !important;' : '')
		.($bottom > 0 ? 'margin-bottom:' . $bottom . 'px !important;' : '')
		.($left > 0 ? 'margin-left:' . $left . 'px !important;' : '')
		.($right > 0 ? 'margin-right:' . $right . 'px !important;' : '')
		.($width > 0 ? 'width:' . $width . $ed . ';' : '')
		.($height > 0 ? 'height:' . $height . 'px;' : '');

	if (empty($id)) $id = 'sc_zoom_'.str_replace('.', '', mt_rand());
	themerex_enqueue_script( 'elevate-zoom', get_template_directory_uri() . '/js/jquery.elevateZoom-3.0.4.min.js', array(), null, true );
	return (!sc_param_is_off($border) ? '<div class="sc_border sc_border_'.$border.'">' : '')
				.'<div'.($id ? ' id="sc_zoom_'.$id.'"' : '').' class="sc_zoom"'.($s!='' ? ' style="'.$s.'"' : '').'>'
					.'<img src="'.($src!='' ? $src : $url).'"'.($height > 0 ? ' style="height:'.$height.'px;"' : '').' border="0" data-zoom-image="'.$over.'" alt="" />'
				. '</div>'
			. (!sc_param_is_off($border) ? '</div>' : '');
}
// ---------------------------------- [/zoom] ---------------------------------------


// ---------------------------------- [banner] ---------------------------------------Ok

add_shortcode('trx_banner', 'sc_banner');

function sc_banner($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"src" => "",
		"url" => "",
		"title" => "",
		"link" => "",
		"target" => "",
		"rel" => "",
		"popup" => "no",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "",
		"height" => ""
    ), $atts));
	/*scripts & styles*/
	themerex_enqueue_style(  'magnific-style', get_template_directory_uri() . '/js/magnific-popup/magnific-popup.css', array(), null );
	themerex_enqueue_script( 'magnific', get_template_directory_uri() . '/js/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), null, true );
			
	$ed = themerex_substr($width, -1)=='%' ? '%' : 'px';
	$width = (int) str_replace('%', '', $width);
	$image = $src!='' ? $src : $url;
	$url = getAttachmentID($url);
	$image = getAttachmentID($image);
	$src = getAttachmentID($src);
	//image crop
	$no_crop = getThumbSizes(array(
				'thumb_size' => 'image_large',
				'thumb_crop' => true,
				'sidebar' => false ));
	$crop = array(
		"w" => $width != '' && $ed != '%' ? $width : $no_crop['w'],
		"h" => $height != '' && $ed != '%' ? $height : null
		);
	$image = getResizedImageURL($image, $crop['w'], $crop['h']);
	
	
	$s = ($top > 0 ? 'margin-top:'.$top.'px;' : '')
		.($bottom > 0 ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left > 0 ? 'margin-left:'.$left.'px;' : '')
		.($right > 0 ? 'margin-right:'.$right.'px;' : '')
		.($width > 0 ? 'width:'.$width.$ed.';' : '')
		.($height > 0 ? 'height:'.$height.'px;' : '');
	$c = (sc_param_is_on($popup) ? ' user-popup-link' : '')
		.($align && $align!='none' ? ' sc_float_'.$align : '');
	
	$content = do_shortcode($content);
	return '<a'.($id ? ' id="sc_banner_'.$id.'"' : '').' href="'.($popup == 'yes' ? '#sc_popup_'.$link : $link).'" class="sc_banner '.$c.'"'
		.(!empty($target) ? ' target="'.$target.'"' : '') 
		.(!empty($rel) ? ' rel="'.$rel.'"' : '')
		.($s!='' ? ' style="'.$s.'"' : '')
		.'>'
		.'<img src="'.$image.'" class="sc_banner_image" border="0" alt="" />'
		.(trim($title) ? '<span class="sc_banner_title">'.$title.'</span>' : '')
		.(trim($content) ? '<span class="sc_banner_content">'.$content.'</span>' : '')
		.'</a>';
}

// ---------------------------------- [/banner] ---------------------------------------


// ---------------------------------- [trx_text] ---------------------------------------Ok

add_shortcode('trx_text', 'sc_text');

function sc_text($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"align" => "left",
		"weight" => "inherit",
		"color" => "",
		"spacing" => "",
		"uppercase" => "",
		"height" => "",
		"class" => "",
		//icon
		"size" => "",
		"position" => "inline",
		"box_style" => "none",
		"bg_color" => "",
		"icon_color" => "",
		"icon" => "",
		"icon_image" => "",
		"image_url" => "",
		
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

    $factor = array(
		'inherit' => 1,
		'small' => 0.35,
		'medium' => 0.55,
		'large' => 1.2,
		'huge' => 2 );


 	$image_url = getAttachmentID($image_url);
	$font_size = $size;
	$style_icon = $icon != '' || $bg_color != '' ? 'icon' : ($image_url != '' || $icon_image != '' ? 'image' : '');

	$block_size = getThumbSizes(array(
								'thumb_size' => 'cub_mini',
								'thumb_crop' => true,
								'sidebar' => false ));
	$image_url = $image_url !== ''?	getResizedImageURL($image_url, $block_size['w'], $block_size['h']) : '';

	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($weight && $weight!='inherit' ? 'font-weight:'.$weight .';' : '')
		.($color !== '' ? 'color:'.$color.';' : '')
		.($spacing !== '' ? 'letter-spacing: '.$spacing.'px;' : '')
		.($uppercase == 'yes' || $uppercase == 'on' ? 'text-transform: uppercase;' : '')
		.($size !== '' ? 'font-size: '.$size.'px;' : '')
		.($height !== '' ? 'line-height: '.$height.'px;' : '');

	$c = ($style_icon !== '' ? ' sc_text_style_'.$style_icon : '')
		.($align !=='' ? ' sc_text_'.$align : '')
		.($box_style !== '' && $box_style !=='none' && $style_icon !== '' ? ' sc_text_icon_box_'.$box_style : '' )
		.($class !== '' ? ' '.$class : '');

	$c_ico = (' sc_icon_size_'.$size)
			.($position !== '' ?  ' sc_icon_'.$position : ' sc_icon_inline')
			.($box_style !== 'none' || $bg_color != '' ? ' sc_icon_box sc_icon_box_'.$box_style : '')
			.($icon!=='' && $icon!=='none' ? ' '.$icon : '');

	$s_ico = ($style_icon == 'icon' ? 'font-size: '.$font_size.'px; line-height: '.$font_size.'px; '.($icon_color !== '' ? 'color:'.$icon_color.';' : '') : '')
			.($style_icon == 'image' ? 'background-image:url('.($image_url !== '' ? $image_url : ($icon_image !=='' ? get_template_directory_uri().'/images/icons/'.$icon_image.'.png' : '' )).');' : ''  )
			.('width: '.$font_size.'px;')
			.('height: '.$font_size.'px;')
			.($bg_color !== '' ? 'background-color: '.$bg_color.';' : '');


	$icons = $style_icon !== '' ? '<span class="sc_icon '.$c_ico.'" '.($s_ico != '' ? 'style="'.$s_ico.'"' : '').'></span>' : '';	
	$icon_left_top = $icon_right = '';
	if($position == 'left' || $position == 'top' || $position == 'inline' ){
		$icon_left_top = $icons;
	} else if($position == 'right'){
		$icon_right = $icons;
	}

	return '<p '.($id ? ' id="sc_text_'.$id.'"' : '').' class="sc_text '.$c.'"'.($s!='' ? ' style="'.$s.'"' : '').'>'
		.$icon_left_top.do_shortcode($content).$icon_right
		.'</p>';
}

// ---------------------------------- [/trx_text] ---------------------------------------


// ---------------------------------- [trx_around] ---------------------------------------Ok

add_shortcode('trx_around', 'sc_around');

$THEMEREX_sc_around_counter = 0;
$THEMEREX_sc_around_left_content = '';
$THEMEREX_sc_around_right_content = '';

function sc_around($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
    	"id" => "",
		"image" => "",
		"style" => "",
		"align" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "",
		"height" => ""
    ), $atts));

	global $THEMEREX_sc_around_counter, $THEMEREX_sc_around_left_content, $THEMEREX_sc_around_right_content;
    $THEMEREX_sc_around_left_content = '';
    $THEMEREX_sc_around_right_content = '';
	$THEMEREX_sc_around_counter = 0;

	$content = do_shortcode($content);
	$image = getAttachmentID($image);
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.($width !== '' ? 'max-width:'.$width.'px;' : '')
		.($align == 'center' ? 'margin-left: auto; margin-right: auto;' : '')
		.($align == 'left' ? 'margin-left: 0;' : '')
		.($align == 'right' ? ' margin-right: 0; margin-left: auto;' : '')
		.($height !== '' ? 'min-height:'.$height.'px;' : '')
		.($style !== '' ? $style : '');


	return '<div class="sc_around_list" style="'.$s.'">'
			.'<div class="sc_around_left">'
			.$THEMEREX_sc_around_left_content 
			.'</div>'
			.'<div class="sc_around_image"><div class="sc_around_bg" '.($image != '' ? 'style="background-image: url('.$image.')"' : '').'></div></div>'
			.'<div class="sc_around_right">'
			.$THEMEREX_sc_around_right_content 
			.'</div>'
			.'</div>';
}


add_shortcode('trx_around_item', 'sc_around_item');

function sc_around_item($atts, $content=null) {
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts( array(
		"link" => "",
		"color" => ""
	), $atts));
	global $THEMEREX_sc_around_counter, $THEMEREX_sc_around_left_content, $THEMEREX_sc_around_right_content;
	$THEMEREX_sc_around_counter++;

	$output = '';

	if($THEMEREX_sc_around_counter <= 6){
		$content = do_shortcode($content);

		$n = '<div class="sc_around_item">'
			    .($link != '' ? '<a href="'.$link.'" style="color: '.$color.';"><span>'.$content.'</span></a>' : '<span>'.$content.'</span>')
				.'<div class="sc_around_line">'
                .'<div class="sc_around_head"></div></div>'
             .'</div>';

		if($THEMEREX_sc_around_counter % 2 == 1){
			$THEMEREX_sc_around_left_content .= $n; 
			$THEMEREX_sc_around_right_content .= '';
		}
		else if($THEMEREX_sc_around_counter % 2 == 0){
			$THEMEREX_sc_around_right_content .= $n; 
			$THEMEREX_sc_around_left_content .= '';
		}
	}
	
	return $output;
}
// ---------------------------------- [/trx_around] ---------------------------------------


// ---------------------------------- [aside] ---------------------------------------Ok

add_shortcode('trx_aside', 'sc_aside');

function sc_aside($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"title" => "",
		"link" => "",
		"image" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));

    $image = getAttachmentID($image);
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '');

	$title = $title=='' ? $link : $title;
	$content = do_shortcode($content);
	if (themerex_substr($content, 0, 2)!='<p') $content = '<p>'.$content.'</p>';
	return '<div'.($id ? ' id="sc_aside_'.$id.'"' : '').' class="sc_aside"'.($s ? ' style="'.$s.'"' : '').'>'
		.($image != '' ? '<div class="sc_aside_image"><img src="'.$image.'" alt=""></div>' : '')
		.($title == '' ? '' : ('<div class="sc_aside_title">'.($link!='' ? '<a href="'.$link.'">' : '').$title.''.($link!='' ? '</a>' : '').'</div>'))
		.'<div class="sc_aside_content">'.$content.'</div>'
		.'</div>';
}
// ---------------------------------- [/aside] ---------------------------------------


// ---------------------------------- [status] ---------------------------------------Ok

add_shortcode('trx_status', 'sc_status');

function sc_status($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));


	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '');

	$content = do_shortcode($content);
	if (themerex_substr($content, 0, 2)!='<p') $content = '<p>'.$content.'</p>';
	return '<div'.($id ? ' id="sc_status_'.$id.'"' : '').' class="sc_status"'.($s ? ' style="'.$s.'"' : '').'>'
		.'<div class="sc_status_content">'.$content.'</div>'
		.'</div>';
}
// ---------------------------------- [/status] ---------------------------------------


// ---------------------------------- [trx_points] ---------------------------------------Ok

add_shortcode('trx_points', 'sc_points');

$THEMEREX_sc_points_type = 0;
$THEMEREX_sc_points_arrows = 0;
$THEMEREX_sc_arrows_color = '';
function sc_points($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"id" => "",
		"style" => "",
		"type" => "1",
		"arrows" => "yes",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"arrow_color" => ""
    ), $atts));

    global $THEMEREX_sc_points_type, $THEMEREX_sc_points_arrows, $THEMEREX_sc_arrows_color;
    $THEMEREX_sc_points_type = $type;
	$THEMEREX_sc_points_arrows = $arrows;
	$THEMEREX_sc_arrows_color = $arrow_color;
	$s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:'.$left.'px;' : '')
		.($right !== '' ? 'margin-right:'.$right.'px;' : '')
		.$style;

	$content = do_shortcode($content);

	return '<div'.($id ? ' id="sc_status_'.$id.'"' : '').' class="sc_points sc_points_style_'.$type.'"'.($s ? ' style="'.$s.'"' : '').' >'
		.$content
		.'</div>';
}

add_shortcode('trx_point_item', 'sc_point_item');

function sc_point_item($atts, $content=null){	
	if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"icon" => "",
		"image" => "",
		"color" => "",
		"background" => "",
		"size" => "100",
		"link" => ""
    ), $atts));

    $image = getAttachmentID($image);
    global $THEMEREX_sc_points_type, $THEMEREX_sc_points_arrows, $THEMEREX_sc_arrows_color;
    $type = $THEMEREX_sc_points_type;
    $arrows = $THEMEREX_sc_points_arrows;

    $s = ($background !== '' ? 'background-color: '.$background.';' : '');


	$content = do_shortcode($content);

	if($type == "1")
	{
	//	if(strlen($content) > 60) $content = substr($content, 0, 60).' ...';
		$a = '<div class="sc_point_arrow"><span class="icon icon-left96" '.($THEMEREX_sc_arrows_color !== '' ? 'style="color: '.$THEMEREX_sc_arrows_color.';"' : ($background !== '' ? 'style="color: '.$background.';"' : 'style="color: '.$color.';"')).'></span></div>';

		return '<'.($link !== '' ? 'a href="'.$link.'"' : 'div').'  class="sc_point_item" style="'.$s.'">'
			.'<div class="sc_point_item_icon"><span class="icon '.$icon.'" style="font-size: '.$size.'px; '.($color != '' ? 'color: '.$color.'' : '').'"></span></div>'
			.'<div class="sc_point_item_content" '.($background == '' ? 'style="color: '.$color.';"' : '').'>'.$content.'</div>'
			.'</'.($link !== '' ? 'a' : 'div').'>'
			.($arrows == 'yes' ? $a : '');
	}
	else
	{
		$a = '<div class="sc_point_arrow"><span class="icon icon-right-bold" '.($THEMEREX_sc_arrows_color !== '' ? 'style="color: '.$THEMEREX_sc_arrows_color.';"' : ($background !== '' ? 'style="color: '.$background.';"' : 'style="color: '.$color.';"')).'></span></div>';

		return '<'.($link !== '' ? 'a href="'.$link.'"' : 'div').'  class="sc_point_item">'
			.'<div class="sc_point_item_image"><img src="'.$image.'" alt=""></div>'
			.'<div class="sc_point_item_content" '.($color != '' ? 'style="color:'.$color.';"' : '').'>'.$content.'</div>'
			.'</'.($link !== '' ? 'a' : 'div').'>'
			.($arrows == 'yes' ? $a : '');
	}
}
// ---------------------------------- [/trx_point] ---------------------------------------


// ---------------------------------- [trx_wave] ---------------------------------------Ok

add_shortcode('trx_wave', 'sc_wave');

function sc_wave($atts, $content=null){	
		if (in_shortcode_blogger()) return '';
    extract(shortcode_atts(array(
		"width" => "",
		"type" => "1",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => ""
    ), $atts));
    $ed_l = ($left !== 'auto' ? themerex_substr($left, -1)=='%' ? '' : 'px' : '');
    $ed_r = ($right !== 'auto' ? themerex_substr($right, -1)=='%' ? '' : 'px' : '');
    $s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		.($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		.($left !== '' ? 'margin-left:' . $left .$ed_l. ';' : '')
		.($right !== '' ? 'margin-right:' . $right .$ed_r. ';' : '')
		.($width !== '' ? 'width: '.$width.'px;' : '');

	return '<div class="sc_wave sc_type_'.$type.'" style="'.$s.'"></div>';
    
}

// ---------------------------------- [/trx_wave] ---------------------------------------


// ---------------------------------- [trx_more] ---------------------------------------Ok
add_shortcode('trx_more', 'sc_more');

function sc_more($atts, $content=null){
	if (in_shortcode_blogger()) return '';
	 extract(shortcode_atts(array(
		"id" => "",
		"open" => "no",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"color" => ""
    ), $atts));

	 $s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		 .($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		 .($left !== '' ? 'margin-left:' . $left .$ed_l. ';' : '')
		 .($right !== '' ? 'margin-right:' . $right .$ed_r. ';' : '');
	if($open == 'yes') 
		return '<div class="sc_more hidden"></div>';
			
	else 
		return '<div class="sc_more" data-id="'.$id.'">'
                .'<div class="icon-down-open"></div>'
                .'<span '.($color != '' ? 'style="color: '.$color.';' : '').'">more</span>'
            .'</div>';
}	
// ---------------------------------- [/trx_more] ---------------------------------------


// ---------------------------------- [trx_islands] ---------------------------------------Ok
add_shortcode('trx_islands', 'sc_islands');


$THEMEREX_sc_islands_counter;
function sc_islands($atts, $content=null){
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => "",
		"align" => "",
		"style" => ""
	), $atts));

	 $ed_l = ($left !== 'auto' ? themerex_substr($left, -1)=='%' ? '%' : 'px' : '');
     $ed_r = ($right !== 'auto' ? themerex_substr($right, -1)=='%' ? '%' : 'px' : '');
	 $s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		 .($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		 .($left !== '' ? 'margin-left:' . $left .$ed_l. ';' : '')
		 .($right !== '' ? 'margin-right:' . $right .$ed_r. ';' : '')
		 .($width !== '' ? 'width:'.$width.'px;' : '');

	global $THEMEREX_sc_islands_counter;
	$THEMEREX_sc_islands_counter = 0;

	$content = do_shortcode($content);
	return  '<div class="sc_islands '.($style == 'dark' ? 'sc_style_dark' : '').'" '.($id != '' ? 'id="'.$id.'"' : '').' style="'.$s.'">'
			.'<div class="sc_islands_wrap">'
            .$content
            .'</div>'
            .'</div>';          
}
// ---------------------------------- [/trx_islands] ---------------------------------------


// ---------------------------------- [trx_island_item] ---------------------------------------Ok
add_shortcode('trx_island_item', 'sc_island_item');


function sc_island_item($atts, $content=null){
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"url" => ""
	), $atts));


	global $THEMEREX_sc_islands_counter;
	$THEMEREX_sc_islands_counter++;

	$content = do_shortcode($content);

	if($THEMEREX_sc_islands_counter <= 5)
	return  '<a href="'.$url.'" class="sc_island_item style_'.$THEMEREX_sc_islands_counter.'">'
			.'<div class="sc_island_image"></div>'
            .'<div class="sc_island_title">'.$content.'</div>'
            .'</a>';          
}
// ---------------------------------- [/trx_island_item] ---------------------------------------

function getAttachmentID($image){
 //get attachment WP
 if ($image > 0) {
  $attach = wp_get_attachment_image_src( $image, 'full' );
  if (isset($attach[0]) && $attach[0]!='')
   $image = $attach[0];
 }
 return $image;
}


// ---------------------------------- [trx_blockquote] ---------------------------------------
add_shortcode('trx_blockquote', 'sc_blockquote');


function sc_blockquote($atts, $content=null){
	if (in_shortcode_blogger()) return '';

	$content = do_shortcode($content);

	if($THEMEREX_sc_islands_counter <= 5)
	return  '<blockquote>'
			.$content
            .'</blockquote>';          
}
// ---------------------------------- [/trx_blockquote] ---------------------------------------


// ---------------------------------- [trx_graph] ---------------------------------------Ok
add_shortcode('trx_graph', 'sc_graph'); 
//type= "line | curve"
function sc_graph($atts, $content=null){
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"id" => "",
		"labels" => "Label1, Label2, Label3",
		"type" => "Curve",
		"style" => "",
		"top" => "",
		"bottom" => "",
		"left" => "",
		"right" => "",
		"width" => ""
	), $atts));
	themerex_enqueue_script( 'diagram-chart', get_template_directory_uri() . '/js/diagram/chart.min.js', array(), null, true );
	themerex_enqueue_script( 'diagram-raphael', get_template_directory_uri() . '/js/diagram/diagram.raphael.js', array(), null, true );
	themerex_enqueue_script( 'graph', get_template_directory_uri() . '/js/diagram/Graph.js', array('jquery'), null, true );
	
	 $ed_l = ($left !== 'auto' ? themerex_substr($left, -1)=='%' ? '%' : 'px' : '');
     $ed_r = ($right !== 'auto' ? themerex_substr($right, -1)=='%' ? '%' : 'px' : '');
	 $s = ($top !== '' ? 'margin-top:'.$top.'px;' : '')
		 .($bottom !== '' ? 'margin-bottom:'.$bottom.'px;' : '')
		 .($left !== '' ? 'margin-left:' . $left .$ed_l. ';' : '')
		 .($right !== '' ? 'margin-right:' . $right .$ed_r. ';' : '')
		 .($width !== '' ? 'width:'.$width.'px;' : '');

	$content = do_shortcode($content);   
	if($type == 'line') $type = 'Line';
	return '<div class="tw-chart-graph tw-animate tw-redraw with-list-desc" data-zero="false" data-labels="'.$labels.'"'
			.'data-type="'.$type.'" data-item-height="" data-animation-delay="0" data-animation-offset="90%" style="'.$s.'">'
			.'<ul class="data" style="display: none;">'
			.$content
			.'</ul>'
			.'<canvas></canvas>'
			.'</div>';	
}
// ---------------------------------- [/trx_graph] ---------------------------------------


// ---------------------------------- [trx_graph_item] ---------------------------------------Ok
add_shortcode('trx_graph_item', 'sc_graph_item');

function sc_graph_item($atts, $content=null){
	if (in_shortcode_blogger()) return '';
	extract(shortcode_atts(array(
		"datas" => "10,40,60,30,70",
		"color" => "#5ea281",
	), $atts));
	if($content == '') $content = "Attribute";
	return  '<li data-datas="'.$datas.'" data-fill-color="'.$color.'" data-fill-text="'.$content.'"></li>';          
}
// ---------------------------------- [/trx_graph_item] ---------------------------------------
