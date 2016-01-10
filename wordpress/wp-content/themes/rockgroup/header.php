<?php
/**
 * The Header for our theme.
 *
 * @package Rockgroup
 */

 
global 	$THEMEREX_mainmenu,
		$logo_image;
		themerex_init_template();	// Init theme template - prepare global variables
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="icon" type="image/x-icon" href="<?php echo get_custom_option('favicon') != '' ? get_theme_option('favicon') : get_template_directory_uri().'/images/favicon.ico'; ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<?php 
	
	if(get_custom_option('logo_image') != '') $logo_image = get_custom_option('logo_image');
	$body_style =  get_custom_option('body_style');
	$blog_style = get_custom_option('blog_style');
	$side_bar = get_custom_option('show_sidebar_main');
	if(is_404())  $side_bar = 'fullWidth';
	$slider_show	= get_custom_option('slider_show')=='yes';
	$pagination_style = get_theme_option('blog_pagination');

	$class_array  = array();
	//body class / theme color style
 	$class_array[] = get_custom_option('color_scheme_theme');
	//sideBar menu position left/right
	$class_array[] = $side_bar;
	
	$class_array[] = $side_bar != 'fullWidth' ? 'sideBarShow' : 'sideBarHide';
	$class_array[] = $side_bar == 'wide' ? 'sideBarWide' : '';

	$class_array[] = get_custom_option('menu_style') != '' ? 'menuStyle'.get_custom_option('menu_style') : 'menuStyle1';
	$class_array[] = sc_param_is_on(get_custom_option('menu_smart_scroll')) ? 'menuSmartScrollShow' : '';
	//blog style
	$class_array[] = 'blogStyle'.(strpos($blog_style,'portfolio') !== false ? 'Portfolio' : 'Excerpt');

	//body style
	if(($blog_style == 'excerpt_line' || $blog_style == 'excerpt' || (is_single() && ($blog_style == 'portfolio_big' || $blog_style == 'portfolio_mini' || $blog_style == 'portfolio_medium'))) && (is_category() || is_single() || $side_bar == 'sideBarLeft' || $side_bar == 'sideBarRight') && $body_style == 'fullWide')
	{
		$class_array[] = ' bodyStyleWide';
	}
	else $class_array[] = ' bodyStyle'.ucfirst($body_style);

	//color scheme
	if(!is_404()) $class_array[] = 'color_scheme_'.get_custom_option('color_scheme');
	//error page
	else $class_array[] = 'color_scheme_green';
	//BG style
	if ( $body_style == 'boxed') {
		//background custom style
		if( get_custom_option('bg_image') != '' && get_custom_option('bg_image') != 0 ) {
			$class_array[] = 'bgImage_'. get_custom_option('bg_image');
		} else if( get_custom_option('bg_pattern') != '' && get_custom_option('bg_pattern') != 0) {
			$class_array[] = 'bgPattern_'. get_custom_option('bg_pattern');
		}
	}

	$logo_position = 'logo_'.get_custom_option('logo_position');
	//main top menu position & style
	$class_array[] = get_custom_option('menu_position') == 'Fixed' ? 'menuStyle'.get_custom_option('menu_position') : '';
	$class_array[] = get_custom_option('menu_display').'MenuDisplay';
	$class_array[] = get_custom_option('logo_type').'Style';
	$class_array[] = get_custom_option('logo_background') == 'yes' ? 'logoStyleBG' : '';
	$class_array[] = $slider_show ? 'sliderShow' : '';
	$class_array[] = $logo_position;

	//echo style/class
	$style = !empty($style_array) ? 'style="background: '.join(' ', $style_array).'"' : '';
	$class = !empty($class_array) ? ' '.join(' ', $class_array) : '';

?>

<body  <?php body_class(); ?> data-menu="<?php echo get_theme_option('responsive_menu_width'); ?>">
<?php do_action('before'); ?>

<div id="wrap" class="wrap <?php echo esc_attr($class); ?>" <?php echo esc_attr($style); ?>>
<div class="buttonScrollUp upToScroll icon-up-open-big"></div>
<div id="wrapBox" class="wrapBox">
	<?php if ( get_custom_option('main_menu_show') == 'yes'){ ?>
	<header id="header">

		<?php if ( get_custom_option('menu_position') == 'Fixed' && get_custom_option('main_menu_show') == 'yes' && $THEMEREX_mainmenu)  { ?>
			<div class="menuFixedWrapBlock"></div>

				<?php if($logo_position == 'logo_top' || $logo_position == 'logo_center') { ?>
					<!--logo-->
					<div class="logoHeader">
						<?php //logo text style
						if( get_custom_option('logo_type') == 'logoImage'){ ?>
							<a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($logo_image); ?>" alt=""></a>
						<?php } else { ?>
							<a href="<?php echo esc_url(home_url()); ?>"><?php echo get_custom_option('title_logo'); ?></a>
						<?php } ?>
					</div>
					<?php 
					if( get_custom_option('sub_title_logo') != '' ){ ?>
					<h2 class="subTitle"><?php echo esc_attr(get_custom_option('sub_title_logo')); ?></h2>
					<?php } ?>
				<?php } ?>

				<!--menu-->
				<div class="menuFixedWrap">
				<?php } 

				else {?>
						<!--logo-->
					<div class="logoHeader">
						<?php //logo text style
						if( get_custom_option('logo_type') == 'logoImage'){ ?>
							<a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($logo_image); ?>" alt=""></a>
						<?php } else { ?>
							<a href="<?php echo esc_url(home_url()); ?>"><?php echo  esc_attr(get_custom_option('title_logo')); ?></a>
						<?php } ?>
					</div>
			 	<?php }?>

				<a href="#" class="openMobileMenu"></a>
				<?php if ( get_custom_option('main_menu_show') == 'yes' && $THEMEREX_mainmenu)  { ?>
					<a href="#" class="openTopMenu"></a>
				<?php } 

				if( get_custom_option('show_login') == 'yes' ) { ?>
					<div class="usermenuArea">
					<?php 
						$THEMEREX_usermenu_show = false;
						get_template_part('/templates/page-part-user-panel'); 
					?>
					</div>
				<?php } 

				//show main top menu
				if ( get_custom_option('main_menu_show') == 'yes' && $THEMEREX_mainmenu)  { ?>
				<div class="wrapTopMenu">
					<div class="topMenu main">
						<?php echo balanceTags($THEMEREX_mainmenu); ?>
					</div>
				</div>
				<?php } 
				if ( get_custom_option('main_menu_show') == 'yes' && !$THEMEREX_mainmenu) echo '<div class="sc_show_menu_error"><strong>Please choose or create menu in Appearance > Menus.<strong></div>'; ?>

		<?php if ( get_custom_option('menu_position') == 'Fixed' && get_custom_option('main_menu_show') == 'yes' && $THEMEREX_mainmenu)  { ?>
		</div> <!-- /menuFixedWrap -->

		<?php if($logo_position == 'logo_bottom') { ?>
			<!--logo-->
			<div class="logoHeader">
				<?php //logo text style
					if( get_custom_option('logo_type') == 'logoImage'){ ?>
						<a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($logo_image); ?>" alt=""></a>
				<?php } else { ?>
						<a href="<?php echo esc_url(home_url()); ?>"><?php echo  esc_attr(get_custom_option('title_logo')); ?></a>
				<?php } ?>
			</div>
			<?php 
			if( get_custom_option('sub_title_logo') != '' ){ ?>
			<h2 class="subTitle"><?php echo esc_attr(get_custom_option('sub_title_logo')); ?></h2>
			<?php } ?>
		<?php } ?>

		<?php } ?>

	</header>
	<?php } ?>
	<?php 

	if (get_custom_option('slider_show')=='yes') { 
		//slider
		get_template_part('templates/page-part-slider'); 
	}
	else if(get_custom_option('header_image') != ''){
		//header image
		echo balanceTags('<div class="sc_header_image" style="background-image: url('.get_custom_option('header_image').');"></div>');
	}
	
	
	//category title & description
	if (sc_param_is_on( get_custom_option('description_lable_show'))) { 
		$catTitle = getBlogTitle(); 
		$catDescription = '';
		if(get_custom_option('description_lable') != '') $catDescription = get_queried_object() -> category_description ?  get_queried_object() -> category_description : '';
		if ($catDescription == '' && get_custom_option('description_lable') != '') $catDescription = get_custom_option('description_lable');
	
		if($catTitle || $catDescription){
		?>
			<div class="subCategory">
				<h1><?php echo esc_attr($catTitle); ?></h1> <?php
				echo balanceTags($catDescription ? '<div class="categoryDescription">'.esc_attr($catDescription).'</div>' : ''); ?>
				
			</div><?php 
		}
	} 

	$footer_widget = (get_custom_option('show_sidebar_top') == 'yes' && is_active_sidebar( get_custom_option('sidebar_top')));
		if( $footer_widget ){ ?>
			<div class="topWidget">
				<div class="main">

					<?php  // ---------------- Footer sidebar ----------------------
					if ( $footer_widget  ) { 
						global $THEMEREX_CURRENT_SIDEBAR;
						$THEMEREX_CURRENT_SIDEBAR = 'top'; 
							do_action( 'before_sidebar' );
							if ( !dynamic_sidebar( get_custom_option('sidebar_top') ) ) {
								// Put here html if user no set widgets in sidebar
							}
					} ?>
				</div><!-- /top widget -->
			</div>
	<?php }  ?>


	<div class="wrapContent">
		<div id="wrapWide" class="wrapWide">

			<!--[if lt IE 9]>
			<?php echo ('<center>'.do_shortcode("[trx_infobox style='info' title='Your browser needs to be updated.' closeable='no']
				[trx_columns indent='no' columns='4']
				[trx_column_item][trx_icon icon='icon-chrome' align='center' box_style='circle' size='30' bottom='5']<a href='https://www.google.com/intl/en/chrome/browser/' target='_blank'>Chrome</a>[/trx_column_item]
				[trx_column_item][trx_icon icon='icon-safari' align='center' box_style='circle' size='30' bottom='5']<a href='http://support.apple.com/kb/dl1531' target='_blank'>Safari</a>[/trx_column_item]
				[trx_column_item][trx_icon icon='icon-firefox' align='center' box_style='circle' size='30' bottom='5']<a href='http://www.mozilla.org/en-US/firefox/new/' target='_blank'>FireFox</a>[/trx_column_item]
				[trx_column_item][trx_icon icon='icon-ie' align='center' box_style='circle' size='30' bottom='5']<a href='http://windows.microsoft.com/en-us/internet-explorer/download-ie' target='_blank'>Internet Exp</a>.[/trx_column_item]
				[/trx_columns]

			[/trx_infobox]").'</center>'); ?>
			<![endif]-->

			<div class="content">
				<?php
				$fstyle = strpos($blog_style,'portfolio') !== false;
				echo ($body_style == 'boxed' &&  $side_bar != 'fullWidth' && !$fstyle ) ? '<div class="main">' : '' ?>

