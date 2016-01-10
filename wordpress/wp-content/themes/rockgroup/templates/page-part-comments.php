<?php


	
//===================================== Comments =====================================
if (get_custom_option("show_post_comments") == 'yes') {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		themerex_enqueue_script( 'comment-reply', false, array(), null, true );
		themerex_enqueue_script( 'form-comments', get_template_directory_uri() . '/js/_form_comments.js', array(), null, true );
	}
	if ( comments_open() || get_comments_number() != 0 ) {
		comments_template();
	}
}
?>
