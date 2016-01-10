<?php

$gmap_styles = getGooglemapStyles();

// Switcher choises
$THEMEREX_shortcodes_yes_no 	= getYesNoList();
$THEMEREX_shortcodes_on_off 	= getOnOffList();
$THEMEREX_shortcodes_dir 		= getDirectionList();
$THEMEREX_shortcodes_align 		= getAlignmentList();
$THEMEREX_shortcodes_text_align	= getAlignList();
$THEMEREX_shortcodes_float 		= getFloatList();
$THEMEREX_shortcodes_show_hide 	= getShowHideList();
$THEMEREX_shortcodes_box_style	= getBoxStyles();
$THEMEREX_shortcodes_sorting 	= getSortingList();
$THEMEREX_shortcodes_ordering 	= getOrderingList();
$THEMEREX_shortcodes_sliders	= getSlidersList();
$THEMEREX_shortcodes_users		= getUsersList();
$THEMEREX_shortcodes_categories	= getCategoriesList();
$THEMEREX_shortcodes_columns	= getColumnsList();
$THEMEREX_shortcodes_images		= themerex_array_merge(array('none'=>"none"), getListFiles("/images/icons", "png"));
$THEMEREX_shortcodes_icons 		= array_merge(array("none"), getIconsList());
$THEMEREX_shortcodes_locations	= getDedicatedLocationsList();

global $THEMEREX_shortcodes_yes_no;

// Current elemnt id
$THEMEREX_shortcodes_id = array(
	"id" => "id",
	"title" => __("Element ID", "themerex"),
	"desc" => __("ID for current element", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "text"
);

// Width and height params
function THEMEREX_shortcodes_width($w='') {
	return array(
		"id" => "width",
		"title" => __("Width", "themerex"),
		"divider" => false,
		"value" => $w,
		"type" => "text"
	);
}
function THEMEREX_shortcodes_height($h='',$des='Width (in pixels or percent) and height (only in pixels) of element') {
	return array(
		"id" => "height",
		"title" => __("Height", "themerex"),
		"desc" => __($des, "themerex"),
		"value" => $h,
		"type" => "text"
	);
}

/*indent*/
function THEMEREX_shortcodes_indent($status='yes'){ 
	global $THEMEREX_shortcodes_yes_no;
	return array(
		"id" => "indent",
		"title" => __("Space between columns", "themerex"),
		"desc" => __("Turns sace between columns on", "themerex"),
		"value" => $status,
		"type" => "switch",
		"options" => $THEMEREX_shortcodes_yes_no,
	);
}


// Margins params
$THEMEREX_shortcodes_margin_top = array(
	"id" => "top",
	"title" => __("Top margin", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "spinner"
);
$THEMEREX_shortcodes_margin_right = array(
	"id" => "right",
	"title" => __("Right margin", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "spinner"
);
$THEMEREX_shortcodes_margin_bottom = array(
	"id" => "bottom",
	"title" => __("Bottom margin", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "spinner"
);
$THEMEREX_shortcodes_margin_left = array(
	"id" => "left",
	"title" => __("Left margin", "themerex"),
	"divider" => false,
	"value" => "",
	"type" => "spinner"
);


// List's styles
$THEMEREX_shortcodes_list_styles = array(
	'ul' => __("Unordered", 'themerex'),
	'ol' => __("Ordered", 'themerex'),
	'iconed' => __('Iconed', 'themerex')
);

// section/block options
$THEMEREX_section_block_options = array(
	array(
		"id" => "class",
		"title" => __("CSS class", "themerex"),
		"desc" => __("Attribute class for container (if need)", "themerex"),
		"divider" => false,
		"value" => "",
		"type" => "text"
	),
	array(
		"id" => "style",
		"title" => __("CSS style", "themerex"),
		"desc" => __("Any additional CSS rules (if need)", "themerex"),
		"divider" => false,
		"value" => "",
		"type" => "text"
	),
	array(
		"id" => "align",
		"title" => __("Align", "themerex"),
		"desc" => __("Select block alignment", "themerex"),
		"value" => "none",
		"type" => "checklist",
		"dir" => "horizontal",
		"options" => $THEMEREX_shortcodes_align,
	),
	array(
		"id" => "dedicated",
		"title" => __("Dedicated", "themerex"),
		"desc" => __("Use this block as dedicated content - show it before post title on single page", "themerex"),
		"value" => "no",
		"type" => "switch",
		"options" => $THEMEREX_shortcodes_yes_no
	),
	array(
		"id" => "columns",
		"title" => __("Columns emulation", "themerex"),
		"desc" => __("Select width for columns emulation", "themerex"),
		"divider" => false,
		"value" => "none",
		"type" => "checklist",
		"options" => $THEMEREX_shortcodes_columns
	), 
	array(
		"id" => "scroll",
		"title" => __("Use scroller", "themerex"),
		"desc" => __("Use scroller to show block content", "themerex"),
		"divider" => false,
		"value" => "no",
		"type" => "switch",
		"options" => $THEMEREX_shortcodes_yes_no
	),
	array(
		"id" => "dir",
		"title" => __("Scroll direction", "themerex"),
		"desc" => __("Scroll direction (if Use scroller = yes)", "themerex"),
		"divider" => true,
		"value" => "horizontal",
		"type" => "checklist",
		"options" => $THEMEREX_shortcodes_dir
	),
	array(
		"id" => "link",
		"title" => __("URL for block", "themerex"),
		"divider" => false,
		"value" => "",
		"type" => "text"
	),
	array(
		"id" => "background",
		"title" => __("Background color", "themerex"),
		"divider" => false,
		"value" => "",
		"type" => "color"
	),
	array(
		"id" => "src",
		"title" => __("Background image", "themerex"),
		"divider" => true,
		"value" => "",
		"type" => "media"
	),
	array(
		"id" => "_content_",
		"title" => __("Container content", "themerex"),
		"desc" => __("Content for section container", "themerex"),
		"rows" => 4,
		"value" => "",
		"type" => "textarea"
	),
	THEMEREX_shortcodes_width(),
	THEMEREX_shortcodes_height(),
	array(
		"id" => "padding",
		"title" => __("Padding", "themerex"),
		"desc" => __("Padding of block (top right bottom left / Example: 20px 10px 0 30px)", "themerex"),
		"divider" => false,
		"value" => "",
		"type" => "text"
	),
	$THEMEREX_shortcodes_margin_top,
	$THEMEREX_shortcodes_margin_right,
	$THEMEREX_shortcodes_margin_bottom,
	$THEMEREX_shortcodes_margin_left,
	$THEMEREX_shortcodes_id
);


// Shortcodes list
//------------------------------------------------------------------
$THEMEREX_shortcodes = array(

//=== Aside ============================================================================================================
	array(
		"title" => __("Aside", "themerex"),//Ok
		"id" => "trx_aside",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "link",
				"title" => __("Item link", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "image",
				"title" => __("Item image", "themerex"),
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "_content_",
				"title" => __("Content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),
//=== Audio ============================================================================================================
	array(
		"title" => __("Audio", "themerex"), //Ok
		"desc" => __("Insert audio player", "themerex"),
		"id" => "trx_audio",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Audio track title", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "author",
				"title" => __("Author of the track", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "url",
				"title" => __("URL for audio file", "themerex"),
				"desc" => __("URL for audio file", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media",
				"before" => array(
					'title' => __('Choose audio', 'themerex'),
					'action' => 'media_upload',
					'type' => 'audio',
					'multiple' => false,
					'linked_field' => '',
					'captions' => array( 	
						'choose' => __('Choose audio file', 'themerex'),
						'update' => __('Select audio file', 'themerex')
					)
				),
				"after" => array(
					'icon' => 'icon-cancel',
					'action' => 'media_reset'
				)
			),
			array(
				"id" => "image",
					"title" => __("Image", "themerex"),
					"value" => "",
					"type" => "media"
			),
			array(
				"id" => "autoplay",
				"title" => __("Autoplay audio", "themerex"),
				"desc" => __("Autoplay audio on page load", "themerex"),
				"value" => "off",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_on_off
			),
			array(
				"id" => "controls",
				"title" => __("Show controls", "themerex"),
				"desc" => __("Show controls in audio player (used in standard html5 player or 3rd party plugins)", "themerex"),
				"size" => "medium",
				"value" => "show",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_show_hide
			),
			THEMEREX_shortcodes_width("100%"),
			THEMEREX_shortcodes_height('','Height of the block with image. This option works if you have a background image'),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),

	//=== Banner ============================================================================================================

	array(
		"title" => __("Banner", "themerex"), //Ok
		"desc" => __("Banner image with link", "themerex"),
		"id" => "trx_banner",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "src",
				"title" => __("URL (source) for image file", "themerex"),
				"desc" => __("Select or upload image or write URL from other site", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "align",
				"title" => __("Banner alignment", "themerex"),
				"desc" => __("Align banner to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			array(
				"id" => "link",
				"title" => __("Link URL", "themerex"),
				"desc" => __("URL for link on banner click", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "rel",
				"title" => __("Rel attribute", "themerex"),
				"desc" => __("Rel attribute for banner's link (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "target",
				"title" => __("Link target", "themerex"),
				"desc" => __("Target for link on banner click", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "popup",
				"title" => __("Open link in popup", "themerex"),
				"desc" => __("Open link target in popup window", "themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			), 
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Banner title", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Text", "themerex"),
				"desc" => __("Banner text", "themerex"),
				"value" => "",
				"type" => "text"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),

//=== Section / Block ============================================================================================================

	//block
	array(
		"title" => __("Block container", "themerex"), //Ok
		"desc" => __("Container for any block with desired class and style ([section] analog - to nesting enable)", "themerex"),
		"id" => "trx_block",
		"decorate" => true,
		"container" => true,
		"params" => $THEMEREX_section_block_options
	),

//=== Blogger ============================================================================================================
	array(
		"title" => __("Blogger", "themerex"), //Ok
		"desc" => __("Insert posts (pages) in many styles from desired categories or directly from ids", "themerex"),
		"id" => "trx_blogger",
		"decorate" => false,
		"container" => false,
		"params" => array(

			array(
				"id" => "style",
				"title" => __("Posts output style", "themerex"),
				"desc" => __("Select desired style for posts output", "themerex"),
				"divider" => false,
				"value" => "regular",
				"type" => "select",
				"options" => array(
					'regular' => __('Regular', 'themerex'),
					'excerpt' => __('Excerpt', 'themerex'),
					'related' => __('Related', 'themerex'),
					'date' => __('Date', 'themerex'),
					'image_large' => __('Large featured image', 'themerex'),
					'image_medium' => __('Medium featured image', 'themerex'),
					'image_small' => __('Small featured image', 'themerex'),
					'image_tiny' => __('Tiny featured image', 'themerex'),
					'accordion_1' => __('Accordion style 1', 'themerex'),
					'accordion_2' => __('Accordion style 2', 'themerex'),
					'accordion_3' => __('Accordion style 3', 'themerex'),
					'list' => __('List', 'themerex')
				)
			),
			array(
				"id" => "cat",
				"title" => __("Category list", "themerex"),
				"desc" => __("Select the desired categories. If not selected - show posts from any category or from IDs list", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "select",
				"style" => "list",
				"multiple" => true,
				"options" => $THEMEREX_shortcodes_categories
			),
			array(
				"id" => "count",
				"title" => __("Total posts to show", "themerex"),
				"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
				"divider" => false,
				"value" => 3,
				"min" => 1,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "visible",
				"title" => __("Number of visible posts", "themerex"),
				"desc" => __("How many posts will be visible at once? If empty or 0 - all posts are visible", "themerex"),
				"divider" => false,
				"value" => 3,
				"min" => 1,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "offset",
				"title" => __("Offset before select posts", "themerex"),
				"desc" => __("Skip posts before select next part.", "themerex"),
				"divider" => false,
				"value" => 0,
				"min" => 0,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "scroll",
				"title" => __("Use scroller", "themerex"),
				"desc" => __("Use scroller to show all posts (if parameter 'visible' less than 'count')", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			THEMEREX_shortcodes_indent(),
			array(
				"id" => "orderby",
				"title" => __("Post order by", "themerex"),
				"desc" => __("Select desired posts sorting method", "themerex"),
				"divider" => false,
				"value" => "date",
				"type" => "select",
				"options" => $THEMEREX_shortcodes_sorting
			),
			array(
				"id" => "order",
				"title" => __("Post order", "themerex"),
				"desc" => __("Select desired posts order", "themerex"),
				"divider" => false,
				"value" => "desc",
				"type" => "switch",
				"size" => "big",
				"options" => $THEMEREX_shortcodes_ordering
			),
			array(
				"id" => "ids",
				"title" => __("Post IDs list", "themerex"),
				"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "location",
				"title" => __("Dedicated content location", "themerex"),
				"desc" => __("Select position for dedicated content (only for style=excerpt)", "themerex"),
				"divider" => false,
				"value" => "default",
				"type" => "select",
				"options" => $THEMEREX_shortcodes_locations
			),
			array(
				"id" => "dir",
				"title" => __("Posts direction", "themerex"),
				"desc" => __("Display posts in horizontal or vertical direction", "themerex"),
				"divider" => false,
				"value" => "horizontal",
				"type" => "switch",
				"size" => "big",
				"options" => $THEMEREX_shortcodes_dir
			),
			array(
				"id" => "rating",
				"title" => __("Show rating stars", "themerex"),
				"desc" => __("Show rating stars under post's header", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "descr",
				"title" => __("Description length", "themerex"),
				"desc" => __("How many characters are displayed from post excerpt? If 0 - don't show description", "themerex"),
				"divider" => false,
				"value" => 0,
				"min" => 0,
				"max" => 1000,
				"increment" => 10,
				"type" => "spinner"
			),
			array(
				"id" => "info",
				"title" => __("Show post info block", "themerex"),
				"desc" => __("Show post info block (author, date, tags, etc.)", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "readmore",
				"title" => __("More link text", "themerex"),
				"desc" => __("Read more link text. If empty - show 'More', else - used as link text", "themerex"),
				"value" => "",
				"type" => "text"
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),



//=== Br ============================================================================================================
	array(
		"title" => __("Break <br>", "themerex"),//Ok
		"desc" => __("Line break with clear floating (if need)", "themerex"),
		"id" => "trx_br",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "clear",
				"title" => __("Clear floating", "themerex"),
				"desc" => __("Clear floating (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'none' => __('None', 'themerex'),
					'left' => __('Left', 'themerex'),
					'right' => __('Right', 'themerex'),
					'both' => __('Both', 'themerex')
				)
			)
		)
	),




//=== Button ============================================================================================================
	array(
		"title" => __("Button", "themerex"),//Ok
		"desc" => __("Button with link", "themerex"),
		"id" => "trx_button",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Caption", "themerex"),
				"desc" => __("Button caption", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "skin",
				"title" => __("Button's color style", "themerex"),
				"desc" => __("Select button's color style", "themerex"),
				"divider" => false,
				"value" => "global",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'global' => __('Global', 'themerex'),
					'dark' => __('Dark', 'themerex')
				)
			), 
			array(
				"id" => "style",
				"title" => __("Button's style", "themerex"),
				"desc" => __("Select button's style", "themerex"),
				"divider" => false,
				"value" => "regular",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'regular' => __('Regular', 'themerex'),
					'line' => __('Line', 'themerex'),
					'shadow' => __('Shadow', 'themerex'),
				)
			),
			array(
				"id" => "size",
				"title" => __("Button's size", "themerex"),
				"desc" => __("Select button's size", "themerex"),
				"divider" => false,
				"value" => "medium",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'mini' => __('Small', 'themerex'),
					'medium' => __('Medium', 'themerex'),
					'big' => __('Large', 'themerex')
				)
			), 
			array(
				"id" => "fullsize",
				"title" => __("Fullsize mode", "themerex"),
				"desc" => __("Set button's width to 100%", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			), 
			array(
				"id" => "icon",
				"title" => __('Button icon',  'themerex'),
				"desc" => __('Select icon for the title from Fontello icons set',  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
			),
			array(
				"id" => "background",
				"title" => __("Background color", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "color",
				"title" => __("Text color", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "align",
				"title" => __("Button alignment", "themerex"),
				"desc" => __("Align button to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			array(
				"id" => "link",
				"title" => __("<b>Link URL</b>", "themerex"),
				"desc" => __("URL for link on button click", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "title",
				"title" => __("Title button", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "target",
				"title" => __("Option open", "themerex"),
				"desc" => __("Open in new tab", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "width",
				"title" => __("Width button", "themerex"),
				"desc" => __("Specifies the width of the button", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "height",
				"title" => __("Height button", "themerex"),
				"desc" => __("Specifies the height of the button", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "rel",
				"title" => __("Rel attribute", "themerex"),
				"desc" => __("Rel attribute for button's link (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "popup",
				"title" => __("Open link in popup", "themerex"),
				"desc" => __("Open link target in popup window", "themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			), 
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),

//=== Chart ============================================================================================================
	array(
		"title" => __("Chart", "themerex"),//Ok
		"desc" => __("Insert a chart in your page (post)", "themerex"),
		"id" => "trx_chart",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "size",
				"title" => __("Title size", "themerex"),
				"divider" => false,
				"value" => 46,
				"min" => 1,
				"type" => "spinner"
			),
			array(
				"id" => "color",
				"title" => __("Title color", "themerex"),
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "legend",
				"title" => __("Show legend", "themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Align object to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Chart", "themerex"),
			"desc" => __("Chart item", "themerex"),
			"id" => "trx_chart_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "title",
					"title" => __("Skills item title", "themerex"),
					"desc" => __("Current skills item title", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "level",
					"title" => __("Skills item level", "themerex"),
					"desc" => __("Current skills level", "themerex"),
					"divider" => false,
					"value" => 50,
					"min" => 0,
					"increment" => 1,
					"type" => "spinner"
				),
				array(
				"id" => "color",
				"title" => __("Color of skills item", "themerex"),
				"value" => "",
				"type" => "color"
				),
				array(
				"id" => "icon",
				"title" => __('Icon',  'themerex'),
				"desc" => __("Select font icon from the Fontello icons set",  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
				),
				array(
				"id" => "icon_color",
				"title" => __("Color of icon", "themerex"),
				"value" => "",
				"type" => "color"
				),
				array(
				"id" => "_content_",
				"title" => __("Item content", "themerex"),
				"desc" => __("Current item content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),

//=== Chat ============================================================================================================
	array(
		"title" => __("Chat", "themerex"), //Ok
		"desc" => __("Chat message", "themerex"),
		"id" => "trx_chat",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Item title", "themerex"),
				"desc" => __("Chat item title", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "link",
				"title" => __("Item link", "themerex"),
				"desc" => __("Chat item link", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Chat item content", "themerex"),
				"desc" => __("Current chat item content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),

//=== Columns ============================================================================================================
	array(
		"title" => __("Columns", "themerex"), //Ok
		"desc" => __("Insert up to 6 columns in your page (post)", "themerex"),
		"id" => "trx_columns",
		"decorate" => true,
		"container" => false,
		"params" => array(
			THEMEREX_shortcodes_indent(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Column", "themerex"),
			"desc" => __("Column item", "themerex"),
			"id" => "trx_column_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "colspan",
					"title" => __("Merge columns", "themerex"),
					"desc" => __("Count merged columns from current", "themerex"),
					"value" => "",
					"min" => 2,
					"max" => 11,
					"increment" => 1,
					"type" => "spinner"
				),
				array(
					"id" => "_content_",
					"title" => __("Column item content", "themerex"),
					"desc" => __("Current column item content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),



//=== Contact form ============================================================================================================
	array(
		"title" => __("Contact form", "themerex"),//Ok
		"desc" => __("Insert contact form", "themerex"),
		"id" => "trx_contact_form",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Contact form title", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "description",
				"title" => __("Description", "themerex"),
				"desc" => __("Short description for contact form", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),



//=== Contact info ============================================================================================================
	array( 
		"title" => __('Contact info', 'themerex'), //Ok
		"desc" => __('Display contact information using theme options', 'themerex'),
		"id" => "trx_contact_info",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Contact info title", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "description",
				"title" => __("Description", "themerex"),
				"desc" => __("Short description for contact info", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			array( 
				"id" => "contact_list",
				"title" => __('Contact block elements', 'themerex'),
				"desc" => __('Sets number and order of info putout<br><i>objects can be dragged with mouse</i>', 'themerex'),
				"value" => "adress_1,phone_1,website,email",
				'multiple' => true,
				"type" => "checklist",
				"options" => array(
					"address_1" => __('Adress 1', 'themerex'),
					"address_2" => __('Adress 2', 'themerex'),
					"phone_1" 	=> __('Phone 1', 'themerex'),
					"phone_2" 	=> __('Phone 2', 'themerex'),
					"fax" 		=> __('Fax', 'themerex'),
					"website"	=> __('Web site', 'themerex'),
					"email" 	=> __('Email', 'themerex'),
				)
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),

//=== Content block on fullscreen page =============================================================================================
	array(
		"title" => __("Content block", "themerex"),//Ok
		"desc" => __("Container for main content block with desired class and style (use it only on fullscreen pages)", "themerex"),
		"id" => "trx_content",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Container content", "themerex"),
				"desc" => __("Content for section container", "themerex"),
				"divider" => true,
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			array( 
				"id" => "align",
				"title" => __('Text align', 'themerex'),
				"value" => "center",
				"type" => "checklist",
				"options" => array(
					"left" => __('Left', 'themerex'),
					"center" => __('Center', 'themerex'),
					"right" 	=> __('Right', 'themerex'),
				)
			),
			array(
				"id" => "class",
				"title" => __("Element CSS class", "themerex"),
				"desc" => __("CSS class for current element (optional)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("CSS styles", "themerex"),
				"desc" => __("Any additional CSS rules (if need)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_id			
		)
	),


//=== Countdown ============================================================================================================
	array(
		"title" => __("Countdown", "themerex"),//Ok
		"desc" => __("Insert countdown object", "themerex"),
		"id" => "trx_countdown",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "date",
				"title" => __("Date", "themerex"),
				"desc" => __("Upcoming date (format: yyyy-mm-dd)", "themerex"),
				"value" => "",
				"format" => "yy-mm-dd",
				"type" => "date"
			),
			array(
				"id" => "time",
				"title" => __("Time", "themerex"),
				"desc" => __("Upcoming time (format: HH:mm:ss)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Countdown style", "themerex"),
				"value" => "round",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					"flip" => __('Flip', 'themerex'),
					"round" => __('Round', 'themerex'),
				)
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),




//=== Dropcaps ============================================================================================================
	array(
		"title" => __("Dropcaps", "themerex"),//Ok
		"desc" => __("Make first letter as dropcaps", "themerex"),
		"id" => "trx_dropcaps",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Dropcaps style", "themerex"),
				"value" => "1",
				"style" => "list",
				"type" => "images",
				"options" => array(
					1 => get_template_directory_uri().'/admin/images/icons/dropcaps1.png',
					2 => get_template_directory_uri().'/admin/images/icons/dropcaps2.png',
					3 => get_template_directory_uri().'/admin/images/icons/dropcaps3.png',
					4 => get_template_directory_uri().'/admin/images/icons/dropcaps4.png',
				)
			),
			array(
				"id" => "_content_",
				"title" => __("Paragraph content", "themerex"),
				"desc" => __("Paragraph with dropcaps content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),





//=== Emailer ============================================================================================================
	array(
		"title" => __("E-mail collector", "themerex"),//Ok
		"desc" => __("Collect the e-mail address into specified group", "themerex"),
		"id" => "trx_emailer",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "group",
				"title" => __("Group", "themerex"),
				"desc" => __("The name of group to collect e-mail address", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array( 
				"id" => "open",
				"title" => __('Open form', 'themerex'),
				"desc" => __('Open search e-mailer', 'themerex'),
				"std" => "yes",
				"options" => $yes_no,
				"type" => "switch"
			),
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Align object to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),



//=== Google map ============================================================================================================
	array(
		"title" => __("Google map", "themerex"),//Ok
		"desc" => __("Insert Google map with desired address or coordinates", "themerex"),
		"id" => "trx_googlemap",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "address",
				"title" => __("Address", "themerex"),
				"desc" => __("Address to show in map center", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "latlng",
				"title" => __("Latitude and Longtitude", "themerex"),
				"desc" => __("Comma separated map center coorditanes (instead Address)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "zoom",
				"title" => __("Zoom", "themerex"),
				"desc" => __("Map zoom factor", "themerex"),
				"divider" => false,
				"value" => 16,
				"min" => 1,
				"max" => 20,
				"type" => "spinner"
			),
			array( 
				"id" => "scroll",
				"title" => __('Zoom with mouse wheel', 'themerex'),
				"desc" => __('Map\'s zoom with mouse wheel', 'themerex'),
				"override" => "category,page,post",
				"std" => "yes",
				"options" => $yes_no,
				"type" => "switch"
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Map style", "themerex"),
				"value" => "royal",
				"type" => "checklist",
				"options" => $gmap_styles,
			),
			THEMEREX_shortcodes_width('100%'),
			THEMEREX_shortcodes_height(300),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),

//=== Graph ============================================================================================================
	array(
		"title" => __("Graph", "themerex"),//Ok
		"desc" => __("Insert a graph in your page (post)", "themerex"),
		"id" => "trx_graph",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "labels",
				"title" => __("Labels", "themerex"),
				"desc" => __("The graph requires an array of labels for each of the data points. This is shown on the X axis.", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array( 
				"id" => "type",
				"title" => __('Type', 'themerex'),
				"value" => "Curve",
				"type" => "checklist",
				"options" => array(
					"Curve" => __('Curve', 'themerex'),
					"Line" => __('Line', 'themerex'),
				)
			),
			array(
				"id" => "style",
				"title" => __("CSS style", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Graph", "themerex"),
			"desc" => __("Graph item", "themerex"),
			"id" => "trx_graph_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "datas",
					"title" => __("Datas", "themerex"),
					"desc" => __("Insert datas (example: value1, value2, value3)", "themerex"),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "color",
					"title" => __("Colour for the fill", "themerex"),
					"divider" => true,
					"value" => "",
					"type" => "color"
				),
				array(
					"id" => "_content_",
					"title" => __("Attribute", "themerex"),
					"divider" => true,
					"value" => "Attribute",
					"type" => "text"
				),
			)
		)
	),

//=== Hide any block ============================================================================================================
	array(
		"title" => __("Hide any block", "themerex"),//Ok
		"desc" => __("Hide any block with desired CSS-selector", "themerex"),
		"id" => "trx_hide",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "selector",
				"title" => __("Selector", "themerex"),
				"desc" => __("Any block's CSS-selector", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			)
		)
	),



//=== Highlght text ============================================================================================================
	array(
		"title" => __("Highlight text", "themerex"),//Ok
		"desc" => __("Highlight text with selected color, background color and other styles", "themerex"),
		"id" => "trx_highlight",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "type",
				"title" => __("Style", "themerex"),
				"desc" => __("Highlight Style", "themerex"),
				"value" => "1",
				"style" => "list",
				"type" => "images",
				"options" => array(
					1 => get_template_directory_uri().'/admin/images/icons/highlight2.png',
					2 => get_template_directory_uri().'/admin/images/icons/highlight1.png',
					3 => get_template_directory_uri().'/admin/images/icons/highlight3.png',
					4 => get_template_directory_uri().'/admin/images/icons/highlight4.png',
				)
			),
			array(
				"id" => "color",
				"title" => __("Color", "themerex"),
				"desc" => __("Color for highlighted text", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "backcolor",
				"title" => __("Background color", "themerex"),
				"desc" => __("Background color for highlighted text", "themerex"),
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "style",
				"title" => __("CSS-styles", "themerex"),
				"desc" => __("Any additional CSS rules", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Highlighting content", "themerex"),
				"desc" => __("Content for highlight", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_id
		)
	),

//=== Icon ============================================================================================================
	array(
		"title" => __("Icon", "themerex"),//Ok
		"desc" => __("Insert icon", "themerex"),
		"id" => "trx_icon",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "icon",
				"title" => __('Icon',  'themerex'),
				"desc" => __("Select font icon from the Fontello icons set",  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
			),
			array(
				"id" => "color",
				"title" => __("Icon's color", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Icon text alignment", "themerex"),
				"value" => "",
				"divider" => false,
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			array(
				"id" => "box_style",
				"title" => __("Background style", "themerex"),
				"desc" => __("Style of the icon background ", "themerex"),
				"divider" => false,
				"value" => "none",
				"type" => "radio",
				"options" => $THEMEREX_shortcodes_box_style,
			),
			array(
				"id" => "bg_color",
				"title" => __("Icon's background color", "themerex"),
				"desc" => __("Icon's background color", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "size",
				"title" => __("Font size", "themerex"),
				"desc" => __("Icon font size", "themerex"),
				"value" => "20",
				"divider" => false,
				"type" => "spinner",
				"min" => 8,
				"max" => 240
			),
			array(
				"id" => "weight",
				"title" => __("Font weight", "themerex"),
				"desc" => __("Icon font weight", "themerex"),
				"value" => "",
				"type" => "select",
				"size" => "medium",
				"options" => array(
					'100' => __('Thin (100)', 'themerex'),
					'300' => __('Light (300)', 'themerex'),
					'400' => __('Normal (400)', 'themerex'),
					'700' => __('Bold (700)', 'themerex')
				)
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),


//=== Icons Widget============================================================================================================
	array(
		"title" => __("Icons widget", "themerex"),//Ok
		"desc" => __("Insert icons widget", "themerex"),
		"id" => "trx_icons_widget",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "icon",
				"title" => __('Icon',  'themerex'),
				"desc" => __("Select font icon from the Fontello icons set",  'themerex'),
				"divider" => false,
				"value" => "icon-heart",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
			),
			array(
				"id" => "count",
				"title" => __("Icons count", "themerex"),
				"divider" => false,
				"value" => "10",
				"type" => "text"
			),
			array(
				"id" => "value",
				"title" => __("Value", "themerex"),
				"desc" => __("Insert value", "themerex"),
				"value" => "5",
				"divider" => false,
				"type" => "text"
			), 
			array(
				"id" => "size",
				"title" => __("Icons size", "themerex"),
				"desc" => __("Insert icons size", "themerex"),
				"divider" => false,
				"value" => "40",
				"type" => "text"
			),
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),


//=== Image ============================================================================================================
	array(
		"title" => __("Image", "themerex"),//Ok
		"desc" => __("Insert image into your post (page)", "themerex"),
		"id" => "trx_image",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "url",
				"title" => __("URL for image file", "themerex"),
				"desc" => __("Select or upload image or write URL from other site", "themerex"),
				"dependency" => array(
						'user' => array('is_empty', 'none')
				),
				"value" => "",
				"readonly" => false,
				"type" => "media"
			),
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Image title (if need)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "align",
				"title" => __("Float image", "themerex"),
				"desc" => __("Float image to left or right side", "themerex"),
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),



//=== Infobox ============================================================================================================
	array(
		"title" => __("Infobox", "themerex"),//Ok
		"desc" => __("Insert infobox into your post (page)", "themerex"),
		"id" => "trx_infobox",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Infobox style", "themerex"),
				"divider" => false,
				"value" => "regular",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'regular' => __('Regular', 'themerex'),
					'info' => __('Info', 'themerex'),
					'notice' => __('Notice', 'themerex'),
					'warning' => __('Warning', 'themerex'),
					'success' => __('Success', 'themerex')
				)
			),
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Title infobox", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "dir",
				"title" => __("Title position", "themerex"),
				"desc" => __("Vertical title position or horizontal", "themerex"),
				"divider" => false,
				"value" => "horizontal",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'horizontal' => __('Horizontal', 'themerex'),
					'vertical' => __('Vertical', 'themerex')
				)
			),
			array(
				"id" => "closeable",
				"title" => __("Closeable box", "themerex"),
				"desc" => __("Create closeable box (with close button)", "themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "_content_",
				"title" => __("Infobox content", "themerex"),
				"desc" => __("Content for infobox", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),

			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),

//=== Islands ============================================================================================================
	array(
		"title" => __("Islands", "themerex"),//Ok
		"desc" => __("Insert widget into your post (page)", "themerex"),
		"id" => "trx_islands",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Text color", "themerex"),
				"divider" => true,
				"value" => "light",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'light' => __('White', 'themerex'),
					'dark' => __('Black', 'themerex')
				)
			),
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
			"children" => array(
			"title" => __("Item", "themerex"),
			"desc" => __("<b>Max count of children is 5!</b>", "themerex"),
			"id" => "trx_island_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "url",
					"title" => __('URL for item',  'themerex'),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "_content_",
					"title" => __("Title", "themerex"),
					"rows" => 4,
					"divider" => false,
					"value" => "",
					"type" => "text"
				)
			)
		)
	),


//=== Line ============================================================================================================
	array(
		"title" => __("Line", "themerex"),//Ok
		"desc" => __("Insert Line into your post (page)", "themerex"),
		"id" => "trx_line",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"divider" => false,
				"value" => "solid",
				"dir" => "vertical",
				"type" => "radio",
				"options" => array(
					'solid' => __('Solid <dd class=\"lineSolid\"></dd>', 'themerex'),
					'dashed' => __('Dashed <dd class=\"lineDashed\"></dd>', 'themerex'),
					'dotted' => __('Dotted <dd class=\"lineDotted\"></dd>', 'themerex'),
				)
			),
			array(
				"id" => "color",
				"title" => __("Color", "themerex"),
				"desc" => __("Line color", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "align",
				"title" => __("Line alignment", "themerex"),
				"desc" =>  __("This option works along with the width option", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align,
			),			
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),



//=== List ============================================================================================================
	array(
		"title" => __("List", "themerex"),//Ok
		"desc" => __("List items with specific bullets", "themerex"),
		"id" => "trx_list",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Bullet's style", "themerex"),
				"desc" => __("Bullet's style for each list item", "themerex"),
				"value" => "ul",
				"type" => "checklist",
				"options" => $THEMEREX_shortcodes_list_styles
			), 
			array(
				"id" => "icon",
				"title" => __('List icon',  'themerex'),
				"desc" => __("Select list icon from Fontello icons set (only for style='Iconed')",  'themerex'),
				"value" => "",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
			),
			array(
				"id" => "marked",
				"title" => __("Ticked list", "themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"desc" => __("List item with specific bullet", "themerex"),
			"id" => "trx_list_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "_content_",
					"title" => __("List item content", "themerex"),
					"desc" => __("Current list item content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				array(
					"id" => "icon",
					"title" => __('List icon',  'themerex'),
					"desc" => __("Select list icon from Fontello icons set (only for style='Iconed')",  'themerex'),
					"value" => "",
					"type" => "icons",
					"options" => $THEMEREX_shortcodes_icons
				),
				array(
					"id" => "marked",
					"title" => __("Ticked list's item", "themerex"),
					"value" => "no",
					"type" => "switch",
					"options" => $THEMEREX_shortcodes_yes_no
				),
				array(
					"id" => "title",
					"title" => __("List item title", "themerex"),
					"desc" => __("Current list item title (show it as tooltip)", "themerex"),
					"value" => "",
					"type" => "text"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),


//=== More ============================================================================================================
	array(
		"title" => __("More button", "themerex"),//Ok
		"desc" => __("Insert button to hide and show selected <b>SECTION</b>", "themerex"),
		"id" => "trx_more",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "id",
				"title" => __("Block ID", "themerex"),
				"desc" => __("Insert id of section which you want show/hide", "themerex"),
				"divider" => true,
				"value" => "",
				"type" => "text"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
		)
	),

//=== Popup ============================================================================================================
	array(
		"title" => __("Popup window", "themerex"),//Ok
		"desc" => __("Container for any html-block with desired class and style for popup window", "themerex"),
		"id" => "trx_popup",
		"decorate" => true,
		"container" => true,
		"params" => array(
			$THEMEREX_shortcodes_id,
			array(
				"id" => "class",
				"title" => __("CSS class", "themerex"),
				"desc" => __("Attribute class for container (if need)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("CSS style", "themerex"),
				"desc" => __("Any additional CSS rules (if need)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Container content", "themerex"),
				"desc" => __("Content for section container", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
		)
	),


//=== Price_table ============================================================================================================
	array(
		"title" => __("Price table container", "themerex"), //Ok
		"desc" => __("Price table container. After insert it, move cursor inside and select shortcode Price Item", "themerex"),
		"id" => "trx_price_table",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"divider" => true,
				"value" => "1",
				"dir" => "horizontal",
				"type" => "radio",
				"options" => array(
					'1' => __('Style 1', 'themerex'),
					'2' => __('Style 2', 'themerex'),
					'3' => __('Style 3', 'themerex'),
				)
			), 
			array(
				"id" => "color",
				"title" => __("Color type", "themerex"),
				"divider" => true,
				"value" => "green",
				"dir" => "horizontal",
				"type" => "radio",
				"options" => array(
					'green' => __('Basic', 'themerex'),
					'blue' => __('Blue', 'themerex'),
				)
			), 
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Alignment text in the table", "themerex"),
				"value" => "center",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			THEMEREX_shortcodes_indent(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"desc" => __("Price item column", "themerex"),
			"id" => "trx_price_item",
			"decorate" => true,
			"container" => true,
			"params" => array(
				array(
					"id" => "animation",
					"title" => __("Animation", "themerex"),
					"desc" => __("Animate column on mouse hover", "themerex"),
					"value" => "yes",
					"type" => "switch",
					"options" => $THEMEREX_shortcodes_yes_no
				),
				$THEMEREX_shortcodes_id
			)
		)
	),

//=== Price_item ============================================================================================================
	array(
		"title" => __("Price table item", "themerex"), //Ok
		"desc" => __("Price table column", "themerex"),
		"id" => "trx_price_item",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "animation",
				"title" => __("Animation", "themerex"),
				"desc" => __("Animate column on mouse hover", "themerex"),
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Data", "themerex"),
			"desc" => __("Price item data - title, price, footer, etc.", "themerex"),
			"id" => "trx_price_data",
			"decorate" => false,
			"container" => true,
			"params" => array(
				array(
					"id" => "_content_",
					"title" => __("Content", "themerex"),
					"desc" => __("Current cell content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				array(
					"id" => "type",
					"title" => __("Cell type", "themerex"),
					"desc" => __("Select type of the price table cell", "themerex"),
					"value" => "regular",
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => array(
						'none' => __('Regular', 'themerex'),
						'title' => __('Title', 'themerex'),
						'image' => __('Image', 'themerex'),
						'price' => __('Price', 'themerex'),
						'footer' => __('Footer', 'themerex'),
						'united' => __('United', 'themerex')
					)
				), 
				array(
					"id" => "money",
					"title" => __("Money", "themerex"),
					"desc" => __("Money value (dot or comma separated) - only for type=price", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "currency",
					"title" => __("Currency", "themerex"),
					"desc" => __("Currency character - only for type=price", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "period",
					"title" => __("Period", "themerex"),
					"desc" => __("Period text (if need). For example: monthly, daily, etc. - only for type=price", "themerex"),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "image",
					"title" => __("URL (source) for image file", "themerex"),
					"desc" => __("Select or upload image or write URL from other site", "themerex"),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),

//=== Price_data ============================================================================================================
	array(
		"title" => __("Price table data", "themerex"),//Ok
		"desc" => __("Price item data - title, price, footer, etc.", "themerex"),
		"id" => "trx_price_data",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Content", "themerex"),
				"desc" => __("Current cell content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			array(
				"id" => "type",
				"title" => __("Cell type", "themerex"),
				"desc" => __("Select type of the price table cell", "themerex"),
				"value" => "regular",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'none' => __('Regular', 'themerex'),
					'title' => __('Title', 'themerex'),
					'image' => __('Image', 'themerex'),
					'price' => __('Price', 'themerex'),
					'footer' => __('Footer', 'themerex'),
					'united' => __('United', 'themerex')
				)
			), 
			array(
				"id" => "money",
				"title" => __("Money", "themerex"),
				"desc" => __("Money value (dot or comma separated) - only for type=price", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "currency",
				"title" => __("Currency", "themerex"),
				"desc" => __("Currency character - only for type=price", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "period",
				"title" => __("Period", "themerex"),
				"desc" => __("Period text (if need). For example: monthly, daily, etc. - only for type=price", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "image",
				"title" => __("URL (source) for image file", "themerex"),
				"desc" => __("Select or upload image or write URL from other site", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			$THEMEREX_shortcodes_id
		)
	),


//=== Quote ============================================================================================================
	array(
		"title" => __("Quote", "themerex"), //Ok
		"desc" => __("Quote text", "themerex"),
		"id" => "trx_quote",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Quote content", "themerex"),
				"desc" => __("Quote content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"divider" => true,
				"value" => "1",
				"dir" => "horizontal",
				"type" => "radio",
				"options" => array(
					'1' => __('Style 1', 'themerex'),
					'2' => __('Style 2', 'themerex'),
				)
			), 
			array(
				"id" => "link",
				"title" => __("Quote cite", "themerex"),
				"desc" => __("URL for quote cite", "themerex"),
				"divider" => true,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "author",
				"title" => __("Title (author)", "themerex"),
				"desc" => __("Quote title (author name)", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "years",
				"title" => __("Born", "themerex"),
				"desc" => __("Only when the style 2", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "image",
				"title" => __("Photo", "themerex"),
				"desc" => __("Only when the style 2", "themerex"),
				"divider" => true,
				"value" => "",
				"type" => "media"
			),
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),



//=== Rocks ============================================================================================================
	array(
		"title" => __("Rocks", "themerex"),//Ok
		"desc" => __("Insert a rocks skills in your page (post)", "themerex"),
		"id" => "trx_rocks",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "count",
				"title" => __("The number of items", "themerex"),
				"divider" => false,
				"value" => 1,
				"min" => 1,
				"type" => "spinner"
			),
			array(
				"id" => "maximum",
				"title" => __("Max value", "themerex"),
				"desc" => __("Max value for skills items", "themerex"),
				"divider" => false,
				"value" => 100,
				"min" => 1,
				"type" => "spinner"
			),
			array(
				"id" => "color",
				"title" => __("Skills text color", "themerex"),
				"value" => "",
				"type" => "color"
			),
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Skill", "themerex"),
			"desc" => __("Skills item", "themerex"),
			"id" => "trx_rocks_item",
			"container" => false,
			"params" => array(
				array(
					"id" => "title",
					"title" => __("Skills item title", "themerex"),
					"desc" => __("Current skills item title", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "level",
					"title" => __("Sklls item level", "themerex"),
					"desc" => __("Current skills level", "themerex"),
					"divider" => false,
					"value" => 50,
					"min" => 0,
					"increment" => 1,
					"type" => "spinner"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),



//=== Round  ============================================================================================================
	array(
		"title" => __("Round list", "themerex"),//Ok
		"id" => "trx_around",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "image",
				"title" => __("Image", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "style",
				"title" => __("CSS style", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Align object to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"id" => "trx_around_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "link",
					"title" => __("URL for item", "themerex"),
					"divider" => true,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "color",
					"title" => __("Text color", "themerex"),
					"type" => "color"
				),
				array(
					"id" => "_content_",
					"title" => __("Content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),



//=== Search form ============================================================================================================
	array(
		"title" => __("Search form", "themerex"),//Ok
		"desc" => __("Search form", "themerex"),
		"id" => "trx_search",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "align",
				"title" => __("Alignment", "themerex"),
				"desc" => __("Align object to left, center or right", "themerex"),
				"value" => "none",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			), 
			array( 
				"id" => "open",
				"title" => __('Open form', 'themerex'),
				"desc" => __('Open search form', 'themerex'),
				"std" => "yes",
				"options" => $yes_no,
				"type" => "switch"
			),
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),


//=== Section / Block ============================================================================================================

	//section
	array(
		"title" => __("Section container", "themerex"),//Ok
		"desc" => __("Container for any block with desired class and style", "themerex"),
		"id" => "trx_section",
		"decorate" => true,
		"container" => true,
		"params" => $THEMEREX_section_block_options
	),

//=== Skills ============================================================================================================
	array(
		"title" => __("Skills", "themerex"),//Ok
		"desc" => __("Insert skills diagramm in your page (post)", "themerex"),
		"id" => "trx_skills",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "type",
				"title" => __("Skills type", "themerex"),
				"desc" => __("Select type of skills block", "themerex"),
				"divider" => false,
				"value" => "bar",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'bar' => __('Bar', 'themerex'),
					'pie' => __('Pie chart', 'themerex'),
					'counter' => __('Counter', 'themerex'),
					'arc' => __('Arc', 'themerex')
				)
			), 
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Only for counter", "themerex"),
				"value" => "1",
				"dir" => "horizontal",
				"type" => "radio",
				"options" => array(
					'1' => __('Style 1', 'themerex'),
					'2' => __('Style 2', 'themerex'),
					'3' => __('Style 3', 'themerex'),
					'4' => __('Style 4', 'themerex'),
				)
			),
			array(
				"id" => "dir",
				"title" => __("Direction", "themerex"),
				"desc" => __("Select direction of skills block", "themerex"),
				"divider" => false,
				"value" => "horizontal",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_dir
			), 
			array(
				"id" => "layout",
				"title" => __("Skills layout", "themerex"),
				"desc" => __("Select layout of skills block", "themerex"),
				"divider" => false,
				"value" => "rows",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => array(
					'rows' => __('Rows', 'themerex'),
					'columns' => __('Columns', 'themerex')
				)
			),
			array(
				"id" => "count",
				"title" => __("The number of items", "themerex"),
				"divider" => false,
				"value" => 1,
				"min" => 1,
				"type" => "spinner"
			),
			array(
				"id" => "maximum",
				"title" => __("Max value", "themerex"),
				"desc" => __("Max value for skills items", "themerex"),
				"divider" => false,
				"value" => 100,
				"min" => 1,
				"type" => "spinner"
			),
			array(
				"id" => "align",
				"title" => __("Align skills block", "themerex"),
				"desc" => __("Align skills block to left or right side", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_float
			), 
			array(
				"id" => "color",
				"title" => __("Skills items color", "themerex"),
				"desc" => __("Color for all skills items", "themerex"),
				"value" => "",
				"type" => "color"
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Skill", "themerex"),
			"desc" => __("Skills item", "themerex"),
			"id" => "trx_skills_item",
			"container" => false,
			"params" => array(
				array(
					"id" => "title",
					"title" => __("Skills item title", "themerex"),
					"desc" => __("Current skills item title", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "level",
					"title" => __("Sklls item level", "themerex"),
					"desc" => __("Current skills level", "themerex"),
					"divider" => false,
					"value" => 50,
					"min" => 0,
					"increment" => 1,
					"type" => "spinner"
				),
				array(
					"id" => "color",
					"title" => __("Skills item color", "themerex"),
					"desc" => __("Current skills item color", "themerex"),
					"divider" => false,
					"value" => "#5ea281",
					"type" => "color"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),


//=== Slider ============================================================================================================
	array(
		"title" => __("Slider", "themerex"),//Ok
		"desc" => __("Insert slider into your post (page)", "themerex"),
		"id" => "trx_slider",
		"decorate" => true,
		"container" => false,
		"params" => array_merge(array(
			array(
				"id" => "engine",
				"title" => __("Slider engine", "themerex"),
				"desc" => __("Select engine for slider. Attention! 'Flex' and 'Swiper' are built-in engines, all other engines appears only if corresponding plugings are installed", "themerex"),
				"value" => "swiper",
				"type" => "checklist",
				"options" => $THEMEREX_shortcodes_sliders
			)),
			revslider_exists() || royalslider_exists() ? array(
			array(
				"id" => "alias",
				"title" => __("Revolution slider alias or Royal Slider ID", "themerex"),
				"desc" => __("Alias for Revolution slider or Royal slider ID", "themerex"),
				"value" => "",
				"type" => "text"
			)) : array(), array(
		//	$THEMEREX_shortcodes_slider_theme,
			array(
				"id" => "cat",
				"title" => __("Swiper: Category list", "themerex"),
				"desc" => __("Comma separated list of category slugs. If empty - select posts from any category or from IDs list", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "select",
				"style" => "list",
				"multiple" => true,
				"options" => $THEMEREX_shortcodes_categories
			),
			array(
				"id" => "count",
				"title" => __("Swiper: Number of posts", "themerex"),
				"desc" => __("How many posts will be displayed? If used IDs - this parameter ignored.", "themerex"),
				"divider" => false,
				"value" => 3,
				"min" => 1,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "offset",
				"title" => __("Swiper: Offset before select posts", "themerex"),
				"desc" => __("Skip posts before select next part.", "themerex"),
				"divider" => false,
				"value" => 0,
				"min" => 0,
				"max" => 100,
				"type" => "spinner"
			),
			array(
				"id" => "orderby",
				"title" => __("Swiper: Post order by", "themerex"),
				"desc" => __("Select desired posts sorting method", "themerex"),
				"divider" => false,
				"value" => "date",
				"type" => "select",
				"options" => $THEMEREX_shortcodes_sorting
			),
			array(
				"id" => "ids",
				"title" => __("Swiper: Post IDs list", "themerex"),
				"desc" => __("Comma separated list of posts ID. If set - parameters above are ignored!", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "controls",
				"title" => __("Show slider controls", "themerex"),
				"desc" => __("Show arrows inside slider", "themerex"),
				"divider" => false,
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "pagination",
				"title" => __("Show slider pagination", "themerex"),
				"desc" => __("Show bullets for slide switch", "themerex"),
				"divider" => false,
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "titles",
				"title" => __("Show titles section", "themerex"),
				"desc" => __("Show section with post's title and short post's description", "themerex"),
				"divider" => false,
				"value" => "no",
				"type" => "checklist",
				"options" => array(
					"no"    => __('Not show', 'themerex'),
					"slide" => __('Show/Hide info', 'themerex'),
					"fixed" => __('Fixed info', 'themerex'),
				)
			),
			array(
				"id" => "links",
				"title" => __("Post's title as link", "themerex"),
				"desc" => __("Make links from post's titles", "themerex"),
				"divider" => false,
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "align",
				"title" => __("Float slider", "themerex"),
				"desc" => __("Float slider to left or right side", "themerex"),
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_float
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)),
		"children" => array(
			"title" => __("Slide", "themerex"),
			"desc" => __("Slider item", "themerex"),
			"id" => "trx_slider_item",
			"container" => false,
			"params" => array(
				array(
					"id" => "src",
					"title" => __("URL (source) for image file", "themerex"),
					"desc" => __("Select or upload image or write URL from other site for the current slide", "themerex"),
					"readonly" => false,
					"value" => "",
					"type" => "media"
				),
			//	$THEMEREX_shortcodes_slider_theme,
				$THEMEREX_shortcodes_id
			)
		)
	),

//=== Status ============================================================================================================
	array(
		"title" => __("Status", "themerex"),//Ok
		"id" => "trx_status",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Content", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_id
		)
	),


//=== Successive blocks ============================================================================================================
	array(
		"title" => __("Successive blocks", "themerex"), //Ok
		"desc" => __("Insert blocks with arrow into post (page)", "themerex"),
		"id" => "trx_points",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "type",
				"title" => __("Block type", "themerex"),
				"desc" => __("Select block type", "themerex"),
				"value" => "regular",
				"type" => "select",
				"options" => array(
					"1" => __('Type 1', 'themerex'),
					"2" => __('Type 2', 'themerex'),
				)
			),
			array(
				"id" => "arrows",
				"title" => __("Arrows", "themerex"),
				"desc" => __("Show arrows", "themerex"),
				"type" => "checklist",
				"dir" => "horizontal",
				"value" => "center",
				"options" => array(
					"yes" => __('Yes', 'themerex'),
					"no" => __('No', 'themerex'),
				)
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"id" => "trx_point_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "icon",
					"title" => __('List icon',  'themerex'),
					"desc" => __("Only for style 1",  'themerex'),
					"value" => "",
					"type" => "icons",
					"options" => $THEMEREX_shortcodes_icons
				),
				array(
					"id" => "size",
					"title" => __("Icon size", "themerex"),
					"value" => 100,
					"min" => 10,
					"type" => "spinner"
				),
				array(
					"id" => "color",
					"title" => __("Icon color", "themerex"),
					"value" => "",
					"type" => "color"
				),
				array(
					"id" => "image",
					"title" => __("Image", "themerex"),
					"desc" => __("Only for style 2", "themerex"),
					"value" => "",
					"type" => "media"
				),
				array(
					"id" => "background",
					"title" => __("Background color", "themerex"),
					"value" => "",
					"type" => "color"
				),
				array(
					"id" => "_content_",
					"title" => __("List item content", "themerex"),
					"desc" => __("Current list item content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),

//=== Table ============================================================================================================
	array(
		"title" => __("Table", "themerex"),//Ok
		"desc" => __("Insert table into post (page). ", "themerex"),
		"id" => "trx_table",
		"decorate" => true,
		"container" => true,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Table style", "themerex"),
				"desc" => __("Select table style", "themerex"),
				"value" => "regular",
				"type" => "select",
				"options" => array(
					"1" => __('Style 1', 'themerex'),
					"2" => __('Style 2', 'themerex'),
					"3" => __('Style 3', 'themerex'),
				)
			),
			array(
				"id" => "align",
				"title" => __("Text align", "themerex"),
				"desc" => __("Text's position in the table", "themerex"),
				"type" => "checklist",
				"dir" => "horizontal",
				"value" => "center",
				"options" => $THEMEREX_shortcodes_text_align,
			),
			array(
				"id" => "_content_",
				"title" => __("Table content", "themerex"),
				"desc" => __("Content, created with any table-generator <br> Paste here table content, generated on one of many public internet resources, for example: <a href='http://www.impressivewebs.com/html-table-code-generator/'>generation1</a> or <a href='http://html-tables.com/'>generation2</a>", "themerex"),
				"rows" => 8,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),



//=== Tabs ============================================================================================================
	array(
		"title" => __("Tabs", "themerex"),//Ok
		"desc" => __("Insert tabs in your page (post)", "themerex"),
		"id" => "trx_tabs",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Tabs style", "themerex"),
				"value" => "1",
				"type" => "checklist",
				"options" => array(
					"1" => __('Style 1', 'themerex'),
					"2" => __('Style 2', 'themerex'),
					"3" => __('Style 3', 'themerex')
				)
			),
			array(
				"id" => "scroll",
				"title" => __("Use scroller", "themerex"),
				"desc" => __("Use scroller to show tab content (height parameter required)", "themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Tab", "themerex"),
			"desc" => __("Tab item", "themerex"),
			"id" => "trx_tab",
			"container" => true,
			"params" => array(
				array(
					"id" => "_title_",
					"title" => __("Tab title", "themerex"),
					"desc" => __("Current tab title", "themerex"),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "_content_",
					"title" => __("Tab content", "themerex"),
					"desc" => __("Current tab content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),




//=== Team ============================================================================================================
	array(
		"title" => __("Team", "themerex"),//Ok
		"desc" => __("Insert team in your page (post)", "themerex"),
		"id" => "trx_team",
		"decorate" => true,
		"container" => false,
		"params" => array(
			THEMEREX_shortcodes_indent(),
			array(
				"id" => "rounding",
				"title" => __("Avatar corner rounding", "themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Team style", "themerex"),
				"value" => "1",
				"type" => "checklist",
				"options" => array(
					"1" => __('Style 1', 'themerex'),
					"2" => __('Style 2', 'themerex'),
					"3" => __('Style 3', 'themerex'),
				)
			),
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Member", "themerex"),
			"desc" => __("Team member", "themerex"),
			"id" => "trx_team_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "user",
					"title" => __("Team member", "themerex"),
					"desc" => __("Select one of registered users (if present) or put name, position etc. in fields below", "themerex"),
					"value" => "",
					"type" => "select",
					"options" => $THEMEREX_shortcodes_users
				),
				array(
					"id" => "name",
					"title" => __("Name", "themerex"),
					"desc" => __("Team member's name", "themerex"),
					"dependency" => array(
						'user' => array('is_empty', 'none')
					),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "position",
					"title" => __("Position", "themerex"),
					"desc" => __("Team member's position", "themerex"),
					"dependency" => array(
						'user' => array('is_empty', 'none')
					),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "email",
					"title" => __("E-mail", "themerex"),
					"desc" => __("Team member's e-mail", "themerex"),
					"dependency" => array(
						'user' => array('is_empty', 'none')
					),
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "photo",
					"title" => __("Photo", "themerex"),
					"desc" => __("Team member's photo (avatar)", "themerex"),
					"dependency" => array(
						'user' => array('is_empty', 'none')
					),
					"value" => "",
					"readonly" => false,
					"type" => "media"
				),
				array(
					"id" => "border",
					"title" => __("Photo border", "themerex"),
					"value" => "no",
					"type" => "switch",
					"options" => $THEMEREX_shortcodes_yes_no
				),
				array(
					"id" => "align",
					"title" => __("Align", "themerex"),
					"value" => "",
					"divider" => true,
					"type" => "checklist",
					"dir" => "horizontal",
					"options" => array(
					'left' => __('Left', 'themerex'),
					'right' => __('Right', 'themerex')
				)
				),
				array(
					"id" => "_content_",
					"title" => __("Description", "themerex"),
					"desc" => __("Team member's short description", "themerex"),
					"divider" => true,
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),




//=== Testimonials ============================================================================================================
	array(
		"title" => __("Testimonials", "themerex"), //Ok
		"desc" => __("Insert testimonials into post (page)", "themerex"),
		"id" => "trx_testimonials",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Title of testimonmials block", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Testimonials style", "themerex"),
				"divider" => false,
				"value" => "1",
				"type" => "checklist",
				"options" => array(
					"1" => __('Style 1', 'themerex'),
					"2" => __('Style 2', 'themerex'),
				)
			),
			array(
				"id" => "controls",
				"title" => __("Show testimonmials controls", "themerex"),
				"desc" => __("Show arrows inside testimonmials","themerex"),
				"divider" => false,
				"value" => "yes",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			array(
				"id" => "pagination",
				"title" => __("Show testimonmials pagination", "themerex"),
				"desc" => __("Show bullets for testimonmial switch","themerex"),
				"value" => "no",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_yes_no
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Item", "themerex"),
			"desc" => __("Testimonials item", "themerex"),
			"id" => "trx_testimonials_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "name",
					"title" => __("Name", "themerex"),
					"desc" => __("Name of testimonmials author", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "position",
					"title" => __("Position", "themerex"),
					"desc" => __("Position of testimonmials author", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "email",
					"title" => __("E-mail", "themerex"),
					"desc" => __("E-mail of testimonmials author", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "photo",
					"title" => __("Photo", "themerex"),
					"desc" => __("Select or upload photo of testimonmials author", "themerex"),
					"value" => "",
					"type" => "media"
				),
				array(
					"id" => "_content_",
					"title" => __("Testimonials text", "themerex"),
					"desc" => __("Current testimonials text", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id
			)
		)
	),


//=== Text ============================================================================================================
	array(
		"title" => __("Text", "themerex"),//Ok
		"desc" => __("Create p tag with many styles", "themerex"),
		"id" => "trx_text",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Text content", "themerex"),
				"rows" => 4,
				"value" => "Content",
				"type" => "textarea"
			),
			array(
				"id" => "color",
				"title" => __("Text color", "themerex"),
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "size",
				"title" => __('Font size', "themerex"),
				"value" => 16,
				"min" => 1,
				"type" => "spinner"
			),
			array(
				"id" => "weight",
				"title" => __("Font weight", "themerex"),
				"desc" => __("Title font weight", "themerex"),
				"value" => "",
				"type" => "select",
				"size" => "medium",
				"options" => array(
					'100' => __('Thin (100)', 'themerex'),
					'300' => __('Light (300)', 'themerex'),
					'400' => __('Normal (400)', 'themerex'),
					'700' => __('Bold (700)', 'themerex')
				)
			),
			array(
				"id" => "height",
				"title" => __('Line height', "themerex"),
				"value" => 20,
				"min" => 1,
				"type" => "spinner"
			),
			array(
				"id" => "spacing",
				"title" => __('Letter spacing', "themerex"),
				"value" => 0,
				"min" => 0,
				"type" => "spinner"
			),
			array(
				"id" => "uppercase",
				"title" => __('Uppercase', "themerex"),
				"value" => "off",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_on_off
			),
			array(
				"id" => "align",
				"title" => __("Text alignment", "themerex"),
				"desc" => __("Title text alignment", "themerex"),
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),


//=== Title ============================================================================================================
	array(
		"title" => __("Title", "themerex"),//Ok
		"desc" => __("Create header tag (1-6 level) with many styles", "themerex"),
		"id" => "trx_title",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "_content_",
				"title" => __("Title content", "themerex"),
				"desc" => __("Title content", "themerex"),
				"rows" => 4,
				"value" => "Title",
				"type" => "textarea"
			),
			array(
				"id" => "type",
				"title" => __("Title type", "themerex"),
				"desc" => __("Title type (header level)", "themerex"),
				"divider" => false,
				"value" => "1",
				"type" => "select",
				"options" => array(
					'1' => __('Header 1', 'themerex'),
					'2' => __('Header 2', 'themerex'),
					'3' => __('Header 3', 'themerex'),
					'4' => __('Header 4', 'themerex'),
					'5' => __('Header 5', 'themerex'),
					'6' => __('Header 6', 'themerex'),
				)
			),
			array(
				"id" => "color",
				"title" => __("Title color", "themerex"),
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "weight",
				"title" => __("Font weight", "themerex"),
				"desc" => __("Title font weight", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "select",
				"size" => "medium",
				"options" => array(
					'100' => __('Thin (100)', 'themerex'),
					'300' => __('Light (300)', 'themerex'),
					'400' => __('Normal (400)', 'themerex'),
					'700' => __('Bold (700)', 'themerex')
				)
			),
			array(
				"id" => "align",
				"title" => __("Text alignment", "themerex"),
				"desc" => __("Title text alignment", "themerex"),
				"value" => "",
				"divider" => false,
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_align
			),
			
			array(
				"id" => "position",
				"title" => __('Icon (image) position', "themerex"),
				"desc" => __("Select icon (image) position (if style='iconed')", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "checklist",
				"options" => array(
					'top' => __('Top', 'themerex'),
					'left' => __('Left', 'themerex'),
					'right' => __('Right', 'themerex')
				)
			),
			array(
				"id" => "box_style",
				"title" => __('Show background under icon', "themerex"),
				"desc" => __("Select background under icon", "themerex"),
				"divider" => false,
				"value" => "none",
				"type" => "checklist",
				"options" => $THEMEREX_shortcodes_box_style,
			),
			array(
				"id" => "icon",
				"title" => __('Title font icon',  'themerex'),
				"desc" => __("Select font icon for the title from Fontello icons set (if style='iconed')",  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "icons",
				"options" => $THEMEREX_shortcodes_icons
			),
			array(
				"id" => "size",
				"title" => __('Icon size', "themerex"),
				"desc" => __("Select icon size (if style='iconed')", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "checklist",
				"options" => array(
					'small' => __('Small', 'themerex'),
					'medium' => __('Medium', 'themerex'),
					'inherit' => __('Inherit', 'themerex'),
					'large' => __('Large', 'themerex'),
					'huge' => __('Huge', 'themerex')
				)
			),
			array(
				"id" => "icon_color",
				"title" => __('Icon color',  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "bg_color",
				"title" => __("Icon's background color", "themerex"),
				"desc" => __("Icon's background color (if style='iconed')", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "color"
			),
			array(
				"id" => "icon_image",
				"title" => __('or image icon',  'themerex'),
				"desc" => __("Select image icon for the title instead icon above (if style='iconed')",  'themerex'),
				"divider" => false,
				"value" => "",
				"type" => "images",
				"size" => "small",
				"options" => $THEMEREX_shortcodes_images
			),
			array(
				"id" => "image_url",
				"title" => __('or URL for image file', "themerex"),
				"desc" => __("Select or upload image or write URL from other site (if style='iconed')", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),


//=== Toggles ============================================================================================================

	array(
		"title" => __("Toggles / Accordion", "themerex"),//Ok
		"desc" => __("<b>Toggles</b>:  allows to expand and collapse text blocks to reveal the content related to that block; it's possible to expand all blocks <br> <b>Accordion</b>: allows to expand and colapse blocks to reveal the content related to that block, but unlike toggles, when expanding one of the blocks, the rest collapse", "themerex"),
		"id" => "trx_toggles",
		"decorate" => true,
		"container" => false,
		"params" => array(
			array(
				"id" => "type ",
				"title" => __("Type", "themerex"),
				"desc" => __("Select type for display", "themerex"),
				"divider" => false,
				"value" => "toggles",
				"options" => array(
					'toggles' => __('Toggles', 'themerex'),
					'accordion' => __('Accordion', 'themerex')
				),
				"type" => "checklist"
			),
			array(
				"id" => "style",
				"title" => __("Style", "themerex"),
				"desc" => __("Select style for display", "themerex"),
				"divider" => false,
				"value" => "1",
				"options" => array(
					"1" => __('Style 1', 'themerex'),
					"2" => __('Style 2', 'themerex'),
					"3" => __('Style 3', 'themerex')
				),
				"type" => "checklist"
			),
			array(
				"id" => "icon",
				"title" => __("Icon position", "themerex"),
				"desc" => __("Icon's position in the accordion", "themerex"),
				"divider" => false,
				"value" => "left",
				"options" => array(
					'left'	=> __('Left', 'themerex'),
					'right'	=> __('Right', 'themerex'),
					'off'	=> __('Off', 'themerex')
				),
				"type" => "checklist"
			),
			array(
				"id" => "counter",
				"title" => __("Counter", "themerex"),
				"desc" => __("Display counter before each title", "themerex"),
				//"divider" => false,
				"value" => "off",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_on_off
			),
			array(
				"id" => "initial",
				"title" => __("Initially opened item", "themerex"),
				"desc" => __("Option (Number of initially opened item) applies only to accordions", "themerex"),
				"value" => 1,
				"min" => 0,
				"type" => "spinner"
			),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		),
		"children" => array(
			"title" => __("Toggle", "themerex"),
			"desc" => __("Toggle item", "themerex"),
			"id" => "trx_toggles_item",
			"container" => true,
			"params" => array(
				array(
					"id" => "title",
					"title" => __("Toggle item title", "themerex"),
					"desc" => __("Title for current toggle item", "themerex"),
					"divider" => false,
					"value" => "",
					"type" => "text"
				),
				array(
					"id" => "_content_",
					"title" => __("Toggles item content", "themerex"),
					"desc" => __("Current toggle item content", "themerex"),
					"rows" => 4,
					"value" => "",
					"type" => "textarea"
				),
				$THEMEREX_shortcodes_id,
				array(
					"id" => "open",
					"title" => __("Open on show", "themerex"),
					"desc" => __("Open current toggle item on show <br> <i>works only with the type 'toggle'</i>", "themerex"),
					"divider" => false,
					"value" => "no",
					"type" => "switch",
					"options" => $THEMEREX_shortcodes_yes_no
				)
			)
		)
	),



//=== Tooltip ============================================================================================================
	array(
		"title" => __("Tooltip", "themerex"),//Ok
		"desc" => __("Create tooltip for selected text", "themerex"),
		"id" => "trx_tooltip",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "title",
				"title" => __("Title", "themerex"),
				"desc" => __("Tooltip title (required)", "themerex"),
				"value" => "",
				"type" => "text"
			),
			array(
				"id" => "_content_",
				"title" => __("Tipped content", "themerex"),
				"desc" => __("Highlighted content with tooltip", "themerex"),
				"rows" => 4,
				"value" => "",
				"type" => "textarea"
			),
			$THEMEREX_shortcodes_id
		)
	),

//=== Video ============================================================================================================
	array(
		"title" => __("Video", "themerex"),//Ok
		"desc" => __("Insert video player", "themerex"),
		"id" => "trx_video",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "url",
				"title" => __("URL for video file", "themerex"),
				"desc" => __("Select video from media library or paste URL for video file from other site", "themerex"),
				"divider" => false,
				"readonly" => false,
				"value" => "",
				"type" => "media",
				"before" => array(
					'title' => __('Choose video', 'themerex'),
					'action' => 'media_upload',
					'type' => 'video',
					'multiple' => false,
					'linked_field' => '',
					'captions' => array( 	
						'choose' => __('Choose video file', 'themerex'),
						'update' => __('Select video file', 'themerex')
					)
				),
				"after" => array(
					'icon' => 'icon-cancel',
					'action' => 'media_reset'
				)
			),
			array(
				"id" => "autoplay",
				"title" => __("Autoplay video", "themerex"),
				"desc" => __("Autoplay video on page load", "themerex"),
				"divider" => false,
				"value" => "off",
				"type" => "switch",
				"options" => $THEMEREX_shortcodes_on_off
			),
			array(
				"id" => "title",
				"title" => __("Video title", "themerex"),
				"desc" => __("Title displayed in the video", "themerex"),
				"divider" => false,
				"value" => "",
				"type" => "text",
			),
			array(
				"id" => "image",
				"title" => __("Image preview", "themerex"),
				"desc" => __("Select or upload image or write URL from other site for video preview", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),

//=== Wave ============================================================================================================
	array(
		"title" => __("Waves", "themerex"),//Ok
		"desc" => __("Insert waves into post (page)", "themerex"),
		"id" => "trx_wave",
		"decorate" => false,
		"container" => true,
		"params" => array(
			array(
				"id" => "type",
				"title" => __("Waves type", "themerex"),
				"divider" => true,
				"value" => "1",
				"options" => array(
					'1'	=> __('Type 1', 'themerex'),
					'2'	=> __('Type 2', 'themerex')
				),
				"type" => "checklist"
			),
			THEMEREX_shortcodes_width(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	),
//=== Zoom ============================================================================================================
	array(
		"title" => __("Zoom", "themerex"),//Ok
		"desc" => __("Insert zoom image into your post (page)", "themerex"),
		"id" => "trx_zoom",
		"decorate" => false,
		"container" => false,
		"params" => array(
			array(
				"id" => "url",
				"title" => __("URL for image file", "themerex"),
				"desc" => __("Select or upload image or write URL from other site", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "over",
				"title" => __("URL for overlap image file", "themerex"),
				"desc" => __("Select or upload overlapping image", "themerex"),
				"readonly" => false,
				"value" => "",
				"type" => "media"
			),
			array(
				"id" => "align",
				"title" => __("Float zoom", "themerex"),
				"desc" => __("Float zoom to left or right side", "themerex"),
				"value" => "",
				"type" => "checklist",
				"dir" => "horizontal",
				"options" => $THEMEREX_shortcodes_float
			), 
			THEMEREX_shortcodes_width(),
			THEMEREX_shortcodes_height(),
			$THEMEREX_shortcodes_margin_top,
			$THEMEREX_shortcodes_margin_right,
			$THEMEREX_shortcodes_margin_bottom,
			$THEMEREX_shortcodes_margin_left,
			$THEMEREX_shortcodes_id
		)
	)
	
);



// Filters for shortcodes handling
//----------------------------------------------------------------------

// Enable shortcodes in widgets
//add_filter('widget_text', 'do_shortcode');

// Enable shortcodes in excerpt
add_filter('the_excerpt', 'do_shortcode');

// Clear \n around shortcodes
add_filter('widget_text', 'sc_empty_paragraph_fix2', 1);
add_filter('the_excerpt', 'sc_empty_paragraph_fix2', 1);
add_filter('the_content', 'sc_empty_paragraph_fix2', 1);
function sc_empty_paragraph_fix2($content) {   
	$content = str_replace("\r\n", "\n", $content);
	$content = preg_replace("/\]\s*\n*\s*\[/", "][", $content);

	return $content;
}

// Clear paragraph tags around shortcodes
add_filter('widget_text', 'sc_empty_paragraph_fix');
add_filter('the_excerpt', 'sc_empty_paragraph_fix');
add_filter('the_content', 'sc_empty_paragraph_fix');
function sc_empty_paragraph_fix($content) {   
	$content = preg_replace(array(
		"/(<p>|<br>|<br\/>|<br \/>)\s*\n*\s*\[/",
		"/\]\s*\n*\s*(<\/p>|<br>|<br\/>|<br \/>)/",
		"/<p>\s*\n*\s*(<div|<h1|<h2|<h3|<h4|<h5|<h6)/",
		"/(<\/div>|<\/h1>|<\/h2>|<\/h3>|<\/h4>|<\/h5>|<\/h6>)\s*\n*\s*<\/p>/"
		),
		array(
		"[",
		"]",
		"\$1",
		"\$1"
		),
		$content);
	return $content;
}

// Shortcodes list select handler
add_action('admin_head', 'sc_selector_js');
function sc_selector_js() {
	if (is_themerex_options_used()) {
		themerex_options_load_scripts();
		themerex_options_prepare_js();
		themerex_shortcodes_load_scripts();
	}
}	

// ThemeREX shortcodes load scripts
function themerex_shortcodes_load_scripts() {
	global $THEMEREX_shortcodes;
	?>
	<script type="text/javascript">
		var THEMEREX_shortcodes = JSON.parse('<?php echo str_replace("'", "\\'", json_encode($THEMEREX_shortcodes)); ?>');
	</script>
	<?php
	themerex_enqueue_script( 'themerex-shortcodes-script', get_template_directory_uri() . '/includes/shortcodes/shortcodes_admin.js', array('jquery'), null, true );
	themerex_enqueue_script( 'themerex-selection-script', get_template_directory_uri() . '/js/jquery.selection.js', array('jquery'), null, true );
}


// ThemeREX shortcodes prepare scripts
function themerex_shortcodes_prepare_js() {
	global $THEMEREX_shortcodes;
	?>
	<script type="text/javascript">
		var THEMEREX_shortcodes = JSON.parse('<?php echo str_replace("'", "\\'", json_encode($THEMEREX_shortcodes)); ?>');
		var THEMEREX_shortcodes_cp = '<?php echo is_admin() ? 'wp' : 'internal'; ?>';
	</script>
	<?php
}


// Show shortcodes list in admin editor
add_action('media_buttons','sc_selector_add_in_toolbar', 11);
function sc_selector_add_in_toolbar(){
	global $THEMEREX_shortcodes;
	
	$shortcodes_list = '<select class="sc_selector"><option value="">&nbsp;'.__('- Select Shortcode -', 'themerex').'&nbsp;</option>';

	foreach ($THEMEREX_shortcodes as $idx => $sc) {
		$shortcodes_list .= '<option value="' . $idx . '" title="">' . esc_attr($sc['title']) . '</option>';
	}

	$shortcodes_list .= '</select>';

	echo balanceTags($shortcodes_list);
}


function sc_param_is_on($prm) {
	return $prm>0 || in_array(themerex_strtolower($prm), array('true', 'on', 'yes', 'show'));
}
function sc_param_is_off($prm) {
	return empty($prm) || $prm===0 || in_array(themerex_strtolower($prm), array('false', 'off', 'no', 'none', 'hide'));
}
?>
