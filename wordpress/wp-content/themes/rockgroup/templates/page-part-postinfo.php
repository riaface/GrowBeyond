<?php 
if (!function_exists('getPostInfo') ) {
	function getPostInfo($arg,$post_data) {

		if ( sc_param_is_on(get_custom_option('show_post_info',null,$post_data['post_id'])) ) { 

			$array_info = explode(',', $arg);
			$array_list = array();
			$side_bar = get_custom_option('show_sidebar_main');

			if((is_single() && $side_bar == 'fullWidth') || $side_bar == 'wide'){
				$array_list['author'] = $array_list['category'] = $array_list['date'] = '';	
			}
			else {
				$array_list['date'] = $post_data['post_date'] ? '<span class="postSpan postDate">'.__('Posted ', 'themerex').'<a href="'.$post_data['post_link'].'" >'.$post_data['post_date'].'</a></span>' : '';
				$array_list['author'] = $post_data['post_author'] ? '<span class="postSpan postAuthor">'.__(' by ', 'themerex').'<a href="'.$post_data['post_author_url'].'">'.$post_data['post_author'].'</a></span>' : '';
				$array_list['category'] = $post_data['post_categories_links']!='' ? '<span class="postSpan postCategory">'.__('in ', 'themerex').$post_data['post_categories_links'].'</span>' : '' ;
			}

			//post edit
			if( is_singular() ){
				if ($post_data['post_edit_enable'] || $post_data['post_delete_enable']) {
					if ($post_data['post_edit_enable']) { 
						$array_list['editor'] = do_shortcode('[trx_button id="frontend_editor_icon_edit" skin="dark" style="bg" size="mini" fullsize="no" icon="icon-pencil" target="no" popup="no"]'.__('Edit', 'themerex').'[/trx_button]');
					} 
					if ($post_data['post_delete_enable']) { 
						$array_list['editor'] .= do_shortcode('[trx_button id="frontend_editor_icon_delete" skin="global" style="bg" size="mini" fullsize="no" icon="icon-cancel-bold"  target="no" popup="no" left="5"]'.__('Delete', 'themerex').'[/trx_button]');
						
					} 
				}
			}

			//sticky
			$array_list['sticky'] = is_sticky() && !is_singular() ? '<div class="stickyPost"><span class="postSticky">'.__('Sticky Post','themerex').'</span></div>' : '';

			//separator
			$post_info_html = '';
			foreach ( $array_info as $array_infos ) {
				foreach ( $array_list as $k => $val ) {
					if($k == $array_infos) {
						$post_info_html .= $val;
					}
				}				 
			}

			if((is_single() && $side_bar == 'fullWidth') || $side_bar == 'wide') $tags =  $post_data['post_tags_links'] != '' ? '<div class="postTags"><span class="icon icon-tag"></span>'.$post_data['post_tags_links'] . '</div>': '';
			else $tags =  $post_data['post_tags_links'] ? '<div class="postTags">'.$post_data['post_tags_links'].'</div>': '';
			
			return '<div class="postInfo hoverUnderline">'.$tags.'<div class="postWrap">'.$post_info_html.'</div></div>';

		}	
	}
}


if (!function_exists('getPostShare') ) {
	function getPostShare($arg,$post_data) {

		$side_bar = get_custom_option('show_sidebar_main');
		if ( sc_param_is_on(get_custom_option('show_post_info',null,$post_data['post_id'])) && !is_single()) { 

			$array_info = explode(',', $arg);
			$array_list = array();
			
			if($side_bar!= "wide")
			{
				$array_list['views'] = '<div class="postSpan postViews"><span class="icon icon-eye"></span><a href="'.$post_data['post_link'].'" class="revInfo">'.$post_data['post_views'].'</a></div>';
				$array_list['likes'] = '<div class="postSpan postLikes likeButton like" data-postid="'.$post_data['post_id'].'" data-likes="'.$post_data['post_likes'].'"><span class="icon icon-heart"></span><a href="" class="revInfo">'.$post_data['post_likes'].'</a></div>';
				$array_list['more'] = $post_data['post_link'] ? '<div class="postSpan postMore"><span class="icon icon-link"></span><a href="'.$post_data['post_link'].'"  class="revInfo">'.__('More ', 'themerex').'</a></div>' : '';
				//review
				if( $post_data['post_reviews_author'] && sc_param_is_on( get_custom_option('show_reviews',null,$post_data['post_id']) ) ){
					$avg_author = $post_data['post_reviews_'.(get_theme_option('reviews_first')=='author' ? 'author' : 'users')];
					$rating_max = get_custom_option('reviews_max_level');
					$array_list['reviews'] = '<div class="postSpan postReview" title="'.sprintf(__('Rating - %s/%s','themerex'), $avg_author,$rating_max).'"><span class="icon icon-star"></span><a href="'.$post_data['post_link'].'" class="revInfo">'.getReviewsSummaryStarsSharing($avg_author,false,false).'</a></div>';
				}
			}

			$array_list['comments'] = '<div class="postSpan postComment"><span class="icon icon-post"></span><a href="'.$post_data['post_comments_link'].'" class="revInfo">'.$post_data['post_comments'].($side_bar == 'wide' ? ' comments' : '').'</a></div>';
			$post_share =  showShareButtons(array(
						"post_id"    => $post_data["post_id"],
						"post_link"  => $post_data["post_link"],
						"post_title" => $post_data["post_title"],
						"post_descr" => strip_tags($post_data["post_excerpt"]),
						"post_thumb" => $post_data["post_attachment"],
						"style" => "drop",
						"echo" 		 => false));
			if($side_bar!= "wide") $array_list['share'] = '<div class="postSpan postShare share"><span class="icon icon-share"></span><a class="revInfo shareDrop" href="#">'.__('Share ', 'themerex').'</a>'.$post_share.'</div>';
			else $array_list['share'] = '<div class="postSpan postShare share">'.$post_share.'</div>';

			$post_info_html = '';
			foreach ( $array_info as $array_infos ) {
				foreach ( $array_list as $k => $val ) {
					if($k == $array_infos) {
						$post_info_html .= $val;
					}
				}				 
			}
			
			if($post_info_html != '') return '<div class="postSharing hoverUnderline">'.$post_info_html.'</div>';
			else return '';

		}	
	}
}