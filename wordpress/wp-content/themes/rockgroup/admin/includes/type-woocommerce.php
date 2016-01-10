<?php
/* Woocommerce support functions
------------------------------------------------------------------------------- */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content', 'themerex_wrapper_start', 10);
if ( !function_exists( 'themerex_wrapper_start' ) ) {
	function themerex_wrapper_start() {
		$blog_style = 'fullpost'; //get_custom_option('blog_style');
		$post_format = 'standard';
	?>
		<div id="main_inner" class="clearboth blog_style_<?php echo esc_attr($blog_style); ?>">
			<div id="content" class="content_blog post_single" role="main">
				<article <?php post_class('theme_article post_format_'.$post_format); ?>>
					<div class="post_content">
	<?php
	}
}

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);		
add_action('woocommerce_after_main_content', 'themerex_wrapper_end', 10);
if ( !function_exists( 'themerex_wrapper_end' ) ) {
	function themerex_wrapper_end() {
		if (is_product()) {
			showShareButtons(array(
				'post_id'    => get_the_ID(),
				'post_link'  => get_permalink(),
				'post_title' => getPostTitle(),
				'post_descr' => getPostDescription(),
				'post_thumb' => wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()))
			));
		}
	?>
					</div>
				</article>
			</div><!-- #content -->
		</div><!-- #main_inner -->
		<?php get_sidebar(); ?>
	<?php
	}
}

// Redefine number of related products
if ( !function_exists( 'woocommerce_output_related_products' ) ) {
	function woocommerce_output_related_products() {
		if (($ppp = max(3, get_custom_option('post_related_count'))) > 0)
			woocommerce_related_products($ppp, 3);
	}
}


// Return true, if current page is any woocommerce page
if ( !function_exists( 'is_woocommerce_page' ) ) {
	function is_woocommerce_page() {
		return function_exists('is_woocommerce') ? is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() : false;
	}
}
?>