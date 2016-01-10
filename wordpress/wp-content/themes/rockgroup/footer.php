<?php
/**
 * The template for displaying the footer.
 * @package Rockgroup
 */

global $logo_footer; 

				$body_style =  get_custom_option('body_style');
				$side_bar = get_custom_option('show_sidebar_main');
				$fstyle = strpos(get_custom_option('blog_style'),'portfolio') !== false;

				echo ($body_style == 'boxed' &&  $side_bar != 'fullWidth' && !$fstyle) ? '</div><!-- /.main -->' : '' ?>
			</div><!-- /.wrapContent > /.content -->
			<?php get_sidebar(); //sidebar ?>
		</div><!-- /.wrapContent > /.wrapWide -->
	</div><!-- /.wrapContent -->

	<?php 
	// ----------------- Google map -----------------------
	if ( get_custom_option('googlemap_show') == 'yes' ) { 
		$map_address = get_custom_option('googlemap_address');
		$map_latlng = get_custom_option('googlemap_latlng');
		$map_zoom = get_custom_option('googlemap_zoom');
		$map_scroll = get_custom_option('googlemap_scroll');
		$map_style = get_custom_option('googlemap_style');
		if (!empty($map_address) || !empty($map_latlng)) { 
			themerex_enqueue_script('googlemap', 'http://maps.google.com/maps/api/js?sensor=false', array(), null, true );
			themerex_enqueue_script('googlemap_init', get_template_directory_uri().'/js/_googlemap_init.js', array(), null, true ); 

			echo do_shortcode('[trx_googlemap id="footer" latlng="'.$map_latlng.'" address="'.$map_address.'" zoom="'.$map_zoom.'" scroll="'.$map_scroll.'" style="'.$map_style.'" width="100%" height="350"]');
		
		} 
	}

	// -------------- footer -------------- 
	$footer_widget = (get_custom_option('show_sidebar_footer') == 'yes' && is_active_sidebar( get_custom_option('sidebar_footer')));
	
	if( $footer_widget){
	?>
	<footer <?php echo ($footer_widget ? 'class="footerWidget"' : ''); ?>>
		<div class="main">

			<?php  // ---------------- Footer sidebar ----------------------
			if ( $footer_widget  ) { 
				global $THEMEREX_CURRENT_SIDEBAR;
				$THEMEREX_CURRENT_SIDEBAR = 'footer'; 
					do_action( 'before_sidebar' );
					if ( !dynamic_sidebar( get_custom_option('sidebar_footer') ) ) {
						// Put here html if user no set widgets in sidebar
					}
			} 
			?>
		</div><!-- /footer.main -->
	</footer>
	<?php } ?>

	<?php
	$copyright = sc_param_is_on(get_custom_option('show_copyright'));
	$footer_logo = get_custom_option('logo_image_footer');
	if(get_custom_option('footer_show') == 'yes'){
	?>
	<footer <?php echo 'class="footer"' ?>>
		<div class="main">
            <div class="logo">
                <img <?php echo 'src="'.esc_url($footer_logo).'"' ?> alt="" />
            </div>
            <?php 
	         $copy_footer = get_theme_option('footer_copyright');
			if ( $copy_footer != '' && $copyright ){ ?>
				<div class="copyright"><?php
				print str_replace('[year]',date('Y'), $copy_footer); ?>
			    </div>
			<?php }  ?>

             <?php
            $socials = get_theme_option('social_icons');
            if ($socials) { ?>
				<ul class="social_links social_style_<?php echo get_theme_options_attribute('social_icons','style') ?>">
				<?php foreach ($socials as $s) {
				if (empty($s['icon'])) continue; ?>
					<?php 
					$re = "/[a-z]+(.png)/"; 
					$str = $s['icon']; 
									 
					preg_match($re, $str, $matches);
					$d = str_replace(".png","",$matches[0]);
					$d= "icon-".$d; ?>

					<li><a class="social_icons" href="<?php echo esc_url($s['url']); ?>" target="_blank"><span class="icon <?php echo esc_attr($d); ?>"></span></a></li>
				<?php } ?>
				</ul>
			<?php } ?>
		</div><!-- /footer.main -->
	</footer>
	<?php } ?>
</div><!-- /.wrapBox -->
</div><!-- /.wrap -->






<?php 
require(get_template_directory() . '/templates/page-part-login.php');
require(get_template_directory() . '/templates/page-part-js-messages.php');
require(get_template_directory() . '/templates/page-part-customizer.php');
wp_footer(); 
?>
<!-- Google Code for Rock group -->
<!-- Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. For instructions on adding this tag and more information on the above requirements, read the setup guide: google.com/ads/remarketingsetup -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 970001310;
var google_conversion_label = "B_-rCK3tzlkQnpfEzgM";
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/970001310/?value=1.00&amp;currency_code=UAH&amp;label=B_-rCK3tzlkQnpfEzgM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>
