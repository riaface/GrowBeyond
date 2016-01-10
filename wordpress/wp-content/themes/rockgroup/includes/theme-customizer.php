<?php
// Redefine colors in styles
$THEMEREX_custom_css = "";

function getThemeCustomStyles() {
	global $THEMEREX_custom_css;
	return $THEMEREX_custom_css;
}

function addThemeCustomStyle($style) {
	global $THEMEREX_custom_css;
	$THEMEREX_custom_css .= " {$style} \r\n";
}


function prepareThemeCustomStyles() {

	// Custom font
	$fonts = getThemeFontsList(false);
	$theme_font = get_custom_option('theme_font');
	$header_font = get_custom_option('header_font');

	$theme_color = get_custom_option('theme_color');
	$theme_accent_color = get_custom_option('theme_accent_color');
	$background_color = get_custom_option('body_bg_color');

	$logo_widht = get_custom_option('logo_block_width');

	//theme fonts
	if (isset($fonts[$theme_font])) {
		addThemeCustomStyle('
			body, button, input, select, textarea { font-family: \''.$theme_font.'\', '.$fonts[$theme_font]['family'].'; }'); 
	}


	// heading fonts
	if (isset($fonts[$header_font])) {
		addThemeCustomStyle(
			(get_theme_option('show_theme_customizer') == 'yes' ? '.custom_options .co_label, .custom_options .co_header span, ' : '').
			'h1, h2, h3, h4, h5, h6,
			.h1,.h2,.h3,.h4,.h5,.h6,
			#header,
			.logoHeader, .subTitle,
			.widget_calendar table caption,
			.sc_button,
			.widget_calendar,
			.widget_search .searchFormWrap .searchSubmit,
			.sc_video_frame .sc_video_frame_info_wrap .sc_video_frame_info .sc_video_frame_player_title,
			.widget_popular_posts .ui-tabs-nav li a,
			.format-quote .sc_quote,
			.sc_tabs ul.sc_tabs_titles li a,
			.sc_testimonials_item_quote,
			.sc_testimonials_item_user,
			.sc_price_item,
			.sc_pricing_table .sc_pricing_item ul li.sc_pricing_title,
			.sc_skills_arc .sc_skills_legend li,
			.sc_skills_counter,
			.sc_countdown_flip .flip-clock-wrapper ul,
			.sc_countdown_round .countdown-amount{ font-family: \''.$header_font.'\',\''.$theme_font.'\', '.$fonts[$header_font]['family'].'; }'); 
	}
	


	//Custom heading H1-H6
	$hCounter = 1;
	while( $hCounter <= 6 ){
		$heading_array = array();
		$heading_array[] = 'letter-spacing:'.(get_custom_option('header_font_spacing_h'.$hCounter) != '' ? get_custom_option('header_font_spacing_h'.$hCounter) : 0 ).'px;';
		$heading_array[] = 'font-size:'.get_custom_option('header_font_size_h'.$hCounter).'px;';
		$heading_array[] = get_custom_option('header_font_uppercase_h'.$hCounter) == 'yes' ? 'text-transform: uppercase;' : 'text-transform: capitalize;';
		$heading_array[] = 'font-style:'.get_custom_option('header_font_style_h'.$hCounter).';';
		$heading_array[] = 'font-weight:'.get_custom_option('header_font_weight_h'.$hCounter).';';
		$heading_array[] = 'line-height:'.round((get_custom_option('header_font_size_h'.$hCounter)*1.2)).'px;'; 
		$heading_array[] = 'margin: 0 0 '.round((get_custom_option('header_font_size_h'.$hCounter)/2)).'px 0;'; 

		$extra_h2 = $hCounter == 2 ? ', .sc_video_frame .sc_video_frame_info_wrap .sc_video_frame_info .sc_video_frame_player_title' : '';

		addThemeCustomStyle('h'.$hCounter.$extra_h2.'{ '.( !empty($heading_array) ? join(' ', $heading_array) : '').' }');
		$hCounter++;
	}

	//Custom logo style
	if( get_custom_option('logo_type') == 'logoImage'){
		//images style
		addThemeCustomStyle('
			.wrap.logoImageStyle .logoHeader{ width:'.$logo_widht.'px; }
			.wrap.logoImageStyle .logo_bg_size{ border-width: 45px '.($logo_widht/2).'px 0 '.($logo_widht/2).'px; }
			.menu-logo{ width:'.$logo_widht.'px; }' );
		
	} else {
		//logo text style
		$style_logo_array  = array();
		$style_logo_array[] = 'font-family:"'.get_custom_option('logo_font').'";'; 
		$style_logo_array[] = 'font-style:'.get_custom_option('logo_font_style').';'; 
		$style_logo_array[] = 'font-weight:'.get_custom_option('logo_font_weight').';'; 
		$style_logo_array[] = 'font-size:'.get_custom_option('logo_font_size').'px;'; 
		$style_logo_array[] = 'line-height:'.get_custom_option('logo_font_size').'px;'; 
		addThemeCustomStyle('
			.wrap.logoTextStyle .logoHeader{ width:'.$logo_widht.'px; '.(!empty($style_logo_array) ? join(' ', $style_logo_array) : '').' }
			.wrap.logoTextStyle .logo_bg_size{ border-width: 45px '.($logo_widht/2).'px 0 '.($logo_widht/2).'px; } 
			.menu-logo{ width:'.$logo_widht.'px; }
			.wrapTopMenu .topMenu .logo a{'.(!empty($style_logo_array) ? join(' ', $style_logo_array) : '').'}');
	}

	//background custom style
	if( get_custom_option('body_style') == 'boxed'){
		$style_custom_array  = array();
		get_custom_option('bg_color') != '' ? $style_custom_array[] = get_custom_option('bg_color') : '';
		if ( get_custom_option('bg_custom_image') != ''){
			$style_custom_array[] = 'url('.get_custom_option('bg_custom_image').')' ;
			$style_custom_array[] = get_custom_option('bg_custom_image_position_x');
			$style_custom_array[] = get_custom_option('bg_custom_image_position_y');
			$style_custom_array[] = get_custom_option('bg_custom_image_repeat');
			$style_custom_array[] = get_custom_option('bg_custom_image_attachment');
		}
		addThemeCustomStyle('
			.wrap{ background-color: '.(!empty($style_custom_array) ? join(' ', $style_custom_array) : '').';}');
		addThemeCustomStyle('
		 	.bodyStyleBoxed .wrapBox{background-color: '.get_custom_option('body_bg_color').';}');
	}

	if($theme_color == '') $theme_color = '#5ea281';
	if($theme_accent_color == '') $theme_accent_color = '#a7d692';


	//theme color
	if($theme_color != ''){
		addThemeCustomStyle('
		/*color*/
		a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
		.h1 a:hover,.h2 a:hover,.h3 a:hover,.h4 a:hover,.h5 a:hover,.h6 a:hover,
		.logoHeader a, .subTitle, 
		#header .rightTop a,
		.menuStyle2 .wrapTopMenu .topMenu > ul > li > ul li.sfHover > a,
		.menuStyle2 .wrapTopMenu .topMenu > ul > li > ul li a:hover,
		.menuStyle2 .wrapTopMenu .topMenu > ul > li > ul li.menu-item-has-children:after,
		.widget_twitter ul > li:before,
		.widget_twitter ul > li a,
		.widget_rss ul li a,
		.widget_trex_post .ui-tabs-nav li a,
		.nav_pages ul li a:hover,
		.postFormatIcon:before,
		.comments .commentModeration .icon,
		.sc_button.sc_button_skin_dark.sc_button_style_line:hover,
		.sc_button.sc_button_skin_global.sc_button_style_line,
		.sc_quote, blockquote,
		.sc_toggl.sc_toggl_style_1 .sc_toggl_item .sc_toggl_title:hover,
		.sc_toggl.sc_toggl_style_2 .sc_toggl_item .sc_toggl_title:hover,
		.sc_dropcaps.sc_dropcaps_style_3 .sc_dropcap,
		.sc_highlight.sc_highlight_style_2 ,
		.sc_tabs.sc_tabs_style_2 ul li a,
		.sc_tabs.sc_tabs_style_1 ul li.ui-tabs-active a,
		.sc_testimonials .sc_testimonials_item_author .sc_testimonials_item_user,
		ul.sc_list.sc_list_style_iconed li:before,
		ul.sc_list.sc_list_style_iconed.sc_list_marked_yes li,
		ul.sc_list.sc_list_style_iconed li.sc_list_marked_yes ,
		.sc_button.sc_button_skin_global.sc_button_style_line,
		.sc_quote, blockquote,
		.sc_dropcaps.sc_dropcaps_style_3 .sc_dropcap,
		.sc_team .sc_team_item:hover .sc_team_item_title,
		.sc_team .sc_team_item:hover .sc_team_item_position,
		.sc_countdown.sc_countdown_round .sc_countdown_counter .countdown-section .countdown-amount,
		.sc_countdown .flip-clock-wrapper ul li a div div.inn,
		.isotopeWrap .fullItemWrap .fullItemClosed:hover,
		.postInfo .postReview .revBlock .ratingValue,
		.reviewBlock .reviewTab .revTotalWrap .revTotal .revRating,
		.reviewBlock .reviewTab .revWrap .revBlock .ratingValue,
		.sc_countdown.sc_countdown_round .sc_countdown_counter .countdown-section:after,
		.isotopeWrap .isotopeItem .isotopeContent .isotopeTitle a:hover,
		.sc_toggl.sc_toggl_style_4.sc_toggl_icon_show .sc_toggl_item .sc_toggl_title:before,
		.sc_toggl.sc_toggl_style_4 .sc_toggl_item.sc_active .sc_toggl_title,
		.sc_table.sc_table_style_1 table tbody tr td.first,
		.sc_table.sc_table_style_1 table thead tr th.first,.sc_skills_counter .sc_skills_item.sc_skills_style_1 .sc_skills_count,
                .sc_skills_counter .sc_skills_item.sc_skills_style_2 .sc_skills_count,
		.sc_quote.sc_quote_style2 .icon-quote, blockquote.sc_quote_style2 .icon-quote,
		.author .authorInfo .authorTitle a, 
		.comments .commentInfo .commAuthor a,
		.comments .commentInfo .commReply a,
		.comments .commentInfo .commAuthor,
		.sc_slider_swiper .slides li .sc_slider_info a:hover,
		.sc_testimonials .sc_testimonials_item_author .sc_testimonials_item_user,
		.sc_testimonials.sc_testimonials_style_2 .sc_slider_swiper.sc_slider_controls .slider-control-nav li a:before,
		ul.sc_list.sc_list_style_iconed li:before,
		ul.sc_list.sc_list_style_iconed.sc_list_marked_yes li,
		ul.sc_list.sc_list_style_iconed li.sc_list_marked_yes,
		.sc_chat .sc_quote_title,
		.sc_aside_title,
		.post.type-post.format-link a p,
		.sc_button.sc_button_skin_dark.sc_button_style_line:hover,
		.sc_button.sc_button_skin_global.sc_button_style_line,
		.sc_quote, blockquote,
		.sc_quote .sc_quote_title, blockquote .sc_quote_title,
		.sc_toggl.sc_toggl_style_1 .sc_toggl_item .sc_toggl_title:hover,
		.sc_toggl.sc_toggl_style_1 .sc_toggl_item .sc_toggl_title:hover a,
		.sc_toggl.sc_toggl_style_2 .sc_toggl_item .sc_toggl_title:hover,
		.sc_toggl.sc_toggl_style_4 .sc_toggl_item .sc_toggl_title:hover,
		.sc_toggl.sc_toggl_style_4 .sc_toggl_item .sc_toggl_title:hover a,
		.sc_dropcaps.sc_dropcaps_style_3 .sc_dropcap,
		.sc_countdown.sc_countdown_round .sc_countdown_counter .countdown-section .countdown-amount,
		.sc_highlight.sc_highlight_style_2,
		.sc_highlight.sc_highlight_style_2 a,
		.sc_pricing_table:not(.sc_pricing_table_blue).sc_pricing_table_style_1 .sc_pricing_price,
		.sc_pricing_table:not(.sc_pricing_table_blue).sc_pricing_table_style_2 .sc_pricing_price,
		.sc_pricing_table:not(.sc_pricing_table_blue).sc_pricing_table_style_3  .sc_button.sc_button_skin_global,
		.sc_tabs.sc_tabs_style_2 ul li a,
		.logoHeader a,
		.subTitle,
		.wrapTopMenu .topMenu > ul > li > a:hover,
		.hideMenuDisplay .usermenuArea > ul > li > a,
		.menuStyle1 #header ul > li > ul li.sfHover > a,
		.menuStyle1 #header ul > li > ul li a:hover,
		.menuStyle2 #header ul > li > ul li.sfHover > a,
		.menuStyle2 #header ul > li > ul li a:hover,
		.widgetWrap ul > li,
		.widget_twitter ul > li:before,
		.widget_twitter ul > li a,
		.widget_rss ul li a,
		.widget_trex_post .ui-tabs-nav li a,
		.revItem .revBlock .ratingValue,
		.reviewBlock .reviewTab .revWrap .revBlock .ratingValue,
		.reviewBlock .reviewTab .revTotalWrap .revTotal .revRating,
		.nav_pages ul li a:hover,
		.hoverUnderline a:hover,
		.postFormatIcon:before,
		.page404 .title404,
		.comments .commentModeration .icon,
		.isotopeWrap .isotopeItem .isotopeContent .isotopeTitle a:hover,
		.isotopeWrap .fullItemWrap .fullItemClosed:hover,
		.isotopeWrap .fullItemWrap .isotopeNav:hover,
		.sc_pricing_table.sc_pricing_table_style_1 .sc_pricing_item ul li.sc_pricing_title,
		.sc_pricing_table.sc_pricing_table_style_1 .sc_pricing_item ul li.sc_pricing_price,
		.sc_pricing_table.sc_pricing_table_style_3 .sc_pricing_item ul li.sc_pricing_price,
		li.sc_list_item.sc_list_marked_yes,
		.isotopeWrap .isotopeItem .isotopeContent .isotopeCats a:hover,
		.sc_contact_info .sc_contact_info_name,
		.woocommerce .star-rating:before, .woocommerce .star-rating:before,
		.woocommerce .star-rating span, .woocommerce .star-rating span,
		.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong ,
		table.shop_table.cart th, .wrapTopMenu .topMenu div > ul > li > a:hover,
		.sideBarWide .sc_button.sc_button_skin_dark.sc_button_style_bg:hover,
		.sideBarWide .postSharing .postSpan .revInfo:hover, .sc_required, q,
		.widget_trex_post .post_item .post_wrapper .post_title a:hover ,
		.widgetWrap ul > li a:hover,
		.sideBar a:hover{ color: '.$theme_color.'; }
		
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{color: '.$theme_color.' !important; }

		input[type="search"]::-webkit-search-cancel-button {color: '.$theme_color.';}
		
		/*border*/
		.isotopeWrap .isotopeItem .isotopeRating{ border-color: '.$theme_color.' transparent;}
		.woocommerce ul.products li.product a:hover img {border-bottom: 2px solid '.$theme_color.' !important;}

		.nav_pages ul li a:hover,
		.wrapTopMenu .topMenu > ul > li > ul,
		.menuStyle1 .wrapTopMenu .topMenu > ul > li > ul > li ul,
		.menuStyle2 .wrapTopMenu .topMenu > ul > li > ul > li ul,
		.widget_trex_post .ui-tabs-nav li a,
		.sc_button.sc_button_skin_dark.sc_button_style_line:hover,
		.sc_button.sc_button_skin_global.sc_button_style_line,
		.sc_tooltip,
		.sc_tooltip .sc_tooltip_item,
		.sc_tabs.sc_tabs_style_2 ul li a,
		.sc_tabs.sc_tabs_style_2 ul li + li a,
		.sc_tabs.sc_tabs_style_2 .sc_tabs_array,
		.sc_banner:before,
		.sc_button.sc_button_skin_global.sc_button_style_line,
		.sc_banner:before,
		.sc_button.sc_button_skin_dark.sc_button_style_line:hover,
		.sc_button.sc_button_skin_global.sc_button_style_line,
		.sc_tabs.sc_tabs_style_2 ul li a,
		.sc_tabs.sc_tabs_style_2 ul li + li a,
		.sc_tabs.sc_tabs_style_2 .sc_tabs_array,,
		.wrapTopMenu .topMenu > ul > li > ul,
		.usermenuArea > ul > li > ul,
		.menuStyle2 #header ul > li > ul > li ul,
		.widget_calendar table tbody td#today span,
		.widget_trex_post .ui-tabs-nav li a,
		.nav_pages ul li a:hover, .sc_tabs.sc_tabs_style_2 ul.sc_tabs_titles li.ui-tabs-active a{ border-color: '.$theme_color.'; }

		.sc_tooltip .sc_tooltip_item:before,
		.logoStyleBG .logoHeader .logo_bg_size,
		.isotopeWrap .isotopeItem .isotopeRating:after,
		.sc_slider_swiper .sc_slider_info .sc_slider_reviews_short:after,
		.sc_tooltip .sc_tooltip_item:before,
		.logoStyleBG .logoHeader .logo_bg_size { border-color: '.$theme_color.' transparent transparent transparent; }

		.widget_recent_reviews .post_item .post_wrapper .post_info .post_review:after{ border-color: transparent transparent transparent '.$theme_color.'; }
		.buttonScrollUp { border-color: transparent transparent '.$theme_color.' transparent; }
		.sc_testimonials.sc_testimonials_style_1 .sc_testimonials_item_author_show .sc_testimonials_item_quote:after { border-left-color: '.$theme_color.'; }

		.widget_calendar table tbody td#today { outline: 1px solid '.$theme_color.'; }
		.sc_testimonials.sc_testimonials_style_1 .sc_testimonials_item_author_show .sc_testimonials_item_quote:after{  border-left-color: '.$theme_color.'; }
		.sc_pricing_table.sc_pricing_table_style_1 .sc_pricing_item ul li.sc_pricing_title,
		.sc_tooltip{border-bottom-color: '.$theme_color.';}
		.postInfo .stickyPost:after{ border-color: transparent transparent transparent '.$theme_color.'; }


		/*background*/
		#header .openTopMenu,
		.menuStyle1 .wrapTopMenu .topMenu > ul > li > ul > li ul,
		.menuStyle2 .wrapTopMenu .topMenu > ul > li > ul li a:before,
		.widget_calendar table tbody td a:before,
		.widget_calendar table tbody td a:hover, 
		.widget_tag_cloud a:hover,
		.widget_trex_post .ui-tabs-nav li.ui-state-active a,
		.nav_pages ul li span,
		.sc_button.sc_button_skin_global.sc_button_style_bg,
		.sc_video_frame.sc_video_active:before,
		.sc_toggl.sc_toggl_style_2.sc_toggl_icon_show .sc_toggl_item .sc_toggl_title:after,
		.sc_toggl.sc_toggl_style_3 .sc_toggl_item .sc_toggl_title ,
		.sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap,
		.sc_tooltip .sc_tooltip_item,
		.sc_table.sc_table_style_2 table thead tr th,
		.sc_pricing_table.sc_pricing_table_style_2 .sc_pricing_item ul li.sc_pricing_title,
		.sc_pricing_table.sc_pricing_table_style_3 .sc_pricing_item ul li.sc_pricing_title,
		.sc_scroll .sc_scroll_bar .swiper-scrollbar-drag,
		.sc_skills_bar .sc_skills_item .sc_skills_count ,
		.sc_skills_bar.sc_skills_vertical .sc_skills_item .sc_skills_count ,
		.sc_icon.sc_icon_box,
		.sc_icon.sc_icon_box_circle,
		.sc_icon.sc_icon_box_square,
		.sc_slider.sc_slider_dark .slider-pagination-nav span.swiper-active-switch ,
		.sc_slider.sc_slider_light .slider-pagination-nav span.swiper-active-switch,
		.sc_testimonials.sc_testimonials_style_1 .sc_testimonials_item_quote,
		.sc_testimonials.sc_testimonials_style_2 .sc_testimonials_title:after,
		.sc_testimonials.sc_testimonials_style_2 .sc_slider_swiper.sc_slider_pagination .slider-pagination-nav span.swiper-active-switch,
		.sc_button.sc_button_skin_global.sc_button_style_bg,
		.sc_video_frame.sc_video_active:before,
		.sc_loader_show:before,
		.sc_toggl.sc_toggl_style_2.sc_toggl_icon_show .sc_toggl_item .sc_toggl_title:after ,
		.sc_toggl.sc_toggl_style_3 .sc_toggl_item .sc_toggl_title ,
		.sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap,
		.postInfo .postReview .revBlock.revStyle100 .ratingValue,
		.reviewBlock .reviewTab .revWrap .revBlock.revStyle100 .ratingValue,
		.post-password-required .post-password-form input[type="submit"]:hover,
		.sc_button.sc_button_skin_dark.sc_button_style_bg:hover, 
		.sc_button.sc_button_skin_global.sc_button_style_bg,
		.sc_skills_counter .sc_skills_item.sc_skills_style_3 .sc_skills_count,
		.sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_count,
		.isotopeFiltr ul li.active a,
		.sc_slider.sc_slider_dark .slider-pagination-nav span.swiper-active-switch,
		.sc_slider.sc_slider_light .slider-pagination-nav span.swiper-active-switch,
		.sc_slider_swiper .sc_slider_info .sc_slider_reviews_short span.rInfo,
		.sc_testimonials.sc_testimonials_style_1 .sc_testimonials_item_quote,
		.sc_testimonials.sc_testimonials_style_2 .sc_testimonials_title:after,
		.sc_testimonials.sc_testimonials_style_2 .sc_slider_swiper.sc_slider_pagination .slider-pagination-nav span.swiper-active-switch,
		.sc_video_frame.sc_video_active:before,
		.sc_button.sc_button_skin_global.sc_button_style_bg,
		.sc_button.sc_button_style_regular:hover,
		.sc_toggl.sc_toggl_style_2.sc_toggl_icon_show .sc_toggl_item .sc_toggl_title:after,
		.sc_toggl.sc_toggl_style_3 .sc_toggl_item .sc_toggl_title,
		.sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap,
		.sc_tooltip .sc_tooltip_item,
		.sc_table.sc_table_style_2 table thead tr th,
		.sc_pricing_table.sc_pricing_table_style_2 .sc_pricing_item ul li.sc_pricing_title,
		.sc_pricing_table.sc_pricing_table_style_3 .sc_pricing_item ul,
		.sc_pricing_table.sc_pricing_table_style_3 .sc_pricing_item ul li.sc_pricing_title,
		.sc_pricing_table.sc_pricing_table_style_2 .sc_pricing_item ul,
		.sc_scroll .sc_scroll_bar .swiper-scrollbar-drag,
		.sc_skills_bar .sc_skills_item .sc_skills_count,
		.sc_skills_bar.sc_skills_vertical .sc_skills_item .sc_skills_count,
		.sc_icon.sc_icon_box,
		.sc_icon.sc_icon_box_square,
		.sc_icon.sc_icon_box_circle,
		.sc_tabs.sc_tabs_style_2 ul.sc_tabs_titles li.ui-tabs-active a,
		#header .openTopMenu,
		.openMobileMenu,
		.hideMenuDisplay .usermenuArea > ul > li > a:before,
		.menuStyle2 #header ul > li > ul li a:before,
		.widget_calendar table tbody td a:before,
		.widget_calendar table tbody td a:hover,
		.widget_tag_cloud a:hover,
		.widget_recent_reviews .post_item .post_wrapper .post_info .post_review,
		.widget_trex_post .ui-tabs-nav li.ui-state-active a,
		.postInfo .stickyPost .postSticky,
		.revItem .revBlock.revStyle100 .ratingValue,
		.reviewBlock .reviewTab .revWrap .revBlock.revStyle100 .ratingValue,
		.nav_pages ul li span,
		.subCategory,
		.sc_highlight.sc_highlight_style_1,
		.sc_tooltip .sc_tooltip_item,
		.widget_search .searchFormWrap .searchSubmit input,
		#header .usermenuArea ul.usermenuList .usermenuCart .widget_area p.buttons a:hover{ background-color: '.$theme_color.'; }

		.woocommerce ul.products li.product a.button:hover,
		.woocommerce div.product form.cart .button:hover,
		.woocommerce input.button:hover{ background-color: '.$theme_color.' !important;} 

		.sc_button.sc_button_style_regular:hover, .woocommerce #review_form #respond .form-submit input:hover{ background-color: '.$theme_color.' !important; }

		::selection { color: #fff; background-color:'.$theme_color.';}
		::-moz-selection { color: #fff; background-color:'.$theme_color.';}'
		);
	}

	//theme accent color
	if($theme_accent_color != ''){
		addThemeCustomStyle('
		.sc_pricing_table.sc_pricing_table_style_1 .sc_pricing_item ul,
		.sc_pricing_table.sc_pricing_table_style_1 .sc_pricing_item ul li.sc_pricing_title,
		.sc_pricing_table.sc_pricing_table_style_2  .sc_button.sc_button_skin_global.sc_button_style_bg ,
		.sc_pricing_table.sc_pricing_table_style_3 .sc_pricing_item ul,
		.sc_skills_bar .sc_skills_item ,
		.sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_info,
		.sc_tabs.sc_tabs_style_3 ul.sc_tabs_titles li,
		.sc_testimonials.sc_testimonials_style_2 .sc_slider_swiper.sc_slider_pagination .slider-pagination-nav span,
		footer.footer_style_green .widget_tag_cloud a,
		.widget_tag_cloud a,
		.isotopeFiltr ul li a ,
		.themeDark .isotopeFiltr ul li.active a,
		.isotopeFiltr ul li a:hover{ background-color: '.$theme_accent_color.';}

		.woocommerce ul.products li.product a.button,
		.woocommerce div.product form.cart .button,
		.woocommerce #content .quantity .plus:hover, 
		.woocommerce #content .quantity .minus:hover,
		.woocommerce input.button  { background-color: '.$theme_accent_color.' !important; background: '.$theme_accent_color.' !important;}

		.sc_pricing_table.sc_pricing_table_style_2 .sc_pricing_item ul li.sc_pricing_title,
		.sc_pricing_table.sc_pricing_table_style_3 .sc_pricing_item ul li.sc_pricing_title{border-bottom-color: '.$theme_accent_color.';}

		.sc_team .sc_team_item .sc_team_item_border,
		.woocommerce .quantity input.qty, 
		.woocommerce #content .quantity input.qty, 
		.woocommerce .quantity input.qty, 
		.woocommerce #content .quantity input.qty,
		.woocommerce #content .quantity .plus, 
		.woocommerce #content .quantity .minus,
		.woocommerce .quantity .plus, 
		.woocommerce .quantity .minus{border-color: '.$theme_accent_color.';}

		.sc_team .sc_team_item .sc_team_item_socials ul li a:hover span,
		footer.footer_style_green .widgetWrap ul > li a,
		.sc_icons_widget .sc_icons_item{ color: '.$theme_accent_color.'; }

		.woocommerce #content div.product div.images a {border: 2px solid '.$theme_accent_color.' !important;}
		');
	}


	if( $background_color != ''){
		addThemeCustomStyle('
			
			body{ background-color: '.$background_color.'; }
			.rsUni, .rsUni .rsOverflow, .rsUni .rsSlide, .rsUni .rsVideoFrameHolder, .rsUni .rsThumbs{ background-color: '.$background_color.' !important; }
			.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active{border-bottom: 1px solid '.$background_color.'; }
		');
	}
	
	// Custom menu
	if (get_theme_option('menu_colored')=='yes') {
		$menu_name = 'mainmenu';
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
			if (is_object($menu) && $menu) {
				$menu_items = wp_get_nav_menu_items($menu->term_id);
				$menu_styles = '';
				$menu_slider = get_theme_option('menu_slider')=='yes';
				if (count($menu_items) > 0) {
					foreach($menu_items as $k=>$item) {
		//				if ($item->menu_item_parent==0) {
							$cur_accent_color = '';
							if ($item->type=='taxonomy' && $item->object=='category') {
								$cur_accent_color = get_category_inherited_property($item->object_id, 'theme_accent_color');
							}
							if ((empty($cur_accent_color) || is_inherit_option($cur_accent_color)) && isset($item->classes[0]) && !empty($item->classes[0])) {
								$cur_accent_color = (themerex_substr($item->classes[0], 0, 1)!='#' ? '#' : '').$item->classes[0];
							}
							if (!empty($cur_accent_color) && !is_inherit_option($cur_accent_color)) {
								$menu_styles .= ($item->menu_item_parent==0 ? "#header_middle_inner #mainmenu li.menu-item-{$item->ID}.current-menu-item > a," : '')
									. "
									#header_middle_inner #mainmenu li.menu-item-{$item->ID} > a:hover,
									#header_middle_inner #mainmenu li.menu-item-{$item->ID}.sfHover > a { background-color: {$cur_accent_color} !important; }
									#header_middle_inner #mainmenu li.menu-item-{$item->ID} ul { background-color: {$cur_accent_color} !important; } ";
							}
							if ($menu_slider && $item->menu_item_parent==0) {
								$menu_styles .= "
									#header_middle_inner #mainmenu li.menu-item-{$item->ID}.blob_over:not(.current-menu-item) > a:hover,
									#header_middle_inner #mainmenu li.menu-item-{$item->ID}.blob_over.sfHover > a { background-color: transparent !important; } ";
							}
		//				}
					}
				}
				if (!empty($menu_styles)) {
					addThemeCustomStyle($menu_styles);
				}
			}
		}
	}
	
	//main menu responsive width
	//

	$menu_responsive = get_theme_option('responsive_menu_width').'px';
	addThemeCustomStyle("
		@media (min-width: {$menu_responsive}) { 
			.logo_center .logoHeader, .logo_center #mainmenu{display: none;}
		}

		@media (max-width: {$menu_responsive}) { 
			.openMobileMenu{ display: block; }
			.menuStyleFixed #header.fixedTopMenuShow .menuFixedWrap{ position: static !important; }
			.wrapTopMenu .topMenu { width: 100%;  }
			.wrapTopMenu .topMenu > ul{ display: none;  clear:both; }
			.wrapTopMenu .topMenu > ul li{ display: block; clear:both;  border-top: 1px solid #ddd; padding: 10px 0; text-align: center !important;}
			.wrapTopMenu .topMenu > ul li a{ }
			.wrapTopMenu .topMenu > ul li ul{ position: static !important; width:auto !important; margin:0 !important; border: none !important; text-align:center; background-color: transparent !important; }
			.wrapTopMenu .topMenu > ul > li > ul:before{ display:none;}
			.openTopMenu{ display: none; }
			.wrapTopMenu .topMenu > ul > li.sfHover > a:before,
			.wrapTopMenu .topMenu > ul > li > a{ line-height: 30px !important;  opacity:1 !important; height: auto !important; }
			.wrapTopMenu .topMenu > ul > li > a:hover:before{ left:10px; right:10px; }
			.hideMenuDisplay .wrapTopMenu{ min-height: 45px !important; height: auto !important;}
			.hideMenuDisplay .usermenuArea > ul li a{ color: #fff !important; }
			.wrapTopMenu .topMenu > ul > li > ul:after{content: none;}
			.wrapTopMenu .topMenu > ul > li > ul li:last-child {padding-bottom: 0 !important; }
			.wrapTopMenu .topMenu > ul > li > ul li.menu-item-has-children {padding: 10px 0; }
			.menuStyle1 #header ul > li > ul > li ul:before, .menuStyle1 #header ul > li > ul > li ul:after, .menuStyle1 #header ul > li > ul li.menu-item-has-children:after{display: none;}
			.logo_center .topMenu .newMenu, .logo_center .topMenu .logo {display: none !important;}
			.wrap.logoImageStyle .logoHeader {padding-top: 20px;}
		}
	");


	// Main menu height
	$menu_height = (int) get_theme_option('menu_height');
	if ($menu_height > 20) {
		addThemeCustomStyle("
			#mainmenu > li > a { height: {$menu_height}px !important; line-height: {$menu_height}px !important; }
			#mainmenu > li ul { top: {$menu_height}px !important; }
			#header_middle { min-height: {$menu_height}px !important; } ");
	}
	// Submenu width
	$menu_width = (int) get_custom_option('menu_width');
	if ($menu_width > 50) {
		addThemeCustomStyle('
			.wrapTopMenu .topMenu > ul > li > ul { width: '.($menu_width).'px; margin: 0 0 0 -'.(($menu_width+30)/2).'px; }
			#mainmenu > li:nth-child(n+6) ul li ul { left: -'.($menu_width).'px; } ');
	}

	// Custom css from theme options
	$css = get_theme_option('custom_css');
	if (!empty($css)) {
		addThemeCustomStyle($css);
	}
	
	return getThemeCustomStyles();
};
?>