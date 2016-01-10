<?php
if (get_theme_option('show_theme_customizer') == 'yes') {
	$basic_color = get_custom_option('theme_color');
	$accent_color = get_custom_option('theme_accent_color');
	$background_color = get_custom_option('bg_color');
	$color_cheme = get_custom_option('color_scheme_theme');

	$reviews_max_level = max(5, (int) get_custom_option('reviews_max_level'));
	$body_style = get_custom_option('body_style');
	$bg_pattern = get_custom_option('bg_pattern');
	$bg_image = get_custom_option('bg_image');

	$logo_position = get_custom_option('logo_position');
	$menu_style = get_custom_option('menu_style');

	$custom_style = ($color_cheme == 'themeDark' ? 'co_dark' : 'co_light');
	
	/*scripts & styles*/
	themerex_enqueue_style(  'swiperslider-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.css', array(), null );
	themerex_enqueue_script( 'swiperslider', get_template_directory_uri() . '/js/swiper/idangerous.swiper-2.1.js', array('jquery'), null, true );
	themerex_enqueue_style(  'swiperslider-scrollbar-style',  get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar.css', array(), null );
	themerex_enqueue_script( 'swiperslider-scrollbar', get_template_directory_uri() . '/js/swiper/idangerous.swiper.scrollbar-2.1.js', array('jquery'), null, true );
?>
<?php
}
?>
