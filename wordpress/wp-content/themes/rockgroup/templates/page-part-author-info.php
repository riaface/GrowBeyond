<?php
//===================================== Post author info =====================================
if (get_custom_option("show_post_author") == 'yes') {
	$post_author_email = get_the_author_meta('user_email', $post_data['post_author_id']);
	$post_author_avatar = get_avatar($post_author_email, 50*min(2, max(1, get_theme_option("retina_ready"))));
	$post_author_descr = do_shortcode(nl2br(get_the_author_meta('description', $post_data['post_author_id'])));
	$post_author_socicon = get_custom_option('show_post_author_socicon') == true;
?>
	<section class="author vcard" itemscope itemtype="http://schema.org/Person">

		<?php if($post_author_socicon){ ?>
		<div class="authorSoc socLinks">
			<h3><?php _e('Share:','themerex') ?></h3>
			<?php showUserSocialLinks(array('author_id'=>$post_data['post_author_id'])); ?>
		</div>
		<?php } ?>

		<div class="authorInfo">
			<div class="authorAva"><a href="<?php echo esc_url($post_data['post_author_url']); ?>" itemprop="image"><?php echo balanceTags($post_author_avatar); ?></a></div>
			<div class="authorTitle hoverUnderline"><?php echo __('Written by ', 'themerex'); ?><a itemprop="name" href="<?php echo esc_url($post_data['post_author_url']); ?>"><?php echo balanceTags($post_data['post_author']); ?></a></div>
			<div class="authorDescription hoverUnderline" itemprop="description"><?php echo balanceTags($post_author_descr); ?></div>
		</div>
		
	</section>
<?php } ?>
