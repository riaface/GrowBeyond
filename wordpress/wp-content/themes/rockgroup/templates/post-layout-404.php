<?php
/*
 * The template for displaying "Page 404"
 * 
 * @package RockGroup
*/
?>
<section>
	<article>
		<div class="page404">
			<h3 class="title404"><?php _e( '404', 'themerex' ); ?></h3>
			<h3 class="subTitle404"><?php _e('This page could not be found!', 'themerex'); ?></h3>
			<p>
				<?php echo sprintf(__("Can't find what you need? Take a moment and do a search below or start from our <a href='%s'>homepage</a>.", 'themerex'), home_url(), get_bloginfo()); ?>
			</p>
		</div>
	</article>
</section>
	<?php echo do_shortcode('[rev_slider error]'); ?>

<section style="padding-bottom: 60px; background-color: <?php echo get_custom_option('theme_color'); ?> ">
	<article class="sc_content">
		<?php echo do_shortcode('[trx_search open="yes"]'); ?>
	</article>
</section>
