// global jQuery:false 

var THEMEREX_ADMIN_MODE    = false;
var THEMEREX_error_msg_box = null;
var THEMEREX_VIEWMORE_BUSY = false;
var THEMEREX_REMEMBERSCROLL = 0;
var THEMEREX_isotopeInitCounter = 0;
var THEMEREX_isotopeItemRow = 0;
var THEMEREX_isotopeMemoryID = '';
var THEMEREX_isotopeFilter = '*';


jQuery(document).ready(function () {
	"use strict";
	timelineResponsive()
	ready();
	itemPageFull();
	scrollAction();
	fullSlider();

	ResponsiveChart();
	FloatCenter();
	ResponsiveRock();
	ResponsiveRelatedPosts();
	ResopnsiveGalleryItem();
	MoreButton();
	responsiveMenu();
	responsiveCountdown();

});

jQuery(window).resize(function () {
	"use strict";
	itemPageFull();
	timelineResponsive();
	fullSlider();
	scrollAction();

	ResponsiveChart();
	FloatCenter();
	ResponsiveRock();
	ResponsiveRelatedPosts();
	responsiveMenu();
	menuItemIndent();
	responsiveCountdown();

});
jQuery(window).smartresize(function() {
	mobileMenuShow();
})
jQuery(window).scroll(function () {
	"use strict";
	scrollAction();
	responsiveMenu();
	menuItemIndent();
	//post init
});

jQuery(window).load(function () {
	ResponsiveMenuItem();  //newMenu

	setTimeout(function(){
		if (jQuery('.isotopeWrap').length > 0) { 
				jQuery('.isotopeWrap').css('opacity', '1');
				var isotopeWrap = jQuery('.isotopeWrap');
				var isotopeItem = isotopeWrap.find('.isotopeItem');
				var isotopeWrapWidth = isotopeWrap.width();
				var isotopeItemWidth = isotopeWrap.data('foliosize');

					"use strict";
					isotopeItem.css('width', Math.floor(isotopeWrap.width() / Math.floor(isotopeWrap.width() / isotopeItemWidth)));
					isotopeWrap.isotope({
						masonry: {
							columnWidth: Math.floor(isotopeWrap.width() / Math.floor(isotopeWrap.width() / isotopeItemWidth))
						}
					});
					isotopeRow(isotopeWrap,isotopeItem);
		}
	}, 100);

});


function ready() {
	"use strict";
	
	//header bottom 
	if(jQuery('.wrapBox').find('.subCategory').length > 0) jQuery('.wrapBox').find('#header').css('padding-bottom', '25px');


	//isotope
	jQuery('.isotopeWrap').css('opacity', '0');

	//textarea Autosize
	if (jQuery('textarea.textAreaSize').length > 0) {
		jQuery('textarea.textAreaSize').autosize({
			append: "\n"
		});
	}

	// Share button
	if (jQuery('.shareDrop').length > 0) {

		jQuery('.postSharing .postShare').click(function(){
			if(jQuery(this).hasClass('active'))
			{
				jQuery(this).find('.share-social').hide();
				jQuery(this).removeClass('active');
			}
			else {
				jQuery(this).find('.share-social').show();
				jQuery(this).addClass('active');
			}
			return false;
		});

		jQuery(document).click(function (e) {
			"use strict";
			jQuery('.postSharing .postShare .share-social').hide();
			jQuery('.postSharing .postShare.active').removeClass('active');
		});
	}

	// Like button
	jQuery('.postSharing, .masonryMore').on('click', '.likeButton', function(e) {

		var button = jQuery(this);
		var post_id = button.data('postid');
		var likes = 0;
		var grecko_likes = jQuery.cookie('grecko_likes');

		if (grecko_likes === undefined) grecko_likes = '0';
		if (grecko_likes.indexOf(post_id) < 1)  likes = Number(button.data('likes'))+1;
		if (grecko_likes.indexOf(post_id) > -1)  likes = Number(button.data('likes'))-1;

		jQuery.post(THEMEREX_ajax_url, {
			action: 'post_counter',
			nonce: THEMEREX_ajax_nonce,
			post_id: post_id,
			likes: likes
		}).done(function(response) {
			var rez = JSON.parse(response);
			if (rez.error === '') {

				if (grecko_likes.indexOf(post_id) < 1) {
					var title = button.data('title-dislike');
					button.removeClass('like').addClass('likeActive');
					grecko_likes += (grecko_likes.substr(-1) != '*' ? '*' : '') + post_id + '*';
				} else {
					var title = button.data('title-like');
					button.removeClass('likeActive').addClass('like');
					grecko_likes = grecko_likes.replace('*' + post_id + '*', '*');
				}
				button.data('likes', likes).find('a').attr('likes', title).html(likes);
				if(jQuery.cookie('grecko_likes') == '') grecko_likes = "/posts/" + grecko_likes;
				jQuery.cookie('grecko_likes', grecko_likes, {expires: 365, path: '/'});
			} else {
				themerex_message_warning(THEMEREX_MESSAGE_ERROR_LIKE);
			}
		});
		e.preventDefault();
				
				

		return false;
	});


	//hoverZoom img effect
	jQuery('.hoverIncrease').each(function () {
		"use strict";
		var img = jQuery(this).data('image');
		var title = jQuery(this).data('title');
		if (img) {
			jQuery(this).append('<span class="hoverShadow"></span><a href="'+img+'" title="'+title+'"><span class="hoverIcon"></span></a>');
		}
	});


	//hoverZoom img effect
	jQuery('.hoverIncrease').each(function () {
		"use strict";
		var img = jQuery(this).data('image');
		var title = jQuery(this).data('title');
		if (img) {
			jQuery(this).append('<span class="hoverShadow"></span><a href="'+img+'" title="'+title+'"><span class="hoverIcon"></span></a>');
		}
	});

	// ====== isotope =====================================================================
	if (jQuery('.isotopeWrap').length > 0) {

		isotopeFilterClass( '*' );

		var isotopeWrap = jQuery('.isotopeWrap');
		var isotopeItem = isotopeWrap.find('.isotopeItem'); 
		var isotopeWrapWidth = isotopeWrap.width();
		var isotopeItemWidth = isotopeWrap.data('foliosize');

		isotopeItem.css('width',Math.floor(isotopeWrap.width() / Math.floor(isotopeWrap.width() / isotopeItemWidth)));

		//isotope
		isotopeWrap.isotope({
			resizable: false,
			filter: THEMEREX_isotopeFilter,
			masonry: {
				columnWidth: Math.floor(isotopeWrap.width() / Math.floor(isotopeWrap.width() / isotopeItemWidth))
			},
			itemSelector: '.isotopeItem',
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}
		});

		isotopeRow(isotopeWrap,isotopeItem);

		setTimeout(function(){
			isotoreEffect()
		}, 200);


		isotopeResize(isotopeWrap,isotopeItem);

		//isotope Full post 
		isotopeWrap.on( 'click', 'article.isotopeItem', function(e) {
			//isotopeAjaxLoad( isotopeWrap, jQuery(this));

			e.preventDefault();
			var url = jQuery(this).find('.isotopeContent  .isotopeTitle a').attr('href');
			window.open(url, '_blank');
		});

		//isotope navigation
		isotopeWrap.on('click', '.isotopeNav', function() {
			var nav_id = jQuery(this).data('nav-id');
			isotopeAjaxLoad( isotopeWrap, jQuery('.isotopeItem[data-postid="'+nav_id+'"]') );
		});


		//isotope Fullpost closed 
		isotopeWrap.on('click', '.fullItemClosed', function(){
			isotopeRemove( isotopeWrap, jQuery(this).parent('.fullItemWrap'));
		});


		//isotope filtre
		jQuery('.isotopeFiltr li a').click(function () {
			"use strict";

			isotopeRemove( isotopeWrap, isotopeWrap.find('.fullItemWrap') );

			jQuery('.isotopeFiltr li').removeClass('active');
			jQuery(this).parent().addClass('active');
	
			var selectorFilter = jQuery(this).attr('data-filter');

			isotopeFilterClass( selectorFilter );

			isotopeWrap.isotope({
				itemSelector: '.isotopeItem',
				filter: selectorFilter,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			}).isotope( 'on', 'layoutComplete', function() {
				isotopeRow(isotopeWrap, isotopeItem);
			});


			THEMEREX_isotopeFilter = selectorFilter;
			return false;
		});

		
	}

	// main Slider
	if (jQuery('.sliderBullets, .sliderHeader').length > 0) { 
		if (jQuery.rsCSS3Easing!=undefined && jQuery.rsCSS3Easing!=null) {
			jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
		}
		jQuery('.sliderHeader').slideDown(2000, function () {
			"use strict";
			initShortcodes(jQuery(this));
		});
	}


	// ====================================================================================
	// Page Navigation
	jQuery(document).click(function () {
		"use strict";
		jQuery('.pageFocusBlock').slideUp();
	});
	jQuery('.pageFocusBlock').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});
	jQuery('.navInput').click(function (e) {
		"use strict";
		jQuery('.pageFocusBlock').slideDown();
		e.preventDefault();
		return false;
	});


	// topMenu DROP superfish
	jQuery('.topMenu ul, .usermenuArea ul').superfish({
		delay: 500,
		animation: {
			opacity: 'show',
			height: 'show'
		},
		animationOut:{
			opacity: 'hide',
			height: 'hide'	
		},
		speed: 'fast',
		autoArrows: false,
		dropShadows: false
	});



	// top menu animation
	jQuery(document).click(function () {
		"use strict";
		jQuery('.hideMenuDisplay #header').removeClass('topMenuShow');
	});
	jQuery('.hideMenuDisplay .wrapTopMenu').click(function (e) {
		"use strict";
		e.stopPropagation();
	});
	jQuery('.hideMenuDisplay .openTopMenu').click(function (e) {
		"use strict";
		e.stopPropagation();
		jQuery(this).parent().toggleClass('topMenuShow');
		return false;
	});





	// Sidemenu DROP
	jQuery('.sidemenu_area > ul > li.dropMenu ').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});
	jQuery('.sidemenu_area > ul > li.dropMenu, .sidemenu_area > ul > li.dropMenu li').click(function (e) {
		"use strict";
		initScroll('sidemenu_scroll');
		jQuery(this).toggleClass('dropOpen');
		jQuery(this).find('ul').first().slideToggle();
		e.preventDefault();
		return false;
	});

	jQuery('#sidemenu_scroll a').click(function (e) {
		"use strict";
		initScroll('sidemenu_scroll');
		jQuery('#sidemenu_scroll').mCustomScrollbar("update");
		e.preventDefault();
		return false;
	});

	jQuery(document).click(function (e) {
		"use strict";
		jQuery('body').removeClass('openMenuFixRight openMenuFix');
		jQuery('.sidemenu_overflow').fadeOut(400);
	//	jQuery('body').attr('style', '');;

	});
	jQuery('.sidemenu_wrap.swpLeftPos, .swpRightPos, .openRightMenu').click(function (e) {
		"use strict";
		e.preventDefault();
		return false;
	});

	jQuery('.sidemenu_wrap .sidemenu_button').click(function (e) {
		"use strict";
		jQuery('body').addClass('openMenuFix');
		if (jQuery('.sidemenu_overflow').length == 0) {
			jQuery('body').append('<div class="sidemenu_overflow"></div>')
		}
		jQuery('.sidemenu_overflow').fadeIn(400);
		jQuery('body').css('overflow','hidden');
		e.preventDefault();
		return false;
	});

	jQuery('.openRightMenu').click(function (e) {
		"use strict";
		jQuery('body').addClass('openMenuFixRight');
		if (jQuery('.sidemenu_overflow').length == 0) {
			jQuery('body').append('<div class="sidemenu_overflow"></div>')
		}
		jQuery('.sidemenu_overflow').fadeIn(400);
		jQuery('body').css('overflow','hidden');
		e.preventDefault();
		return false;
	});


	//Hover DIR
	jQuery(' .portfolio > .isotopeItem > .hoverDirShow').each(function () {
		"use strict";
		jQuery(this).hoverdir();
	});


	//Portfolio item Description
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		jQuery('.toggleButton').show();
		jQuery('.itemDescriptionWrap,.toggleButton').click(function (e) {
			"use strict";
			jQuery(this).toggleClass('descriptionShow');
			jQuery(this).find('.toggleDescription').slideToggle();
			e.preventDefault();
			return false;
		});
	} else {
		jQuery('.itemDescriptionWrap').hover(function () {
			"use strict";
			jQuery(this).toggleClass('descriptionShow');
			jQuery(this).find('.toggleDescription').slideToggle();
		})
	}





	jQuery('input[type="text"], input[type="password"], input[type="search"], textarea').focus(function () {
			"use strict";
			jQuery(this).attr('data-placeholder', jQuery(this).attr('placeholder')).attr('placeholder', '')
			jQuery(this).parent('li').addClass('iconFocus');
		})
		.blur(function () {
			"use strict";
			jQuery(this).attr('placeholder', jQuery(this).attr('data-placeholder'))
			jQuery(this).parent('li').removeClass('iconFocus');
		});

	//responsive Show menu
	jQuery('.openMobileMenu').click(function(e){
		"use strict";
		var ul = jQuery('.wrapTopMenu .topMenu > ul');
		ul.slideToggle();
		jQuery(this).parents('.menuFixedWrap').toggleClass('menuMobileShow');
		e.preventDefault();
		return false;
	});


	// IFRAME width and height constrain proportions 
	if (jQuery('iframe').length > 0) {
		jQuery(window).resize(function() {
			"use strict";
			videoDimensions();
		});
		videoDimensions();
	}

	// Hide empty pagination
	if (jQuery('#nav_pages > ul > li').length < 3) {
		jQuery('#nav_pages').remove();
	} else {
		jQuery('.theme_paginaton a').addClass('theme_button');
	}

	// View More button
	jQuery('#viewmore_link').click(function(e) {
		"use strict";
		if (!THEMEREX_VIEWMORE_BUSY) {
			jQuery(this).addClass('loading');
			THEMEREX_VIEWMORE_BUSY = true;
			jQuery.post(THEMEREX_ajax_url, {
				action: 'view_more_posts',
				nonce: THEMEREX_ajax_nonce,
				page: THEMEREX_VIEWMORE_PAGE+1,
				data: THEMEREX_VIEWMORE_DATA,
				vars: THEMEREX_VIEWMORE_VARS
			}).done(function(response) {
				"use strict";
				var rez = JSON.parse(response);
				jQuery('#viewmore_link').removeClass('loading');
				THEMEREX_VIEWMORE_BUSY = false;
				if (rez.error === '') {


					var posts_container = jQuery('.content').eq(0);
					if (posts_container.find('section.isotopeWrap').length > 0)	posts_container = posts_container.find('section.isotopeWrap').eq(0);

					if (posts_container.hasClass('isotopeWrap')) {
						posts_container.append(rez.data);
						THEMEREX_isotopeInitCounter = 0;
						initAppendedIsotope(posts_container, rez.filters);
					} else {
						jQuery('.ajaxContainer').append(rez.data);
					}

					initPostFormats();
					THEMEREX_VIEWMORE_PAGE++;
					if (rez.no_more_data==1) {
						jQuery('#viewmore_link').hide();
					}
					if (jQuery('#nav_pages ul li').length >= THEMEREX_VIEWMORE_PAGE) {
						jQuery('#nav_pages ul li').eq(THEMEREX_VIEWMORE_PAGE).toggleClass('pager_current', true);
					}
				}
			});
		}
		e.preventDefault();
		return false;
	});

	// Infinite pagination
	if (jQuery('#viewmore_link.pagination_infinite').length > 0) {
		jQuery(window).scroll(infiniteScroll);
	}

	jQuery('.postBox .postBoxItem .postThumb').each(function(){
		var w = jQuery(this).width();
		jQuery(this).height(w);
	});

	jQuery('.postBox .postBoxItem .postThumb img').each(function(){
	 	if(jQuery(this).height() < jQuery(this).width())
	 		jQuery(this).css({'width': 'auto', 'height': '100%', 'max-width': '500%'});
	});

	jQuery('.sc_gallery .sc_gallery_item .sc_gallery_info_wrap').each(function(){
		var h = jQuery(this).parent().height();
		jQuery(this).height(h);
	});

	//chart diagram height
	jQuery('.sc_chart_diagram ').each(function(){
		var pHeight = jQuery(this).height();
		jQuery(this).attr('data-height', pHeight);
	});

	//sc_content 
	jQuery('.sc_content ').each(function(){
		if(!jQuery(this).parent().hasClass('sc_section')) jQuery(this).addClass('sc_padding');
	});

	initPostFormats();

	jQuery('#main_inner.clearboth.blog_style_fullpost').each(function(){
		if(jQuery(this).parent().find('#sidebar_main').length > 0){
			var sidebar = jQuery(this).parent().find('#sidebar_main');
			jQuery(this).parents('#wrapWide').append(sidebar);
		}
	});

	jQuery('.wrapContent > #sidebar_main').each(function(){
		var sidebar = jQuery(this);
		jQuery('#wrapWide').append(sidebar);
	});

	jQuery('.woocommerce  ul.products li.product h3').each(function(){
		var title = jQuery(this).html();
		if(jQuery(this).html().length > 20) 
			title = title.substr(0, 20) + '..';
		jQuery(this).html(title);
	});

	// Scroll to top
	jQuery('.buttonScrollUp').click(function(e) {
		"use strict";
		jQuery('html,body').animate({
			scrollTop: 0
		}, 'slow');
		e.preventDefault();
		return false;
	});

	//section padding when body has class Boxed
	jQuery('.bodyStyleBoxed.sideBarHide .postContent .sc_section').each(function(){
		if(jQuery(this).parents('.sc_section').length <= 0 && jQuery(this).parents('.post').length <= 0 && !jQuery(this).find('> .sc_wave').length) jQuery(this).addClass('sc_box_padding');
	});

	//out of stock
	jQuery('article .product.type-product.outofstock').each(function()
	{
		jQuery(this).append('<span class="onsale">out of stock</span>');
	});

	//comments
	jQuery('.sideBarWide .postSharing .postShare').each(function()
	{
		jQuery(this).parent().append(this);
	})

	if(jQuery('ul#recentcomments').length > 1)
	{
		jQuery('ul#recentcomments').each(function(){
			var x = 'recentcomments' + Math.floor((Math.random() * 100) + 1);
			jQuery(this).attr('id', '');
		});
	}
}; //end ready




// Fit video frame to document width
function videoDimensions() {
	jQuery('iframe').each(function() {
		"use strict";
		var iframe = jQuery(this).eq(0);
		var w_attr = iframe.attr('width');
		var h_attr = iframe.attr('height');
		if (!w_attr || !h_attr) {
			return;
		}
		var w_real = iframe.width();
		if (w_real!=w_attr) {
			var h_real = Math.round(w_real/w_attr*h_attr);
			iframe.height(h_real);
		}
	});
}

function initPostFormats() {
	"use strict";

	// MediaElement init
	if (THEMEREX_useMediaElement) {

		if (jQuery('audio').length > 0) {
			jQuery('audio').each(function () {
				if (jQuery(this).hasClass('inited')) return;
				jQuery(this).addClass('inited').mediaelementplayer({
					audioWidth: '100%',	// width of audio player
					audioHeight: 30,	// height of audio player
					success: function (mediaElement, domObject) { 
						jQuery(domObject).parents('.sc_audio').addClass('sc_audio_show');
					},
				});
			});
		}

		jQuery('video:not(.videoBackground)').each(function () {
			if (jQuery(this).hasClass('inited')) return;
			jQuery(this).addClass('inited').mediaelementplayer({
				videoWidth: -1,		// if set, overrides <video width>
				videoHeight: -1,	// if set, overrides <video height>
				audioWidth: '100%',	// width of audio player
				audioHeight: 30	// height of audio player
			});
		});


	} else {
		jQuery('.sc_audio').addClass('sc_audio_show');
	}

	// Popup init image
	jQuery("a[href$='jpg'],a[href$='jpeg'],a[href$='png'],a[href$='gif']").attr('rel', 'magnific');
	jQuery("a[rel*='magnific']:not(.inited)").addClass('inited').attr('data-effect',THEMEREX_MAGNIFIC_EFFECT_OPEN).magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: true,
		fixedContentPos: true,
		removalDelay: 500, 
		midClick: true,
		preloader: true,
		gallery:{
    		enabled:true
  		},
		tLoading: '<span></span>',
		image: {
			tError: THEMEREX_MAGNIFIC_ERROR,
			verticalFit: true,
		},
		callbacks: {
			beforeOpen: function() {
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		}
	});
	// Popup init video
	jQuery("a[href*='youtube'],a[href*='vimeo']").attr('rel', 'magnific-video');
	jQuery("a[rel*='magnific-video']:not(.inited)").addClass('inited').attr('data-effect',THEMEREX_MAGNIFIC_EFFECT_OPEN).magnificPopup({
		type: 'iframe',
		closeOnContentClick: true,
		closeBtnInside: true,
		fixedContentPos: true,
		removalDelay: 500, 
		midClick: true,
		preloader: true,
		callbacks:{
			open: function() {
				//open function
    		},
    		close: function() {
    			//close function
    		}
		}
	});



	// Popup windows with any html content
	jQuery('.user-popup-link:not(.inited)').addClass('inited').magnificPopup({
			type: 'inline',
			removalDelay: 500,
			callbacks: {
				beforeOpen: function () {
					this.st.mainClass = 'mfp-zoom-in';
					initShortcodes(jQuery('.sc_popup'));
				},
				open: function () {
					jQuery('html').css({
						overflow: 'visible',
						margin: 0
					});
				},
				close: function () {
				}
			},
			midClick: true
		});


	// Add video on thumb click
	jQuery('.sc_video_frame').each(function () {
		"use strict";
		if (jQuery(this).hasClass('sc_inited')) return;
		if (jQuery(this).hasClass('sc_video_frame_auto_play')){
			scVideoAutoplay(jQuery(this));
		}
		jQuery(this).addClass('sc_inited').click(function (e) {
			"use strict";
			scVideoAutoplay(jQuery(this));
			e.preventDefault();
		});
	});
	jQuery('.sc_video_frame').hover(function() {
		jQuery(this).find('.sc_video_frame_player_title').slideDown(400);
	}, function() {
		jQuery(this).find('.sc_video_frame_player_title').slideUp(400);
	});
	function scVideoAutoplay($videoObject) {
		var video = $videoObject.data('videoframe');
		if (video!=='' && !$videoObject.hasClass('sc_video_active')) {
			$videoObject.addClass('sc_video_active');
			$videoObject.empty().html(video);
			videoDimensions();
		}
		return false;
	}

	//hover Underline effect
	jQuery('.hoverUnderline').each(function() {
		jQuery(this).find('a').each(function() {
			jQuery(this).append('<span class="hoverLine"></span>');
		});
	});

}

//mobile menu init, resize
function mobileMenuShow() {
	"use strict";
	if( THEMEREX_RESPONSIVE_MENU < jQuery(window).width()){
		jQuery('.wrapTopMenu .topMenu > ul').removeAttr('style');
	}
}

// Infinite Scroll 
function infiniteScroll() {
	"use strict";
	var v = jQuery('#viewmore_link.pagination_infinite').offset();
	if (jQuery(this).scrollTop() + jQuery(this).height() + 100 >= v.top && !THEMEREX_VIEWMORE_BUSY) {
		jQuery('#viewmore_link').eq(0).trigger('click');
	}
}

//itemPageFull
function itemPageFull() {
	"use strict";
	var bodyHeight = jQuery(window).height();
	jQuery('.itemPageFull').css('height', bodyHeight - jQuery('.topWrap').height());
	jQuery('#sidemenu_scroll').css('height', bodyHeight);
}


//init scroll
function initScroll(idScroll) {
	"use strict";

	if (!jQuery('#' + idScroll).hasClass("scrollInit")) {
		jQuery('#' + idScroll).addClass('scrollInit').mCustomScrollbar({
			scrollButtons: {
				enable: false
			},
		});

		jQuery('.scrollPositionAction > .roundButton').click(function (e) {
			"use strict";
			var scrollAction = jQuery(this).data('scroll');
			jQuery('#' + idScroll).mCustomScrollbar("scrollTo", scrollAction);
			e.preventDefault();
			return false;
		});

	}
}

//scroll Action
function scrollAction() {
	"use strict";
	var head = jQuery('header');
	var buttonScrollTop = jQuery('.upToScroll');
	var scrollPos = jQuery(window).scrollTop();
	var headHeight = jQuery(window).height();
	var topMemuHeight = head.height();
	var x = jQuery('body').data('menu');
	var menuMinWidth = jQuery(window).width() > x;
	var topWrapHeight = 0;

	//fixed menu
	if (scrollPos < topMemuHeight / 1.5 && menuMinWidth) {
			head.removeClass('fixedTopMenuShow');
			jQuery('.topMenu .logo').removeClass('fixedLogo');
	} 
	else if (scrollPos >= topMemuHeight / 1.5 && menuMinWidth) {
			head.addClass('fixedTopMenuShow');
			//smartScroll
			if (THEMEREX_REMEMBERSCROLL < scrollPos)
			{ 
				//scroll up
	    		//head.removeClass('smartScrollDown');
	    	//	jQuery('.menuFixedWrap').height(menuMinWidth);
	    	//	setTimeout(function(){ jQuery('.topMenu .logo').removeClass('fixedLogo'); }, 300);
	    	head.addClass('smartScrollDown');
	    	   	jQuery('.topMenu .logo').addClass('fixedLogo');
			} 
			else if (THEMEREX_REMEMBERSCROLL > scrollPos)
			{
				//scroll down
	         	head.addClass('smartScrollDown');
	    	   	jQuery('.topMenu .logo').addClass('fixedLogo');
			}
			
	}
	//button UP 
	if(jQuery('.footerWidget').length > 0) topWrapHeight = jQuery('.footerWidget').offset().top - jQuery(window).scrollTop();
	else if (jQuery('.footer').length > 0) topWrapHeight = jQuery('.footer').offset().top - jQuery(window).scrollTop();

	if (scrollPos > topWrapHeight) {
		buttonScrollTop.addClass('buttonShow');
	} else {
		buttonScrollTop.removeClass('buttonShow');
	}
	
	THEMEREX_REMEMBERSCROLL = scrollPos;

	if(jQuery('.post:not(.vis)').length > 0 && ! jQuery('body').hasClass('single'))
	{
		var scroll_top = jQuery(window).scrollTop();
	    var w_height = jQuery(window).height();
	    var total = w_height + scroll_top;
	    jQuery('.post').each(function () {
	        if (!jQuery(this).hasClass('vis')) {
	            if (jQuery(this).offset().top <= total) {
	                jQuery(this).addClass('vis');
	            }
	        }
	    });
	}
}

function responsiveMenu(){
	var x = jQuery('body').data('menu');
	if(jQuery(window).width() < x){
		jQuery('.menuSmartScrollShow.menuStyleFixed #header.fixedTopMenuShow .menuFixedWrap').css({'box-shadow': 'none', 'height': 'auto'});
	}
	var y = jQuery('.topMenu').height();
	var z = jQuery('.topMenu .newMenu').height();
	var t = (y - z) / 2;
	jQuery('.topMenu .newMenu').css('margin-top', t);
}

function fullSlider() {
	"use strict";
	if (jQuery('.fullScreenSlider').length > 0) {
		jQuery('.sliderHeader, .sliderHeader .rsContent').css('height', jQuery(window).height())
	}
}


//Time Line
function timelineResponsive() {
	"use strict";
	var bodyHeight = jQuery(window).height();
	var headHeight = jQuery(window).height() - jQuery('.contentTimeLine h2').height() - 150;
	var leftPosition = (jQuery('.main_content').width() - jQuery('.main').width()) / 2 + jQuery('.sidemenu_wrap').width();
	jQuery('.TimeLineScroll .tlContentScroll').css('height', headHeight);

}

//============= isotope function ============

//isotope effect
function isotoreEffect(){
	"use strict";
	var isotopeWrap = jQuery('.isotopeWrap ');
	isotopeWrap.find('.isotopeItem:not(.isotopeItemShow)').addClass('isotopeItemShow');
}


// isotope rows
function isotopeRow(itemWrap,item){
	"use strict";
	var isotopeWrap = itemWrap;
	var isotopeItem = itemWrap.find('.isotopeItem:not(:hidden)');
	var i = 0;
	var positionCounter = 1;
	var items_sum = 0;
	var row_num = 1;
	var positionCounterArr = [];
	var isotope_width = isotopeWrap.width()

	item.removeClass('itemFirst itemLast').removeAttr('data-row-num');
	isotopeItem.filter(':last').addClass('itemLast');

	while(i < isotopeItem.length) {
		if(items_sum + isotopeItem.eq(i).width() > isotope_width) {
			row_num++;
			items_sum = 0;
		}
		items_sum = items_sum + isotopeItem.eq(i).width();
		if( items_sum == isotopeItem.eq(i).width() ){
			isotopeItem.eq(i).addClass('itemFirst');
			} else if( isotope_width - items_sum <= 3){
				isotopeItem.eq(i).addClass('itemLast');
		}
		isotopeItem.eq(i).attr('data-row-num', row_num);
		i++;
		positionCounterArr[row_num] = items_sum;
	}
}

//scrolling
function isotopeScrolling(item){
	"use strict";
	setTimeout(function(){
		jQuery('html,body').animate({ scrollTop: item.offset().top + item.height()-100}, 'slow' );
	}, 1700);
}

//isotope Ajax Load
function isotopeAjaxLoad(itemWrap,item){
	"use strict";
	var itemRow = item.data('row-num');
	var istPostID = item.data('postid');
	var navFirstID = item.parent('.isotopeWrap').find('article.isotopeItem:visible:first').data('postid');
	var navLastID = item.parent('.isotopeWrap').find('article.isotopeItem:visible:last').data('postid');
	var navPrevID = item.prevAll('article.isotopeItem:visible').data('postid');
	var navNextID = item.nextAll('article.isotopeItem:visible').data('postid');
	var isoFilter = THEMEREX_isotopeFilter.replace('.','').replace('*',''); 
	

	if ( item.hasClass('isotopeActive') ) {
		return;
	}

	jQuery('.isotopeItem[data-postid="'+THEMEREX_isotopeMemoryID+'"]').removeClass('isotopeActive')
	jQuery('.isotopeItem[data-postid="'+istPostID+'"]').addClass('isotopeActive');

	var itemContent = jQuery('<div class="fullItemWrap isotopeItem sc_loader_show '+isoFilter+'" data-postid="'+istPostID+'"><span class="fullItemClosed icon-cancel-line" title="Closed"></span><div class="fullContent"></div></div>');

	if(THEMEREX_isotopeItemRow == itemRow && jQuery('.fullItemWrap').length>0 ){
		jQuery('.fullItemWrap .fullContent').removeClass('ajaxShow').data('postid', istPostID);
	} else {
		isotopeRemove( itemWrap, itemWrap.find('.fullItemWrap'))
		THEMEREX_isotopeItemRow = 0;
		//console.log( itemRow );
		jQuery('.isotopeItem[data-row-num="'+itemRow+'"].itemLast').after( itemContent );  
	
		itemWrap.isotope('destroy').isotope({
			itemSelector: '.isotopeItem',
			filter: THEMEREX_isotopeFilter,
			animationOptions: {
				duration: 750,
				easing: 'linear',
				queue: false
			}

		}).isotope( 'on', 'layoutComplete', function() {
				//function complete
		});
	}

	//add effect
	setTimeout(function(){
		isotoreEffect();
	}, 500);
	isotopeScrolling( item )
			
	//load content 
	jQuery.post(THEMEREX_ajax_url, {
		action: 'isotope_content',
		nonce: THEMEREX_ajax_nonce,
		postID: istPostID,
	}).done(function(response) {
		"use strict";
		var rez = JSON.parse(response);
		jQuery('.fullItemWrap .fullContent').html( (rez != '' ? rez.data : THEMEREX_SEND_ERROR )).addClass('ajaxShow');
		initShortcodes(jQuery('.fullItemWrap'));
		initPostFormats();

		//nav prev
		jQuery('.isotopeNav.isoPrev').data('nav-id', (navPrevID != undefined ? navPrevID : navLastID));
		jQuery('.isotopeNav.isoNext').data('nav-id', (navNextID != undefined ? navNextID : navFirstID));

		THEMEREX_isotopeInitCounter = 0;
		initRelayoutIsotope(jQuery('.fullItemWrap .fullContent'));
	});


	THEMEREX_isotopeItemRow = itemRow;
	THEMEREX_isotopeMemoryID = istPostID;

	return false;
}


function isotopeFilterClass(selector){
	"use strict";

	jQuery('.isotopeWrap .isotopeItem').removeClass('isotopeVisible').each(function() {
		if( selector == '*' ){ 
			jQuery(this).addClass('isotopeVisible');
		} else {
			jQuery(selector).addClass('isotopeVisible');
		}
	});
}


//isotope remove
function isotopeRemove(itemWrap,item) {
	"use strict";

	var isotopeWrap = itemWrap;
	isotopeWrap.find('.isotopeItem[data-postid="'+THEMEREX_isotopeMemoryID+'"]').removeClass('isotopeActive')
	isotopeWrap.isotope('remove', item).isotope('layout');
}

//isotope Images Complete
function initRelayoutIsotope(content){
	"use strict";
	if (!isotopeImagesComplete(content) && THEMEREX_isotopeInitCounter++ < 30) {
			setTimeout(function() { initRelayoutIsotope(content); }, 200);
			return;
	}
	jQuery('.isotopeWrap').isotope('layout');
}

//init Appended Isotope
function initAppendedIsotope(isotopeWrap, filters) {
	"use strict";
	if (!isotopeImagesComplete(isotopeWrap) && THEMEREX_isotopeInitCounter++ < 30) {
		setTimeout(function() { initAppendedIsotope(isotopeWrap, filters); }, 200);
		return;
	}
	var flt = isotopeWrap.siblings('.isotopeFiltr');
	var item = isotopeWrap.find('.isotopeItem:not(.isotopeItemShow)').addClass('isotopeItemShow');
	var isotopeWrapWidth = isotopeWrap.width();
	var isotopeItemWidth = isotopeWrap.data('foliosize');

	item.css('width',Math.floor(isotopeWrap.width() / Math.floor(isotopeWrap.width() / isotopeItemWidth)));

	isotopeRow(isotopeWrap,isotopeWrap.find('isotopeItem'))

	isotopeWrap.isotope('appended', item);
	for (var i in filters) {
		if (flt.find('a[data-filter=".flt_'+i+'"]').length == 0) {
			flt.find('ul').append('<li><a href="#" data-filter=".flt_'+i+'">'+filters[i]+'</a></li>');
		}
	}
}

//isotope Images Complete
function isotopeImagesComplete(content) {
	"use strict";

	var complete = true;
	content.find('img').each(function() {
		if (!complete) return;
		if (!jQuery(this).get(0).complete) complete = false;
	});
	return complete;
}

//isotope resize
function isotopeResize(itemWrap,item){
	"use strict";

	var isotopeWrap = itemWrap;
	var isotopeItem = item;
	var isotopeWrapWidth = isotopeWrap.width();
	var isotopeItemWidth = isotopeWrap.data('foliosize');

	jQuery(window).smartresize(function () {
		"use strict";
		isotopeItem.css('width', Math.floor(isotopeWrap.width() / Math.floor(isotopeWrap.width() / isotopeItemWidth)));
		isotopeWrap.isotope({
			masonry: {
				columnWidth: Math.floor(isotopeWrap.width() / Math.floor(isotopeWrap.width() / isotopeItemWidth))
			}
		});
		isotopeRow(isotopeWrap,isotopeItem);
	}); 
}


function ResponsiveChart(){
	jQuery('.sc_chart_diagram ').each(function(){
		var pWidth = jQuery(this).parent().width();
		var cWidth = jQuery(this).find('.sc_chart_data').width();
		var pHeight = jQuery(this).attr('data-height'); //the real height
		var legend = cWidth * 0.25;
		var nL = jQuery(this).find('.sc_chart_legend').length; 
		var marginL = (pWidth - cWidth - legend) / 2 * 0.6;
		var marginT =   (pHeight - pHeight * 0.6) / (-2);

		if( nL == 0) cWidth = cWidth + legend;
		if(cWidth > pWidth)
		{
			pHeight = pHeight * 0.6;
			
			jQuery(this).css('height', pHeight);
			jQuery(this).find('.sc_chart_data').css({'transform': 'scale(0.6)', 'margin-top': marginT, 'margin-left': marginL});
		}
		else
		{
			jQuery(this).css('height', pHeight);
			jQuery(this).find('.sc_chart_data').css({'transform': 'scale(1)', 'margin-top': 0, 'margin-left': 0});
		}
	});
}


function FloatCenter(){
	jQuery('.sc_float_center').parent().each(function(){
		var width = jQuery(this).width();
		var N = jQuery(this).find('.sc_float_center').length - 1;
		var S = 0;

		jQuery(this).css('text-align', 'center');
		jQuery(this).find('.sc_float_center').each(function(){
			S = S + jQuery(this).width();
		});
		var M = (width - S) / N - 1;
		if(M < 30) M = 30;
		jQuery(this).find('.sc_float_center').css('margin-right', M);
		jQuery(this).find('.sc_float_center:last-child').css('margin-right', 0);
	});
}

function ResponsiveRock(){
	jQuery('.sc_rocks_inner').each(function(){
		var pWidth = jQuery(this).parent().width(); //260
		var cWidth = jQuery(this).width(); //300
		var count = jQuery(this).find('.sc_rocks_row').length; //50
		var shadow = pWidth/count;
		var margin = (pWidth - cWidth * 0.7 ) / (-2);

		if(cWidth > pWidth) jQuery(this).css({'transform': 'scale(0.7)', 'margin-left': margin});
		else jQuery(this).css({'transform': 'scale(1)', 'margin-left': 0});
	});

}

function ResponsiveRelatedPosts(){
	jQuery('.related  .postBoxItem').each(function(){
		jQuery(this).height(jQuery(this).width());
		jQuery(this).find('.postThumb').height(jQuery(this).width());
	});
}

function ResopnsiveGalleryItem(){

	jQuery('.gallery .gallery-item').mouseover(function(){ 
		var h = jQuery(this).height();
		if(h > 298 ) jQuery(this).find('.gallery-caption h4').css({'font-size': '18px', 'line-height': '26px'});
		if(h <= 298  && h > 250) jQuery(this).find('.gallery-caption h4').css({'font-size': '16px', 'line-height': '24px'});
		if(h <= 250  && h > 200) jQuery(this).find('.gallery-caption h4').css({'font-size': '14px', 'line-height': '20px'});
		if(h <= 200  && h > 150) jQuery(this).find('.gallery-caption h4').css({'font-size': '12px', 'line-height': '16px'});
		if(h <= 150  && h > 100) jQuery(this).find('.gallery-caption h4').css({'font-size': '10px', 'line-height': '14px'}); 
	}); 
}

function MoreButton(){
	jQuery('.sc_more').each(function(){
		var item = '#sc_section_' + jQuery(this).data('id');
		jQuery(item).css('display', 'none');

		jQuery(this).click(function(){
			if(jQuery(item).is(':visible')){
				jQuery(item).slideUp('slow','linear');
				jQuery(this).find('div').addClass('icon-down-open');
				jQuery(this).find('div').removeClass('icon-up-open');
				jQuery(this).find('span').html('more');
			}
			else{
				jQuery(item).slideDown('slow','linear');
				jQuery(this).find('div').removeClass('icon-down-open');
				jQuery(this).find('div').addClass('icon-up-open');
				jQuery(this).find('span').html('hide');

			}
		});
	});
}

function ResponsiveMenuItem(){   //newMenu
	if(jQuery('.logoHeader').length != 0 && jQuery('#wrap').hasClass('logo_center'))
	{		
			var count = jQuery('#mainmenu').find('> li.menu-item').length;
			var logo = jQuery('#mainmenu').find('> li.menu-logo').width();
			var menu_1 = '';
			var menu_2 = '';
			var logo = jQuery('.logoHeader').html();
			var x = count / 2; //3
			if((count % 2) != 0)  x = (count + 1) / 2 ; // 3
			var countFirst = x; //3
			var countSecond = countFirst + 1; //2
			//first ul item
			for(var i = 1; i <= countFirst; i++)
			{
				var item = jQuery('#mainmenu').find('> li.menu-item:nth-child(' + i + ')');
				if(jQuery(item).hasClass('menu-item'))
				{
					var html = jQuery(item).html();
					var attr = jQuery(item).attr('class');
					menu_1 = menu_1 + '<li class="' + attr + '">' +  html + '</li>';
				}
			}
			//second ul item
			for(var i = countSecond; i <= count; i++)
			{
				var item = jQuery('#mainmenu').find('> li.menu-item:nth-child(' + i + ')');
				if(jQuery(item).hasClass('menu-item'))
				{
					var html = jQuery(item).html();
					var attr = jQuery(item).attr('class');
					menu_2 = menu_2 + '<li class="' + attr + '">' +  html + '</li>';
				}
			}

			var all = jQuery('<div class=" sc_columns sc_columns_5 sc_columns_indent"><ul class="newMenu  sc_columns_item  sc_columns_item_coun_1 colspan_2 odd first">' 
							+ menu_1 + '</ul><div class="logo  sc_columns_item  sc_columns_item_coun_2 colspan_2_after even">' 
							+ logo + '</div><ul class="newMenu  sc_columns_item  sc_columns_item_coun_3 colspan_2 odd last">' + menu_2 + '</ul></div>');

			jQuery('.topMenu.main').append(all);

			jQuery('.topMenu ul.newMenu, .topMenu ul.newMenu ul').superfish({
				delay: 500,
				animation: {
					opacity: 'show',
					height: 'show'
				},
				animationOut:{
					opacity: 'hide',
					height: 'hide'	
				},
				speed: 'fast',
				autoArrows: false,
				dropShadows: false
			});
	}
	menuItemIndent()
}

function menuItemIndent(){
	//indent top
	var y = jQuery('.topMenu').height();
	var z = jQuery('.topMenu .newMenu').height();
	var t = (y - z) / 2;
	jQuery('.topMenu .newMenu').css('margin-top', t);
			
	var h = jQuery('.topMenu .logo').height();
	var j = (y - h) / 2;
	jQuery('.topMenu .logo').css('margin-top', j);

	//indent child
	jQuery('.wrapTopMenu .topMenu div > ul > li > ul, .wrapTopMenu .topMenu > ul > li > ul').each(function(){
		var x = jQuery(this).parent().width();
		var y = jQuery(this).width();
		var z = (x - y - 40) / 2;
		jQuery(this).css('margin-left', z);

	});

}

function responsiveCountdown(){
	jQuery('.sc_countdown').each(function(){
		var x = jQuery(this).width();
		if(x < 1015) jQuery(this).addClass('respons_3').removeClass('respons_4, respons_5');
		if(x < 669) jQuery(this).addClass('respons_4').removeClass('respons_5');
		if(x < 449) jQuery(this).addClass('respons_5');
	});
}